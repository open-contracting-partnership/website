<?php

	// allow access from all origins
	header('Access-Control-Allow-Origin: *');

	/**
	 * Twitter feed which uses twitteroauth for authentication
	 * 
	 * @version	1.0
	 * @author	Andrew Biggart
	 * @link	https://github.com/andrewbiggart/latest-tweets-php-o-auth/
	 * 
	 * Notes:
	 * Caching is employed because Twitter only allows their RSS and json feeds to be accesssed 150
	 * times an hour per user client.
	 * --
	 * Dates can be displayed in Twitter style (e.g. "1 hour ago") by setting the 
	 * $settings->twitter_style_dates param to true.
	 *
	 * You will also need to register your application with Twitter, to get your keys and tokens.
	 * You can do this here: (https://dev.twitter.com/).
	 *
	 * Don't forget to add your username to the bottom of the script.
	 * 
	 * Credits:
	 ***************************************************************************************
	 * Initial script before API v1.0 was retired
	 * http://f6design.com/journal/2010/10/07/display-recent-twitter-tweets-using-php/
	 *
	 * Which includes the following credits
	 * Hashtag/username parsing based on: http://snipplr.com/view/16221/get-twitter-tweets/
	 * Feed caching: http://www.addedbytes.com/articles/caching-output-in-php/
	 * Feed parsing: http://boagworld.com/forum/comments.php?DiscussionID=4639
	 ***************************************************************************************
	 *
	 ***************************************************************************************
	 * Authenticating a User Timeline for Twitter OAuth API V1.1
	 * http://www.webdevdoor.com/php/authenticating-twitter-feed-timeline-oauth/
	 ***************************************************************************************
	 *
	 ***************************************************************************************
	 * Twitteroauth which has been used for the authentication process
	 * https://github.com/abraham/twitteroauth
	 ***************************************************************************************
	 *
	 *
	**/
	
	// Set timezone. (Modify to match your timezone) If you need help with this, you can find it here. (http://php.net/manual/en/timezones.php)
	date_default_timezone_set('Europe/London');

	function get_settings() {

		$settings_json = array();

		if ( file_exists('settings.json') ) {
			$settings_json = json_decode(file_get_contents('settings.json'), TRUE);
		}

		// print_r($settings_json);

		return (object) array_merge([
			'consumer_key' => '',
			'consumer_secret' => '',
			'access_token' => '',
			'access_token_secret' => '',
			'cache_file' => './tweets.json',
			'tweets_to_display' => 20,
			'ignore_replies' => TRUE,
			'include_rts' => FALSE,
			'date_format' => 'g:i A M jS',
			'twitter_style_dates' => TRUE,
			'cache_time' => 60 * 3
		], $settings_json);

	}

	// Require TwitterOAuth files. (Downloadable from : https://github.com/abraham/twitteroauth)
	require_once("twitteroauth/twitteroauth/twitteroauth.php");
	
	// Function to authenticate app with Twitter.
	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
		$connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
		return $connection;
	}
	
	// Function to display the latest tweets.
	function display_latest_tweets($twitter_user_id) {

		$settings = get_settings();

		// Time that the cache was last updtaed.
		$cache_file_created  = ((file_exists($settings->cache_file))) ? filemtime($settings->cache_file) : 0;
 
		// A flag so we know if the feed was successfully parsed.
		$tweet_found         = false;
		
		// Show cached version of tweets, if it's less than $settings->cache_time.
		if ( time() - $settings->cache_time < $cache_file_created ) {

			$tweet_found = true;

			// Display tweets from the cache.
			readfile($settings->cache_file);

		} else {
		
			// Cache file not found, or old. Authenticae app.
			$connection = getConnectionWithAccessToken($settings->consumer_key, $settings->consumer_secret, $settings->access_token, $settings->access_token_secret);
			
			if ( $connection ) {

				// Get the latest tweets from Twitter
				$get_tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitter_user_id."&count=".$settings->tweets_to_display."&include_rts=".$settings->include_rts."&exclude_replies=".$settings->ignore_replies);
				
				// Error check: Make sure there is at least one item.
				if (count($get_tweets)) {
					
					// Define tweet_count as zero
					$tweet_count = 0;
 
					// Start output buffering.
					ob_start();
 
					// Open the twitter wrapping element.
					$tweets = array();
 
					// Iterate over tweets.
					foreach ( $get_tweets as $tweet ) {

						$tweets[$tweet->id]['id'] = $tweet->id_str;
						$tweets[$tweet->id]['created_at'] = $tweet->created_at;

						$tweet_found = true;
						$tweet_count++;
						$tweet_desc = $tweet->text;

						// Add hyperlink html tags to any urls, twitter ids or hashtags in the tweet.
						$tweet_desc = preg_replace("/((http)+(s)?:\/\/[^<>\s]+)/i", "<a href=\"\\0\" target=\"_blank\">\\0</a>", $tweet_desc );
						$tweet_desc = preg_replace("/[@]+([A-Za-z0-9-_]+)/", "<a href=\"http://twitter.com/\\1\" target=\"_blank\">\\0</a>", $tweet_desc );
						$tweet_desc = preg_replace("/[#]+([A-Za-z0-9-_]+)/", "<a href=\"http://twitter.com/search?q=%23\\1\" target=\"_blank\">\\0</a>", $tweet_desc );

						// replace t.co links with expanded link, if present
						$entities = $tweet->entities;

						if ( isset($entities->urls) && ! empty($entities->urls) ) {

							foreach ( $entities->urls as $url ) {
								$tweet_desc = str_replace($url->url, $url->expanded_url, $tweet_desc);
							}

						}
						$tweets[$tweet->id]['content'] = html_entity_decode($tweet_desc);

						// Convert Tweet display time to a UNIX timestamp. Twitter timestamps are in UTC/GMT time.
						$tweet_time = strtotime($tweet->created_at);

						if ( $settings->twitter_style_dates ) {

							// Current UNIX timestamp.
							$current_time = time();
							$time_diff = abs($current_time - $tweet_time);

							switch ( $time_diff )  {

								case ( $time_diff < 60 ):
									$display_time = $time_diff.' seconds ago';                  
									break;

								case ( $time_diff >= 60 && $time_diff < 3600 ):
									$min = floor($time_diff/60);
									$display_time = $min.' minutes ago';                  
									break;

								case ( $time_diff >= 3600 && $time_diff < 86400 ):
									$hour = floor($time_diff / 3600);
									$display_time = 'about '.$hour.' hour';
									
									if ( $hour > 1 ) {
										$display_time .= 's';
									}

									$display_time .= ' ago';
									break;

								default:
									$display_time = date($settings->date_format, $tweet_time);
									break;

							}

						} else {
							$display_time = date($settings->date_format, $tweet_time);
						}

						$tweets[$tweet->id]['display_time'] = $display_time;

						// If we have processed enough tweets, stop.
						if ($tweet_count >= $settings->tweets_to_display){
							break;
						}
 
					}

					$output = array(
						'username' => $twitter_user_id,
						'tweets' => $tweets
					);

					echo json_encode($output);
 
					// Generate a new cache file.
					$file = fopen($settings->cache_file, 'w');
 
					// Save the contents of output buffer to the file, and flush the buffer. 
					fwrite($file, json_encode($output)); 
					fclose($file);
					
				}
				
			}
			
		}
		
	}
	
	// Display latest tweets. (Modify username to your Twitter handle)
	display_latest_tweets('theideabureau');

?>

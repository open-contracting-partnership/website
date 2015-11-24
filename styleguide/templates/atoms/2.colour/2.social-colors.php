<?php

	$colours = array(
	'youtube'=> '#CC181E',
	'twitter'=> '#00ACEE',
	'facebook'=> '#3B5998',
	'google'=> '#DD4B39',
	'linkedin'=> '#007BB6',
	);

?>

<ul class="sg-colors">

	<?php foreach ( $colours as $name => $colour ) : ?>

		<li>
			<span class="sg-colour" style="background-color: <?php echo $colour; ?>"></span>
			<span class="sg-overlay">
				<span class="sg-label"><?php echo $name; ?><br /><?php echo $colour; ?></span>
			</span>
		</li>

	<?php endforeach; ?>

</ul>
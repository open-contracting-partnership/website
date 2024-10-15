<?php

namespace App\Cards;

use Imgix\UrlBuilder;
use Rareloop\Lumberjack\Facades\Config;

class ResourceCard extends BaseCard
{
    public static function convertTimberPost($post)
    {
        $data = [
            'title' => $post->post_title,
            'date' => $post->date('c'),
            'meta' => null,
            'image_url' => $post->thumbnail ? $post->thumbnail->src : null,
            'url' => $post->link(),
            'type' => null,
            'type_label' => null,
            'is_featured' => $post->meta('resource_is_featured') ?? false,
            'colour' => $post->colour,
            'excerpt' => (string) $post->preview->length(15)->read_more(false),
        ];

        if ($post->type) {
            $data['type'] = $post->type->slug;
            $data['type_label'] = $post->type->name;
        }

        if ($post->event_date) {
            $data['meta'] = \DateTime::createFromFormat('Ymd', $post->event_date)->format('j M Y');
        }

        if (empty($data['image_url'])) {
            // if this is a resource, we need to generate a fallback image
            // if not, we need to specifc a fallback

            $data['image_url'] = self::generateFallbackImage($post);
        }

        return $data;
    }

    public static function generateFallbackImage($post)
    {
        $builder = new UrlBuilder(Config::get('images.imgix_host'));

        $resourceType = $post->type ? $post->type->slug : null;
        $resourceColour = $post->colour;
        $isDataTool = $resourceType == 'data-tool';

        // image params
        $width = 400;
        $textColour = $resourceColour === 'green' ? '000000' : 'FFFFFF';

        $textURL = $builder->createURL("~text", [
            'w' => $width,
            'txt-size' => '40',
            'txt-font' => 'PT-Sans-Bold',
            'txt' => html_entity_decode($post->title),
            'txt-pad' => '5',
            'txt-color' => $textColour,
        ]);

        $backgroundImage = sprintf(
            'wp-content/themes/ocp-v1/resources/img/resource-covers/%s-%s.png',
            $isDataTool ? 'data' : 'resource',
            $resourceColour,
        );

        $imageURL = $builder->createURL($backgroundImage, [
            'mark64' => $textURL,
            'mark-align' => 'top,left',
            'mark-pad' => '35',
            'mark-w' => '1.0',
            'mark-y' => '50',
            'format' => 'auto',
            'w' => $width,
        ]);

        return urldecode($imageURL);
    }
}

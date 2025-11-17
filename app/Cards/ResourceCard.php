<?php

namespace App\Cards;

use App\PostTypes\Resource;
use Imgix\UrlBuilder;
use Rareloop\Lumberjack\Facades\Config;

class ResourceCard extends BaseCard
{
    public static function convertTimberPost($post): array
    {
        if ($post->type->slug === 'resource' && get_class($post) === 'Timber\Post') {
            $post = new Resource($post->ID);
        }

        $data = [
            'title' => $post->post_title,
            'date' => $post->date('c'),
            'meta' => null,
            'image_url' => $post->thumbnail ? $post->thumbnail->src : null,
            'url' => $post->link(),
            'type' => $post->type->slug,
            'type_label' => $post->type->name,
            'is_featured' => $post->meta('resource_is_featured') ?? false,
            'colour' => $post->colour,
            'excerpt' => (string) $post->preview->length(15)->read_more(false),
        ];

        if ($post->resourceType) {
            $data['type'] = $post->resourceType->slug;
            $data['type_label'] = $post->resourceType->name;
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
        if ($post->type->slug !== 'resource') {
            return null;
        }

        $builder = new UrlBuilder(Config::get('images.imgix_domain'));
        $builder->setSignKey(Config::get('images.imgix_signing_key'));

        $resourceType = $post->resourceType ? $post->resourceType->slug : null;
        $resourceColour = $post->colour ?: 'black';
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
            '/themes/ocp-v1/resources/img/resource-covers/%s-%s.png',
            $isDataTool ? 'data' : 'resource',
            $resourceColour,
        );

        $imageURL = $builder->createURL($backgroundImage, [
            'mark64' => $textURL,
            'markAlign64' => 'top,left',
            'mark-pad' => '35',
            'mark-w' => '1.0',
            'mark-y' => '50',
            'format' => 'auto',
            'w' => $width,
        ]);

        return urldecode($imageURL);
    }
}

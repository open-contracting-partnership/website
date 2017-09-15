<template>

	<div v-if="story" class="impact-card impact-card--featured" :style="'background-image: url(' + story.featured_url + ')'">

	    <div class="impact-card__content">

	        <span class="impact-icon" :data-type="story.content_type.slug"></span>

	        <h6 class="impact-card__heading">
	            <a :href="story.link" class="impact-card__link">{{ story.title }}</a>
	        </h6>

	        <p class="impact-card__strap">{{ story.introduction }}</p>

	        <a :href="story.link" class="button button--large">Read more</a>

	    </div>

	</div>

</template>

<script>

    export default {
		props: ['story']
    }

</script>

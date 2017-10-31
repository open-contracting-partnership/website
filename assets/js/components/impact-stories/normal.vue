<template>

	<div v-if="story" class="impact-card impact-card--normal">

	    <a :href="story.link" class="impact-card__media">
	        <img :src="story.thumb_url" />
	        <span class="impact-icon" :data-type="story.content_type.slug"></span>
	    </a>

	    <h6 class="impact-card__heading">
	        <a class="impact-card__link" :href="story.link">{{ story.title }}</a>
	    </h6>

	    <p class="impact-card__strap">{{ story.introduction }}</p>

	    <a :href="story.link" class="impact-card__read-more">{{ story.link_text }} &raquo;</a>

	</div>


</template>

<script>

    export default {
		props: ['story']
    }

</script>

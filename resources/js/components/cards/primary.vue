<template>

	<div class="card card--primary">

		<div class="card__image">

			<imgix
				v-if="card.image_url"
				:url="card.image_url"
				:params="{
					auto: 'format',
					fit: 'crop'
				}"
				:aspect_ratio="[16, 9]"
				:transforms="[{
					w: 415
				}, {
					w: 830
				}, {
					w: 1024
				}, {
					w: 1536
				}, {
					w: 2048
				}]"
				sizes='100vw'
			/>

			<imgix
				v-else
				url='/wp-content/themes/ocp-v1/resources/img/fallback.jpg'
				:params="{
					auto: 'format',
					fit: 'crop'
				}"
				:aspect_ratio="[16, 9]"
				:transforms="[{
					w: 415
				}, {
					w: 830
				}, {
					w: 1024
				}, {
					w: 1536
				}, {
					w: 2048
				}]"
				sizes='100vw'
			/>

		</div>

		<div class="card__main">

			<a class="card__title-link" :href="card.url">
				<h2 class="card__title" v-html="card.title"></h2>
			</a>

			<div class="card__footer">

				<div class="card__meta" v-html="card.meta"></div>

				<div class="card__cta">

					<a class="arrow-link" :href="card.url">
						<svg class="arrow-link__icon"><use xlink:href="#icon-arrow-circle"></use></svg>
						<span v-if="card.button_label" class="arrow-link__label" v-html="card.button_label"></span>
					</a>

				</div>

			</div>

		</div>

	</div>

</template>

<script>

	import Imgix from '../partials/imgix.vue';

	export default {

		props: ['card'],

		components: {
			imgix: Imgix
		}

	}

</script>

<template>

	<div class="gs-landing">

		<div class="page__wrapper">

			<h1 class="gs-landing__title" v-html="content.landing_page.title"></h1>

			<div class="gs-landing__main">

				<div class="gs-landing__intro" v-html="content.landing_page.introduction"></div>

				<div class="gs-landing__diagram">

					<diamonds prefix="landing"></diamonds>

					<router-link
						:to="{ name: 'detail', params: { step: 1 } }"
						class="button button--brand button--large"
						v-html="content.explore_button_label"
					>
					</router-link>

				</div>

			</div>

			<div class="gs-landing__secondary">

				<div class="" v-html="content.landing_page.secondary_copy_1st_column"></div>

				<div class="" v-html="content.landing_page.secondary_copy_2nd_column"></div>

				<div class="gs-landing__secondary-nav">
					<a v-for="link in content.landing_page.links" class="button button--dark button--large" :href="link.url">{{ link.label }}</a>
				</div>

			</div>

		</div>

	</div>

</template>

<script>

    export default {

		computed: {

			content() {
				return content;
			}

		}

	}

</script>

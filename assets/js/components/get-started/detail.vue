<template>

	<div class="gs-detail">

		<div class="nav-bar">

			<router-link v-if="step > 1" :to="{ name: 'detail', params: { step: parseInt(step) - 1 } }" class="prev">
				<svg><use xlink:href="#icon-arrow-left" /></svg>
				<span>Prev</span>
			</router-link>

			<h2>{{ step }}. {{ detail.title }}</h2>

			<router-link v-if="step < 7" :to="{ name: 'detail', params: { step: parseInt(step) + 1 } }" class="next">
				<span>Next</span>
				<svg><use xlink:href="#icon-arrow-right" /></svg>
			</router-link>

		</div>

		<div class="page__wrapper">

			<aside class="gs-detail__sidebar page-sidebar">

				<h1 class="gs-detail__sidebar-title">{{ step }}. {{ detail.title }}</h1>
				<p class="gs-detail__sidebar-strap">{{ detail.strapline }}</p>

				<div class="gs-detail__side-top">

					<diamonds></diamonds>

					<div class="gs-detail__toc">
						<a href="#" class="active">What happens at this step?</a>
						<a href="#">What are the key outputs</a>
						<a href="#">What resources can I use?</a>
						<a href="#">What have other publishers done?</a>
					</div>

				</div>

				<div class="gs-detail__side-footer">

					<div class="gs-detail__key">

						<span class="gs-detail__key-title">Key</span>

						<div class="gs-detail__key-inner">

							<div class="gs-detail__key-col">

								<div class="gs-detail__key-item">
									<svg data-type="connect"><use xlink:href="#icon-7-connect" /></svg>
									<span>Connect</span>
								</div>

								<div class="gs-detail__key-item">
									<svg data-type="read"><use xlink:href="#icon-7-read" /></svg>
									<span>Read</span>
								</div>

							</div>

							<div class="gs-detail__key-col">

								<div class="gs-detail__key-item">
									<svg data-type="complete"><use xlink:href="#icon-7-complete" /></svg>
									<span>Complete</span>
								</div>

								<div class="gs-detail__key-item">
									<svg data-type="get_inspired"><use xlink:href="#icon-7-get_inspired" /></svg>
									<span>Get inspired</span>
								</div>

							</div>

						</div>

					</div>

					<div class="gs-detail__nav">

						<router-link :to="{ name: 'detail', params: { step: step == 1 ? 1 : (parseInt(step) - 1) } }">
							<svg><use xlink:href="#icon-arrow-left" /></svg>
						</router-link>

						<router-link v-for="n in 7" :key="n" :to="{ name: 'detail', params: { step: n } }" v-bind:class="{ active: n == step }">
							{{ n }}
						</router-link>

						<router-link :to="{ name: 'detail', params: { step: step == 7 ? 7 : (parseInt(step) + 1) } }">
							<svg><use xlink:href="#icon-arrow-right" /></svg>
						</router-link>

					</div>

				</div>

			</aside>

			<div class="page-content / gs-detail__content">

				<div v-if="detail.what_happens">

					<h2 class="delta">What happens at this step?</h2>

					<div v-for="section in detail.what_happens" class="gs-detail__section">

						<h3 class="gs-detail__tick-heading">
							<svg><use xlink:href="#icon-7-tick" /></svg>
							<span>{{ section.title }}</span>
						</h3>

						<div v-html="section.content"></div>

						<div v-for="resource in section.resource">

							<a class="gs-detail__resource" :href="resource.url" :data-type="resource.acf_fc_layout">
								<svg><use :xlink:href="'#icon-7-' + resource.acf_fc_layout" /></svg>
								<span>{{ resource.label }}</span>
							</a>

						</div>

					</div>

				</div>

				<div v-if="detail.outputs" class="get-started__section">
					<h2 class="delta">What are the key outputs?</h2>
					<div v-html="detail.outputs"></div>
				</div>

				<div v-if="detail.resources" class="get-started__section">
					<h2 class="delta">What resources can I use?</h2>
					<div v-html="detail.resources"></div>
				</div>

				<div v-if="detail.publishers" class="get-started__section">
					<h2 class="delta">What have other publishers done?</h2>
					<div v-html="detail.publishers"></div>
				</div>

			</div>

		</div>

	</div>

</template>

<script>

    export default {

		computed: {

			detail() {
				return this.$root.steps[this.step - 1];
			},

			step() {
				return this.$route.params.step;
			}

		}

	}

</script>

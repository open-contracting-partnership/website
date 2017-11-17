<template>

	<div class="get-started">

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

			<aside class="get-started__sidebar page-sidebar">

				<h1 class="get-started__sidebar-title">{{ step }}. {{ detail.title }}</h1>
				<p class="get-started__sidebar-strap">{{ detail.strapline }}</p>

				<svg class="get-started__diamonds" viewBox="0 0 430 279">

					<defs>
						<filter x="-4.5%" y="-4.5%" width="108.9%" height="108.9%" filterUnits="objectBoundingBox" id="filter-1">
							<feGaussianBlur stdDeviation="1.75502232" in="SourceGraphic"></feGaussianBlur>
						</filter>
					</defs>

					<g transform="translate(0, 75)">
						<polygon fill="#535E00" points="62 121 3 62 62 3 121 62"></polygon>
						<text class="number" x="62" y="84" text-anchor="middle" font-family="StratumNo1-Bold, StratumNo1" font-size="65" font-weight="bold" fill="#FFFFFF">
							1
						</text>
						<text transform="translate(30, 30) rotate(-45)" text-anchor="middle" font-family="SourceSansPro-Semibold, Source Sans Pro" font-size="14" font-weight="500" fill="#333333">
							MAP
						</text>
					</g>

					<g transform="translate(75, 0)">
						<polygon fill="#535E00" points="62 121 3 62 62 3 121 62"></polygon>
						<text class="number" x="62" y="84" text-anchor="middle" font-family="StratumNo1-Bold, StratumNo1" font-size="65" font-weight="bold" fill="#FFFFFF">
							2
						</text>
						<text transform="translate(30, 30) rotate(-45)" text-anchor="middle" font-family="SourceSansPro-Semibold, Source Sans Pro" font-size="14" font-weight="500" fill="#333333">
							DESIGN
						</text>
					</g>

					<g transform="translate(150, 75)">
						<polygon fill="#535E00" points="62 121 3 62 62 3 121 62"></polygon>
						<text class="number" x="62" y="84" text-anchor="middle" font-family="StratumNo1-Bold, StratumNo1" font-size="65" font-weight="bold" fill="#FFFFFF">
							3
						</text>
						<text transform="translate(30, 30) rotate(-45)" text-anchor="middle" font-family="SourceSansPro-Semibold, Source Sans Pro" font-size="14" font-weight="500" fill="#333333">
							PUBLISH
						</text>
					</g>

					<g transform="translate(75, 150)">
						<polygon fill="#535E00" points="62 121 3 62 62 3 121 62"></polygon>
						<text class="number" x="62" y="84" text-anchor="middle" font-family="StratumNo1-Bold, StratumNo1" font-size="65" font-weight="bold" fill="#FFFFFF">
							4
						</text>
						<text transform="translate(30, 30) rotate(-45)" text-anchor="middle" font-family="SourceSansPro-Semibold, Source Sans Pro" font-size="14" font-weight="500" fill="#333333">
							BUILD
						</text>
					</g>

					<g transform="translate(225, 0)">
						<polygon fill="#D6E100" points="62 121 3 62 62 3 121 62"></polygon>
						<text class="number" x="62" y="84" text-anchor="middle" font-family="StratumNo1-Bold, StratumNo1" font-size="65" font-weight="bold" fill="#FFFFFF">
							5
						</text>
						<text transform="translate(30, 30) rotate(-45)" text-anchor="middle" font-family="SourceSansPro-Semibold, Source Sans Pro" font-size="14" font-weight="500" fill="#333333">
							USE
						</text>
					</g>

					<g transform="translate(300, 75)">
						<polygon fill="#D6E100" points="62 121 3 62 62 3 121 62"></polygon>
						<text class="number" x="62" y="84" text-anchor="middle" font-family="StratumNo1-Bold, StratumNo1" font-size="65" font-weight="bold" fill="#FFFFFF">
							6
						</text>
						<text transform="translate(30, 30) rotate(-45)" text-anchor="middle" font-family="SourceSansPro-Semibold, Source Sans Pro" font-size="14" font-weight="500" fill="#333333">
							EVALUATE
						</text>
					</g>

					<g transform="translate(225, 150)">
						<polygon fill="#D6E100" points="62 121 3 62 62 3 121 62"></polygon>
						<text class="number" x="62" y="84" text-anchor="middle" font-family="StratumNo1-Bold, StratumNo1" font-size="65" font-weight="bold" fill="#FFFFFF">
							7
						</text>
						<text transform="translate(30, 30) rotate(-45)" text-anchor="middle" font-family="SourceSansPro-Semibold, Source Sans Pro" font-size="14" font-weight="500" fill="#333333">
							LEARN / SHARE
						</text>
					</g>

				</svg>

				<div class="get-started__toc">
					<a href="#" class="active">What happens at this step?</a>
					<a href="#">What are the key outputs</a>
					<a href="#">What resources can I use?</a>
					<a href="#">What have other publishers done?</a>
				</div>

				<div class="get-started__side_footer">

					<div class="get-started__key">

						<span class="get-started__key-title">Key</span>

						<div class="get-started__key-inner">

							<div class="get-started__key-col">

								<div class="get-started__key-item">
									<svg data-type="connect"><use xlink:href="#icon-7-connect" /></svg>
									<span>Connect</span>
								</div>

								<div class="get-started__key-item">
									<svg data-type="read"><use xlink:href="#icon-7-read" /></svg>
									<span>Read</span>
								</div>

							</div>

							<div class="get-started__key-col">

								<div class="get-started__key-item">
									<svg data-type="complete"><use xlink:href="#icon-7-complete" /></svg>
									<span>Complete</span>
								</div>

								<div class="get-started__key-item">
									<svg data-type="get_inspired"><use xlink:href="#icon-7-get_inspired" /></svg>
									<span>Get inspired</span>
								</div>

							</div>

						</div>

					</div>

					<div class="get-started__nav">

						<router-link :to="{ name: 'detail', params: { step: step == 1 ? 1 : (parseInt(step) - 1) } }">
							<svg><use xlink:href="#icon-arrow-left" /></svg>
						</router-link>

						<router-link v-for="n in 7" :to="{ name: 'detail', params: { step: n } }" v-bind:class="{ active: n == step }">
							{{ n }}
						</router-link>

						<router-link :to="{ name: 'detail', params: { step: step == 7 ? 7 : (parseInt(step) + 1) } }">
							<svg><use xlink:href="#icon-arrow-right" /></svg>
						</router-link>

					</div>

				</div>

			</aside>

			<div class="page-content / get-started__content">

				<div v-if="detail.what_happens">

					<h2 class="delta">What happens at this step?</h2>

					<div v-for="section in detail.what_happens" class="get-started__section">

						<h3 class="get-started__tick-heading">
							<svg><use xlink:href="#icon-7-tick" /></svg>
							<span>{{ section.title }}</span>
						</h3>

						<div v-html="section.content"></div>

						<div v-for="resource in section.resource">

							<a class="get-started__resource" :href="resource.url" :data-type="resource.acf_fc_layout">
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

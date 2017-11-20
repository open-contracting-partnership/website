<template>

	<svg class="gs-diamonds" viewBox="0 0 430 279">

		<defs>
			<filter x="-4.5%" y="-4.5%" width="108.9%" height="108.9%" filterUnits="objectBoundingBox" id="filter-1">
				<feGaussianBlur stdDeviation="1.75502232" in="SourceGraphic"></feGaussianBlur>
			</filter>
		</defs>

		<g transform="translate(0, 75)" @click="navigate(1)">
			<polygon fill="#535E00" points="62 121 3 62 62 3 121 62"></polygon>
			<text class="number" x="62" y="84" text-anchor="middle" font-family="StratumNo1-Bold, StratumNo1" font-size="65" font-weight="bold" fill="#FFFFFF">
				1
			</text>
			<text transform="translate(30, 30) rotate(-45)" text-anchor="middle" font-family="SourceSansPro-Semibold, Source Sans Pro" font-size="14" font-weight="500" fill="#333333">
				MAP
			</text>
		</g>

		<g transform="translate(75, 0)" @click="navigate(2)">
			<polygon fill="#535E00" points="62 121 3 62 62 3 121 62"></polygon>
			<text class="number" x="62" y="84" text-anchor="middle" font-family="StratumNo1-Bold, StratumNo1" font-size="65" font-weight="bold" fill="#FFFFFF">
				2
			</text>
			<text transform="translate(30, 30) rotate(-45)" text-anchor="middle" font-family="SourceSansPro-Semibold, Source Sans Pro" font-size="14" font-weight="500" fill="#333333">
				DESIGN
			</text>
		</g>

		<g transform="translate(150, 75)" @click="navigate(3)">
			<polygon fill="#535E00" points="62 121 3 62 62 3 121 62"></polygon>
			<text class="number" x="62" y="84" text-anchor="middle" font-family="StratumNo1-Bold, StratumNo1" font-size="65" font-weight="bold" fill="#FFFFFF">
				3
			</text>
			<text transform="translate(30, 30) rotate(-45)" text-anchor="middle" font-family="SourceSansPro-Semibold, Source Sans Pro" font-size="14" font-weight="500" fill="#333333">
				PUBLISH
			</text>
		</g>

		<g transform="translate(75, 150)" @click="navigate(4)">
			<polygon fill="#535E00" points="62 121 3 62 62 3 121 62"></polygon>
			<text class="number" x="62" y="84" text-anchor="middle" font-family="StratumNo1-Bold, StratumNo1" font-size="65" font-weight="bold" fill="#FFFFFF">
				4
			</text>
			<text transform="translate(30, 30) rotate(-45)" text-anchor="middle" font-family="SourceSansPro-Semibold, Source Sans Pro" font-size="14" font-weight="500" fill="#333333">
				BUILD
			</text>
		</g>

		<g transform="translate(225, 0)" @click="navigate(5)">
			<polygon fill="#D6E100" points="62 121 3 62 62 3 121 62"></polygon>
			<text class="number" x="62" y="84" text-anchor="middle" font-family="StratumNo1-Bold, StratumNo1" font-size="65" font-weight="bold" fill="#FFFFFF">
				5
			</text>
			<text transform="translate(30, 30) rotate(-45)" text-anchor="middle" font-family="SourceSansPro-Semibold, Source Sans Pro" font-size="14" font-weight="500" fill="#333333">
				USE
			</text>
		</g>

		<g transform="translate(300, 75)" @click="navigate(6)">
			<polygon fill="#D6E100" points="62 121 3 62 62 3 121 62"></polygon>
			<text class="number" x="62" y="84" text-anchor="middle" font-family="StratumNo1-Bold, StratumNo1" font-size="65" font-weight="bold" fill="#FFFFFF">
				6
			</text>
			<text transform="translate(30, 30) rotate(-45)" text-anchor="middle" font-family="SourceSansPro-Semibold, Source Sans Pro" font-size="14" font-weight="500" fill="#333333">
				EVALUATE
			</text>
		</g>

		<g transform="translate(225, 150)" @click="navigate(7)">
			<polygon fill="#D6E100" points="62 121 3 62 62 3 121 62"></polygon>
			<text class="number" x="62" y="84" text-anchor="middle" font-family="StratumNo1-Bold, StratumNo1" font-size="65" font-weight="bold" fill="#FFFFFF">
				7
			</text>
			<text transform="translate(30, 30) rotate(-45)" text-anchor="middle" font-family="SourceSansPro-Semibold, Source Sans Pro" font-size="14" font-weight="500" fill="#333333">
				LEARN / SHARE
			</text>
		</g>

	</svg>

</template>

<script>

    export default {

		methods: {

			navigate(number) {

				this.$router.push({
					name: 'detail',
					params: {
						step: number
					}
				});

			}

		}

	}

</script>

<template>

	<svg class="gs-diamonds gs-diamonds--clickable" viewBox="0 0 583 374">

		<defs>

			<circle :id="prefix + '--circle-1'" cx="396" cy="187" r="187"/>

			<mask :id="prefix + '--mask-1'" width="374" height="374" x="0" y="0" fill="#fff">
				<use :xlink:href="'#' + prefix + '--circle-1'"/>
			</mask>

			<circle :id="prefix + '--circle-2'" cx="187" cy="187" r="187"/>

			<mask :id="prefix + '--mask-2'" width="374" height="374" x="0" y="0" fill="#fff">
				<use :xlink:href="'#' + prefix + '--circle-2'"/>
			</mask>

			<linearGradient :id="prefix + '--red-gradient'" x1="75.32%" x2="23.93%" y1="25.85%" y2="74.31%">
				<stop stop-color="#F68774" offset="0%"/>
				<stop stop-color="#FB6045" offset="100%"/>
			</linearGradient>

			<linearGradient :id="prefix + '--green-gradient'" x1="75.32%" x2="23.93%" y1="25.85%" y2="74.31%">
				<stop stop-color="#2CDED0" offset="0%"/>
				<stop stop-color="#23B2A7" offset="100%"/>
			</linearGradient>

			<linearGradient :id="prefix + '--purple-gradient'" x1="75.32%" x2="23.93%" y1="25.85%" y2="74.31%">
				<stop stop-color="#949BF0" offset="0%"/>
				<stop stop-color="#6C75E1" offset="100%"/>
			</linearGradient>

		</defs>

		<g fill="none">

			<g>

				<g>

					<use class="gs-diamonds__circle" fill="#FFF" stroke="#B7B7B7" stroke-width="2" :mask="'url(#' + prefix + '--mask-1)'" stroke-dasharray="11" :xlink:href="'#' + prefix + '--circle-1'"/>

					<g stroke="#B7B7B7">
						<use class="gs-diamonds__circle" fill="#FFF" stroke-width="2" :mask="'url(#' + prefix + '--mask-2)'" stroke-dasharray="11" :xlink:href="'#' + prefix + '--circle-2'"/>
						<circle cx="186.6" cy="186.6" r="121.27"/>
					</g>

					<!-- 1, design -->
					<g class="gs-diamonds__step" transform="translate(120 40)" @click="navigate(1)" v-bind:class="{ active: 1 == step }">

						<path d="M58 124.6L2.3 69.1a8 8 0 0 1 0-11.3L58 2.3a8 8 0 0 1 11.3 0l55.6 55.5a8 8 0 0 1 0 11.3l-55.6 55.5a8 8 0 0 1-11.3 0z" fill="#899A03"/>

						<g transform="translate(49 52)">

							<text class="gs-diamonds__step-number" text-anchor="middle" transform="translate(15, 43)">
								1
							</text>

							<text
								class="gs-diamonds__step-title"
								text-anchor="middle"
								transform="translate(15, 16)"
								v-html="labels.design"
							>
							</text>

						</g>

						<g class="gs-diamonds__step-icon" transform="translate(40 -22)">
							<path d="M6 34.5c0 .9-.7 1.5-1.5 1.5S3 35.4 3 34.5v-10c0-.9.7-1.5 1.5-1.5s1.5.6 1.5 1.4v10.1z" fill="#806346" fill-rule="nonzero"/><path d="M6 34.5c0 .9-.7 1.5-1.5 1.5S3 35.4 3 34.5v-10c0-.9.7-1.5 1.5-1.5s1.5.6 1.5 1.4v10.1z" stroke="#262626"/><path d="M10 32.5c0 .8-.7 1.5-1.5 1.5S7 33.4 7 32.6V22.3c0-.8.7-1.4 1.5-1.4s1.5.6 1.5 1.4v10.1z" fill="#806346" fill-rule="nonzero"/><path d="M10 32.5c0 .8-.7 1.5-1.5 1.5S7 33.4 7 32.6V22.3c0-.8.7-1.4 1.5-1.4s1.5.6 1.5 1.4v10.1z" stroke="#262626"/><path d="M14.8 15.2c.4.6.2 1.3-.4 1.6-.5.4-1.2.2-1.6-.4L8.2 7.8c-.4-.6-.2-1.3.4-1.6.5-.4 1.2-.2 1.6.4l4.6 8.6z" fill="#806346" fill-rule="nonzero"/><path d="M14.8 15.2c.4.6.2 1.3-.4 1.6-.5.4-1.2.2-1.6-.4L8.2 7.8c-.4-.6-.2-1.3.4-1.6.5-.4 1.2-.2 1.6.4l4.6 8.6z" stroke="#262626"/><path d="M11 7.3c0-2.4-2.3-3-5-1.4-2.8 1.5-5 4.8-5 7.2v11.5L3.5 26l7.5-4.3V7.3z" fill="#FB6045" fill-rule="nonzero"/><path d="M11 7.3c0-2.4-2.3-3-5-1.4-2.8 1.5-5 4.8-5 7.2v11.5L3.5 26l7.5-4.3V7.3z" stroke="#262626"/><path d="M7.8 20.2c.4.6.2 1.3-.4 1.6-.5.4-1.2.2-1.6-.4L1.2 13c-.4-.7-.2-1.4.4-1.7.5-.4 1.2-.1 1.6.4l4.6 8.6z" fill="#806346" fill-rule="nonzero"/><path d="M7.8 20.2c.4.6.2 1.3-.4 1.6-.5.4-1.2.2-1.6-.4L1.2 13c-.4-.7-.2-1.4.4-1.7.5-.4 1.2-.1 1.6.4l4.6 8.6z" stroke="#262626"/><path d="M6 1a4 4 0 0 1 4 4 4 4 0 0 1-4 4 4 4 0 0 1-4-4 4 4 0 0 1 4-4" fill="#806346" fill-rule="nonzero"/><path d="M6 1a4 4 0 0 1 4 4 4 4 0 0 1-4 4 4 4 0 0 1-4-4 4 4 0 0 1 4-4z" stroke="#262626" stroke-width="1.6"/><path d="M8.3 5c.2 0 .5 0 .6.3.2.2 0 .5-.2.6-.2.2-.5 0-.6-.2-.2-.2 0-.5.2-.6M5.3 6c.2 0 .5 0 .6.3.2.2 0 .5-.2.6-.2.2-.5 0-.6-.2-.2-.2 0-.5.2-.6" fill="#262626" fill-rule="nonzero"/><path d="M10 3.7A4.1 4.1 0 0 0 6.1 1 4.1 4.1 0 0 0 2 5.2v.7a4 4 0 0 0 2.5-.2A4.1 4.1 0 0 0 7 3.2c.9.6 2 .8 3 .5" fill="#464646" fill-rule="nonzero"/><path d="M10 3.7A4.1 4.1 0 0 0 6.1 1 4.1 4.1 0 0 0 2 5.2v.7a4 4 0 0 0 2.5-.2A4.1 4.1 0 0 0 7 3.2c.9.6 2 .8 3 .5z" stroke="#262626"/><path d="M38 36.5c0 .9.7 1.5 1.5 1.5s1.5-.6 1.5-1.5v-10c0-.9-.7-1.5-1.5-1.5s-1.5.6-1.5 1.4v10.1z" fill="#FFCBA6" fill-rule="nonzero"/><path d="M38 36.5c0 .9.7 1.5 1.5 1.5s1.5-.6 1.5-1.5v-10c0-.9-.7-1.5-1.5-1.5s-1.5.6-1.5 1.4v10.1z" stroke="#262626"/><path d="M34 34.5c0 .9.7 1.5 1.5 1.5s1.5-.6 1.5-1.5v-10c0-.9-.7-1.5-1.5-1.5s-1.5.6-1.5 1.4v10.1z" fill="#FFCBA6" fill-rule="nonzero"/><path d="M34 34.5c0 .9.7 1.5 1.5 1.5s1.5-.6 1.5-1.5v-10c0-.9-.7-1.5-1.5-1.5s-1.5.6-1.5 1.4v10.1z" stroke="#262626" stroke-width="1.6"/><path d="M33.4 13.5l-3.8 2.2c-.6.3-.8 1-.4 1.7.3.6 1.1.8 1.7.4L36 15V9.2c0-.7-.6-1.2-1.3-1.2-.7 0-1.2.6-1.2 1.2v4.3h-.1z" fill="#FFCBA6" fill-rule="nonzero"/><path d="M33.4 13.5l-3.8 2.2c-.6.3-.8 1-.4 1.7.3.6 1.1.8 1.7.4L36 15V9.2c0-.7-.6-1.2-1.3-1.2-.7 0-1.2.6-1.2 1.2v4.3h-.1z" stroke="#262626"/><path d="M33 9.3c0-2.4 2.3-3 5-1.4 2.7 1.5 5 4.8 5 7.2v11.5L40.5 28 33 23.7V9.3z" fill="#6C75E1" fill-rule="nonzero"/><path d="M33 9.3c0-2.4 2.3-3 5-1.4 2.7 1.5 5 4.8 5 7.2v11.5L40.5 28 33 23.7V9.3z" stroke="#262626"/><path d="M40.4 17.5l-3.8 2.2c-.6.3-.8 1-.4 1.7.3.6 1.1.8 1.7.4L43 19v-5.7c0-.7-.6-1.2-1.3-1.2-.7 0-1.2.6-1.2 1.2v4.3z" fill="#FFCBA6" fill-rule="nonzero"/><path d="M40.4 17.5l-3.8 2.2c-.6.3-.8 1-.4 1.7.3.6 1.1.8 1.7.4L43 19v-5.7c0-.7-.6-1.2-1.3-1.2-.7 0-1.2.6-1.2 1.2v4.3z" stroke="#262626"/><path d="M37 2a4 4 0 0 1 4 4 4 4 0 0 1-4 4 4 4 0 0 1-4-4 4 4 0 0 1 4-4" fill="#FFCBA6" fill-rule="nonzero"/><path d="M37 2a4 4 0 0 1 4 4 4 4 0 0 1-4 4 4 4 0 0 1-4-4 4 4 0 0 1 4-4z" stroke="#262626"/><path d="M35 6.3c.1-.2.4-.4.7-.3.2.1.4.4.3.7-.1.2-.4.4-.7.3a.5.5 0 0 1-.3-.7zM37 8c0-.4 0-.8-.3-1-.3 0-.6 0-.7.5" stroke="#262626" stroke-width=".8"/><path d="M37 7.3c.1-.2.4-.4.7-.3.2.1.4.4.3.7-.1.2-.4.4-.7.3a.5.5 0 0 1-.3-.7z" stroke="#262626" stroke-width=".8"/><path d="M34 4.7A4.1 4.1 0 0 1 37.9 2C40.2 2 42 3.9 42 6.2v.7a4 4 0 0 1-2.5-.2A4.1 4.1 0 0 1 37 4.2c-.9.5-2 .8-3 .5" fill="#B79F57" fill-rule="nonzero"/><path d="M34 4.7A4.1 4.1 0 0 1 37.9 2C40.2 2 42 3.9 42 6.2v.7a4 4 0 0 1-2.5-.2A4.1 4.1 0 0 1 37 4.2c-.9.5-2 .8-3 .5z" stroke="#262626" stroke-linecap="round" stroke-linejoin="round"/><path d="M57 47.5c0 .9.7 1.5 1.5 1.5s1.5-.6 1.5-1.5v-10c0-.9-.7-1.5-1.5-1.5s-1.5.6-1.5 1.5v10z" fill="#CC9E70" fill-rule="nonzero"/><path d="M57 47.5c0 .9.7 1.5 1.5 1.5s1.5-.6 1.5-1.5v-10c0-.9-.7-1.5-1.5-1.5s-1.5.6-1.5 1.5v10z" stroke="#262626" stroke-width="1.6"/><path d="M52 44.5c0 .9.7 1.5 1.5 1.5s1.5-.6 1.5-1.5v-10c0-.9-.7-1.5-1.5-1.5s-1.5.6-1.5 1.5v10z" fill="#CC9E70" fill-rule="nonzero"/><path d="M52 44.5c0 .9.7 1.5 1.5 1.5s1.5-.6 1.5-1.5v-10c0-.9-.7-1.5-1.5-1.5s-1.5.6-1.5 1.5v10z" stroke="#262626"/><path d="M47.2 27.2c-.4.6-.2 1.3.4 1.6.5.4 1.2.2 1.6-.4l4.6-8.6c.4-.6.2-1.3-.4-1.6-.5-.4-1.2-.2-1.6.4l-4.6 8.6z" fill="#CC9E70" fill-rule="nonzero"/><path d="M47.2 27.2c-.4.6-.2 1.3.4 1.6.5.4 1.2.2 1.6-.4l4.6-8.6c.4-.6.2-1.3-.4-1.6-.5-.4-1.2-.2-1.6.4l-4.6 8.6z" stroke="#262626"/><path d="M51 20.3c0-2.4 2.3-3 5-1.4 2.8 1.5 5 4.8 5 7.2v11.5L58.5 39 51 34.7V20.3z" fill="#23B2A7" fill-rule="nonzero"/><path d="M51 20.3c0-2.4 2.3-3 5-1.4 2.8 1.5 5 4.8 5 7.2v11.5L58.5 39 51 34.7V20.3z" stroke="#262626"/><path d="M59.4 28.5l-3.8 2.2c-.6.3-.8 1-.4 1.7.3.6 1.1.8 1.7.4L62 30v-5.7c0-.7-.6-1.2-1.3-1.2-.7 0-1.2.6-1.2 1.2v4.3z" fill="#CC9E70" fill-rule="nonzero"/><path d="M59.4 28.5l-3.8 2.2c-.6.3-.8 1-.4 1.7.3.6 1.1.8 1.7.4L62 30v-5.7c0-.7-.6-1.2-1.3-1.2-.7 0-1.2.6-1.2 1.2v4.3z" stroke="#262626"/><path d="M56 13a4 4 0 0 1 4 4 4 4 0 0 1-4 4 4 4 0 0 1-4-4 4 4 0 0 1 4-4" fill="#CC9E70" fill-rule="nonzero"/><path d="M56 13a4 4 0 0 1 4 4 4 4 0 0 1-4 4 4 4 0 0 1-4-4 4 4 0 0 1 4-4z" stroke="#262626"/><path d="M53 17.3c.1-.2.4-.4.7-.3.2.1.4.4.3.7-.1.2-.4.4-.7.3a.5.5 0 0 1-.3-.7M56 18.3c.1-.2.4-.4.7-.3.2.1.4.4.3.7-.1.2-.4.4-.7.3a.5.5 0 0 1-.3-.7" fill="#262626" fill-rule="nonzero"/><path d="M57 21a4 4 0 0 0 1.3-3.8H58a4 4 0 0 1-3.7-2.4 4 4 0 0 0-2.2 3.6A4 4 0 0 1 56 13a4 4 0 0 1 4 4 4 4 0 0 1-3 4" fill="#71603F" fill-rule="nonzero"/><path d="M57 21a4 4 0 0 0 1.3-3.8H58a4 4 0 0 1-3.7-2.4 4 4 0 0 0-2.2 3.6A4 4 0 0 1 56 13a4 4 0 0 1 4 4 4 4 0 0 1-3 4z" stroke="#262626" stroke-linecap="round" stroke-linejoin="round"/><path fill="#FFF" fill-rule="nonzero" d="M54.2 53L65 47l-7.2-4L47 49z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M54.2 53L65 47l-7.2-4L47 49z"/><path fill="#FFF" fill-rule="nonzero" d="M54.2 52L65 46l-7.2-4L47 48z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M54.2 52L65 46l-7.2-4L47 48z"/><path fill="#FFF" fill-rule="nonzero" d="M54.2 51L65 45l-7.2-4L47 47z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M54.2 51L65 45l-7.2-4L47 47z"/><path fill="#FFF" fill-rule="nonzero" d="M54.2 50L65 44l-7.2-4L47 46z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M54.2 50L65 44l-7.2-4L47 46z"/><path fill="#FFF" fill-rule="nonzero" d="M54.2 49L65 43l-7.2-4L47 45z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M54.2 49L65 43l-7.2-4L47 45z"/><path fill="#FFF" fill-rule="nonzero" d="M29.6 45L5 30.7 23.4 20 48 34.3z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M29.6 45L5 30.7 23.4 20 48 34.3zM34 31l-12-7M32 32l-12-7M30 33l-12-7M28 34l-12-7M25 36l-12-7M23 37l-12-7"/><path d="M28 38.6l2.2 1.3c.8.4 2 .3 3-.1l3.7-2.1c.7-.4-.2-1-1-.6l-3.4 2-.2-.2 9.3-5.2c1-.6-.2-1.3-1.2-.7L35 36h-.2l5.4-3.1c1-.5-.2-1.2-1.2-.7l-9.4 5.2h-.2l3.4-2c.7-.4-.2-1-.9-.5l-3.7 2c-.8.5-1 1.3-.2 1.7m.8.8c-.5-.3-1.6-.3-2.2.1-.7.4-.8 1-.2 1.3.6.3 1.6.3 2.3-.1.6-.4.7-1 .1-1.3" fill="#262626" fill-rule="nonzero"/>
						</g>

					</g>

					<!-- 2, map -->
					<g class="gs-diamonds__step" transform="translate(38 122)" @click="navigate(2)" v-bind:class="{ active: 2 == step }">

						<path d="M58 124.6L2.3 69.1a8 8 0 0 1 0-11.3L58 2.3a8 8 0 0 1 11.3 0l55.6 55.5a8 8 0 0 1 0 11.3l-55.6 55.5a8 8 0 0 1-11.3 0z" fill="#A6BB05"/>

						<g transform="translate(49 52)">

							<text class="gs-diamonds__step-number" text-anchor="middle" transform="translate(15, 43)">
								2
							</text>

							<text
								class="gs-diamonds__step-title"
								text-anchor="middle"
								transform="translate(15, 16)"
								v-html="labels.map"
							>
							</text>

						</g>

						<g class="gs-diamonds__step-icon" transform="translate(40 -18)">
							<path d="M5.8 35c0 .8-.6 1.4-1.5 1.4-.8 0-1.4-.6-1.4-1.4V24.9c0-.8.6-1.5 1.4-1.5.8 0 1.5.7 1.5 1.5v10z" fill="#806346" fill-rule="nonzero"/><path d="M5.8 35c0 .8-.6 1.4-1.5 1.4-.8 0-1.4-.6-1.4-1.4V24.9c0-.8.6-1.5 1.4-1.5.8 0 1.5.7 1.5 1.5v10z" stroke="#262626" stroke-width="1.6"/><path d="M10 32.5a1.4 1.4 0 1 1-2.9 0v-10c0-.9.7-1.5 1.5-1.5s1.4.6 1.4 1.4v10.1z" fill="#806346" fill-rule="nonzero"/><path d="M10 32.5a1.4 1.4 0 1 1-2.9 0v-10c0-.9.7-1.5 1.5-1.5s1.4.6 1.4 1.4v10.1z" stroke="#262626" stroke-width="1.6"/><path d="M13.5 8.8l3.7-2c.6-.4 1.3-.2 1.6.4.4.6.2 1.3-.4 1.6l-4.8 2.9-4.9-2.9c-.6-.3-.7-1-.4-1.6.3-.6 1-.8 1.7-.5l3.6 2.1z" fill="#806346" fill-rule="nonzero"/><path d="M13.5 8.8l3.7-2c.6-.4 1.3-.2 1.6.4.4.6.2 1.3-.4 1.6l-4.8 2.9-4.9-2.9c-.6-.3-.7-1-.4-1.6.3-.6 1-.8 1.7-.5l3.6 2.1z" stroke="#262626" stroke-width="1.6"/><path d="M11.2 7.7c0-2.3-2.1-3-4.8-1.4-2.7 1.5-4.8 4.7-4.8 7v11.2L4 26l7.3-4.2v-14z" fill="#BDC733" fill-rule="nonzero"/><path d="M11.2 7.7c0-2.3-2.1-3-4.8-1.4-2.7 1.5-4.8 4.7-4.8 7v11.2L4 26l7.3-4.2v-14z" stroke="#262626"/><path d="M3.2 16.2l3.7 2c.6.4.7 1.2.4 1.8-.3.6-1 .7-1.7.4L.8 17.6V12c0-.7.6-1.2 1.2-1.2.7 0 1.2.6 1.2 1.2v4.2z" fill="#806346" fill-rule="nonzero"/><path d="M3.2 16.2l3.7 2c.6.4.7 1.2.4 1.8-.3.6-1 .7-1.7.4L.8 17.6V12c0-.7.6-1.2 1.2-1.2.7 0 1.2.6 1.2 1.2v4.2z" stroke="#262626"/><path d="M6.4.8a4.1 4.1 0 1 1 0 8.3 4.1 4.1 0 0 1 0-8.3" fill="#806346" fill-rule="nonzero"/><path d="M6.4.8a4.1 4.1 0 1 1 0 8.3 4.1 4.1 0 0 1 0-8.3z" stroke="#262626"/><path d="M8.3 4.9c.2-.1.5 0 .6.2.2.2.1.5-.1.6-.3.1-.5 0-.7-.2 0-.2 0-.5.2-.6M5.8 6.3c.3-.1.5 0 .7.2.1.2 0 .5-.2.6-.2.2-.5 0-.7-.1 0-.3 0-.5.2-.7" fill="#262626" fill-rule="nonzero"/><path d="M5.4 9A4 4 0 0 1 4 5.7l.1-.7h.2A4 4 0 0 0 8 2.6c1.3.7 2.3 2 2.3 3.6l.2-1.3a4.1 4.1 0 0 0-8.2 0 4 4 0 0 0 3 4" fill="#262626" fill-rule="nonzero"/><path d="M5.4 9A4 4 0 0 1 4 5.7l.1-.7h.2A4 4 0 0 0 8 2.6c1.3.7 2.3 2 2.3 3.6l.2-1.3a4.1 4.1 0 0 0-8.2 0 4 4 0 0 0 3 4z" stroke="#262626" stroke-linecap="round" stroke-linejoin="round"/><path fill="#FFF" fill-rule="nonzero" d="M19 40.4l24.2-14-18.1-10.5-24.3 14z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M19 40.4l24.2-14-18.1-10.5-24.3 14z"/><path fill="#DAD933" fill-rule="nonzero" d="M23.3 33.1l1.4-10-5.4 1-4.3 8.7z"/><path fill="#DAD933" fill-rule="nonzero" d="M30.8 28.8l-17.5.9 2.1-3.3L30.1 24z"/><path fill="#C1C42E" fill-rule="nonzero" d="M24.7 23.1l-5.4 1-.9 1.8 6-1z"/><path fill="#AFAF2F" fill-rule="nonzero" d="M16.6 29.5l7.3-.3.6-4.3-6 1z"/><path fill="#C1C42E" fill-rule="nonzero" d="M15.4 26.4l3-.5 5.6 3.3-10.7.5z"/><path fill="#919431" fill-rule="nonzero" d="M18.4 26l-1.8 3.5 7.3-.3V29z"/><path d="M36.6 47.8c0 .8-.7 1.5-1.5 1.5s-1.4-.7-1.4-1.5v-10c0-.9.6-1.5 1.4-1.5.8 0 1.5.6 1.5 1.4v10.1z" fill="#515151" fill-rule="nonzero"/><path d="M36.6 47.8c0 .8-.7 1.5-1.5 1.5s-1.4-.7-1.4-1.5v-10c0-.9.6-1.5 1.4-1.5.8 0 1.5.6 1.5 1.4v10.1z" stroke="#262626"/><path d="M32.3 50.3c0 .8-.6 1.4-1.4 1.4-.8 0-1.5-.6-1.5-1.5v-10c0-.9.7-1.5 1.5-1.5s1.4.7 1.4 1.5v10z" fill="#515151" fill-rule="nonzero"/><path d="M32.3 50.3c0 .8-.6 1.4-1.4 1.4-.8 0-1.5-.6-1.5-1.5v-10c0-.9.7-1.5 1.5-1.5s1.4.7 1.4 1.5v10z" stroke="#262626"/><path d="M31.4 30.5c-.4.6-.2 1.3.4 1.7.6.3 1.3.1 1.6-.5l5-8.5c.3-.6 0-1.3-.5-1.6-.6-.4-1.3-.2-1.6.4l-5 8.5z" fill="#FFCBA6" fill-rule="nonzero"/><path d="M31.4 30.5c-.4.6-.2 1.3.4 1.7.6.3 1.3.1 1.6-.5l5-8.5c.3-.6 0-1.3-.5-1.6-.6-.4-1.3-.2-1.6.4l-5 8.5z" stroke="#262626" stroke-width="1.6"/><path d="M37.8 23c0-2.3-2.2-3-4.8-1.4-2.7 1.5-4.9 4.7-4.9 7v11.2l2.5 1.4 7.2-4.2V23z" fill="#6C75E1" fill-rule="nonzero"/><path d="M37.8 23c0-2.3-2.2-3-4.8-1.4-2.7 1.5-4.9 4.7-4.9 7v11.2l2.5 1.4 7.2-4.2V23z" stroke="#262626"/><path d="M33.1 16.3a4.1 4.1 0 1 1-4.1 4.1c0-2.3 1.9-4 4.1-4" fill="#FFCBA6" fill-rule="nonzero"/><path d="M33.1 16.3a4.1 4.1 0 1 1-4.1 4.1c0-2.3 1.9-4 4.1-4v-.1z" stroke="#262626"/><path d="M33.5 16.3h.2c2 .4 3.5 2 3.5 4.1a4 4 0 0 1-3.5 4 4.1 4.1 0 0 1-3.3-5.3c-.4 0-.8 0-1.2-.2l.1-.2.2-.3v-.2l.3-.3.2-.2.2-.2.4-.4h.1l.2-.2.2-.2.3-.1.3-.1.3-.1H33.5" fill="#98760F" fill-rule="nonzero"/><path d="M33.5 16.3h.2c2 .4 3.5 2 3.5 4.1a4 4 0 0 1-3.5 4 4.1 4.1 0 0 1-3.3-5.3c-.4 0-.8 0-1.2-.2l.1-.2.2-.3v-.2l.3-.3.2-.2.2-.2.4-.4h.1l.2-.2.2-.2.3-.1.3-.1.3-.1H33.5v-.1z" stroke="#262626" stroke-linecap="round" stroke-linejoin="round"/><path d="M24.1 34.7c-.4.6-.1 1.3.4 1.7.6.3 1.4 0 1.7-.5l4.9-8.5c.3-.6.1-1.3-.4-1.6-.6-.4-1.4-.2-1.7.4l-4.9 8.5z" fill="#FFCBA6" fill-rule="nonzero"/><path d="M24.1 34.7c-.4.6-.1 1.3.4 1.7.6.3 1.4 0 1.7-.5l4.9-8.5c.3-.6.1-1.3-.4-1.6-.6-.4-1.4-.2-1.7.4l-4.9 8.5z" stroke="#262626"/>
						</g>

					</g>

					<!-- 3, build -->
					<g class="gs-diamonds__step" transform="translate(120 205)" @click="navigate(3)" v-bind:class="{ active: 3 == step }">

						<path d="M58 124.6L2.3 69.1a8 8 0 0 1 0-11.3L58 2.3a8 8 0 0 1 11.3 0l55.6 55.5a8 8 0 0 1 0 11.3l-55.6 55.5a8 8 0 0 1-11.3 0z" fill="#A6BB05"/>

						<g transform="translate(49 52)">

							<text class="gs-diamonds__step-number" text-anchor="middle" transform="translate(15, 43)">
								3
							</text>

							<text
								class="gs-diamonds__step-title"
								text-anchor="middle"
								transform="translate(15, 16)"
								v-html="labels.build"
							>
							</text>

						</g>

						<g class="gs-diamonds__step-icon" transform="translate(40 -18)">
							<path fill="#F2F2F2" fill-rule="nonzero" d="M33 11.7L27.3 15 16 8.3 21.7 5z"/><path stroke="#262626" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M33 11.7L27.3 15 16 8.3 21.7 5z"/><path fill="#F2F2F2" fill-rule="nonzero" d="M32 12L21 5.1V3l11 6.8z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M32 12L21 5.1V3l11 6.8z"/><path fill="#F2F2F2" fill-rule="nonzero" d="M33 12l-6 3v-1.9l6-3.1z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M33 12l-6 3v-1.9l6-3.1z"/><path fill="#F2F2F2" fill-rule="nonzero" d="M22 4.9L16 8V6l6-3z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M22 4.9L16 8V6l6-3z"/><path fill="#F2F2F2" fill-rule="nonzero" d="M27 16L16 9.2V7l11 6.9z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M27 16L16 9.2V7l11 6.9z"/><path fill="#E5E5E5" fill-rule="nonzero" d="M1 10.8V24l17-9.9V1z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M1 10.8L18 1v13.1L1 24z"/><path fill="#6C75E1" fill-rule="nonzero" d="M2 11.5V20l15-8.5V3z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M2 11.5V20l15-8.5V3z"/><path fill="#E5E5E5" fill-rule="nonzero" d="M17.4 17L6 23.7l5.6 3.3L23 20.3z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M17.4 17L6 23.7l5.6 3.3L23 20.3z"/><path d="M20.6 32.4v2.4c0 .7-.6 1.3-1.3 1.3-.8 0-1.4-.6-1.4-1.3V30a1.4 1.4 0 0 1 2-1.2l4.2 2.4c.7.4.9 1.2.5 1.9-.4.6-1.2.9-1.9.5L20 32" fill="#FFCBA6" fill-rule="nonzero"/><path d="M20.6 32.4v2.4c0 .7-.6 1.3-1.3 1.3-.8 0-1.4-.6-1.4-1.3V30a1.4 1.4 0 0 1 2-1.2l4.2 2.4c.7.4.9 1.2.5 1.9-.4.6-1.2.9-1.9.5L20 32" stroke="#262626" stroke-linecap="round" stroke-linejoin="round"/><path d="M26.8 40.5c1.9 1 1.9 2.8 0 4-2 1-5 1-7 0-1.8-1.2-1.8-3 0-4 2-1.1 5-1.1 7 0" fill="#A2A2A2" fill-rule="nonzero"/><path d="M26.8 40.5c1.9 1 1.9 2.8 0 4-2 1-5 1-7 0-1.8-1.2-1.8-3 0-4 2-1.1 5-1.1 7 0z" stroke="#262626" stroke-linecap="round" stroke-linejoin="round"/><path d="M24.5 41.3a1.1 1.1 0 0 1-2.3 0V37c0-.6.5-1.1 1.1-1.1.7 0 1.2.5 1.2 1.1v4.3z" fill="#A2A2A2" fill-rule="nonzero"/><path d="M24.5 41.3a1.1 1.1 0 0 1-2.3 0V37c0-.6.5-1.1 1.1-1.1.7 0 1.2.5 1.2 1.1v4.3z" stroke="#262626" stroke-linecap="round" stroke-linejoin="round"/><path fill="#515151" fill-rule="nonzero" d="M23.3 41.2l-6.9-4v-2.6l7-4 6.9 4v2.6z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M23.3 41.2l-6.9-4v-2.6l7-4 6.9 4v2.6z"/><path d="M15.7 34.1l3 1.8c.6.3 1.5.1 1.9-.5.3-.6.1-1.5-.5-1.9l-4.2-2.3a1.4 1.4 0 0 0-2 1.1v8c0 .8.5 1.4 1.3 1.4s1.4-.6 1.4-1.4v-5.6" fill="#FFCBA6" fill-rule="nonzero"/><path d="M15.7 34.1l3 1.8c.6.3 1.5.1 1.9-.5.3-.6.1-1.5-.5-1.9l-4.2-2.3a1.4 1.4 0 0 0-2 1.1v8c0 .8.5 1.4 1.3 1.4s1.4-.6 1.4-1.4v-5.6" stroke="#262626" stroke-linecap="round" stroke-linejoin="round"/><path d="M23.4 20.6l-3.4-2c-.6-.2-1.3 0-1.6.5-.4.5-.2 1.2.4 1.5l4.6 2.7 4.6-2.6c.6-.4.8-1 .4-1.6-.3-.6-1-.7-1.6-.4l-3.4 2z" fill="#FFCBA6" fill-rule="nonzero"/><path d="M23.4 20.6l-3.4-2c-.6-.2-1.3 0-1.6.5-.4.5-.2 1.2.4 1.5l4.6 2.7 4.6-2.6c.6-.4.8-1 .4-1.6-.3-.6-1-.7-1.6-.4l-3.4 2z" stroke="#262626"/><path d="M28 20c0-2.1-2.1-2.7-4.7-1.3-2.5 1.5-4.6 4.4-4.6 6.6V36l2.4 1.3 6.9-4V20z" fill="#23B2A7" fill-rule="nonzero"/><path d="M28 20c0-2.1-2.1-2.7-4.7-1.3-2.5 1.5-4.6 4.4-4.6 6.6V36l2.4 1.3 6.9-4V20z" stroke="#262626"/><path fill="#515151" fill-rule="nonzero" d="M30.3 34.6l-7 4-2.3-1.4V26.7l7-4 2.3 1.3z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M30.3 34.6l-7 4-2.3-1.4V26.7l7-4 2.3 1.3z"/><path d="M23.5 13.7c2.1 0 3.9 1.8 3.9 3.9 0 2.1-1.8 3.8-3.9 3.8a3.9 3.9 0 1 1 0-7.7" fill="#FFCBA6" fill-rule="nonzero"/><path d="M23.5 13.7c2.1 0 3.9 1.8 3.9 3.9 0 2.1-1.8 3.8-3.9 3.8a3.9 3.9 0 1 1 0-7.7z" stroke="#262626"/><path d="M23.8 13.7h.3a4 4 0 0 1 3.3 3.9c0 1.9-1.4 3.5-3.3 3.8a4 4 0 0 1-3.2-5.1 4 4 0 0 1-1.1-.1v-.3l.2-.2v-.3l.3-.2.2-.3.2-.2.4-.3.3-.2.2-.2.3-.1.2-.1h.3l.3-.1H23.8" fill="#464646" fill-rule="nonzero"/><path d="M23.8 13.7h.3a4 4 0 0 1 3.3 3.9c0 1.9-1.4 3.5-3.3 3.8a4 4 0 0 1-3.2-5.1 4 4 0 0 1-1.1-.1v-.3l.2-.2v-.3l.3-.2.2-.3.2-.2.4-.3.3-.2.2-.2.3-.1.2-.1h.3l.3-.1H23.8z" stroke="#262626" stroke-linecap="round" stroke-linejoin="round"/><path d="M16.5 24.6l-3.5-2c-.5-.3-1.2 0-1.6.4-.3.6 0 1.3.4 1.6l4.7 2.7 4.6-2.7c.6-.3.7-1 .4-1.6-.3-.5-1-.7-1.6-.4l-3.4 2z" fill="#FFCBA6" fill-rule="nonzero"/><path d="M16.5 24.6l-3.5-2c-.5-.3-1.2 0-1.6.4-.3.6 0 1.3.4 1.6l4.7 2.7 4.6-2.7c.6-.3.7-1 .4-1.6-.3-.5-1-.7-1.6-.4l-3.4 2z" stroke="#262626"/>
						</g>

					</g>

					<!-- 4, publish -->
					<g class="gs-diamonds__step" transform="translate(202 122)" @click="navigate(4)" v-bind:class="{ active: 4 == step }">

						<path d="M58 124.6L2.3 69.1a8 8 0 0 1 0-11.3L58 2.3a8 8 0 0 1 11.3 0l55.6 55.5a8 8 0 0 1 0 11.3l-55.6 55.5a8 8 0 0 1-11.3 0z" fill="#A6BB05"/>

						<g transform="translate(49 52)">

							<text class="gs-diamonds__step-number" text-anchor="middle" transform="translate(15, 43)">
								4
							</text>

							<text
								class="gs-diamonds__step-title"
								text-anchor="middle"
								transform="translate(15, 16)"
								v-html="labels.publish"
							>
							</text>

						</g>

						<g class="gs-diamonds__step-icon" transform="translate(40 -20)">
							<path d="M22.2 48c2.4 1.4 2.4 3.6 0 5a9.3 9.3 0 0 1-8.4 0c-2.4-1.4-2.4-3.6 0-5a9.3 9.3 0 0 1 8.4 0" fill="#A2A2A2" fill-rule="nonzero"/><path d="M22.2 48c2.4 1.4 2.4 3.6 0 5a9.3 9.3 0 0 1-8.4 0c-2.4-1.4-2.4-3.6 0-5a9.3 9.3 0 0 1 8.4 0z" stroke="#262626" stroke-linecap="round" stroke-linejoin="round"/><path d="M19 48.6c0 .8-.7 1.4-1.5 1.4-.9 0-1.5-.6-1.5-1.4v-5.2c0-.8.7-1.4 1.5-1.4.9 0 1.5.6 1.5 1.4v5.2z" fill="#A2A2A2" fill-rule="nonzero"/><path d="M19 48.6c0 .8-.7 1.4-1.5 1.4-.9 0-1.5-.6-1.5-1.4v-5.2c0-.8.7-1.4 1.5-1.4.9 0 1.5.6 1.5 1.4v5.2z" stroke="#262626" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path fill="#515151" fill-rule="nonzero" d="M17.5 49L9 44.1V41l8.5-4.9 8.5 4.9V44z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M17.5 49L9 44.1V41l8.5-4.9 8.5 4.9V44z"/><path fill="#515151" fill-rule="nonzero" d="M20 37.3L11.7 42 9 40.5V27.7l8.2-4.7 2.7 1.6z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M20 37.3L11.7 42 9 40.5V27.7l8.2-4.7 2.7 1.6z"/><path d="M22 55.3c0 1-.7 1.7-1.6 1.7-.9 0-1.6-.7-1.6-1.7v-8.8l-4-2.4c-.8-.4-1-1.5-.6-2.3.5-.8 1.4-1 2.2-.6l4.8 3c.5.3.8.8.8 1.4v9.7z" fill="#FFCBA6" fill-rule="nonzero"/><path d="M22 55.3c0 1-.7 1.7-1.6 1.7-.9 0-1.6-.7-1.6-1.7v-8.8l-4-2.4c-.8-.4-1-1.5-.6-2.3.5-.8 1.4-1 2.2-.6l4.8 3c.5.3.8.8.8 1.4v9.7z" stroke="#262626"/><path d="M27 52.3c0 1-.7 1.7-1.6 1.7-.9 0-1.6-.7-1.6-1.7v-8.8l-4-2.4c-.8-.4-1-1.5-.6-2.3.4-.8 1.4-1 2.2-.6l4.8 3c.5.3.8.8.8 1.4v9.7z" fill="#FFCBA6" fill-rule="nonzero"/><path d="M27 52.3c0 1-.7 1.7-1.6 1.7-.9 0-1.6-.7-1.6-1.7v-8.8l-4-2.4c-.8-.4-1-1.5-.6-2.3.4-.8 1.4-1 2.2-.6l4.8 3c.5.3.8.8.8 1.4v9.7z" stroke="#262626"/><path d="M25 24.7l4-2.5c.6-.4 1.4-.1 1.8.5.4.7.2 1.6-.4 2L25 28l-5.3-3.3c-.7-.4-.9-1.3-.5-2s1.2-.9 1.8-.5l4 2.5z" fill="#FFCBA6" fill-rule="nonzero"/><path d="M25 24.7l4-2.5c.6-.4 1.4-.1 1.8.5.4.7.2 1.6-.4 2L25 28l-5.3-3.3c-.7-.4-.9-1.3-.5-2s1.2-.9 1.8-.5l4 2.5z" stroke="#262626"/><path d="M23 22.6c0-2.7-2.5-3.4-5.5-1.6-3 1.8-5.5 5.5-5.5 8.2v13.2l2.8 1.6 8.2-4.9V22.6z" fill="#23B2A7" fill-rule="nonzero"/><path d="M23 22.6c0-2.7-2.5-3.4-5.5-1.6-3 1.8-5.5 5.5-5.5 8.2v13.2l2.8 1.6 8.2-4.9V22.6z" stroke="#262626"/><path d="M17.5 15a4.5 4.5 0 1 1 0 9 4.5 4.5 0 0 1 0-9" fill="#FFCBA6" fill-rule="nonzero"/><path d="M17.5 15a4.5 4.5 0 1 1 0 9 4.5 4.5 0 0 1 0-9z" stroke="#262626"/><path d="M19.5 19.1a1 1 0 0 1 1.4.4 1 1 0 0 1-.4 1.4 1 1 0 0 1-1.4-.4 1 1 0 0 1 .4-1.4z" stroke="#262626" stroke-width=".8"/><path d="M18.2 21c-.4-.3-.2-.8.3-.9.5-.2 1.2 0 1.5.2M16.5 21.1a1 1 0 0 1 1.4.4 1 1 0 0 1-.4 1.4 1 1 0 0 1-1.4-.4 1 1 0 0 1 .4-1.4z" stroke="#262626" stroke-width=".8"/><path d="M22 18.3c-.7-2-2.4-3.3-4.4-3.3-2.5 0-4.6 2.2-4.6 5v.8a4 4 0 0 0 2.8-.1 4.7 4.7 0 0 0 2.8-3.1 4 4 0 0 0 3.4.7" fill="#98760F" fill-rule="nonzero"/><path d="M22 18.3c-.7-2-2.4-3.3-4.4-3.3-2.5 0-4.6 2.2-4.6 5v.8a4 4 0 0 0 2.8-.1 4.7 4.7 0 0 0 2.8-3.1 4 4 0 0 0 3.4.7z" stroke="#262626" stroke-linecap="round" stroke-linejoin="round"/><path d="M18.8 39.8c.4.7.2 1.6-.4 2-.7.4-1.5.2-1.8-.5l-5.4-10.1c-.4-.7-.2-1.6.5-2 .6-.4 1.4-.2 1.8.5l5.3 10.1z" fill="#FFCBA6" fill-rule="nonzero"/><path d="M18.8 39.8c.4.7.2 1.6-.4 2-.7.4-1.5.2-1.8-.5l-5.4-10.1c-.4-.7-.2-1.6.5-2 .6-.4 1.4-.2 1.8.5l5.3 10.1z" stroke="#262626"/><path fill="#F2F2F2" fill-rule="nonzero" d="M27.9 37L17 43.5l9.2 5.5L37 42.5z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M27.9 37L17 43.5l9.2 5.5L37 42.5z"/><path fill="#515151" fill-rule="nonzero" d="M36 43.3L27.8 48 22 44.7l8.2-4.7z"/><path stroke="#262626" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M36 43.3L27.8 48 22 44.7l8.2-4.7z"/><path fill="#F2F2F2" fill-rule="nonzero" d="M29.8 38.3L41 32l-2.8 10.7L27 49z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M29.8 38.3L41 32l-2.8 10.7L27 49z"/><path fill="#D1D871" fill-rule="nonzero" d="M22.3 2.2L20.5 1l.1 2.1L19 4.5l2 .5.8 2 1-1.8 2.2-.1-1.3-1.7.6-2z"/><path stroke="#333" stroke-linecap="round" stroke-linejoin="round" d="M22.3 2.2L20.5 1l.1 2.1L19 4.5l2 .5.8 2 1-1.8 2.2-.1-1.3-1.7.6-2z"/><path fill="#D1D871" fill-rule="nonzero" d="M17.3 4.2L15.5 3l.2 2.2L14 6.5l2 .5.8 2 1.1-1.8H20l-1.4-1.7.6-2z"/><path stroke="#333" stroke-linecap="round" stroke-linejoin="round" d="M17.3 4.2L15.5 3l.2 2.2L14 6.5l2 .5.8 2 1.1-1.8H20l-1.4-1.7.6-2z"/><path fill="#D1D871" fill-rule="nonzero" d="M12.3 7.2L10.5 6l.2 2.1L9 9.5l2 .5.8 2 1.1-1.8 2.1-.1-1.3-1.7.5-2z"/><path stroke="#333" stroke-linecap="round" stroke-linejoin="round" d="M12.3 7.2L10.5 6l.2 2.1L9 9.5l2 .5.8 2 1.1-1.8 2.1-.1-1.3-1.7.5-2z"/><path fill="#D1D871" fill-rule="nonzero" d="M7.3 10.2L5.5 9l.2 2.1L4 12.4l2 .6.8 2 1.1-1.8 2.1-.1-1.3-1.7.5-2z"/><path stroke="#333" stroke-linecap="round" stroke-linejoin="round" d="M7.3 10.2L5.5 9l.2 2.1L4 12.4l2 .6.8 2 1.1-1.8 2.1-.1-1.3-1.7.5-2z"/><path fill="#D1D871" fill-rule="nonzero" d="M3.2 13.2L1.5 12l.1 2.2L0 15.5l2 .5.8 2 1-1.8L6 16l-1.4-1.6.6-2z"/><path stroke="#333" stroke-linecap="round" stroke-linejoin="round" d="M3.2 13.2L1.5 12l.1 2.2L0 15.5l2 .5.8 2 1-1.8L6 16l-1.4-1.6.6-2z"/>
						</g>

					</g>

					<!-- 5, use -->
					<g class="gs-diamonds__step" transform="translate(300 30)" @click="navigate(5)" v-bind:class="{ active: 5 == step }">

						<path d="M58 124.6L2.3 69.1a8 8 0 0 1 0-11.3L58 2.3a8 8 0 0 1 11.3 0l55.6 55.5a8 8 0 0 1 0 11.3l-55.6 55.5a8 8 0 0 1-11.3 0z" :fill="'url(#' + prefix + '--red-gradient)'"/>

						<g transform="translate(49 52)">

							<text class="gs-diamonds__step-number" text-anchor="middle" transform="translate(15, 43)">
								5
							</text>

							<text
								class="gs-diamonds__step-title"
								text-anchor="middle"
								transform="translate(15, 16)"
								v-html="labels.use"
							>
							</text>

						</g>

						<g class="gs-diamonds__step-icon" transform="translate(48 -4)">
							<path d="M20 27.9c0 .6.4 1.1 1 1.1s1-.5 1-1.1V20c0-.6-.4-1.1-1-1.1s-1 .5-1 1.1V28z" fill="#515151" fill-rule="nonzero"/><path d="M20 27.9c0 .6.4 1.1 1 1.1s1-.5 1-1.1V20c0-.6-.4-1.1-1-1.1s-1 .5-1 1.1V28z" stroke="#262626"/><path d="M17 25.9c0 .6.4 1.1 1 1.1s1-.5 1-1.1V18c0-.6-.4-1.1-1-1.1s-1 .5-1 1.1V26z" fill="#515151" fill-rule="nonzero"/><path d="M17 25.9c0 .6.4 1.1 1 1.1s1-.5 1-1.1V18c0-.6-.4-1.1-1-1.1s-1 .5-1 1.1V26z" stroke="#262626"/><path d="M13.5 6.8l-3-1.7a1 1 0 0 0-1.4.4c-.3.4 0 1 .4 1.3l4 2.2 4-2.2c.5-.3.6-.9.4-1.3a1 1 0 0 0-1.4-.4l-3 1.7z" fill="#FFCBA6" fill-rule="nonzero"/><path d="M13.5 6.8l-3-1.7a1 1 0 0 0-1.4.4c-.3.4 0 1 .4 1.3l4 2.2 4-2.2c.5-.3.6-.9.4-1.3a1 1 0 0 0-1.4-.4l-3 1.7z" stroke="#262626"/><path fill="#6C75E1" fill-rule="nonzero" d="M8 6l1.5-3L11 4 9.5 7z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M8 6l1.5-3L11 4 9.5 7zM11 2c-.3-.6-.9-1-1.5-1S8.3 1.4 8 2"/><path d="M9 2.3c.1-.2.3-.3.4-.3.2 0 .4.1.5.3M11 1.8c-.2-.5-.6-.8-1-.8s-.8.3-1 .8" stroke="#262626" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 5.8c0-1.8 1.8-2.3 4-1.1 2.2 1.2 4 3.6 4 5.4V19L22 20l-6-3.3v-11z" fill="#FB6045" fill-rule="nonzero"/><path d="M16 5.8c0-1.8 1.8-2.3 4-1.1 2.2 1.2 4 3.6 4 5.4V19L22 20l-6-3.3v-11z" stroke="#262626"/><path d="M22 17c0 .6.5 1 1 1 .6 0 1-.5 1-1V9c0-.6-.5-1-1-1a1 1 0 0 0-1 1v8z" fill="#FFCBA6" fill-rule="nonzero"/><path d="M22 17c0 .6.5 1 1 1 .6 0 1-.5 1-1V9c0-.6-.5-1-1-1a1 1 0 0 0-1 1v8z" stroke="#262626"/><path d="M19.5 1a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7" fill="#FFCBA6" fill-rule="nonzero"/><path d="M19.5 1a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7z" stroke="#262626" stroke-width="1.6"/><path d="M17 4.3c.1-.2.4-.4.7-.3.2.1.4.4.3.7-.1.2-.4.4-.7.3a.5.5 0 0 1-.3-.7z" stroke="#262626" stroke-width=".8"/><path d="M19 5c0-.4 0-.8-.3-1-.3 0-.6 0-.7.5M19 5.3c.1-.2.4-.4.7-.3.2.1.4.4.3.7-.1.2-.4.4-.7.3a.5.5 0 0 1-.3-.7z" stroke="#262626" stroke-width=".8"/><path d="M20.4 8c.7-.7 1.1-1.6 1.1-2.7v-.6h-.2c-1.4 0-2.7-.9-3.2-2.1a3.6 3.6 0 0 0-2 3l-.1-1c0-2 1.6-3.6 3.5-3.6 2 0 3.5 1.6 3.5 3.5 0 1.7-1.1 3-2.6 3.5" fill="#A2A2A2" fill-rule="nonzero"/><path d="M20.4 8c.7-.7 1.1-1.6 1.1-2.7v-.6h-.2c-1.4 0-2.7-.9-3.2-2.1a3.6 3.6 0 0 0-2 3l-.1-1c0-2 1.6-3.6 3.5-3.6 2 0 3.5 1.6 3.5 3.5 0 1.7-1.1 3-2.6 3.5z" stroke="#262626" stroke-linecap="round" stroke-linejoin="round"/><path d="M2 33.9c0 .6.4 1.1 1 1.1s1-.5 1-1.1V26c0-.6-.4-1.1-1-1.1s-1 .5-1 1.1V34z" fill="#CC9E70" fill-rule="nonzero"/><path d="M2 33.9c0 .6.4 1.1 1 1.1s1-.5 1-1.1V26c0-.6-.4-1.1-1-1.1s-1 .5-1 1.1V34z" stroke="#262626"/><path d="M6 35.9c0 .6.4 1.1 1 1.1s1-.5 1-1.1V28c0-.6-.4-1.1-1-1.1s-1 .5-1 1.1V36z" fill="#CC9E70" fill-rule="nonzero"/><path d="M6 35.9c0 .6.4 1.1 1 1.1s1-.5 1-1.1V28c0-.6-.4-1.1-1-1.1s-1 .5-1 1.1V36z" stroke="#262626"/><path d="M1 22c0 .6.5 1 1 1 .6 0 1-.5 1-1v-8c0-.6-.5-1-1-1a1 1 0 0 0-1 1v8z" fill="#CC9E70" fill-rule="nonzero"/><path d="M1 22c0 .6.5 1 1 1 .6 0 1-.5 1-1v-8c0-.6-.5-1-1-1a1 1 0 0 0-1 1v8z" stroke="#262626" stroke-width="1.6"/><path d="M1 14.8c0-1.8 1.8-2.3 4-1.1 2.2 1.2 4 3.6 4 5.4V28L7 29l-6-3.3v-11z" fill="#23B2A7" fill-rule="nonzero"/><path d="M1 14.8c0-1.8 1.8-2.3 4-1.1 2.2 1.2 4 3.6 4 5.4V28L7 29l-6-3.3v-11z" stroke="#262626"/><path d="M5.5 9a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7" fill="#CC9E70" fill-rule="nonzero"/><path d="M5.5 9a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7z" stroke="#262626"/><path d="M4.8 9h-.2C3.2 9.4 2 10.9 2 12.6c0 1.8 1.1 3.2 2.6 3.5 1.5-.3 2.6-1.7 2.6-3.5l-.1-1.1.9-.1-.1-.2-.1-.3-.1-.2-.1-.2-.2-.3-.1-.2c-.2 0-.3-.2-.4-.3l-.2-.2h-.1l-.3-.2h-.1L5.8 9h-.2L5.5 9h-.7" fill="#92613C" fill-rule="nonzero"/><path d="M4.8 9h-.2C3.2 9.4 2 10.9 2 12.6c0 1.8 1.1 3.2 2.6 3.5 1.5-.3 2.6-1.7 2.6-3.5l-.1-1.1.9-.1-.1-.2-.1-.3-.1-.2-.1-.2-.2-.3-.1-.2c-.2 0-.3-.2-.4-.3l-.2-.2h-.1l-.3-.2h-.1L5.8 9h-.2L5.5 9h-.7z" stroke="#262626" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.8 10.7l.2-.9a4 4 0 0 0-.8-.2C7.5 8.6 6.3 8 5 8c-2.2 0-4 2-4 4.3l.3 1.5-.2.9.8.2H3a6 6 0 0 0 5.8-4.2" fill="#FFDC00" fill-rule="nonzero"/><path d="M8.8 10.7l.2-.9a4 4 0 0 0-.8-.2C7.5 8.6 6.3 8 5 8c-2.2 0-4 2-4 4.3l.3 1.5-.2.9.8.2H3a6 6 0 0 0 5.8-4.2z" stroke="#262626" stroke-linecap="round" stroke-linejoin="round"/><path d="M10.5 18.8l3-1.7a1 1 0 0 1 1.4.4c.3.4 0 1-.4 1.3l-4 2.2-4-2.2a1 1 0 0 1-.3-1.3c.2-.5.8-.6 1.3-.4l3 1.7z" fill="#CC9E70" fill-rule="nonzero"/><path d="M10.5 18.8l3-1.7a1 1 0 0 1 1.4.4c.3.4 0 1-.4 1.3l-4 2.2-4-2.2a1 1 0 0 1-.3-1.3c.2-.5.8-.6 1.3-.4l3 1.7z" stroke="#262626"/><path fill="#FFF" fill-rule="nonzero" d="M37 36.1L28.7 41 15 32.9l8.3-4.9z"/><path stroke="#333" stroke-linecap="round" stroke-linejoin="round" d="M37 36.1L28.7 41 15 32.9l8.3-4.9z"/><path fill="#FFF" fill-rule="nonzero" d="M37 35.1L28.7 40 15 31.9l8.3-4.9z"/><path stroke="#333" stroke-linecap="round" stroke-linejoin="round" d="M37 35.1L28.7 40 15 31.9l8.3-4.9z"/><path fill="#FFF" fill-rule="nonzero" d="M37 34.1L28.7 39 15 30.9l8.3-4.9z"/><path stroke="#333" stroke-linecap="round" stroke-linejoin="round" d="M37 34.1L28.7 39 15 30.9l8.3-4.9z"/><path fill="#FFF" fill-rule="nonzero" d="M37 33.1L28.7 38 15 29.9l8.3-4.9z"/><path stroke="#333" stroke-linecap="round" stroke-linejoin="round" d="M37 33.1L28.7 38 15 29.9l8.3-4.9z"/><path fill="#FB6045" fill-rule="nonzero" d="M25 28l-1.4.1-.3.9-3.3-2 1.7-1z"/><path stroke="#333" stroke-linecap="round" stroke-linejoin="round" d="M25 28l-1.4.1-.3.9-3.3-2 1.7-1z"/><path d="M29 36l5-3" stroke="#333" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M28 36l5-3M27 35l5-3M26 35l5-3M25 34l5-3M24 34l5-3" stroke="#333" stroke-linecap="round" stroke-linejoin="round"/>
						</g>

					</g>

					<!-- 6, evaluate -->
					<g class="gs-diamonds__step" transform="translate(390 122)" @click="navigate(6)" v-bind:class="{ active: 6 == step }">

						<path d="M58 124.6L2.3 69.1a8 8 0 0 1 0-11.3L58 2.3a8 8 0 0 1 11.3 0l55.6 55.5a8 8 0 0 1 0 11.3l-55.6 55.5a8 8 0 0 1-11.3 0z" :fill="'url(#' + prefix + '--purple-gradient)'"/>

						<g transform="translate(49 52)">

							<text class="gs-diamonds__step-number" text-anchor="middle" transform="translate(15, 43)">
								6
							</text>

							<text
								class="gs-diamonds__step-title"
								text-anchor="middle"
								transform="translate(15, 16)"
								v-html="labels.evaluate"
							>
							</text>


						</g>

						<g class="gs-diamonds__step-icon" transform="translate(45 -8)">

							<path fill="#FFF" fill-rule="nonzero" d="M0 13.2L25.7 28 45 16.8 19.3 2z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M25.7 28L0 13.2 19.3 2 45 16.8z"/><path stroke="#333" stroke-linecap="round" stroke-linejoin="round" d="M23.6 21L17 17.4l4.4-2.4 6.6 3.6z"/><path stroke="#333" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" d="M17 18v-7.5L21 8v7.6z"/><path stroke="#333" stroke-linecap="round" stroke-linejoin="round" d="M27 19v-7.3L21 8v7.3zM29 12v7M29 20.7l-1-.7M29 12.8l-1-.8"/><path d="M15 10v7M15 17.7l-1-.7M15 10.8l-1-.8M19 9v.3" stroke="#333" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M19 10v5" stroke="#333" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="1.1"/><path d="M19 16v.3" stroke="#333" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M19 16l6 4" stroke="#333" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="1"/><path d="M34 16l3 2M35 15l3 2M37 14l3 2" stroke="#333" stroke-linecap="round" stroke-linejoin="round"/><path d="M6.6 34.3c0 .8.7 1.5 1.5 1.5.9 0 1.6-.7 1.6-1.5V23.7c0-.8-.7-1.5-1.6-1.5-.8 0-1.5.7-1.5 1.5v10.6z" fill="#806346" fill-rule="nonzero"/><path d="M6.6 34.3c0 .8.7 1.5 1.5 1.5.9 0 1.6-.7 1.6-1.5V23.7c0-.8-.7-1.5-1.6-1.5-.8 0-1.5.7-1.5 1.5v10.6z" stroke="#262626"/><path d="M11 36.8c0 .9.7 1.5 1.6 1.5.8 0 1.5-.6 1.5-1.5V26.3c0-.9-.7-1.5-1.5-1.5-.9 0-1.6.6-1.6 1.5v10.5z" fill="#806346" fill-rule="nonzero"/><path d="M11 36.8c0 .9.7 1.5 1.6 1.5.8 0 1.5-.6 1.5-1.5V26.3c0-.9-.7-1.5-1.5-1.5-.9 0-1.6.6-1.6 1.5v10.5z" stroke="#262626"/><path d="M10.3 9l3.8-2.2c.6-.3 1.4 0 1.7.5.4.6.2 1.4-.4 1.8L10.3 12l-5-3c-.7-.3-.9-1-.5-1.7.3-.6 1-.8 1.7-.4L10.3 9z" fill="#806346" fill-rule="nonzero"/><path d="M10.3 9l3.8-2.2c.6-.3 1.4 0 1.7.5.4.6.2 1.4-.4 1.8L10.3 12l-5-3c-.7-.3-.9-1-.5-1.7.3-.6 1-.8 1.7-.4L10.3 9z" stroke="#262626"/><path d="M5.3 8.4c0-2.4 2.3-3.1 5-1.5 2.8 1.6 5.1 5 5.1 7.3V26L13 27.4 5.3 23V8.4z" fill="#FB6045" fill-rule="nonzero"/><path d="M5.3 8.4c0-2.4 2.3-3.1 5-1.5 2.8 1.6 5.1 5 5.1 7.3V26L13 27.4 5.3 23V8.4z" stroke="#262626"/><path d="M10.4 1.2a4.3 4.3 0 1 1 0 8.6 4.3 4.3 0 1 1 0-8.6" fill="#806346" fill-rule="nonzero"/><path d="M10.4 1.2a4.3 4.3 0 1 1 0 8.6 4.3 4.3 0 1 1 0-8.6z" stroke="#262626"/><path d="M10 1.2h-.2c-2 .3-3.7 2.1-3.7 4.3 0 2.1 1.6 4 3.7 4.2a4.3 4.3 0 0 0 3.4-5.6l1.3-.1-.1-.3-.1-.3L14 3l-.1-.3-.3-.2c0-.1 0-.2-.2-.3L13 2l-.2-.3h-.3v-.1l-.3-.2H12l-.3-.1-.4-.1H10" fill="#262626" fill-rule="nonzero"/><path d="M10 1.2h-.2c-2 .3-3.7 2.1-3.7 4.3 0 2.1 1.6 4 3.7 4.2a4.3 4.3 0 0 0 3.4-5.6l1.3-.1-.1-.3-.1-.3L14 3l-.1-.3-.3-.2c0-.1 0-.2-.2-.3L13 2l-.2-.3h-.3v-.1l-.3-.2H12l-.3-.1-.4-.1H10z" stroke="#262626" stroke-linecap="round" stroke-linejoin="round"/><path fill="#FFF" fill-rule="nonzero" d="M13 12.8l6.3-11 6.3 3.7-6.3 11z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M13 12.8l6.3-11 6.3 3.7-6.3 11z"/><path d="M17.9 13.4l3.8-2.2c.6-.3 1.4-.1 1.7.5.4.6.2 1.4-.4 1.7l-5 3-5.2-3c-.6-.3-.8-1-.4-1.7.3-.6 1-.8 1.7-.5l3.8 2.2z" fill="#806346" fill-rule="nonzero"/><path d="M17.9 13.4l3.8-2.2c.6-.3 1.4-.1 1.7.5.4.6.2 1.4-.4 1.7l-5 3-5.2-3c-.6-.3-.8-1-.4-1.7.3-.6 1-.8 1.7-.5l3.8 2.2z" stroke="#262626"/>

						</g>

					</g>

					<!-- 7, learn & share -->
					<g class="gs-diamonds__step" transform="translate(300 215)" @click="navigate(7)" v-bind:class="{ active: 7 == step }">

						<path d="M58 124.6L2.3 69.1a8 8 0 0 1 0-11.3L58 2.3a8 8 0 0 1 11.3 0l55.6 55.5a8 8 0 0 1 0 11.3l-55.6 55.5a8 8 0 0 1-11.3 0z" :fill="'url(#' + prefix + '--green-gradient)'"/>

						<g transform="translate(49 52)">

							<text class="gs-diamonds__step-number" text-anchor="middle" transform="translate(15, 43)">
								7
							</text>

							<text
								class="gs-diamonds__step-title"
								text-anchor="middle"
								transform="translate(15, 0)"
								v-html="labels.learn[0]"
							>
							</text>

							<text
								class="gs-diamonds__step-title"
								text-anchor="middle"
								transform="translate(15, 16)"
								v-html="labels.learn[1]"
							>
							</text>

						</g>

						<g class="gs-diamonds__step-icon" transform="translate(85 65)">
							<path d="M65.1 51.7a1.2 1.2 0 1 1-2.4 0v-8.3c0-.6.5-1.2 1.2-1.2s1.2.5 1.2 1.2v8.3z" fill="#806346" fill-rule="nonzero"/><path d="M65.1 51.7a1.2 1.2 0 1 1-2.4 0v-8.3c0-.6.5-1.2 1.2-1.2s1.2.5 1.2 1.2v8.3z" stroke="#262626"/><path d="M61.6 53.7a1.2 1.2 0 1 1-2.4 0v-8.3c0-.6.6-1.2 1.2-1.2.7 0 1.2.6 1.2 1.2v8.3z" fill="#806346" fill-rule="nonzero"/><path d="M61.6 53.7a1.2 1.2 0 1 1-2.4 0v-8.3c0-.6.6-1.2 1.2-1.2.7 0 1.2.6 1.2 1.2v8.3z" stroke="#262626"/><path d="M66.6 31.4a1 1 0 0 1-1.2.6 1 1 0 0 1-.6-1.3l2.7-7.6a1 1 0 0 1 1.3-.6c.5.2.8.8.6 1.3l-2.8 7.6z" fill="#806346" fill-rule="nonzero"/><path d="M66.6 31.4a1 1 0 0 1-1.2.6 1 1 0 0 1-.6-1.3l2.7-7.6a1 1 0 0 1 1.3-.6c.5.2.8.8.6 1.3l-2.8 7.6z" stroke="#262626"/><path d="M66.1 31.4c0-2-1.8-2.5-4-1.2-2.1 1.3-4 3.9-4 5.8V45l2 1.2 6-3.4V31.4z" fill="#6C75E1" fill-rule="nonzero"/><path d="M66.1 31.4c0-2-1.8-2.5-4-1.2-2.1 1.3-4 3.9-4 5.8V45l2 1.2 6-3.4V31.4z" stroke="#262626"/><path d="M62.3 25.9" fill="#806346" fill-rule="nonzero"/><path d="M62.3 25.9z" stroke="#262626" stroke-width="1.6"/><path d="M62.5 25.9h.2a3.3 3.3 0 1 1 0 6.6 3.4 3.4 0 0 1-2.7-4.4h-1l.1-.3.1-.2.1-.2c0-.2.1-.2.2-.3l.1-.2.2-.1.4-.4.2-.1.2-.1.2-.2h.3l.2-.1H62.5" fill="#464646" fill-rule="nonzero"/><path d="M62.5 25.9h.2a3.3 3.3 0 1 1 0 6.6 3.4 3.4 0 0 1-2.7-4.4h-1l.1-.3.1-.2.1-.2c0-.2.1-.2.2-.3l.1-.2.2-.1.4-.4.2-.1.2-.1.2-.2h.3l.2-.1H62.5z" stroke="#262626" stroke-linecap="round" stroke-linejoin="round"/><path d="M60.7 34.1c.1.6 0 1.1-.6 1.3-.5.2-1.1 0-1.3-.6l-2.7-7.6a1 1 0 0 1 .6-1.2c.5-.2 1 0 1.2.6l2.8 7.5z" fill="#806346" fill-rule="nonzero"/><path d="M60.7 34.1c.1.6 0 1.1-.6 1.3-.5.2-1.1 0-1.3-.6l-2.7-7.6a1 1 0 0 1 .6-1.2c.5-.2 1 0 1.2.6l2.8 7.5z" stroke="#262626"/><path d="M50.2 48.8c0 .7-.5 1.2-1.2 1.2s-1.2-.5-1.2-1.2v-8.3a1.2 1.2 0 1 1 2.4 0v8.3z" fill="#FFCBA6" fill-rule="nonzero"/><path d="M50.2 48.8c0 .7-.5 1.2-1.2 1.2s-1.2-.5-1.2-1.2v-8.3a1.2 1.2 0 1 1 2.4 0v8.3z" stroke="#262626"/><path d="M46.7 50.8c0 .7-.5 1.2-1.2 1.2-.6 0-1.1-.5-1.1-1.2v-8.3a1.2 1.2 0 1 1 2.3 0v8.3z" fill="#FFCBA6" fill-rule="nonzero"/><path d="M46.7 50.8c0 .7-.5 1.2-1.2 1.2-.6 0-1.1-.5-1.1-1.2v-8.3a1.2 1.2 0 1 1 2.3 0v8.3z" stroke="#262626"/><path d="M51.7 28.5a1 1 0 0 1-1.2.6c-.5-.2-.8-.8-.6-1.3l2.7-7.6c.2-.5.8-.7 1.3-.6.5.2.8.8.6 1.3l-2.8 7.6z" fill="#FFCBA6" fill-rule="nonzero"/><path d="M51.7 28.5a1 1 0 0 1-1.2.6c-.5-.2-.8-.8-.6-1.3l2.7-7.6c.2-.5.8-.7 1.3-.6.5.2.8.8.6 1.3l-2.8 7.6z" stroke="#262626"/><path d="M51.2 28.5c0-1.9-1.8-2.4-4-1.2-2.2 1.3-4 3.9-4 5.8v9.2l2 1.1 6-3.4V28.5z" fill="#23B2A7" fill-rule="nonzero"/><path d="M51.2 28.5c0-1.9-1.8-2.4-4-1.2-2.2 1.3-4 3.9-4 5.8v9.2l2 1.1 6-3.4V28.5z" stroke="#262626"/><path d="M47.4 23a3.4 3.4 0 1 1 0 6.7 3.4 3.4 0 0 1 0-6.7" fill="#FFCBA6" fill-rule="nonzero"/><path d="M47.4 23a3.4 3.4 0 1 1 0 6.7 3.4 3.4 0 0 1 0-6.7z" stroke="#262626" stroke-width="1.6"/><path d="M47.6 23h.2c1.7.3 3 1.7 3 3.4 0 1.6-1.3 3-3 3.3a3.4 3.4 0 0 1-2.6-4.5h-1V25l.1-.3.1-.2.2-.2.2-.2.1-.2.4-.3.2-.2.2-.1.2-.1.3-.1h.2l.3-.1h.9" fill="#98760F" fill-rule="nonzero"/><path d="M47.6 23h.2c1.7.3 3 1.7 3 3.4 0 1.6-1.3 3-3 3.3a3.4 3.4 0 0 1-2.6-4.5h-1V25l.1-.3.1-.2.2-.2.2-.2.1-.2.4-.3.2-.2.2-.1.2-.1.3-.1h.2l.3-.1h.9z" stroke="#262626" stroke-linecap="round" stroke-linejoin="round"/><path d="M45.8 31.3c.2.5 0 1-.6 1.2-.5.2-1.1 0-1.3-.6l-2.7-7.6a1 1 0 0 1 .6-1.2c.5-.2 1 0 1.3.6l2.7 7.5z" fill="#FFCBA6" fill-rule="nonzero"/><path d="M45.8 31.3c.2.5 0 1-.6 1.2-.5.2-1.1 0-1.3-.6l-2.7-7.6a1 1 0 0 1 .6-1.2c.5-.2 1 0 1.3.6l2.7 7.5z" stroke="#262626"/><path fill="#FFF" fill-rule="nonzero" d="M35.3 24.2L.5 44.3v-23l34.8-20z"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M35.3 24.2L.5 44.3v-23l34.8-20z"/><path fill="#FFF" fill-rule="nonzero" d="M5.6 38.5l4.6-11.4 5.2.1 5-8.7h5l5-11.4"/><path stroke="#262626" stroke-linecap="round" stroke-linejoin="round" d="M5.6 38.5l4.6-11.4 5.2.1 5-8.7h5l5-11.4"/><path d="M8 20.5c.3.3.5.7.5 1.3 0 1.6-1.4 3.7-3 4.7-1.1.6-2 .6-2.6 0l5.2-6z" fill="#515151" fill-rule="nonzero"/><path d="M8 20.5c.3.3.5.7.5 1.3 0 1.6-1.4 3.7-3 4.7-1.1.6-2 .6-2.6 0l5.2-6z" stroke="#333" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 20.5c-.4-.6-1.4-.7-2.5 0v3l2.6-3z" fill="#8B8B8B" fill-rule="nonzero"/><path d="M8 20.5c-.4-.6-1.4-.7-2.5 0v3l2.6-3zM3 26.4c-.3-.3-.5-.7-.5-1.2 0-1.7 1.4-3.8 3-4.7v3l-2.6 3z" stroke="#333" stroke-linecap="round" stroke-linejoin="round"/><path d="M17 56.6a1.2 1.2 0 1 1-2.4 0v-8.3c0-.7.5-1.2 1.2-1.2.6 0 1.1.5 1.1 1.2v8.3z" fill="#515151" fill-rule="nonzero"/><path d="M17 56.6a1.2 1.2 0 1 1-2.4 0v-8.3c0-.7.5-1.2 1.2-1.2.6 0 1.1.5 1.1 1.2v8.3z" stroke="#262626"/><path d="M20.4 54.6a1.2 1.2 0 1 1-2.4 0v-8.3c0-.7.6-1.2 1.2-1.2.7 0 1.2.5 1.2 1.2v8.3z" fill="#515151" fill-rule="nonzero"/><path d="M20.4 54.6a1.2 1.2 0 1 1-2.4 0v-8.3c0-.7.6-1.2 1.2-1.2.7 0 1.2.5 1.2 1.2v8.3z" stroke="#262626"/><path d="M23.3 35.1l3-1.7a1 1 0 0 1 1.3.4 1 1 0 0 1-.3 1.4l-4 2.3-4-2.4c-.5-.2-.6-.8-.3-1.3s.9-.6 1.4-.4l2.9 1.8z" fill="#CC9E70" fill-rule="nonzero"/><path d="M23.3 35.1l3-1.7a1 1 0 0 1 1.3.4 1 1 0 0 1-.3 1.4l-4 2.3-4-2.4c-.5-.2-.6-.8-.3-1.3s.9-.6 1.4-.4l2.9 1.8z" stroke="#262626"/><path d="M21.4 34.2c0-1.9-1.8-2.4-4-1.1-2.1 1.2-4 3.8-4 5.7V48l2 1.2 6-3.5V34.2z" fill="#FB6045" fill-rule="nonzero"/><path d="M21.4 34.2c0-1.9-1.8-2.4-4-1.1-2.1 1.2-4 3.8-4 5.7V48l2 1.2 6-3.5V34.2z" stroke="#262626"/><path d="M14.8 41.2l3 1.7c.5.3.6.9.4 1.4-.3.5-.9.6-1.4.3l-4-2.3v-4.6c0-.6.5-1 1-1 .6 0 1 .5 1 1v3.5z" fill="#CC9E70" fill-rule="nonzero"/><path d="M14.8 41.2l3 1.7c.5.3.6.9.4 1.4-.3.5-.9.6-1.4.3l-4-2.3v-4.6c0-.6.5-1 1-1 .6 0 1 .5 1 1v3.5z" stroke="#262626"/><path d="M17.4 28.6a3.4 3.4 0 1 1 0 6.7 3.4 3.4 0 0 1 0-6.7" fill="#CC9E70" fill-rule="nonzero"/><path d="M17.4 28.6a3.4 3.4 0 1 1 0 6.7 3.4 3.4 0 0 1 0-6.7z" stroke="#262626"/><path d="M19 31.9c.2-.1.4 0 .5.1.1.2 0 .4-.1.6-.2 0-.4 0-.5-.2-.1-.2 0-.4.1-.5M17 33c.1 0 .3 0 .4.2.1.2 0 .4-.1.5h-.5c-.1-.3 0-.5.1-.6" fill="#262626" fill-rule="nonzero"/><path d="M16.6 35.2a3.3 3.3 0 0 1-1.1-2.5V32h.2c1.4 0 2.6-.9 3-2 1.2.5 1.9 1.6 2 2.9l.1-1a3.4 3.4 0 0 0-6.7 0c0 1.5 1 2.8 2.5 3.2" fill="#464646" fill-rule="nonzero"/><path d="M16.6 35.2a3.3 3.3 0 0 1-1.1-2.5V32h.2c1.4 0 2.6-.9 3-2 1.2.5 1.9 1.6 2 2.9l.1-1a3.4 3.4 0 0 0-6.7 0c0 1.5 1 2.8 2.5 3.2z" stroke="#262626" stroke-linecap="round" stroke-linejoin="round"/>
						</g>

					</g>

					<!-- triangle arrows -->
					<path fill="#FB6046" d="M322.18 135.32l-1.4 11.3-9.9-9.9z"/>
					<path fill="#858585" d="M267.67 94.17l9.55 1.77-7.78 7.78z"/>
					<path fill="#858585" d="M100.33 271.83l-9.55-1.77 7.78-7.78z"/>
					<path fill="#858585" d="M92.67 109.83l1.77-9.55 7.78 7.78z"/>
					<path fill="#858585" d="M278.33 265.17l-1.77 9.55-7.78-7.78z"/>
					<path fill="#6C75E1" d="M365.35 193.66l-10.5 4.44 3.62-13.53z"/>
					<path fill="#26C0B4" d="M323.18 240.68l-11.3-1.4 9.9-9.9z"/>

				</g>

			</g>

		</g>

	</svg>

</template>

<script>

	export default {

		props: ['prefix'],

		computed: {

			content() {
				return content;
			},

			lang() {
				return this.content.language_code;
			},

			labels() {

				const labels = {
					en: {
						design: 'Design',
						map: 'Map',
						build: 'Build',
						publish: 'Publish',
						use: 'Use',
						evaluate: 'Evaluate',
						learn: ['Learn', '& Share']
					},
					es: {
						design: 'Diseña',
						map: 'Mapear',
						build: 'Construir',
						publish: 'Publicar',
						use: 'Usar',
						evaluate: 'Evaluar',
						learn: ['Aprender', 'y Compartir']
					}
				};

				return labels[this.lang];

			},

			step() {
				return this.$parent.step;
			}

		},

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

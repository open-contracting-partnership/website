<template>

	<div class="country-search" v-bind:class="{ 'country-search--is-open': is_open }" @click.prevent>

		<div class="country-search__input">
			<input type="text" :placeholder="placeholder" v-model="filter" ref="input" @focus="open" @blur="blur" @keydown.up.prevent="moveUp" @keydown.down.prevent="moveDown" @keyup.enter="change" @keyup.esc="close" />
			<svg><use xlink:href="#icon-search" /></svg>
		</div>

		<div class="country-search__results">

			<ul class="country-search__list" v-if="is_open === true && filtered_countries.length > 0" @mouseover="mouseOver" @mouseout="mouseOut">

				<li v-for="(country, index) in filtered_countries" v-bind:class="{ focus: index === focus}" @click="change" @mouseover="hover(index)">

					<flag :code="country.code" />

					<div>
						{{ country.name }}
					</div>

				</li>

			</ul>

		</div>

	</div>

</template>

<script>

	import _ from 'underscore'
	import { mapGetters } from 'vuex'

    export default {

		props: {
			placeholder: {
				default: 'Find Country',
				type: String
			}
		},

		data() {

			return {
				is_open: false,
				filter: '',
				focus: 0,
				mouse_hover: false
			}

		},

		watch: {

			filter: function() {
				this.focus = 0;
			}

		},

		computed: {

			...mapGetters([
				'countries'
			]),

			filtered_countries() {

				let countries = [];
				const filter_match = new RegExp(this.filter, "gi");

				if ( this.countries ) {

					_.each(this.countries, (country) => {

						// if set, test the filter and reject if no match found
						if ( this.filter !== '' && country.name.match(filter_match) === null ) {
							return;
						}

						countries.push({
							code: country.iso_a2.toLowerCase(),
							name: country.name,
							available: true
						})

					});

				}

				return countries;
				return countries.slice(0, 5);

			},

			selected_country() {
				return this.filtered_countries[this.focus];
			}

		},

		methods: {

			hover(index) {
				this.focus = index;
			},

			mouseOver() {
				this.mouse_hover = true;
			},

			mouseOut() {
				this.mouse_hover = false;
			},

			blur($event) {

				if ( this.mouse_hover === false ) {
					this.close();
				} else {
					$event.preventDefault();
				}

			},

			change() {

				if ( this.selected_country.available === true ) {
					this.close();
					this.$emit('change', this.selected_country.code);
				}

			},

			moveUp() {
				this.focus = this.focus === 0 ? _.size(this.filtered_countries) - 1 : this.focus - 1;
			},

			moveDown() {
				this.focus = this.focus === _.size(this.filtered_countries) - 1 ? 0 : this.focus + 1;
			},

			open() {
				this.focus = 0;
				this.is_open = true;
			},

			close() {
				this.is_open = false;
				this.$refs.input.blur();
			}

		}

	}

</script>

<style lang="scss">

	// ATTN: this is not ideal, but webpack aliases aren't working
	@import "../../../scss/_bootstrap.scss";

	.country-search {
		background-color: color('white');
		border: 1px solid color('body');
		padding: spacing(.5) spacing(1);
		width: spacing(42);
		max-width: 100%;
	}

		.country-search__input {
			display: flex;
			align-items: center;
		}

			.country-search__input input {
				flex: 1 1 100%;
				margin-right: spacing(1);
				margin-bottom: 0;
				border: none;
				padding: spacing(.5);
				min-width: 0;

				&::-webkit-input-placeholder { /* Chrome/Opera/Safari */
					@include font-size(14);
					color: color('body');
				}

				&::-moz-placeholder { /* Firefox 19+ */
					@include font-size(14);
					color: color('body');
				}

				&:-ms-input-placeholder { /* IE 10+ */
					@include font-size(14);
					color: color('body');
				}

				&:-moz-placeholder { /* Firefox 18- */
					@include font-size(14);
					color: color('body');
				}

			}


			.country-search__input > svg {
				font-size: 16px;
				width: 1em;
				height: 1em;
				fill: color('body');
				flex: 0 0 1em;
			}

		.country-search__results {
			max-height: spacing(25);
			overflow-y: auto;
			-webkit-overflow-scrolling: touch;
		}

		.country-search__list {
			@include font-size(14);
			padding: 0;
			margin: 0;
			list-style: none;
			margin-top: spacing(1);
		}

			.country-search__list li {
				border-radius: 2px;
				padding: spacing(.75) spacing(1);
				cursor: pointer;
				display: flex;
				align-items: center;
				margin-bottom: spacing(.5);
			}

			.country-search__list li.focus {
				background-color: color('lighter-grey');
			}

			.country-search__list li.disabled {
				filter: grayscale(100%) opacity(50%);
			}

				.country-search__list .flag-icon {
					font-size: 18px;
					flex: 0 0 1.3333333em;
					margin-right: spacing(1);
				}

				.country-search__no-data {
					@include font-size(12);
				}

</style>

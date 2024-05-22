<template>

	<div class="country-search__container">

		<div class="country-search" v-bind:class="{ 'country-search--is-open': is_open }" @click.prevent>

			<div class="country-search__input">
				<input type="text" :placeholder="placeholder" v-model="filter" ref="input" @focus="open" @blur="blur" @keydown.up.prevent="moveUp" @keydown.down.prevent="moveDown" @keyup.enter="change" @keyup.esc="close" />
				<svg><use xlink:href="#icon-search" /></svg>
			</div>

			<router-link class="country-search__table" :to="{ name: 'table' }">
				<svg><use xlink:href="#icon-table" /></svg>
			</router-link>

			<div class="country-search__results" v-if="is_open === true && filtered_countries.length > 0">

				<ul class="country-search__list" @mouseover="mouseOver" @mouseout="mouseOut">

					<li v-for="(country, index) in filtered_countries" v-bind:class="{ disabled: country.available === false, focus: index === focus}" @click="change" @mouseover="hover(index)">

						<flag :code="country.code" />

						<div>
							{{ country.name }}
							<span v-if="country.available === false" class="country-search__no-data" v-html="content.search.no_data"></span>
						</div>

					</li>

				</ul>

			</div>

		</div>

	</div>

</template>

<script>

	import _ from 'underscore'
	import { mapGetters } from 'vuex'

    export default {

		props: {
			placeholder: {
				default: 'Search',
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
				'content',
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
							available: typeof country.has_data !== 'undefined' && country.has_data === true
						})

					});

				}

				return countries;

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
	@import "../../../../scss/_bootstrap.scss";

	.country-search__container {
		width: 100%;
		max-width: spacing(42);
	}

	.country-search {

		position: relative;
		background-color: $ui-white;
		border: 1px solid $ui-grey-3;
		border-radius: 0 spacing(1) spacing(1) 0;
		max-width: spacing(42);
		display: flex;
		flex-wrap: wrap;

		@include from(M) {
			border-radius: 0 17px 17px 0;
		}

		&.country-search--is-open {
			border-bottom-right-radius: 0;
		}

	}

		.country-search__input {

			display: flex;
			align-items: center;
			flex-grow: 0;
			flex-shrink: 0;
			flex-basis: calc(100% - 33px);
			padding: spacing(.5) spacing(1);

			@include from(M) {
				flex-basis: 100%;
			}

		}

			.country-search__input input {
				flex: 1 1 100%;
				font-size: 11px;
				@include font('secondary', 'bold');
				margin-right: spacing(1);
				margin-bottom: 0;
				border: none;
				padding: spacing(.5);
				min-width: 0;
				text-transform: uppercase;

				&::-webkit-input-placeholder { /* Chrome/Opera/Safari */
					color: $ui-grey-3;
				}

				&::-moz-placeholder { /* Firefox 19+ */
					color: $ui-grey-3;
				}

				&:-ms-input-placeholder { /* IE 10+ */
					color: $ui-grey-3;
				}

				&:-moz-placeholder { /* Firefox 18- */
					color: $ui-grey-3;
				}

			}

			.country-search__input > svg {
				font-size: 16px;
				width: 1em;
				height: 1em;
				fill: $ui-grey-3;
				flex: 0 0 1em;
			}

		.country-search__table {

			display: flex;
			flex: 0 0 33px;
			justify-content: center;
			align-items: center;
			border-left: 1px solid $ui-grey-3;
			cursor: pointer;

			@include from(M) {
				display: none;
			}

		}

			.country-search__table > svg {
				font-size: 16px;
				width: 1em;
				height: 1em;
				fill: $ui-grey-3;
			}

		.country-search__results {
			position: absolute;
			top: 100%;
			right: -1px;
			left: -1px;
			z-index: 2;
			border-radius: 0 0 2px 2px;
			background-color: $ui-white;
			border: 0 solid $ui-grey-3;
			border-width: 0 1px 1px 1px;
			max-height: spacing(25);
			overflow-y: auto;
			-webkit-overflow-scrolling: touch;
			border-top: 1px solid $ui-grey-3;
			flex: 0 0 100%;
		}

		.country-search__list {
			font-size: 14px;
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
				background-color: $ui-grey-7;
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
					font-size: 12px;
				}

</style>

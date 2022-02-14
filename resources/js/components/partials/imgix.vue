<template>


	<img
		v-if="url"
		:src="src"
		:srcset="srcset"
		:sizes="sizes"
		:alt="alt"
		:width="width"
		:height="height"
		loading="lazy"
	>

</template>

<script>

    import _ from 'lodash';

	export default {

		props: {
			'url': {
				type: String,
				required: true
			},
			'params': {
				type: Object,
				required: true
			},
			'aspect_ratio': {
				default: null
			},
			'transforms': {
				type: Array,
				required: true
			},
			'sizes': {},
			'alt': {}
		},

		computed: {

			src() {
				return this.buildURL(this.transforms[0]);
			},

			srcset() {

				const srcset = this.transforms.map(transform => {
					return this.buildURL(transform) + ' ' + transform['w'] + 'w';
				});

				return srcset.join(', ');

			},

			height() {
				return this.aspect_ratio ? this.aspect_ratio[1] : null;
			},

			width() {
				return this.aspect_ratio ? this.aspect_ratio[0] : null;
			}

		},

		methods: {

			buildURL(transform) {
				transform = Object.assign({}, this.params, transform);

				delete transform['host'];

				if ( this.aspect_ratio && transform['w'] ) {
					transform['h'] = Math.ceil(transform['w'] / (this.aspect_ratio[0] / this.aspect_ratio[1]));
				}

				var esc = encodeURIComponent;
				var query = Object.keys(transform)
					.map(k => esc(k) + '=' + esc(transform[k]))
					.join('&');

				let url = this.url;

                _.each(content.imgix_host_transforms, (transform, source) => {
                    url = url.replace(source, transform);
                });

				return url + '?' + query;
			}

		}

	}

</script>

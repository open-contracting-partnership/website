<template>

	<div class="card card--primary / vue-load__component">

		<div class="card__header / card--content-spine" data-content-type="resource">

			<div class="content-spine__icon">
				<svg><use xlink:href="#icon-resource"></use></svg>
			</div>

			<span class="content-spine__title" v-html="type"></span>

			<span class="content-spine__meta" v-html="resource.custom.year"></span>

		</div>

		<div class="card__content">

			<div class="card__title">

				<h6 class="card__heading">
					<a @click.prevent="click" class="card__link" :href="resource.link" v-html="resource.title"></a>
				</h6>

			</div>

			<p class="card__meta" v-if="resource.fields.organisation !== ''">
				<span class="card__author">By {{ resource.fields.organisation }}</span>
			</p>

		</div>

	</div>

</template>

<script>

    export default {

		props: {
			resource: Object
		},

		computed: {

			type: function() {
				return this.resource.taxonomies['resource-type'][Object.keys(this.resource.taxonomies['resource-type'])[0]];
			}

		},

		methods: {

			click($event) {

				this.$emit('clicked', {
					resource: this.resource,
					event: $event
				});

			}

		}

    }

</script>

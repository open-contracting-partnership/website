<template>

	<div
        class="card card--resource"
        data-colour-scheme="light"
        :data-colour="card.colour"
        :data-has-border="card.is_featured"
    >
        <div class="card__mast">
            <div class="card__icon"></div>
			<span class="card__type" v-html="card.type_label"></span>


            <span v-if="card.is_featured" class="card__tag">Featured</span>


        </div>

		<div class="card__body">
			<a class="card__link" :href="card.url" v-html="card.title"></a>
		</div>

		<div class="card__footer">
            <p class="card__meta">{{ card.meta }}</p>
		</div>

	</div>

</template>

<script>

	export default {
		props: ['card']
	}

</script>

<template>

	<div class="card card--resource" data-colour-scheme="light" :data-colour="card.colour">

		<div class="card__body">
			<a class="card__link" :href="card.url" v-html="card.title"></a>
		</div>

		<div class="card__footer">
			<div class="card__icon"></div>
			<span class="card__type" v-html="card.type_label"></span>
		</div>

	</div>

</template>

<script>

	export default {
		props: ['card']
	}

</script>

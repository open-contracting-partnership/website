<template>

	<a :href="event.link" class="card card--event">

		<div class="card-event__date">
			<span class="card-event__day">{{ event.custom.day }}</span>
			<span class="card-event__month">{{ event.custom.month }}</span>
		</div>

		<div class="card__content">
			<h6 class="card__heading" v-html="event.title"></h6>
		</div>

	</a>

</template>

<script>

	export default {

		props: {
			event: Object
		}

	}

</script>

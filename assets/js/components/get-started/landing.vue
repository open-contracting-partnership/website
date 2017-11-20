<template>

	<div class="gs-landing">

		<div class="page__wrapper">

			<h1 class="gs-landing__title">The Open Contracting Journey</h1>

			<div class="gs-landing__main">

				<div class="gs-landing__intro">
					<p>Open contracting is guided by a set of global principles for improving disclosure, data and engagement across the entire chain of public procurement, from planning through to delivery. </p>
					<p>Collaboration and engagement with those who use the information should underpin every open contracting intervention.</p>
					<p>Here you will find the information, resources, tools and case studies you need to publish standardized open data about public contracting processes — and how to put this data into use to drive wider systemic change and engagement with different parts of government, business and civil society.</p>
				</div>

				<div class="gs-landing__diagram">

					<diamonds></diamonds>

					<router-link :to="{ name: 'detail', params: { step: 1 } }" class="button button--brand button--large">
						Explore the 7 Steps
					</router-link>

				</div>

			</div>

			<div class="gs-landing__secondary">

				<div class="">
					<p>The Open Contracting Data Standard (OCDS) provides a common open schema for publishing structured data as a foundation for effective open contracting. It can help make sure that the contracting data and documents you publish meets global best practices and are fit for purpose to meet the needs of a range of different users.  We run a free global helpdesk at data@open-contracting.org to assist publishers. </p>
					<p>OCDS is not designed as a ‘pass or fail’ system for compliance. Rather, it provides guidance to first publish what you can, and then improve the amount and quality of data that you publish, in an iterative process.</p>
				</div>

				<div class="">
					<p>It can be used as a data model for e-procurement reforms (such as in Ukraine’s e-procurement system ProZorro), to extract data and visualize data from an existing e-procurement system (such as in Mexico City), or to map and structure data from different government sources (as in Nigeria’s Budeshi or the UK’s Contracts Finder). </p>
					<p>Government officials, citizens, journalists and companies can all be users of your data once it is in user friendly, open formats. There is a growing field of re-useable tools, analysis and feedback methods based on this data. Think mobile apps that facilitate bidding for business. Dashboards to monitor performance. Tools to analyze and flag potential corruption risks. Feedback processes that monitor government contracting on a day-by-day basis. Policy reforms to drive better value for money and comparisons across government.</p>
				</div>

				<div class="gs-landing__secondary-nav">
					<a class="button button--dark button--large" href="/get-started/global-principles/">Global Principles</a>
					<a class="button button--dark button--large" href="/resources/">Resources and tools</a>
				</div>

			</div>

		</div>

	</div>

</template>

<script>

    export default {

		computed: {

			// step() {
			// 	return this.$route.params.step.split('-')[0];
			// },
            //
			// detail() {
			// 	return this.$root.bob;
			// }

		}

	}

</script>

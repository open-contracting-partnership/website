<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">

	<title>The Idea Bureau - Patern Library</title>

	<script>
	  (function(d) {
		var config = {
		  kitId: 'xpw3jps',
		  scriptTimeout: 3000,
		  async: true
		},
		h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
	  })(document);
	</script>

	<link rel="stylesheet" href="/wp-content/themes/ocp-v1/patterns/libs/prism/prism.css">
	<link rel="stylesheet" href="//theideabureau.github.io/pattern-library/patterns/build/css/styles.css">

	<style>
		html {font-size: 20px;}
		body {font-size:16px;}
	</style>

</head>
<body>

	<script>var css_url = '/wp-content/themes/ocp-v1/assets/css/styles.min.css';</script>

	<div style="display: none; visibility: hidden;">
		<?php include_once('../assets/img/icons.svg'); ?>
	</div>

	<aside class="sg-nav">

		<div class="sg-nav__pane">
			<h1>Patern Library</h1>
		</div>

		<div class="sg-nav__pane">
			<input type="search" autofocus placeholder="Search" v-model="search" @keyup="filterPatterns">
		</div>

		<div class="sg-nav__pane">

			<ol>
				<tree :model="treeData"></tree>
			</ol>

		</div>

	</aside>

	<main class="sg-main">
		<pattern :model="flatTreeData"></pattern>
	</main>

	<!-- item template -->
	<template id="item-template">

		<li v-for="item in model.items" v-show="item.display === true">

			<a href="#{{item.url}}">
				{{item.name}}
			</a>

			<ol v-if="this.hasChildren(item)">
				<tree :model="item"></tree>
			</ol>

		</li>

	</template>

	<style>

		.sg-breadcrumbs span {
			color: #D0D0D0;
		}

		.sg-breadcrumbs span:after {
			content: " / ";
		}

		.sg-breadcrumbs span:last-child:after {
			content: normal;
		}

		.sg-breadcrumbs a {
			text-decoration: none;
			color: #333;
		}

		.sg-breadcrumbs a:hover,
		.sg-breadcrumbs a:focus,
		.sg-breadcrumbs a:active {
			text-decoration: underline;
		}

	</style>

	<template id="pattern-template">

		<div class="sg-section" v-for="pattern in model" id="{{ pattern.url }}" v-show="pattern.display === true">

			<div class="sg-panel sg-panel__title">

				<h1 class="sg-breadcrumbs">

					<span v-for="breadcrumb in pattern.breadcrumbs">
						<a href="#{{ breadcrumb.url }}">{{ breadcrumb.label }}</a>
					</span>

				</h1>

			</div>
<!--
			<div class="sg-panel sg-panel__description">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, sit, voluptatibus?</p>
			</div> -->

			<div class="sg-panel sg-panel__example">

				<div>
					<style scoped v-if="pattern.isComponent !== true"></style>
					<div v-html="pattern.contents"></div>
				</div>

			</div>

			<!--
			<div class="sg-panel sg-panel__code">
				<pre><code class="language-markup">{{ pattern.contents }}</code></pre>
			</div> -->

		</div>

	</template>

	<script src="/wp-content/themes/ocp-v1/patterns/libs/jquery-1.12.0.min.js"></script>
	<script src="/wp-content/themes/ocp-v1/patterns/libs/prism/prism.js"></script>
	<script src="/wp-content/themes/ocp-v1/patterns/libs/scoper/scoper.min.js"></script>
	<script src="/wp-content/themes/ocp-v1/patterns/libs/vue/dist/vue.js"></script>
	<script src="//theideabureau.github.io/pattern-library/patterns/build/js/main.min.js"></script>

</body>
</html>
		</main>

		<script>

			var ajax = new XMLHttpRequest();
			ajax.open('GET', '<?php echo get_bloginfo('template_directory'); ?>/dist/svg/icons.svg?v=<?php echo wp_get_theme()->Version; ?>', true);
			ajax.send();
			ajax.onload = function(e) {
				var div = document.createElement('div');
				div.style.display = 'none';
				div.style.visibility = 'hidden';
				div.innerHTML = ajax.responseText;
				document.body.insertBefore(div, document.body.childNodes[0]);
			}

		</script>

		<?php wp_footer(); ?>

	</body>

</html>

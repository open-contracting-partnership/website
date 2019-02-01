$(document).ready(function() {

	$('.contracts-table').tablesorter({

		// set the initial table
		textExtraction: function(node) {

			var $node = $(node);

			if ( $node.filter('[data-value]').length ) {

				var value = $node.attr('data-value');

				if ( ! isNaN(parseFloat(value)) ) {
					value = parseFloat(value);
				}

				return value;

			} else {

				return $node.text().replace(/-/g, '');

			}

			return $node.innerHTML;

		}

	});

	$('[name="phase"]').on('change', function() {

		var $this = $(this),
			$rows = $('.contracts-table tbody tr');

		$rows.show();

		if ( $this.val() !== '' ) {

			$rows.filter('[data-phase!="' + $this.val() + '"]').hide();

		}

	});

});

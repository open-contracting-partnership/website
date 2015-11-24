<?php

	$colours = array(
		'white' => '#fff',
		'brand' => '#353535',
		'grey' => '#cccccc'
	);

?>

<ul class="sg-colors">

	<?php foreach ( $colours as $name => $colour ) : ?>

		<li>
			<span class="sg-colour" style="background-color: <?php echo $colour; ?>"></span>
			<span class="sg-overlay">
				<span class="sg-label"><?php echo $name; ?><br /><?php echo $colour; ?></span>
			</span>
		</li>

	<?php endforeach; ?>

</ul>

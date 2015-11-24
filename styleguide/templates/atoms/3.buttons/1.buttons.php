<div class="band--double">

	<h3 class="sg-heading">Sizes</h3>

	<a href="#" class="button button--small">Small Button</a>

	<a href="#" class="button">Regular Button</a>

	<a href="#" class="button button--medium">Medium Button</a>

	<a href="#" class="button button--large">Large Button</a>

	<a href="#" class="button button--huge">Huge Button</a>

</div>

<div class="band--double">

	<a href="#" class="btn has-friend">Has a friend</a><a href="#" class="btn btn--alt">Best Friend</a>

</div>

<div class="band--double">

	<h3 class="sg-heading">Variations</h3>

	<p>
		<a href="#" class="button button--uppercase">Uppercase Button</a>

		<a href="#" class="button button--uppercase button--medium">Uppercase Medium Button</a>

		<a href="#" class="button button--uppercase button--large"> Uppercase Large Button</a>
	</p>

	<p>
		<a href="#" class="button button--block button--medium">Block Button</a>
	</p>

	<p>
		<a href="#" class="button button--block button--left button--medium">Left Align Button</a>
	</p>

	<p><button>Button Element</button></p>

	<p><input type="submit" value="Submit Element" /></p>

	<p><a href="http://google.com" class="button button--disabled" disabled>Disabled Button</a></p>

</div>

<div class="band--double">

	<h3 class="sg-heading">Colour Option</h3>

	<!-- Copy the values from the button-color array in the variables partial in Scss -->
	<?php foreach ( ['blue', 'green', 'pink', 'orange'] as $color ) : ?>

	<div class="band">

		<a href="#" class="button button--small button--<?php echo $color; ?>">Small Button</a>

		<a href="#" class="button button--<?php echo $color; ?>">Regular Button</a>

		<a href="#" class="button button--medium button--<?php echo $color; ?>">Medium Button</a>

		<a href="#" class="button button--large button--<?php echo $color; ?>">Large Button</a>

	</div>

	<?php endforeach; ?>

</div>
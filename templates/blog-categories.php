<?php namespace ProcessWire;

// setting('noindex', true);

$limit = 18;
$categories = page()->children("limit=$limit");
//	no items found
if( !$categories->count() ) {
	echo noFound();
	return;
}
?>

<div id="main-body">
	<?= pagination($categories); ?>

	<div class='flex flex-wrap flex-gap-xs padding-y-md'>
	<?php
		foreach ($categories as $category):
			if ($category->references()->count()):
	?>
			<div class='item'>
				<a class='link btn btn--primary btn--lg' href='<?= $category->url ?>'>
					<?= $category->title ?>
					<span>/ ( <?= $category->references->count() ?> )</span>
				</a>
			</div>
	<?php
			endif;
		endforeach;
	?>
	</div>

	<?= pagination($categories); ?>
</div>

<div id="main-sidebar">
	<?php files()->include(setting('blogParts') . "/_sidebar") ?>
</div>
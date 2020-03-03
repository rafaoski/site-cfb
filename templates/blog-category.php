<?php namespace ProcessWire;

// setting('noindex', true);
setting('title', setting('category') . " | $page->title");
setting('mainTitle', setting('category') . ": $page->title");

// get items
$limit = 12;
$blogPosts = pages()->get("template=blog")->children("categories=$page,limit=$limit");
// no items found
if( !$blogPosts->count() ) {
	echo noFound();
	return;
}
?>

<div id="main-body">
	<?= pagination($blogPosts); ?>

	<div class='grid grid-gap-sm'>
	<?php
		foreach ($blogPosts as $item) {
			echo "<div class='col-6@md'>" . animatedCard($item) . "</div>";;
		}
	?>
	</div>

	<?= pagination($blogPosts); ?>
</div>

<div id="main-sidebar">
	<?php files()->include(setting('blogParts') . "/_sidebar") ?>
</div>
<?php namespace ProcessWire;

if(input()->urlSegment1 != $authText) throw new Wire404Exception();

setting('metaTitle', setting('authors'));
setting('metaDescription', '');
setting('mainTitle', setting('authors'));
setting('noindex', true);

$authors = users()->find("text!='',limit=24");

// No items found
if( !$authors->count() ) {
	echo noFound();
	return;
}
?>

<div id="main-body">
	<?= pagination($authors); ?>
	<div class='flex flex-wrap flex-gap-sm'>
		<?php
			foreach ($authors as $author) {
				$autLink = page()->url . $authText . '/' . $author->text . '/';
				echo "<a class='btn btn--lg btn--subtle' href='$autLink'>$author->title</a>";
			}
		?>
	</div>
	<?= pagination($authors); ?>
</div>

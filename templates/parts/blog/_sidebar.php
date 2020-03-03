<?php namespace ProcessWire;

$categories = pages()->get("template=blog-categories");
$lastPosts = pages()->find("template=blog-post, start=0, sort=-date, limit=6");
?>

<!-- CATEGORIES -->
<div class="blog-categories">
	<h3 class='text-uppercase'>
		<span>&bull;</span>
		<?=$categories->title?>
	</h3>
	<div class="flex flex-wrap flex-gap-xxs">
		<?php foreach ($categories->children("start=0, limit=12, sort=random") as $category):
				if ($category->references()->count()):
		?>
			<a class='link btn btn--sm btn--primary' href='<?= $category->url ?>'>
				<?= $category->title ?>
			</a>
		<?php
				endif;
			endforeach;
		?>
	</div>
</div>
<hr>

<!-- LATEST POSTS -->
<div class="recent-posts">
	<h3 class='text-uppercase'>
		<span>&bull;</span>
		<?= setting('recent-entries') ?>
	</h3>
	<ul>
		<?php foreach ($lastPosts as $item): ?>
			<li>
				<a href='<?=$item->url?>'>
					<?= $item->title ?> /
				</a>
			</li>
		<?php
			endforeach;
		?>
	</ul>
</div>
<hr>

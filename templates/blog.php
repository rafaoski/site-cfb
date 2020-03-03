<?php namespace ProcessWire;

// Path to blog template parts
$blogParts = setting('blogParts');

// Not use url segment 3
if($input->urlSegment3) throw new Wire404Exception();

// Blog RSS
if(input()->urlSegment1 == 'rss') {
	files()->include("$blogParts/_rss.php");
	die();
}

// Reset author
$postAuthor = '';

// If input url segment 1 check authors or authors/author-name
if( strlen(input()->urlSegment1) ) {
// Authors url segments
$authText = strtolower(setting('authors'));
// List Authors
	if(input()->urlSegment1 == $authText && !strlen(input()->urlSegment2) ) {
			files()->include("$blogParts/_authors", ['authText' => $authText]);
			return;
// Get Single Author Terms
	} elseif (input()->urlSegment1 == $authText && strlen(input()->urlSegment2) ) {
// Get Author from url slug-name
		$userLink = sanitizer()->pageName($input->urlSegment2);
		$getUser = users()->get("text=$userLink");
// Author Name
		$userTitle = $getUser->title;
// Change settings title, meta-title, meta-description, main title, noindex follow
		if($userTitle) {
			setting('metaTitle', setting('author') . " | $userTitle");
			setting('metaDescription', '');
			setting('mainTitle', setting('author') . ": $userTitle");
			setting('noindex', true);
		}
// Find user
		$postAuthor = ",created_users_id=$getUser->id";
	} else {
		throw new Wire404Exception();
	}
}

// Get Blog Children
$limit = 12;
$blogPosts = page()->children("limit=$limit{$postAuthor}");

// No items found
if(!$blogPosts->count()) {
	echo noFound();
	return;
}
?>

<div id="main-body">
	<?= pagination($blogPosts); ?>

	<div class='grid grid-gap-sm'>
		<?php
			foreach ($blogPosts as $item) {
				echo "<div class='col-6@md'>" . animatedCard($item) . "</div>";
			}
		?>
	</div>

	<?= pagination($blogPosts); ?>
</div>

<div id="main-sidebar">
	<?php files()->include("$blogParts/_sidebar") ?>
</div>

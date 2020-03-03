<?php namespace ProcessWire;

// setting('mainImage', false);

// Path to blog template parts
$blogParts = setting('blogParts');
?>

<head id='html-head' pw-append>
	<script defer src='<?= urls('jquery') ?>'></script>
	<script defer src='<?= urls()->FieldtypeComments ?>comments.min.js'></script>
	<link rel="stylesheet" href="<?= urls()->FieldtypeComments ?>comments.css">
</head>

<div id="main-body">
	<?= blogPost(page()) ?>

	<?= toAny([
			'twitter' => true,
			'facebook' => true,
			'email' => true
		]);
	?>

	<?= pageLinks(page()->links()) // https://processwire.com/blog/posts/processwire-3.0.107-core-updates/ ?>

	<?php
		// Comments
		setting('disableComments') == false ? files()->include("$blogParts/_comments") : '';
	?>
</div>

<div id="main-sidebar">
	<?php files()->include("$blogParts/_sidebar") ?>
</div>
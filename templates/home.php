<?php namespace ProcessWire;

// Change main image visibility
setting('mainImage', false);
?>

<div id="main">
	<?php
	// Basic Sections insode home-parts/_section-{section-name}
		$sections =
		[
			'hero' => setting('hero'),
			'about' => setting('about'),
			'projects' => setting('projects'),
			'recent' => setting('recent'),
		];
	// Sections ( https://processwire.com/api/ref/null-page/ )
		foreach ($sections as $section => $item):
			if($item->id && !$item->hasStatus('unpublished')):
				$sectionBg = sectionBg($item->images->first,
				$class = "bg-image flex flex-center flex-column text-component padding-y-md min-height-100vh");
	?>
			<section id='<?= "section-{$section}" ?>'<?= $sectionBg ?>>
				<?php files()->include(setting('homeParts') . '/_section-' . $section, ['item' => $item]); ?>
			</section>
	<?php
			endif;
	 	endforeach;
	?>
</div>
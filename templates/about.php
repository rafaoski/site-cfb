<?php namespace ProcessWire; ?>

<div id="main-body">
	<?= page()->body ?>

<?php if (page()->hasChildren()): ?>
	<h3 class='text-xl'><?= setting('also-like') ?></h3>
	<div class="flex flex-wrap flex-gap-md">
		<?php
			foreach (page()->children as $item) {
				echo "<div class='item text-md'><a href='$item->url'>$item->title</a></div>";
			}
		?>
	</div>
<?php endif; ?>
</div>
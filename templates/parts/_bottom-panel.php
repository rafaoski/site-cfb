<?php namespace ProcessWire;

/**
 *
 * Bottom Panel
 *
 */

$bottomPanel = setting('bottomPanel');
?>

<div class="text-component margin-y-xs text-sm flex flex-wrap flex-gap-lg justify-center@md">
	<?php foreach ($bottomPanel as $panel) : ?>
		<div id='<?= $panel->id ?>'>
			<div class='panel-item'>
				<?php if ($panel->title): ?>
					<h3 class='text-uppercase'><?=$panel->title?></h3>
					<hr style='margin: .5em;'>
				<?php endif ?>

				<?= $panel->body ?>
				<?= $panel->textarea ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>
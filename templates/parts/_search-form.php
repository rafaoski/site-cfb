<?php namespace ProcessWire; ?>

<form id='form' action='<?= pages()->get('template=search')->url ?>' method='get'>
	<p>
		<label class='text-xl' for="search"><?= setting('search-site') ?></label><br>
		<input
			type='search'
			id='search'
			name='q'
			class='form-control'
			placeholder='<?= setting('search') ?>&hellip;'
			required
		>
	</p>
</form>
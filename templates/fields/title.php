<?php namespace ProcessWire;

if(setting('mainTitle') == '') return;
?>

<h1 id='title' class='main-title text-xl@md text-uppercase'>
	<span class='text-xxl@md color-primary'>&bull;</span>
	<span class='text-xl@md'><?= setting('mainTitle') ?></span>
</h1>
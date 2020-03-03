<?php namespace ProcessWire;

/**
 *
 * Social Profiles
 *
 */

// Get Social Profiles
$socialProfiles = setting('socialProfiles');

if (!$socialProfiles->count()) return;

// Social Profiles Loop
foreach ($socialProfiles as $item) {
$icon = $item->name;
echo "
	<li>
		<a
			class='link btn btn--sm border color-inherit'
			href='$item->text_1'
			title='$item->title'
			target='_blank'
			rel='noreferrer noopener'
		>
			<span class='padding-x-xs'>$item->title</span>
			<i data-feather='$icon' stroke-width='1'></i>
		</a>
	</li>\n
";
}

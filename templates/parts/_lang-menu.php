<?php namespace ProcessWire;

/**
 *
 * language switcher / navigation
 *
 */

if(!$page->getLanguages()) return;
if (!modules()->isInstalled("LanguageSupportPageNames")) return;
?>

<!-- language switcher / navigation -->
<div class='lang-links margin-x-sm flex flex-center flex-gap-xxs'>
	<?php
		foreach($languages as $language) {

			if(!$page->viewable($language)) continue; // is page viewable in this language?

			if($language->id == $user->language->id) {
				$class =  'current text-bold btn--primary ';
			} else {
				$class = 'no-current';
			}

			$url = $page->localUrl($language->id);
			$hreflang = $home->getLanguageValue($language, 'name');
			$title = $language->title;
			$prefix = strtoupper($hreflang);
			// echo "<a class='link btn btn--sm $class' hreflang='$hreflang' href='$url'>$title</a>";
			echo "<a class='link btn btn--sm $class' hreflang='$hreflang' href='$url' alt='$title'>$prefix</a>";
		}
	?>
</div>
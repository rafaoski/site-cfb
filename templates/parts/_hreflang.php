<?php namespace ProcessWire;

/**
 *
 * this is good to do for SEO in helping search engines understand
 * what languages your site is presented in
 *
 */

if(!$page->getLanguages()) return;
if (!modules()->isInstalled("LanguageSupportPageNames")) return;

$homepage = setting('home');

foreach($languages as $language) {
	// if this page is not viewable in the language, skip it
	if(!$page->viewable($language)) continue;
	// get the http URL for this page in the given language
	$url = $page->localHttpUrl($language);
	// hreflang code for language uses language name from homepage
	$hreflang = $homepage->getLanguageValue($language, 'name');
	// output the <link> tag: note that this assumes your language names are the same as required by hreflang.
	echo "\n\t<link rel='alternate' hreflang='$hreflang' href='$url' />";
}
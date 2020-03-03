<?php namespace ProcessWire;

$maintenanceMode = pages()->get('/options/')->checkbox;
$cleanAdmin = pages()->get('/options/')->more_options->get("name=clean-admin");

/**
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/503
 * @link https://yoast.com/http-503-site-maintenance-seo/
 * @link https://processwire.com/docs/modules/hooks/
 *
 */
wire()->addHookAfter('Page::render', function($event) use($maintenanceMode) {

	if($maintenanceMode == false) return '';

	$page = $event->object;

	$content = $event->return;

// We'll only apply this to the front-end of our site
	if( !user()->isSuperuser() && $page->template != 'admin') {
		$event->return = files()->render('_maintenance-mode');
	} else {
// This is for admin backend
		$txt = __('Maintenance Mode');
		$message = "
		<h1 style='background: #040404ab; color: white; position: fixed; bottom: 0; margin: 0; padding: 10px;'>
			$txt
		</h1>";
		$event->return = str_replace ('</body>', "$message\n</body>", $content);
	}
});

/** Clean Admin Tree */
$wire->addHookAfter('Page::render', function($event) use($cleanAdmin) {

	if( $cleanAdmin == false ) return;

	// we'll only apply this to the back-end of our site
	if(page()->template != 'admin') return;

	$value  = $event->return; // Return Content
	$templates = urls()->templates; // Get Template folder URL
	$style = "\n<link rel='stylesheet' href='{$templates}assets/css/clean-admin.css'>\n";
	$event->return = str_replace("</head>", "\n\t$style</head>", $value); // Return All Changes
});

/** Generate permalink in blog author page based on user title field */
wire()->addHookAfter('Pages::saveReady', function($event) {

	$page = $event->arguments('page');

	if ($page->template != 'user') return;
	if(!$page->isChanged('title')) return;

		// -- Turn off outputFormatting
		$page->of(false);

		// -- Save Multi Language Fields ( https://processwire.com/docs/multi-language-support/multi-language-fields/ )
		if($page->getLanguages() && modules()->isInstalled("LanguageSupportPageNames")) {
			foreach (languages() as $language) {
			// -- Get language value user_link
			$userLink = $page->title->getLanguageValue($language->name);
			// -- Set language value into user_link
			$page->text->setLanguageValue(sanitizer()->pageName($userLink));
			}
		} else {
			// -- If no multi language
			$page->text = sanitizer()->pageName($page->title, true);
		}
});

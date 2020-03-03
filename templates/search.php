<?php namespace ProcessWire;

// look for a GET variable named 'q' and sanitize it
$q = input()->get('q');
// sanitize to text, which removes markup, newlines, too long, etc.
$q = sanitizer()->text($q);
// did $q have anything in it after sanitizing to text?
if($q) {
	// Sanitize for placement within a selector string. This is important for any
	// values that you plan to bundle in a selector string like we are doing here.
	// It quotes them when necessary, and removes characters that might cause issues.
	$q = sanitizer()->selectorValue($q);
	// Search the title and body fields for our query text.
	// Limit the results to 50 pages. The has_parent!=2 excludes irrelevant admin
	// pages from the search, for when an admin user performs a search.
	$selector = "title|body~=$q, limit=50, has_parent!=2|1015";
	// Find pages that match the selector
	$matches = pages()->find($selector);

	setting('mainTitle', page()->title . ": $q");

} else {
	$matches = wireArray(); // Empty Array
}
// unset the variable that we no longer need, since it can contain user input
unset($q);
?>

<div id="main-body">
<?php
// did we find any matches?
	if( $matches->count() ):
?>
	<h3> <?= sprintf(setting('found-matches'), $matches->count) ?></h3>
	<ul>
		<?php
			foreach ($matches as $item) {
				echo "<li><a href='$item->url'>$item->title</a></li>";
			}
		?>
	</ul>
<?php else : ?>
	<h3><?= setting('no-results') ?></h3>
<?php endif; ?>
</div>

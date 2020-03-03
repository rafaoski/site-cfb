<?php namespace ProcessWire;

/**
 * Return Background Image ( Main Section )
 *
 * @param PageImage $img
 *
 */
function mainBg($img, $class = 'bg-image') {
	if( !setting('mainImage') ) return '';
	if(!$img) return '';
	return " class='$class' style='background-image:url({$img->url})'";
}

/**
 *  Return Background Image ( Custom Section / Home Page )
 *
 * @param PageImage $img
 *
 */
function sectionBg($img, $class = 'bg-image') {
	if(!$img) return '';
	return " class='$class' style='background-image:url({$img->url})'";
}

 /**
 *
 * Return Picture
 * @param Pageimage $img
 * @link https://apoorv.pro/lozad.js/
 */
function picture($img) {

// Reset variables
$imgWebp = '';
if(!$img) return '';

	// Get first jpg/png/svg image
	$imgUrl = $img->url;
	$imgDescription = $img->title ?: $img->description;

	// Get First WebP image
	if($img->webp()) {
		$imgWebp = $img->webp();
		$imgWebp = "<source srcset='$imgWebp->url' type='image/$imgWebp->ext'>";
	}
	// Return Picture
	return
	" <picture>
		$imgWebp
		<source srcset='$imgUrl' type='image/$img->ext'>
		<img src='$imgUrl' alt='$imgDescription'>
	</picture>";
}

/**
 * Return no found
 *
 * @param string $id ( id to replace in main / Markup Region )
 *
 */
function noFound($id = 'main-content') {
	return "<div id='$id'><h1>" . setting('no-results') . "<h1></div>";
}

/**
 * Return Edit button link
 *
 * @param string $labelBtn
 * @param Page $item
 *
 */
function editBtn($labelBtn, $item) {

	if($item->editable) {
		return "
				<a class='edit-btn btn btn--primary position-fixed margin-xs top-0 margin-top-xxl'
				   href='$item->editUrl'
				   style='z-index: 1'
				>
					$labelBtn
				</a>
			";
	}
}

/**
 * Return debug regions
 *
 */
function debugRegions() {
	if(config()->debug && user()->isSuperuser()) {
		return "
		<section id='debug'>
			<div class='container'>
				<!--PW-REGION-DEBUG-->
			</div>
		</section>
		";
	}
}

/**
 * Given a group of pages, render a simple <li> list nav
 *
 * This is here to demonstrate an example of a simple shared function.
 * Usage is completely optional.
 *
 * @param PageArray $items
 * @param string $class
 *
 */
function simplyNav(PageArray $items, $class = '') {

	// $out is where we store the markup we are creating in this function
	$out = '';

	// cycle through all the items
	foreach($items as $item) {

		// render markup for each navigation item as an <li>
		if($item->id == page()->id || $item->id != 1 && $item->name == page()->parent->name) {
			// if current item is the same as the page being viewed, add a "current" class to it
			$class .= ' current text-bold text-md bg-contrast-low';
		} else {
			// otherwise just a regular list item
			$class = '';
		}

		$out .=  "\n\t<li class='item'>";

		// markup for the link
		$out .= "<a class='link text-uppercase{$class}' href='$item->url'>$item->title</a>";

		// close the list item
		$out .= "</li>\n";

	}

	// return the markup we generated above
	return $out;
}

/**
 * Render breadcrumb list from the given items
 *
 * @param Page|PageArray|null $items
 * @param array|string $options Additional options to modify default behavior:
 *  - `appendCurrent` (bool): Append current page as non-linked item at the end? (default=false).
 * @return string
 *
 */
function breadcrumb($items = null, $options = array()) {

	if(setting('home')->id == page()->parent->id) return;

	// $out is where we store the markup we are creating in this function
	$out = '';

	$defaults = array(
		'appendCurrent' => true,
		'class' => 'breadcrumb flex flex-wrap flex-gap-xxxs font-secondary',
	);

	if($items === null) $items = page();
	if($items instanceof Page) $items = $items->parents();
	if(!$items->count) return '';

	$options = _mergeOptions($defaults, $options);

	$out .= "<ul class='$options[class]' style='z-index: 999'>";

	foreach($items as $item) {
		$out .= "<li><a href='$item->url'>$item->title</a> / </li>";
	}

	if($options['appendCurrent']) {
		$page = $items->wire('page');
		$out .= "<li><span class='current'>$page->title</span></li>";
	}

	$out .= "</ul>";

	return $out;
}

/**
 * Return Animated Card
 *
 * @param Page $item
 * @param array|string $options Options to modify default behavior Basic Usage animatedCard(page())
 * 'html_element' => string | html element like article or div,
 * 'class' => string | main CSS card class default ( card bg ),
 * 'url' => URL | item url,
 * 'picture' => URL | mage source,
 * 'title' => string | item title,
 * 'content' => string | content body,
 * 'icon' => string | icon ( https://github.com/feathericons/feather )
 *
 */
function animatedCard($item, $options = array()) {

	$defaults = array(
		'html_element' => 'article',
		'class' => 'card bg',
		'url' => $item->url,
		'picture' => picture($item->images->first),
		'title' => $item->title,
		'content' => sanitizer()->truncate($item->body, ['maxLength' => 120]),
		'icon' => 'arrow-right'
	);
	$options = _mergeOptions($defaults, $options);

	return "
		<$options[html_element] class='$options[class]'>
			<a href='$options[url]' class='card__link'>
				<div class='card__picture'>
					$options[picture]
				</div>

				<div class='text-component padding-md'>
					<h3 class='text-lg'>
						<span class='card__title'>$options[title]</span>
					</h3>
					<p class='color-contrast-medium'>$options[content]</p>
				</div>

				<div class='card__icon-wrapper' aria-hidden='true'>
					<i class='icon color-bg' data-feather='$options[icon]'></i>
				</div>
			</a>
		</$options[html_element]>
	";
}

/**
 *  Return Basic Pagination
 *  https://processwire.com/docs/front-end/markup-pager-nav/
 *
 * @param PageArray $results
 *
 */
function pagination(PageArray $results) {
	return $results->renderPager(array(
		'nextItemLabel' => setting('next'),
		'previousItemLabel' => setting('previous'),
		'listMarkup' => "<ul class='MarkupPagerNav flex flex-gap-xs flex-wrap margin-y-md' style='list-style: none'>{out}</ul>",
		'itemMarkup' => "<li class='{class}'>{out}</li>",
		'linkMarkup' => "<a href='{url}'><span>{out}</span></a>",
		'currentItemClass' => 'text-bold text-md'
	));
}

/***********************************************************
 * Blog Functions
 *
 */

/**
 * Return AddToAny social share buttons script
 * https://www.addtoany.com/
 *
 * @param array|string $options Options to modify default behavior Basic Usage toAny(['twitter' => true'])
 * 'twitter' => true,
 * 'facebook' => true,
 * 'google_plus' => false,
 * 'linkedin' => false,
 * 'rreddit' => false,
 * 'email' => false,
 * 'google_gmail' => false,
 * 'share_all' => true,
 *
 */
function toAny($options = array()) {

// $out is where we store the markup we are creating in this function
	$out = '';
// Reset variables
	$buttonLinks = '';
// Default share links
	$links = [
		'twitter' => "<a class='a2a_button_twitter'></a>",
		'facebook' => "<a class='a2a_button_facebook'></a>",
		'google_plus' => "<a class='a2a_button_google_plus'></a>",
		'linkedin' => "<a class='a2a_button_linkedin'></a>",
		'rreddit' => "<a class='a2a_button_reddit'></a>",
		'email' => "<a class='a2a_button_email'></a>",
		'google_gmail' => "<a class='a2a_button_google_gmail'></a>",
		'share_all' => "<a class='a2a_dd' href='https://www.addtoany.com/share'></a>"
	];
// Foreach Items
	foreach ($options as $key => $value) {
		if($options[$key] == true) {
			$buttonLinks .= $links[$key];
		}
	}
// Start Content
	$out .= "<!-- AddToAny BEGIN -->
	<div class='a2a_kit a2a_kit_size_32 a2a_floating_style a2a_vertical_style'
			 style='right:0px; top:100px; background-color: #2e2d2d99;'>";
	$out .= $buttonLinks; // Show Links
	$out .= "</div>
	<script async src='https://static.addtoany.com/menu/page.js'></script>
	<!-- /AddToAny END -->";
	return $out;
}

 /**
 * Return page links
 *
 * @param Pagearray $item
 * @link https://processwire.com/blog/posts/processwire-3.0.107-core-updates/
 *
 */
function pageLinks($item) {

	// Return mull if no count any links
	if (!$item->count()) return '';

	// $out is where we store the markup we are creating in this function
	$out = '';

	// if another page has links to this page
	$out .= "<h3>" . setting('also-like') . "</h3>";
	$out .= "<ul>";
		$out .= $item->each("<li><a href={url}>{title}</a></li>");
	$out .= "</ul>";
// Return Links
	return $out;
}

/**
 * Return article title
 *
 * @param string $itemTitle
 * @param url $itemUrl
 *
 */
function blogTitle($itemTitle, $itemUrl) {
	if(page()->template != 'blog-post') {
		return "<h3 class='text-uppercase font-syncopate'>
					<span class='color-contrast-higher'>&bull;</span>
					<a href='$itemUrl'>$itemTitle</a>
				</h3>";
	}
}

/**
 * Return article author
 *
 * @param Page $item created by user
 *
 */
function blogAuthor($createdUser) {

// $out is where we store the markup we are creating in this function
	$out = '';

	$getUser = users()->get($createdUser);

	$nickName = $getUser->title;
	$userLink = $getUser->text;

	$out .= "<a class='author' href='";
	$out .= setting('blog')->url . strtolower(setting('authors')) . '/' . $userLink . "/' rel='nofollow'>";
	$out .= "$nickName</a>";

	return $out;
}

/**
 * Return article body
 *
 * @param string $body
 * @link https://processwire.com/api/ref/sanitizer/truncate/
 *
 */
function blogBody($body) {
	$shortBody = sanitizer()->truncate($body, ['maxLength' => 120]);
	return page()->template != 'blog-post' ? "<p>$shortBody</p>" : $body;
}

/**
 * Return article categories or tags
 *
 * @param PageArray|array $item reference field likie categories or tags
 * @param string $linkClass CSS class
 *
 */
function blogReferences($item, $linkClass = 'category') {

// $out is where we store the markup we are creating in this function
	$out = '';

	if($item && $item->count()) {
		$out .=  "<span>";
		$out .= $item->each("<a class='$linkClass' href='{url}'>{title}</a> ");
		$out .= "</span>";
	}
	return $out;
}

/**
 * Return article comments
 *
 * @param Page $item
 * @param CommentArray $comments field comments
 * @param mixed $before custom html elements like span
 *
 */
function commentsCount($item, $comments, $before) {

	// $out is where we store the markup we are creating in this function
	$out = '';

	// Comments Are Disabled
	if(setting('disableComments') == true) return;

	if(!$comments) return;

	$commentsCount = $comments->count();
	$commentText = setting('no-comments');
	$closedText = setting('comments-closed');

	if($commentsCount) $commentText = $commentsCount . ' ' . _n(setting('comment'), setting('comments'), $commentsCount);

	$out .= "$before<span class='comments'>";
 	// Comments Are Closed
		if($item->checkbox == 1) {
			$out .= $closedText;
		} else {
			$out .= "<a href='$item->url#CommentForm'>$commentText</a>";
		}
	$out .= "</span>";

	return $out;
}

/**
 * Render a comment repply
 *
 * @param int $commentId get comment id to set reply button url
 *
 */
function commentReply($commentId) {
	return "<a class='CommentActionReply btn btn--primary btn--sm'
			data-comment-id='$commentId' href='#Comment$commentId'>" . setting('reply') . "</a>";
}

/**
 * Render a ProcessWire comment
 *
 * @param Comment $comment
 * @param int $calculateDepth calculate comment depth
 * @param boolean $reply
 * @return string
 *
 */
function comment(Comment $comment, $calculateDepth, $reply = true) {

	$text = $comment->getFormatted('text');
	$cite = $comment->getFormatted('cite');
	$website = $comment->getFormatted('website');
	$field = $comment->getField();
	$page = $comment->getPage();
	$classes = array();
	$metas = array();
	$gravatar = '';
	$replies = '';

// Set reply button
	if($reply == true) {
		$maxDepth = $comment->getField()->depth; // Max depth from field comments
		$replies = $calculateDepth <= $maxDepth ? commentReply($comment->id) : '';
	}
// Gravatar
	if($field->get('useGravatar')) {
		$img = $comment->gravatar($field->get('useGravatar'), $field->get('useGravatarImageset'));
		if($img) $gravatar = "<img src='$img' alt='$cite'>";
	}
// Cite
	if($website) $cite = "<a href='$website' rel='nofollow' target='_blank'>$cite</a>";
	$created = wireDate('relative', $comment->created);

	if($field->get('usePermalink')) {
		$permalink = $page->httpUrl;
		$urlSegmentStr = $this->wire('input')->urlSegmentStr;
		if($urlSegmentStr) $permalink .= rtrim($permalink, '/') . $urlSegmentStr . '/';
		$permalink .= '#Comment' . $comment->id;
		$permalink = "<a href='$permalink'>" . __('Permalink') . "</a>";
		$metas[] = "<li>$permalink</li>";
	}

	$classes = implode(' ', $classes);
	$metas = implode('', $metas);

	if($metas) {
		$meats = "<ul class='metas'>$metas</ul>";
	} else {
		$meats = '';
	}

	$out = "
		<article id='Comment$comment->id' class='$classes' data-comment='$comment->id'>
			<header class='flex flex-column'>
				<p class='flex flex-column'>
					<span class='text-sm'>$cite &bull; $created</span>
					<span style='width: 50px'>$gravatar</span>
				</p>
				$metas
			</header>
			<div class='text-component'>
				$text
			</div>
			$replies
		</article>
	";
	return $out;
}

/**
 * Render a list of ProcessWire comments using Uikit markup
 *
 * Note: does not currently support threaded comments (comment depth).
 * Use ProcessWire’s built-in comments rendering for that purpose.
 *
 * @param CommentArray $comments
 * @param array|string $options Options to modify default behavior
 *  - `id` (string): HTML id attribute of the comments list (default='comments').
 * @param int $calculateDepth calculate comment depth
 * @link https://processwire.com/talk/topic/21926-paginating-comments-using-pw-built-in-pagination-in-uikit-3-siteblog-profile/
 * @return string
 *
 */
function comments(CommentArray $comments, $options = array(), $calculateDepth = 0) {
// $out is where we store the markup we are creating in this function
	$out = '';

	$calculateDepth++;

	$defaults = array(
		'id' => 'comments',
		'ul' => true,
		'paginate' => false,
		'limit' => 12,
		'reply' => true
	);

	$options = _mergeOptions($defaults, $options);

 	if($options['paginate']) {
 		$limit = $options['limit'];
 		$start = (wire()->input->pageNum - 1) * $limit;
 		$total = $comments->count();
 		$comments = $comments->slice($start, $limit);
 		$comments->setLimit($limit);
 		$comments->setStart($start);
 		$comments->setTotal($total);
 	}

// redirect to first pagination if accessed at an out-of-bounds pagination
	if(input()->pageNum > 1 && !$comments->count) {
		session()->redirect(page()->url);
	}

	if($options['ul']) $out .= "<ul id='$options[id]' class='comment-list' style='list-style: none'>";

	foreach($comments as $comment) {

		$out .= "<li class='padding-sm bg-contrast-lower'>";

		$out .= comment($comment, $calculateDepth, $options['reply']);

// Show comment children
		if($comment->children->count()) {
			$out .= "<ul class='margin-left-md' style='list-style: none'>";
			$out .= comments($comment->children, ['ul' => false, 'paginate' => false, 'reply' => $options['reply']], $calculateDepth);
			$out .= '</ul>';
		}

		$out .= "</li>";
	}

	if($options['ul']) $out .= "</ul>";

	if($comments->getTotal() > $comments->count() ) {
 		$out .= pagination($comments);
	 }

	return $out;
}

/**
 * Return Blog Post
 *
 * @param Page $item
 * @param str $class CSS class
 *
 */
function blogPost($item, $class = '') {
// https://processwire.com/api/ref/null-page/
	if($item instanceof NullPage) return '';
// Reset img variables
	$description = '';
// Image
	$picture = picture($item->images->first);
// Bullet
	$bullet = "<span class='bull margin-x-xxxs'> &bull; </span>";
// Get title
	$title = blogTitle($item->title, $item->url);
// Get body
	$body = blogBody($item->body);
// Get author ( User )
	$author = blogAuthor($item->createdUser->id);
// Categories
	$categories = $item->categories->count() ? $bullet . ' ' . blogReferences($item->categories, 'text-uppercase') : '';
// Get Date
	$date = "<span class='date'>" . $item->get('date|createdStr') . "</span>";
// Get Comments
	$comments = commentsCount($item, $item->comments, $bullet);
// Article info
	$entryContent = "$author $bullet $date $categories $comments";
// Read More
	$readMore = "<a class='link btn btn--primary' href='$item->url'>" . setting('read-more') . "</a>";
	$readMore = page()->id != $item->id ? $readMore : $readMore = '';
// Class
	$class ? $class = " $class" : $class = '';

// RETURN CONTENT
return "
	<article class='article $item->name{$class}'>
		<header class='entry-heder'>
			$picture
			$title
		</header>

		<div class='entry-content'>
			<p class='margin-y-xxs text-sm font-secondary' style='margin-bottom: var(--space-xxxs)'>
				$entryContent
			</p>
			$body $readMore
		</div>
	</article>
";
}


/*****************************************************************************************
 * ProcessWire internal support functions
 *
 */
/**
 * Prepare and merge an $options argument for one of the markup functions
 *
 * - This converts PW selector strings or data attribute strings to associative arrays.
 * - This converts non-associative attributes to associative boolean attributes.
 * - This merges $defaults with $options.
 *
 * @param array $defaults
 * @param array|string $options
 * @return array
 * @internal
 *
 */
function _mergeOptions(array $defaults, $options) {
	// allow for ProcessWire selector style strings
	// allow for data attribute strings
	if(is_string($options)) {
		$options = str_replace(';', ',', $options);
		$o = explode(',', $options);
		$options = array();
		foreach($o as $value) {
			if(strpos($value, '=')) {
				// key=value
				list($key, $value) = explode('=', $value, 2);
			} else if(strpos($value, ':')) {
				// key: value
				list($key, $value) = explode(':', $value, 2);
			} else {
				// boolean
				$key = $value;
				$value = true;
			}
			$key = trim($key);
			if(is_string($value)) {
				$value = trim($value);
				// convert boolean strings to real booleans
				$v = strtolower($value);
				if($v === 'false') $value = false;
				if($v === 'true') $value = true;
			}
			$options[$key] = $value;
		}
	}
	if(!is_array($options)) {
		$options = array();
	}
	foreach($options as $key => $value) {
		if(is_int($key) && is_string($value)) {
			// non-associative options convert to boolean attribute
			$defaults[$value] = true;
		}
	}
	return array_merge($defaults, $options);
}
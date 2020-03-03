<?php namespace ProcessWire;

/**
 *
 * This _init.php file is called automatically by ProcessWire before every page render
 *
 * Get or set a runtime site setting
 * @link https://processwire.com/api/ref/functions/setting/
 *
 */

// as a convenience, set location of our 3rd party resources (jQuery)...
urls()->set('jquery', 'https://code.jquery.com/jquery-3.4.1.min.js');

$home = pages('/');
$blog = pages()->get("template=blog");
$options = pages()->get('/options/');

// Basic Settings
setting([
// Custom html classes
	'htmlClasses' => WireArray([
		'template-' . page()->template->name,
		'page-' . page()->id,
	]),
// Basic
	'home' => $home,
	'privacyPolicy' => pages()->get("template=privacy"),
	'options' => $options,
	'siteName' => $options->text,
	'logo' => $options->logo,
	'favicon' => $options->favicon,
	'socialProfiles' =>$options->social_profiles,
	'metaTitle' => page('meta_title|title'),
	'metaDescription' => page()->meta_description,
	'noindex' => false,
	'poweredUrl' => 'https://processwire.com',
// Home Sections
	'hero' => $home,
	'about' => pages()->get("template=about"),
	'projects'=> pages()->get("template=projects"),
	'recent' => $blog->child(),
// Path to template parts
	'homeParts' => 'parts/home',
	'blogParts' => 'parts/blog',
// Blog
	'blog' => $blog,
	'disableComments' => $options->more_options->get("name=disable-comments"),
// Contact Page
	'saveMessages' => $options->more_options->get("name=save-messages"),
// Images
	'img' => page()->images && page()->images->count() ? page()->images : '',
	'spinner' => urls('templates') . 'assets/img/spinner.svg',
// Main
	'mainTitle' => page('title'),
	'mainImage' => true, // Set basic background image for all pages
// Bottom Panel
	'bottomPanel' => $options->bottom_panel,
// Basic Translations
	'lang' => __('en'),
	'edit' => __('Edit'),
	'next' => __('Next'),
	'previous' => __('Previous'),
	'search' => __('Search'),
	'search-site' => __('Search the entire site'),
	'found-matches' => __('Found %d page(s)'),
	'no-results' => __('Sorry, no results were found.'),
	'maintenance-mode' => __('Maintenance Mode'),
	'site-disabled' => __('Our site is currently disabled.'),
	'to-top' => __('To top'),
	'we-sociable' => __('We are sociable'),
	'powered' => __('Probably supported by ProcessWire CMS'),
// Contact Page Translate
	'message-error' => __('Some errors, please update your form'),
	'message-success' => __('Success, your message has been sent'),
	'txt-from' => __('From'),
	'form-legend' => __('Contact Us'),
	'form-name' => __('Name'),
	'form-email' => __('Email'),
	'form-privacy' => __('I agree with the %s terms.'),
	'form-message' => __('Message'),
	'form-spam' => __('To help prevent automated spam, please answer this question'),
	'fs-placeholder' => __('* Using only numbers, what is 10 plus 15?'),
	'fs-error' => __('Fill out the spam prevention box correctly'),
	'form-submit' => __('Submit'),
// Blog Translate
	'in-blog' => __('In the blog'),
	'posted-in' => __('Posted in'),
	'all-posts' => __('All posts'),
	'recent-posts' => __('Recent posts'),
	'read-more' => __('Read More'),
	'written-on' => __('Written on'),
	'byline-text' => __('Posted by %1$s on %2$s'),
	'also-like' => __('You might also like:'),
	'author' => __('Author'),
	'authors' => __('Authors'), // is also url segments ( blog/authors/author-mame )
	'category' => __('Category'),
	'tag' => __('Tag'),
	'author-checkbox' => __('You probably need to check the author checkbox in your user profile'),
	'rss' => __('RSS'),
	'recent-entries' => __('Recent entries'),
// Comments Form Translate
	'previous-comments' => __('Previous Comments'),
	'next-comments' => __('Next Comments'),
	'post-comment' => __('Post a comment'),
	'comment' => __('Comment'),
	'comments' => __('Comments'),
	'no-comments' => __('No Comments'),
	'comments-closed' => __('Comments are closed'),
	'comment-header' => __('Posted by {cite} on {created}'),
	'success-message' => __('Thank you, your comment has been posted.'),
	'pending-message' => __('Your comment has been submitted and will appear once approved by the moderator.'),
	'error-message' => __('Your comment was not saved due to one or more errors.') . ' ' .
	__('Please check that you have completed all fields before submitting again.'),
	'comment-cite' => __('Your Name'),
	'comment-email' => __('Your E-Mail'),
	'comment-website' => __('Website'),
	'comment-stars' => __('Your Rating'),
	'submit' => __('Submit'),
	'stars-required' => __('Please select a star rating'),
	'reply' => __('Reply')
]);

include_once('./_func.php');
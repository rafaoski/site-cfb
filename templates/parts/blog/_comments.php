<?php namespace ProcessWire;

/**
 *
 * @link https://processwire.com/docs/modules/guides/comments/
 *
 */

if(!page()->comments) return;

$openComments = page()->checkbox_1 == 0;

// Find comments without nested children ( parent_id=0 )
$comments = page()->comments->find("parent_id=0");
$paginateLimit = 24;

if($openComments) {
// Opened Comments
	echo "<h3 class='text-xxl text-bold text-uppercase'>" . setting('comments') . "</h3>";
} else {
// Comments Are Closed
	echo "<h3>" . setting('comments-closed') . "</h3>";
}

// Show Comments List
echo comments($comments, ['paginate' => true, 'limit' => $paginateLimit, 'reply' => $openComments]);

// If not closed comments
if($openComments) {
// comments form with all options specified (these are the defaults)
	echo page()->comments->renderForm(array(
		'headline' => "<h3 class='text-xl'>" . setting('post-comment') . '</h3>',
		'successMessage' => "<p class='success'>" . setting('success-message') . "</p>",
		'errorMessage' => "<p class='error'>" . setting('error-message') . "</p>",
		'processInput' => true,
		'encoding' => 'UTF-8',
		'attrs' => array(
			'id' => 'CommentForm',
			'action' => './',
			'method' => 'post',
			'class' => '',
			'rows' => 5,
			'cols' => 50,
			),
		'labels' => array(
			'cite' => setting('comment-cite'),
			'email' => setting('comment-email'),
			'text' => setting('comment'),
			'submit' => setting('submit'),
		),
		'classes' => array(
			'form' => '',
			'label' => '',
			'labelSpan' => '',
			'cite' => 'CommentFormCite {id}_cite',
			'citeInput' => 'required form-control',
			'email' => 'CommentFormEmail {id}_email',
			'emailInput' => 'required email form-control',
			'text' => 'CommentFormText {id}_text',
			'textInput' => 'required form-control',
			'website' => 'CommentFormWebsite {id}_website',
			'websiteInput' => 'website form-control',
			'stars' => 'CommentFormStars {id}_stars',
			'starsRequired' => 'CommentFormStarsRequired',
			'honeypot' => 'CommentFormHP {id}_hp',
			'notify' => 'CommentFormNotify',
			'radioLabel' => '',
			'radioInput' => '',
			'submit' => 'CommentFormSubmit {id}_submit',
			'submitButton' => 'btn btn--primary',
		),
		// the name of a field that must be set (and have any non-blank value), typically set in Javascript to keep out spammers
		// to use it, YOU must set this with a <input hidden> field from your own javascript, somewhere in the form
		'requireSecurityField' => '', // not used by default
	));
}

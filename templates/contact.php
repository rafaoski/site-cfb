<?php namespace ProcessWire;

/**
 *
 * @link https://processwire.com/docs/start/variables/input/
 * @link https://processwire.com/api/ref/session/
 * @link https://processwire.com/api/ref/session/c-s-r-f/
 * @link https://processwire.com/api/ref/pages/save/
 * @link https://processwire.com/api/ref/wire-date-time/date/
 *
 */

// Basic info
$saveMessages = setting('saveMessages');
$adminMail = page()->e_mail;
$subject = page()->text;
// Privacy Page
$privacyPolicy = setting('privacyPolicy');

// Custom Title
$mailLink = "<a class='text-sm' href='mailto:$adminMail'>$adminMail</a>";
setting('mainTitle', page('title') . "<br>$mailLink");

// Translate
$messageError = setting('message-error');
$messageSuccess = setting('message-success');
$txtFrom = setting('txt-from');
$formLegend = setting('form-legend');
$formName = setting('form-name');
$formEmail = setting('form-email');
$formPrivacy = setting('form-privacy');
$formMessage = setting('form-message');
$formSpam = setting('form-spam');
$fsPlaceholder = setting('fs-placeholder');
$fsError = setting('fs-error');
$formSubmit = setting('form-submit');

// If submit form
if(input('post')->submit) {

	if(input()->post('inputSpam') != 25)  {
		session()->set('message', "<h2 class='color-error'>$fsError</h2>");
		session()->redirect('./');
	}

	if($session->CSRF->hasValidToken()) {

	// Get all value inputs
		$form =
		[
			'name'    => input()->post('inputName','text'),
			'email'   => input()->post('inputEmail','email'),
			'message' => input()->post('textareaMessage','textarea'),
		];

	// Check form
		foreach ($form as $item) {
			if(!$item) {
				session()->set('message', "<h2 class='color-error'>$messageError</h2>");
				session()->redirect('./');
			}
		}

	// Compose a simple HTML email message
		$bodyHtml =
<<<EOT
		<h1>$txtFrom: <a href="mailto:{$form['email']}">{$form['name']}</a></h1>
		<p style='font-size: 22px'>$formMessage: {$form['message']}</p>
EOT;

	// form submission is valid
	// okay to process
		$message = $mail->new();
		$message->to($adminMail)->from($form['email']);
		$message->subject($subject)
				->body($form['message'])
				->bodyHTML($bodyHtml);
		$numSent = $message->send();

// Save Contact
		if ($saveMessages == true) {
			// save to log that can be viewed via the pw backend
				$p = new Page();
				$p->template = 'contact-item';
				// $p->parent = 1052;
				$p->parent = page();
				$p->title = $form['email'] . ' - ' . datetime()->date('Y-m-d h:i:s');
				$p->body = $bodyHtml;
				$p->addStatus(Page::statusHidden);
				$p->save();
		}

	// Set success message
		session()->set('message', "<h2 class='color-success'>$messageSuccess</h2>");
		session()->redirect('./');
	} else {
	// Form submission is NOT valid
		throw new WireException('CSRF check failed!');
	}
}
?>

<div id="main-content" class='-container -max-width-lg'>
	<?php
		if(session('message')) {
		// Get Message
			echo "<div class='padding-sm'>" . session()->message . "</div>";
		// Remove message
			session()->remove('message');
		}
	?>

	<form class='bg-contrast-low padding-md container max-width-sm' action="./" method='post'>
		<?php
			echo session()->CSRF->renderInput();
		?>
		<fieldset class="margin-bottom-md">
			<legend class="form-legend"><?= $formLegend ?></legend>

			<div class="margin-bottom-sm">
				<div class="grid grid-gap-sm">
					<div class="col-6@md">
						<label class="form-label margin-bottom-xxs" for="inputName"><?= $formName ?>:</label>
						<input class="form-control width-100%" type="text" name="inputName" id="inputName" required>
					</div>

					<div class="col-6@md">
						<label class="form-label margin-bottom-xxs" for="inputEmail"><?= $formEmail ?>:</label>
						<input class="form-control width-100%" type="email" name="inputEmail" id="inputEmail" placeholder="email@myemail.com" required>
					</div>
				</div>
			</div>

			<div>
				<label class="form-label margin-bottom-xxs" for="textareaMessage"><?= $formMessage ?>:</label>
				<textarea class="form-control width-100%" name="textareaMessage" id="textareaMessage" required></textarea>
			</div>

			<div class='margin-y-sm'>
				<input class="padding-md" type="checkbox" name="inputPrivacy" id="inputPrivacy" required>
				<label class="form-label margin-bottom-xxs" for="inputPrivacy">
					<?= sprintf($formPrivacy, "<a href='$privacyPolicy->url'>$privacyPolicy->title</a>") ?>
				</label>
			</div>

			<div class='margin-y-sm'>
				<label class="form-label margin-bottom-xxs" for="inputSpam"><?= $formSpam ?>:<br>
				<span class='color-error'><?= $fsPlaceholder ?></span></label>
				<input class="form-control width-100%" type="number" name="inputSpam" id="inputSpam" placeholder="<?= $fsPlaceholder ?>" required>
			</div>
		</fieldset>

		<div class="text-right">
			<input class='link btn btn--primary' type='submit' name='submit' value='<?= $formSubmit ?>'>
		</div>
	</form>

	<div class="container max-width-md margin-y-md">
		<?= page()->body ?>
	</div>

</div>
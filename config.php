<?php

/**
 * ProcessWire Configuration File
 *
 * Site-specific configuration for ProcessWire.
 * This config.php file was generated by the ProcessExportProfile module.
 *
 * Please see the file /wire/config.php which contains all configuration options you may
 * specify here. Simply copy any of the configuration options from that file and paste
 * them into this file in order to modify them.
 *
 * ProcessWire
 * Copyright (C) 2020 by Ryan Cramer
 * Licensed under MPL 2.0
 *
 * https://processwire.com
 *
 */

if(!defined("PROCESSWIRE")) die();

/*** SITE CONFIG *************************************************************************/

$config->prependTemplateFile = '_init.php';
$config->appendTemplateFile = '_main.php';
$config->useMarkupRegions = true;
$config->useFunctionsAPI = true;
$config->useWebP = true;
$config->defaultAdminTheme = 'AdminThemeUikit';

/**
 * Example Custom Config
 * https://processwire.com/api/variables/config/
 * https://processwire.com/blog/posts/pw-3.0.87/#new-field-template-context-settings
 */

/** Advanced Configuration **/
// $config->advanced = true;

/** Show demo site **/
// $config->demo = true;

/** Predefined image size settings https://processwire.com/blog/posts/pw-3.0.151/#predefined-image-size-settings **/
// $config->imageSizes = [
// 	'thumb' => [
// 	  'width' => 200,
// 	  'height' => 200
// 	],
// 	'thumb2x' => [
// 	  'width' => 400,
// 	  'height' => 400,
// 	  'quality' => 50
// 	]
//   ];

/** https://processwire.com/blog/posts/pw-3.0.99/ **/
// $config->noHTTPS = true;

/**  ignore HTTPS for this hostname only: **/
// $config->noHTTPS = 'dev.processwire.com';

/** ignore HTTPS for these hostnames: **/
//     $config->noHTTPS = [
//       'dev.processwire.com',
//       'stage.processwire.com',
//       'localhost:8888',
//     ];

/*** INSTALLER CONFIG ********************************************************************/



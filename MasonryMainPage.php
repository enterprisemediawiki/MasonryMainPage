<?php
/**
 * The MasonryMainPage extension enables use of Masonry blocks within MediaWiki
 *
 * Documentation: https://github.com/enterprisemediawiki/MasonryMainPage
 * Support:       https://github.com/enterprisemediawiki/MasonryMainPage
 * Source code:   https://github.com/enterprisemediawiki/MasonryMainPage
 *
 * @file MasonryMainPage.php
 * @addtogroup Extensions
 * @author Daren Welsh
 * @copyright © 2014 by Daren Welsh
 * @licence GNU GPL v3+
 */

# Not a valid entry point, skip unless MEDIAWIKI is defined
if (!defined('MEDIAWIKI')) {
	die( "MasonryMainPage extension" );
}

// if wfLoadExtension exists (MW 1.25+) use that method of registering extensions
if ( function_exists( 'wfLoadExtension' ) ) {
	wfLoadExtension( 'MasonryMainPage' );
	// Keep i18n globals so mergeMessageFileList.php doesn't break
	$wgMessagesDirs['MasonryMainPage'] = __DIR__ . '/i18n';
	$wgExtensionMessagesFiles['MasonryMainPageMagic'] = __DIR__ . '/Magic.php';
	wfWarn(
		'Deprecated PHP entry point used for MasonryMainPage extension. ' .
		'Please use wfLoadExtension instead, ' .
		'see https://www.mediawiki.org/wiki/Extension_registration for more details.'
	);
	return;

// For MW 1.24 and lower, use normal extension registration
// This should be removed when this extension drops support for <1.25
} else {

	$wgExtensionCredits['parserhook'][] = array(
		'path'           => __FILE__,
		'name'           => 'MasonryMainPage',
		'url'            => 'http://github.com/enterprisemediawiki/MasonryMainPage',
		'author'         => '[https://www.mediawiki.org/wiki/User:Darenwelsh Daren Welsh]',
		'descriptionmsg' => 'masonrymainpage-desc',
		'version'        => '0.3.0'
	);


	# Internationalization
	$wgExtensionMessagesFiles['MasonryMainPageMagic'] = __DIR__ . '/Magic.php';

	# The "class" file contains the bulk of a simple parser function extension.
	$wgAutoloadClasses['MasonryMainPage'] = __DIR__ . '/MasonryMainPage.class.php';

	$wgResourceModules['ext.masonrymainpage.base'] = array(
		'scripts' => array( 'imagesloaded.pkgd.js', 'masonry.pkgd.js', 'masonry-common.js' ),
		'styles' => 'Masonry.css',
		'localBasePath' => __DIR__,
		'remoteExtPath' => 'MasonryMainPage',
		'position' => 'top',
	);

	# This specifies the function that will initialize the parser function.
	$wgHooks['ParserFirstCallInit'][] = 'MasonryMainPage::setup';

}

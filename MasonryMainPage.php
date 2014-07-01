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

$wgExtensionCredits['parserhook'][] = array(
	'path'           => __FILE__,
	'name'           => 'MasonryMainPage',
	'url'            => 'http://github.com/enterprisemediawiki/MasonryMainPage',
	'author'         => 'Daren Welsh',
	'descriptionmsg' => 'Enables use of Masonry blocks in MediaWiki',
	'version'        => '0.1.0'
);

# $dir: the directory of this file, e.g. something like:
#	1)	/var/www/wiki/extensions/BlankParserFunction
# 	2)	C:/xampp/htdocs/wiki/extensions/BlankParserFunction
$dir = dirname( __FILE__ ) . '/';

# Location of "message file". Message files are used to store your extension's text
#	that will be displayed to users. This text is generally stored in a separate
#	file so it is easy to make text in English, German, Russian, etc, and users can
#	easily switch to the desired language.
// No internationalization yet
// $wgExtensionMessagesFiles['BlankParserFunction'] = $dir . 'BlankParserFunction.i18n.php';

# The "body" file will contain the bulk of a simple parser function extension. 
#	NEED MORE INFO HERE.
#
$wgAutoloadClasses['MasonryMainPage'] = $dir . 'MasonryMainPage.body.php';

# This specifies the function that will initialize the parser function.
#	NEED MORE INFO HERE.
#
// $wgHooks['ParserFirstCallInit'][] = 'MasonryMainPage::setup';

/**
 *  Use a hook to add a meta tag to force IE to not use compatibility mode
 **/
$wgHooks['BeforePageDisplay'][] = 'MasonryMainPage::addIECompatibilityMetaTag';

/**
 *  JSC-MOD specific javascript modifications
 **/
$wgHooks['AjaxAddScript'][] = 'MasonryMainPage::addMasonryFiles';


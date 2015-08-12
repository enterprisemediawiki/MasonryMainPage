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
	'author'         => '[https://www.mediawiki.org/wiki/User:Darenwelsh Daren Welsh]',
	'descriptionmsg' => 'masonrymainpage-desc',
	'version'        => '0.2.0'
);

# $dir: the directory of this file, e.g. something like:
#	1)	/var/www/wiki/extensions/BlankParserFunction
# 	2)	C:/xampp/htdocs/wiki/extensions/BlankParserFunction
$dir = dirname( __FILE__ ) . '/';

# Internationalization
$wgExtensionMessagesFiles['MasonryMainPage'] = $dir . 'MasonryMainPage.i18n.php';

# The "class" file contains the bulk of a simple parser function extension. 
$wgAutoloadClasses['MasonryMainPage'] = $dir . 'MasonryMainPage.class.php';

$wgResourceModules['ext.masonrymainpage.base'] = array(
	'scripts' => array( 'imagesloaded.pkgd.js', 'masonry.pkgd.js', 'masonry-common.js' ),
	'styles' => 'Masonry.css',
	'localBasePath' => __DIR__,
	'remoteExtPath' => 'MasonryMainPage',
	'position' => 'top',
);

/**
 *  Use a hook to add a meta tag to force IE to not use compatibility mode
 **/
$wgHooks['BeforePageDisplay'][] = 'MasonryMainPage::addIECompatibilityMetaTag';

# This specifies the function that will initialize the parser function.
$wgHooks['ParserFirstCallInit'][] = 'MasonryMainPage::setup';

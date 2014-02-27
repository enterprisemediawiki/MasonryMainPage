<?php
/** 
 * The MasonryMainPage extension does .... something...
 * 
 * Documentation: http://???
 * Support:       http://???
 * Source code:   http://???
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
	'url'            => 'http://github.com/darenwelsh/MediaWiki-MasonryMainPage',
	'author'         => 'Daren Welsh',
	'descriptionmsg' => 'masonrymainpage-desc',
	'version'        => '0.1.0'
);

# $dir: the directory of this file, e.g. something like:
#	1)	/var/www/wiki/extensions/BlankParserFunction
# 	2)	C:/xampp/htdocs/wiki/extensions/BlankParserFunction
// this isn't used, yet
// $dir = dirname( __FILE__ ) . '/';

# Location of "message file". Message files are used to store your extension's text
#	that will be displayed to users. This text is generally stored in a separate
#	file so it is easy to make text in English, German, Russian, etc, and users can
#	easily switch to the desired language.
// No internationalization yet
// $wgExtensionMessagesFiles['BlankParserFunction'] = $dir . 'BlankParserFunction.i18n.php';

# The "body" file will contain the bulk of a simple parser function extension. 
#	NEED MORE INFO HERE.
#
// No classes yet
// $wgAutoloadClasses['BlankParserFunction'] = $dir . 'BlankParserFunction.body.php';

# This specifies the function that will initialize the parser function.
#	NEED MORE INFO HERE.
#
// No parser function yet
// $wgHooks['ParserFirstCallInit'][] = 'BlankParserFunction::setup';


/**
 *  JSC-MOD specific javascript modifications
 **/
$wgHooks['AjaxAddScript'][] = 'addMasonryFiles';
function addMasonryFiles ( $out ){
	global $wgScriptPath;

	$out->addScriptFile( $wgScriptPath .'/extensions/JSCMOD/Masonry/masonry.pkgd.min.js' );
	$out->addScriptFile( $wgScriptPath .'/extensions/JSCMOD/Masonry/masonry-common.js' );

	$out->addLink( array(
		'rel' => 'stylesheet',
		'type' => 'text/css',
		'media' => "screen",
		'href' => "$wgScriptPath/extensions/MasonryMainPage/MasonryMainPage.css"
	) );
	
	return true;
}

<?php
/**
 * The MasonryMainPage extension enables the use of Masonry blocks
 * within MediaWiki.
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

class MasonryMainPage
{

	static function setup ( &$parser ) {

		$parser->setFunctionHook(
			'masonry-block', // the name of your parser function, the same as the $magicWords value you set in BlankParserFunction.i18n.php 
			array(
				'MasonryMainPage',  // class to call function from
				'renderMasonryMainPage' // function to call within that class
			),
			SFH_OBJECT_ARGS // defines the format of how data is passed to your function...don't worry about it for now.
		);

		return true;

	}


	static function renderMasonryMainPage ( &$parser, $frame, $args ) {

		// self::addJSandCSS(); // adds the javascript and CSS files 
		// self::addMasonryFiles(); // adds the javascript and CSS files 

		// first_argument  = Type of block (currently requires a template in MW)
		// second_argument = Color of block (choices in Masonry.css)

		$first_argument = trim( $frame->expand($args[0]) );

		if ( count($args) > 1 )
			$second_argument = trim( $frame->expand($args[1]) );
		else
			$second_argument = "";

		$text = "<div class='item w2'>
        <div class='item-content'>"
         . $first_argument . "</div></div>";

		// $text .= $second_argument;

		return $text;

	}

	/**
	 * Adds the following meta tag to the HTML header of all pages
	 * <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	 *
	 * This forces IE to load the page NOT in compatibility mode. Loading 
	 * in compatibility mode breaks the Masonry extension.
	 *
	 * This function should be called on the 'BeforePageDisplay' hook as follows:
	 * $wgHooks['BeforePageDisplay'][] = onBeforePageDisplay( OutputPage &$out, Skin &$skin ) { ... }
	 **/
	static function addIECompatibilityMetaTag (&$out, &$skin) {
		$out->addMeta( 'http:X-UA-Compatible', 'IE=9; IE=8; IE=7; IE=EDGE' );
	}

	static function addMasonryFiles ( $out ){
		global $wgScriptPath;

		$out->addScriptFile( $wgScriptPath .'/extensions/MasonryMainPage/masonry.pkgd.min.js' );
		$out->addScriptFile( $wgScriptPath .'/extensions/MasonryMainPage/imagesloaded.pkgd.min.js' );
		$out->addScriptFile( $wgScriptPath .'/extensions/MasonryMainPage/masonry-common.js' );

		$out->addLink( array(
			'rel' => 'stylesheet',
			'type' => 'text/css',
			'media' => "screen",
			'href' => "$wgScriptPath/extensions/MasonryMainPage/Masonry.css"
		) );
		
		return true;
	}
}
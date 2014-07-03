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
			// name of parser function
			// same as $magicWords value set in MasonryMainPage.i18n.php 
			'masonry-block', 
			array(
				'MasonryMainPage',  // class to call function from
				'renderMasonryMainPage' // function to call within that class
			),
			SFH_OBJECT_ARGS // defines format of how data is passed to function
		);

		return true;

	}

	static function renderMasonryMainPage ( &$parser, $frame, $args ) {
		//The $args array looks like this (not necessarily in order):
		//	[0] => 'Title = Block Title Example' (Such as MW page name), need to set default
		//	[1] => 'Body = Body of block', need to set default
		//  [2] => 'Color = Blue' //Optional color argument, default is green (choices in Masonry.css)
		//  [3] => 'Width = 2' //Optional width of block, default is 1 (item or item w2)
		// more options to come later like priority, expiration date, etc

		// self::addMasonryFiles(); // adds the javascript and CSS files 

		// $Title  = Block title (Such as MW page name)
		// $Body = Body of block
		// ****Need to add these args
		// $Color  = Color of block (choices in Masonry.css)
		// $Width = Width of block (item or item w2)

		//Currently assumes $Title is first arg and $Body is second
		//Need to fix so any order is accepted if user passes named args (Body = "...")
		// $Title = trim( $frame->expand($args[0]) );

		// if ( count($args) > 1 )
		// 	$Body = trim( $frame->expand($args[1]) );
		// else
		// 	$Body = "";


		//***New method to create array of named args***
		//Run extractOptions on $args
		$options = self::extractOptions( $args );

		//Define the main output
		// *******Need to allow for item and item w2
	        // {{#if: {{{color|}}} | main-page-box-{{{color}}} | }}
	        // {{#if: {{{style|}}} | style="{{{style|}}}" | }}>
		$text = "<div class='item'>
	        <div class='item-content'>
	        <table class='main-page-box main-page-box-green'>" .

	        //This contains the heading of the masonry block (a wiki link to whatever is passed)
	        "<tr><th>[[" . $options['title'] . "]]</th></tr>" .
			
			//This contains the body of the masonry block
			//Wiki code like links can be include; templates and wiki tables cannot
			"<tr><td>"
	         . $options['body'] . "</td></tr></table></div></div>";
// print_r($options);
		return $text;

	}

	/**
	 * Converts an array of values in form [0] => "name=value" into a real
	 * associative array in form [name] => value
	 *
	 * @param array string $options
	 * @return array $results
	 */
	static function extractOptions( array $options ) {
		$results = array();
	 
		foreach ( $options as $option ) {
			$pair = explode( '=', $option, 2 );
			if ( count( $pair ) == 2 ) {
				//***issue right now with trim not working - FIXIT
				$name = strtolower(trim( $pair[0] )); //Convert to lower case so it is case-insensitive
				$value = trim( $pair[1] );
				$results[$name] = $value;
			}
		}
		//Now you've got an array that looks like this:
		//	[title] => Block Title Example
		//	[body]  => Body of block
		//  [color] => Blue
		//  [width] => 2

		return $results;
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
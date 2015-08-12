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
		//	[0] => 'Title = Block Title Example' (Such as MW page name) //Optional header
		//	[1] => 'Body = Body of block'
		//  [2] => 'Color = Blue' //Optional, default is green (choices in Masonry.css)
		//                        //Specify 'none' for no color formatting
		//  [3] => 'Width = 2' //Optional width of block, default is 1 (item or item w2)
		// more options to come later like priority, expiration date, etc

		//Run extractOptions on $args
		$options = self::extractOptions( $frame, $args );

		$itemClass = 'item';
		if ( $options['width']=="2" ) {
			$itemClass .= " w2";
		}

		if ( $options['color']=="none") {
			$tableClass = '';
		} else {
			$tableClass = 'class="main-page-box main-page-box-' . $options['color'] . '"';
		}
	
		//Define the main output
		$text = 
			"<div class='$itemClass'>
				<div class='item-content'>
					<table $tableClass>";

		//This contains the heading of the masonry block (a wiki link to whatever is passed)
		//Check if 'title' has a value
		if ( !isset($options['title']) || $options['title']=="" ) {
				//If no 'title' then omit table header tags
		} else {
			$text .= "<tr><th>" . $options['title'] . "</th></tr>";
		}
		
		$body = trim( $options['body'] );
		
		// This contains the body of the masonry block
		// Wiki code like links can be included; templates and wiki tables cannot
		// \n before $body so user input starts on new line without
		// any whitespace before it.
		$text .= "<tr><td>\n$body</td></tr></table></div></div>";

		return $text;

	}

	/**
	 * Converts an array of values in form [0] => "name=value" into a real
	 * associative array in form [name] => value
	 *
	 * @param array string $args
	 * @return array $options
	 */
	static function extractOptions( $frame, array $args ) {
		$options = array();
	 
		foreach ( $args as $arg ) {
			$pair = explode( '=', $frame->expand($arg) , 2 );
			if ( count( $pair ) == 2 ) {
				$name = strtolower(trim( $pair[0] )); //Convert to lower case so it is case-insensitive
				$value = trim( $pair[1] );
				$options[$name] = $value;
			}
		}
		//Now you've got an array that looks like this:
		//	[title] => Block Title Example
		//	[body]  => Body of block
		//  [color] => Blue
		//  [width] => 2

		//Check for empties, set defaults
		//Default 'title'
		if ( !isset($options['title']) || $options['title']=="" ) {
		        	$options['title']= ""; //no default, but left here for future options
	        }
        //Default 'color'
        if ( !isset($options['color']) || $options['color']=="" ) {
	        	$options['color']= "green"; //green is default color
        }
        //Default 'width'
        if ( !isset($options['width']) || $options['width']=="" ) {
		        	$options['width']= "1"; //default of 1
	        }

		return $options;
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
		$out->addModules( 'ext.masonrymainpage.base' );
	}

}

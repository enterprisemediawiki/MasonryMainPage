<?php
/**
 * Internationalisation file for extension MasonryMainPage.
 *
 * @file
 * @ingroup Extensions
 */
$magicWords = array();
$messages = array();

/** English **/
$messages['en'] = array(
	'masonrymainpage'         => 'MasonryMainPage',
	'masonrymainpage-desc'    => 'Enables use of Masonry blocks in MediaWiki via the masonry-block parser function'
);

/** German **/
$messages['de'] = array(
	'masonrymainpage'         => 'MasonryMainPage',
	'masonrymainpage-desc'    => 'Ermöglicht die mauerwerksverbundartige Anordnung von Inhaltsblöcken auf Wikiseiten'
);

# The $magicWords array is where we'll declare the name of our parser function
# Below we've declared that it will be called "masonry-block", and thus will be
# called in wikitext by doing {{#masonry-block: example | parameters }}
$magicWords['en'] = array(
   'masonry-block' => array(
   		0,              // zero means case-insensitive, 1 means case sensitive
   		'masonry-block' // parser function in this language. For English this will probably be the same as above
   	),
);

$magicWords['de'] = array(
   'masonry-block' => array( 0, 'mauerwerksblock' ),
);

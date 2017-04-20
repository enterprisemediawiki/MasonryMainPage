MasonryMainPage
===============

This extension enables the use of Masonry blocks in MediaWiki.

Masonry is developed by David DeSandro and information about that script can be found at http://masonry.desandro.com

USAGE
-----

To enable this extension, append the following to LocalSettings.php

```html
require_once "$IP/extensions/MasonryMainPage/MasonryMainPage.php";
```

To use this extension in a MediaWiki page, add the following elements to the contents of a wiki page:

```html
<!--

   DIV for outer Masonry container

--><div id="mediawiki-masonry-main-page-container"><!--


   Begin Masonry Blocks

-->
{{#masonry-block: title =
 | width =
 | color =
 | body  =
 }}
{{#masonry-block: title =
 | body  =
 }}
<!--

   End DIV for outer Masonry container

-->
</div>
```

OPTIONS
-------

<ul><li>title = Title of your block (optional, will not show a header if omitted).</li>
<li>width = 1 (or 2) (optional, default is 1).</li>
<li>color = white (optional, default is green, options include orange, yellow, blue, white, purple, green, and none).</li>
<li>body = This is the main content. Wiki code like links can be included; templates and wiki tables cannot.</li></ul>

TEMPLATES
---------

Instead of clogging your main page with lots of content, you can also use templates.

For example, you could create Template:Pages That Need Help Block with the content below:
```html
{{#masonry-block: title=Where to Help
 | color=orange
 | body =
[[Pages that need help]]
* [[Special:WantedPages|Pages that need to be created]]
* [[Articles requiring clarification|Pages needing clarification]]
* [[Articles to be expanded|Pages needing expansion]]
* [[Articles with unsourced statements|Pages with unsourced statements]]
}}

```

Then, on the main page, just place {{Pages That Need Help Block}} in the Masonry container div.



BACKGROUND INFO
---------------

The parser function #masonry-block essentially adds the following code and applies some CSS:

```html
    <div class="item">
        <div class="item-content">This can be any content for a block.</div>
    </div>
    <div class="item w2">
        <div class="item-content">This can be any content for a block that is twice as wide.</div>
    </div>
```

If you run into issues using a complex template in a masonry-block, you might try using this method instead of the parser function.

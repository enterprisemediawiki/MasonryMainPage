MasonryMainPage
=========================

This extension enables the use of Masonry blocks in MediaWiki. 

Masonry is developed by David DeSandro and information about that script can be found at http://masonry.desandro.com

=========================
USAGE
=========================

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
 | width = 
 | color = 
 | body  = 
 }}
<!--

   End DIV for outer Masonry container

-->
</div>
```

=========================
OPTIONS
=========================

<ul><li>title = Title of your block (optional, will not show a header if omitted).</li>
<li>width = 1 (or 2) (optional, default is 1).</li>
<li>color = white (default is green, options in CSS).</li>
<li>body  = This is the main content. Wiki code like links can be included; templates and wiki tables cannot.</li></ul>

=========================
BACKGROUND INFO
=========================

The parser function #masonry-block essentially adds the following code and applies some CSS:

```html
    <div class="item">
        <div class="item-content">This can be any content for a block.</div>
    </div>
    <div class="item w2">
        <div class="item-content">This can be any content for a block that is twice as wide.</div>
    </div>
```
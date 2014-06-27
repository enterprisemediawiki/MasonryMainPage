MediaWiki-MasonryMainPage
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
    <div class="item">
        <div class="item-content">This can be any content for a block.</div>
    </div>
    <div class="item w2">
        <div class="item-content">This can be any content for a block that is twice as wide.</div>
    </div>
<!--


   End DIV for outer Masonry container

-->
</div>
```
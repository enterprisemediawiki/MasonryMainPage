var colCount = 0;
var colWidth = 610;
var margin = 20;
var windowWidth = 0;
var blocks = [];

function setupBlocks() {
    windowWidth = $(window).width();
    colWidth = $('.block').outerWidth();
    colCount = Math.floor(windowWidth/(colWidth+margin));
    for(var i=0;i<colCount;i++) {
        blocks.push(margin);
    }
      //    alert(blocks); //displays feedback of block placement calc (for troubleshooting)
      // console.log(windowWidth); //(for troubleshooting)
    positionBlocks();
}

$(window).resize(setupBlocks);



function positionBlocks() {
    $('.block').each(function(){
        var min = Array.min(blocks);
        var index = $.inArray(min, blocks);
        var leftPos = margin+(index*(colWidth+margin));
        $(this).css({
            'left':leftPos+'px',
            'top':min+'px'
        });
        blocks[index] = min+block.outerHeight()+margin;
        // console.log(index); //(for troubleshooting)
    });
}

// Function to get the Min value in Array
Array.min = function(array) {
    return Math.min.apply(Math, array);
};

/* Do this Masonry stuff after the page is loaded */
$(document).ready(function(){
// $(window).load(function(){ //alternate method (for troubleshooting)
// initialize
var $container = $('#mediawiki-masonry-main-page-container');
  // initialize Masonry after all images have loaded  
  $container.imagesLoaded( function() {
    $container.masonry({
      columnWidth: 310,
      gutter: 0,
      itemSelector: '.item'
    });
    // console.log('Images loaded');
  });
});


// $(document).ready(setupBlocks){console.log('test')}; //(for troubleshooting)





/* ALTERNATE Function to reload after images are done loading */
/*
// initialize Masonry
var $container = $('#container').masonry();
// layout Masonry again after all images have loaded
$container.imagesLoaded( function() {
  $container.masonry();
});
*/

/* Function to make blocks toggle size when clicked */
/* COMMENTED OUT TO KEEP THINGS SIMPLE AT FIRST
$( function() {

  var $container = $('.js-masonry').masonry({
    columnWidth: 10
  });

  $container.on( 'click', '.item-content', function() {
    $( this ).parent('.item').toggleClass('is-expanded');
    $container.masonry();
  });
  
});
*/

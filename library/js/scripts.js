/*----- jquery menu aim ---------------------------------------------------------------
https://github.com/kamens/jQuery-menu-aim.git
(minified)
*/

!function(e){function t(t){var n=e(this),i=null,o=[],u=null,r=null,c=e.extend({rowSelector:"> li",submenuSelector:"*",submenuDirection:"right",tolerance:75,enter:e.noop,exit:e.noop,activate:e.noop,deactivate:e.noop,exitMenu:e.noop},t),l=3,f=300,a=function(e){o.push({x:e.pageX,y:e.pageY}),o.length>l&&o.shift()},s=function(){r&&clearTimeout(r),c.exitMenu(this)&&(i&&c.deactivate(i),i=null)},h=function(){r&&clearTimeout(r),c.enter(this),v(this)},m=function(){c.exit(this)},x=function(){y(this)},y=function(e){e!=i&&(i&&c.deactivate(i),c.activate(e),i=e)},v=function(e){var t=p();t?r=setTimeout(function(){v(e)},t):y(e)},p=function(){function t(e,t){return(t.y-e.y)/(t.x-e.x)}if(!i||!e(i).is(c.submenuSelector))return 0;var r=n.offset(),l={x:r.left,y:r.top-c.tolerance},a={x:r.left+n.outerWidth(),y:l.y},s={x:r.left,y:r.top+n.outerHeight()+c.tolerance},h={x:r.left+n.outerWidth(),y:s.y},m=o[o.length-1],x=o[0];if(!m)return 0;if(x||(x=m),x.x<r.left||x.x>h.x||x.y<r.top||x.y>h.y)return 0;if(u&&m.x==u.x&&m.y==u.y)return 0;var y=a,v=h;"left"==c.submenuDirection?(y=s,v=l):"below"==c.submenuDirection?(y=h,v=s):"above"==c.submenuDirection&&(y=l,v=a);var p=t(m,y),b=t(m,v),d=t(x,y),g=t(x,v);return d>p&&b>g?(u=m,f):(u=null,0)};n.mouseleave(s).find(c.rowSelector).mouseenter(h).mouseleave(m).click(x),e(document).mousemove(a)}e.fn.menuAim=function(e){return this.each(function(){t.call(this,e)}),this}}(jQuery);

/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/

function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y }
}
// setting the viewport width
var viewport = updateViewportDimensions();





/*-- main menu toggle -----------------------------------------------------------------

*/

var navMain_ul  = document.getElementById('js-main-list'),
  navMain_li  = navMain_ul.children;

//for (i = 0; i < navMain_li.length; i++) {
//  navMain_li[i].onclick = function () {
//    this.classList.toggle('active-li');
//  };
//}

var $navMain_ul = $('#js-main-list'),
    $navMain_li = $navMain_ul.find('li'),
    bigScreen = false;
//menu aim for large screen
$navMain_ul.mouseenter( function() {
  vp = updateViewportDimensions();
  if ( vp.width >= 1030 ) {
    bigScreen = true;
    $navMain_ul.menuAim({
      activate: showSubMenu,
      deactivate: hideSubMenu,
      exitMenu: hideAllMenus
    })
  } else {
    bigScreen = false;
  }
});

function showSubMenu(row) {
  if (bigScreen) {
    $row = $(row);
    $row.addClass('active-li');
  }
}

function hideSubMenu(row) {
  $row = $(row);
  $row.removeClass('active-li');
}

function hideAllMenus() {
  bigScreen = false;
  $navMain_li = $navMain_ul.find('li').removeClass('active-li');
}

//much simpler touch toggle for small screens
$navMain_li.click( function() {
  $(this).toggleClass('active-li')
});



/*-- carousel scroller ----------------------------------------------------------------*/

var carousel = document.getElementById('js-carouselMain') || null,
  slides = document.getElementsByClassName('slide'),
  blips = document.getElementsByClassName('blipper'),
  slideCount = slides.length,
  slideTime = 5000,
  slideDelay = 600, //to match scroll timer
  hoverLock = false;

var tickerValue = 1;

function ticker() {
  if (!hoverLock) {

    if (tickerValue < slideCount) {

      tickerValue++;

    } else {

      tickerValue = 1;

    }
console.log("tick " + tickerValue);
    goSlide(tickerValue);

  }
};

function goSlide(x) {
  x--;
  for (i = 0; i < slideCount; i++) {
    if (slides[i].classList.contains('go-away')) {
      slides[i].classList.remove('is-active');
      slides[i].classList.remove('go-away');
    } else if (slides[i].classList.contains('is-active')) {
      slides[i].classList.add('go-away');
      blips[i].classList.remove('active');
    }
    if (slides[i].dataset.slidenum == x) {
      slides[i].classList.add('is-active');
      blips[i].classList.add('active');
    }
  }
}

if (carousel) {
  window.setInterval(ticker, slideTime);

  carousel.onmouseover = function () {
    hoverLock = true;
  }

  carousel.onmouseout = function() {
    hoverLock = false;
  }
}

/* js + ajax auto complete ------------------------------------------------------------*/
// takes categories + key brands.

var MIN_LENGTH = 3;

var $searchForm = $("#js-form-complete").children(".form-search");
var $searchIn = $searchForm.children(".search-in"); //$("#js-search-header");
var $searchOut = $searchForm.children(".search-out"); // $("#js-search-header-results");


$searchIn.keyup(function () {

  var keyword = $(this).val();

  if (keyword.length >= MIN_LENGTH) {

    $.get(fileSrc.ajaxAdmin, {
      keyword: keyword,
      action: "jr_autocomplete"
    }).done(searchToText);

  } else {
    $searchOut.html('');
  }
});

function searchToText(data) {

  var results = $.parseJSON(data);

  $searchOut.html('');

  $(results).each(function (i) {
    if (i < 4) {
      var link = fileSrc.site + '/' + this.filter + '/' + this.url + '/';
      var brand = (this.filter == 'brand') ? '<span> - Brand</span>' : '';
      var output = '<li><a tabindex="' + i + '" href="' + link + '" >' + this.name + brand + '</a></li>';

      $searchOut.append(output);
    }
  })
};

/* item gallery actions -------------------------------------------------------------- */

var $imgGalleryMain = $('#js-gallery-primary'),
    $imgGalleryFull = $('#js-gallery-thumbs'),
    $imgGalleryThumb = $imgGalleryFull.children('li');
    $imgGalleryModal = $('#js-gallery-modal'),
    $imgGalleryOpen = $imgGalleryMain.children('.item-main-zoom'),
    $imgGalleryClose = $imgGalleryModal.children('.modal-close');

// zoom and enhance
$imgGalleryOpen.click(function() {
  $getImgSrc = $imgGalleryMain.children('img').attr('src');
  $bigImgSrc = $getImgSrc.replace('gallery-tile','gallery');
  //console.log($getImgSrc);


  if ($imgGalleryModal.children('img').length) {

    $imgGalleryModal.addClass('is-active').children('img').attr('src',$bigImgSrc);
  } else {
    $bigImgNew = '<img src="' + $bigImgSrc + '" >';
    $imgGalleryModal.addClass('is-active').append($bigImgNew);
  }

});

$imgGalleryClose.click(function() {
  $imgGalleryModal.removeClass('is-active');
});

//"carousel switch"
// since this is likely to open an image that doesnt exist, need to ajax call the php resize function
$imgGalleryThumb.click(function() {
  $getThumbSrc = $(this).children('img').attr('src').replace('gallery-thumb','gallery').split('/').slice(-5).join('/');
  $getThumbSrc = '../'.concat($getThumbSrc);

  $imgGalleryMain.addClass('loading');

  $.get(fileSrc.ajaxAdmin, {
    src: $getThumbSrc,
    size: 'tile',
    action: "jr_resize"
   }, replaceMainImg)

});

function replaceMainImg(data) {
  var results = $.parseJSON(data);

  $newSrc = results.replace('../', fileSrc.site +'/');
  $imgGalleryMain.removeClass('loading').children('img').attr('src',$newSrc);
}

/*$btnFindDeadImg.click(function() {

  $outputGallery.html('');

  $.get(fileSrc.ajaxAdmin, {
    keyword: 'gallery',
    action: "jra_deadimgstats"
  }, listDeadImg)
});

function listDeadImg(data) {
  var results = $.parseJSON(data);
  var output = '<b>Removable Images: </b>' + results.count +
    '<br><b>Space To Save: </b>' + results.size +
    '<p>(To override this, mark items as \'force show\' on the database)</p>';
  $outputGallery.append(output);
  $btnDelDeadImg.show();
}*/

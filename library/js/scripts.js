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

/*-- main menu toggle -----------------------------------------------------------------*/

var navMain_ul  = document.getElementById('js-main-list'),
  navMain_li  = navMain_ul.children;

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
    //console.log("tick " + tickerValue);
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

var $searchForm = $("#js-form-complete").find(".form-search"),
    $searchIn = $searchForm.find(".search-in"),
    $searchOut = $searchForm.find(".search-out");


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
      var extra = (this.filter == 'brand') ? '<span> - Brand</span>' : '<span> - Category</span>';
      var output = '<li><a href="' + link + '" >' + this.name + extra + '</a></li>';
      $searchOut.append(output);
    }
  })
};

//adds arrow movment to the options
$searchIn.keypress(function(e) {
  $results = $searchOut.find('li > a');
  if (e.keyCode == '40' && $results.length > 0) {
    e.preventDefault();
    searchTraverse('down');
  }
});

$searchOut.on('keypress','li > a', function(e) {
  $focussed = $searchOut.find(':focus');
  if (e.keyCode == '40' && $focussed.length > 0) {
    e.preventDefault();
    $i = $(this).parent('li').index();
    searchTraverse('down', $i);
  }
});

$searchOut.on('keypress','li > a', function(e) {
  $focussed = $searchOut.find(':focus');
  if (e.keyCode == '38' && $focussed.length > 0) {
    e.preventDefault();
    $i = $(this).parent('li').index();
    searchTraverse('up', $i);
  }
});

function searchTraverse(direction, i = -1) {
  $results = $searchOut.find('li > a');
  $resultCount = $results.length;
  if (direction == 'down' && i < $resultCount) {
    i++
    $target = $results.eq(i++);
    $text = $target.text();
    $searchIn.val($text);
  } else if (direction == 'up') {
    if (i > 0) {
      i--
      $target = $results.eq(i);
      $text = $target.text();
      $searchIn.val($text);
    } else {
      $target = $searchIn;
    }
  }
  $target.focus();
}

/* item gallery buttons -------------------------------------------------------------- */

var $imgGalleryMain   = $('#js-gallery-primary'),
    $imgGalleryFull   = $('#js-gallery-thumbs'),
    $imgGalleryThumb  = $imgGalleryFull.find('li');
    $imgGalleryModal  = $('#js-gallery-modal'),
    $imgGalleryOpen   = $imgGalleryMain.find('.item-main-zoom'),
    $imgGalleryClose  = $imgGalleryModal.find('.modal-close'),
    $imgGalleryPrev   = $('#js-gallery-prev'),
    $imgGalleryNext   = $('#js-gallery-next');
    $imgGalleryNum    = ($imgGalleryThumb.length) - 1;

// zoom and enhance
$imgGalleryOpen.click(function() {
  $getImgSrc = $imgGalleryMain.find('img').attr('src');
  $bigImgSrc = $getImgSrc.replace('gallery-tile','gallery');
  //console.log($getImgSrc);


  if ($imgGalleryModal.find('img').length) {

    $imgGalleryModal.addClass('is-active').find('img').attr('src',$bigImgSrc);
  } else {
    $bigImgNew = '<img src="' + $bigImgSrc + '" >';
    $imgGalleryModal.addClass('is-active').append($bigImgNew);
  }

});

$imgGalleryClose.click(function() {
  $imgGalleryModal.removeClass('is-active');
});

//"gallery switch"
// checks first to see if the tile sized image exists (likely wont), need to ajax call the php resize function
$imgGalleryThumb.click(function() {
  i = $(this).index();
  setMainImg(i);
});

function setMainImg(i) {
  $thumbImg = $imgGalleryThumb.eq(i).find('img');
  $getThumbSrc = $thumbImg.attr('src').replace('gallery-thumb', 'gallery').split('/').slice(-3).join('/');
  $fullThumbSrc = '../' + $getThumbSrc;
  $imgGalleryMain.addClass('loading');
  if ($thumbImg.data('tile') == 1) {
    $imgGalleryMain.removeClass('loading').find('img').attr('src', fileSrc.site + '/' + $getThumbSrc);
  } else {
    $.get(fileSrc.ajaxAdmin, {
      src: $fullThumbSrc,
      size: 'tile',
      action: "jr_resize"
    }, replaceMainImg);
    $thumbImg.data('tile', 1);
  }
}

function replaceMainImg(data) {
  var results = $.parseJSON(data);
  $newSrc = results.replace('../', fileSrc.site +'/');
  $imgGalleryMain.removeClass('loading').find('img').attr('src',$newSrc);
}

$imgGalleryPrev.click(function() {
  if ($imgGalleryNum == 0) {
    $imgGalleryNum = $imgGalleryThumb.length;
  }
  $imgGalleryNum--
  console.log($imgGalleryNum);
  setMainImg($imgGalleryNum);
})

$imgGalleryNext.click(function() {
  if ($imgGalleryNum == ($imgGalleryThumb.length) - 1) {
    $imgGalleryNum = -1;
  }
  $imgGalleryNum++
  console.log($imgGalleryNum);
  setMainImg($imgGalleryNum);
})

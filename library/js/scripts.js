/*! Jon Richards 2015 | GPL-2.0+ | http://www.gnu.org/licenses/gpl-2.0.txt
 * INCLUDES
 * Jquery Menu Aim | https://github.com/kamens/jQuery-menu-aim
 * Get Viewport Dimensions | http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript
!*/



angular.module('redHotChilli', [])

.controller('carouselCtrl', ['$interval', '$scope', function ($interval, $scope) {
  var slideNum = document.getElementById('js-carousel-main').children.length,
    carousel = $scope,
    n = 0;

  carousel.sl0 = 'is-active';

  carousel.go = function (index) {
    n = index;
    push();
  };

  return $interval(function () {
    if (!carousel.slidePause) {
      n = (n < slideNum - 1) ? n + 1 : 0;
      push();
    }
  }, 8000);

  function push() {
    for (i = 0; i < slideNum; i++) {
      carousel['sl' + i] = (carousel['sl' + i] == 'is-active') ? 'go-away' : '';
    }
    carousel['sl' + n] = 'is-active';
  }

}])

.directive('isSticky', function ($window) {
  return function (scope, element, attrs) {
    var _theMenuBar = document.getElementById('theMenu');
    console.log(_theMenuBar.getBoundingClientRect());
    $window.onscroll=function(e){
      if (_theMenuBar.getBoundingClientRect().top < 0) {
        //THROTTLE THIS
        scope.scrollCheck = true;
      }
      //need to put the placehold box in again
    }
  }

})


.service('throttle', function() {
  //https://dzone.com/articles/throttling-input-angularjs
  /*can set to :
    - throttle clicking carousel.
    - throttle scroller
    - throttle autocomplete
    */
})

/*.controller('searchCtrl', ['$scope', function($scope) {
  //placeholder for the search autocomplete
}])

.controller('menuCtrl', ['$scope', function($scope) {
//placeholder for meun aim
}])*/

/*----- jquery menu aim ---------------------------------------------------------------*/
/*region
https://github.com/kamens/jQuery-menu-aim.git
(minified)
*/
!function(e){function t(t){var n=e(this),i=null,o=[],u=null,r=null,c=e.extend({rowSelector:"> li",submenuSelector:"*",submenuDirection:"right",tolerance:75,enter:e.noop,exit:e.noop,activate:e.noop,deactivate:e.noop,exitMenu:e.noop},t),l=3,f=300,a=function(e){o.push({x:e.pageX,y:e.pageY}),o.length>l&&o.shift()},s=function(){r&&clearTimeout(r),c.exitMenu(this)&&(i&&c.deactivate(i),i=null)},h=function(){r&&clearTimeout(r),c.enter(this),v(this)},m=function(){c.exit(this)},x=function(){y(this)},y=function(e){e!=i&&(i&&c.deactivate(i),c.activate(e),i=e)},v=function(e){var t=p();t?r=setTimeout(function(){v(e)},t):y(e)},p=function(){function t(e,t){return(t.y-e.y)/(t.x-e.x)}if(!i||!e(i).is(c.submenuSelector))return 0;var r=n.offset(),l={x:r.left,y:r.top-c.tolerance},a={x:r.left+n.outerWidth(),y:l.y},s={x:r.left,y:r.top+n.outerHeight()+c.tolerance},h={x:r.left+n.outerWidth(),y:s.y},m=o[o.length-1],x=o[0];if(!m)return 0;if(x||(x=m),x.x<r.left||x.x>h.x||x.y<r.top||x.y>h.y)return 0;if(u&&m.x==u.x&&m.y==u.y)return 0;var y=a,v=h;"left"==c.submenuDirection?(y=s,v=l):"below"==c.submenuDirection?(y=h,v=s):"above"==c.submenuDirection&&(y=l,v=a);var p=t(m,y),b=t(m,v),d=t(x,y),g=t(x,v);return d>p&&b>g?(u=m,f):(u=null,0)};n.mouseleave(s).find(c.rowSelector).mouseenter(h).mouseleave(m).click(x),e(document).mousemove(a)}e.fn.menuAim=function(e){return this.each(function(){t.call(this,e)}),this}}(jQuery);

/* endregion */

/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y }
}

/*-- Header scroll --------------------------------------------------------------------

var stickyRight = document.getElementById('js-sticky-right'),
    stickyLeft = document.getElementById('js-sticky-left'),
    $stRight = $(stickyRight),
    $stLeft = $(stickyLeft),
    $fixedHeader = [$stRight,$stLeft],
    titlePos = findTop(stickyLeft),
    divFiller = '<div class="js-filler"></div>';

function throttle(fn, threshhold, scope) {
  threshhold || (threshhold = 250);
  var last,
      deferTimer;
  return function () {
    var context = scope || this;

    var now = +new Date,
        args = arguments;
    if (last && now < last + threshhold) {
      // hold on to it
      clearTimeout(deferTimer);
      deferTimer = setTimeout(function () {
        last = now;
        fn.apply(context, args);
      }, threshhold);
    } else {
      last = now;
      fn.apply(context, args);
    }
  };
}

window.onscroll = throttle(
  function () {
    //console.log(titlePos);
    scrollPos = window.scrollY;

    if (scrollPos > titlePos + 40) {
      setFixed($fixedHeader);
    } else {
      unsetFixed($fixedHeader);
    }
  }, 100);

function setFixed($objArray) {
  $objArray.forEach (function($obj) {
    if ($obj.data('fixed') == 0) {
      $objH = $obj.height();
      $objW = $obj.width();
      $obj.addClass('is-fixed').data('fixed', 1).after(divFiller).next('.js-filler').height($objH).width($objW);
    }
  });
}

function unsetFixed($objArray) {
  $objArray.forEach (function($obj) {
    if ($obj.data('fixed') == 1) {
      $obj.removeClass('is-fixed').data('fixed', 0).next('.js-filler').remove();
    }
  });
}

function findTop(obj) {
  var curtop = 0;
  if (obj.offsetParent) {
    do {
      curtop += obj.offsetTop;
    } while (obj = obj.offsetParent);
  }
  return curtop;
}
*/

/*-- main menu toggle -----------------------------------------------------------------*/
/*region */
var $menuToggle = $('#menu-toggle'),
    $navMain_ul = $('#js-main-list'),
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

$navMain_ul.mouseleave( function() {
  window.setTimeout(closeMainMenu,300);
})

function closeMainMenu() {
  //console.log($navMain_ul.prev());
  $menuToggle .attr('checked', false);
}


/*-- carousel scroller ----------------------------------------------------------------

//redone in jquery
var $carousel = $('#js-carousel-main'),
    $slide = $carousel.find('.slide'),
    $tabs = $('#js-carousel-blips > .blip');

var slideCount = $slide.length - 1,
    slideTime = 8000, // miliseconds
    hoverLock = false,
    timerLock = false,
    tickerInt = 0;

if ($carousel.length > 0) {
  var carouselTimer = window.setInterval(ticker, slideTime);
  $carousel.mouseover(function() {
    hoverLock = true;
  })
  $carousel.mouseout(function() {
    hoverLock = false;
    clearInterval(carouselTimer);
    carouselTimer = window.setInterval(ticker, slideTime);
  })
  $tabs.mouseover(function() {
    hoverLock = true;
  })
  $tabs.mouseout(function() {
    hoverLock = false;
    clearInterval(carouselTimer);
    carouselTimer = window.setInterval(ticker, slideTime);
  })
}

function ticker() {
  vp = updateViewportDimensions(); //the carousel is inactive on little screens.
  if (!hoverLock && !timerLock && vp.width >= 481) {
    tickerInt = (tickerInt == slideCount) ? 0 : tickerInt + 1;
    timerLock = true;
    slideActivate(tickerInt);
  }
}

$tabs.click(function() {
  if (timerLock == true) {
  }
  if (tickerInt != $(this).index() && !timerLock) {
    timerLock = true;
    tickerInt = $(this).index();
    slideActivate(tickerInt);
  }
});

function slideActivate(i) {
  $carousel.find('.go-away').removeClass('is-active').removeClass('go-away');
  $carousel.find('.is-active').addClass('go-away');
  $slide.eq(i).removeClass('go-away').addClass('is-active');
  $tabs.removeClass('active').eq(i).addClass('active');
  setTimeout(function () {
    timerLock = false;
  }, 600);
}
*/

/* js + ajax auto complete ------------------------------------------------------------*/
// takes categories + key brands.
/* region */
var MIN_LENGTH = 3;

var $searchForm = $("#js-form-complete").find(".form-search"),
    $searchIn = $searchForm.find(".search-in"),
    $searchOut = $searchForm.find(".search-out");


$searchIn.keyup(function () {
  vp = updateViewportDimensions();
  if ( vp.width >= 1030 ) {
    var keyword = $(this).val();
    if (keyword.length >= MIN_LENGTH) {
      $.get(fileSrc.admin, {
        keyword: keyword,
        action: "jr_autocomplete"
      }).done(searchToText);
    } else {
      $searchOut.html('');
    }
  }
});

function searchToText(data) {
  var results = $.parseJSON(data);
  $searchOut.html('');
  $(results).each(function (i) {
    if (i < 4) {
      var link = fileSrc.site + 'products/' + this.filter + '/' + this.url + '/';
      var extra = (this.filter == 'brand') ? '<span> - Brand</span>' : '<span> - Category</span>';
      var output = '<li><a href="' + link + '" >' + this.name + extra + '</a></li>';
      $searchOut.append(output);
    }
  })
};

//adds arrow movment to the options
$searchIn.on('keydown',function(e) {

  $results = $searchOut.find('li > a');
  if (e.keyCode == '40' && $results.length > 0) {
    e.preventDefault();
    searchTraverse('down', -1);
  }
});

$searchOut.on('keydown','li > a', function(e) {

  $focussed = $searchOut.find(':focus');
  if (e.keyCode == '40' && $focussed.length > 0) {
    e.preventDefault();
    $i = $(this).parent('li').index();
    searchTraverse('down', $i);
  } else if (e.keyCode == '38' && $focussed.length > 0) {
    e.preventDefault();
    $i = $(this).parent('li').index();

    searchTraverse('up', $i);
  }
});

function searchTraverse(direction, i) {
  $results = $searchOut.find('li > a');
  $resultCount = $results.length;
  if (direction == 'down' && i < $resultCount - 1) {
    i++
    $target = $results.eq(i);
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
  //console.log(i);
}
/* endregion */
/* item gallery buttons -------------------------------------------------------------- */

var $imgGalleryMain   = $('#js-gallery-primary'),
    $imgGalleryFull   = $('#js-gallery-thumbs'),
    $imgGalleryThumb  = $imgGalleryFull.find('li');
    $imgGalleryPrev   = $('#js-gallery-prev'),
    $imgGalleryNext   = $('#js-gallery-next');
    $imgGalleryNum    = ($imgGalleryThumb.length) - 1;

//"gallery switch"
// checks first to see if the tile sized image exists (possibly wont), need to ajax call the php resize function
$imgGalleryThumb.click(function() {
  i = $(this).index();
  setMainImg(i);
});

function setMainImg(i) {
  $thumbImg = $imgGalleryThumb.eq(i).find('img');
  $getThumbSrc = $thumbImg.attr('src').replace('gallery-thumb', 'gallery');
  //$relSrc = $getThumbSrc;

  $imgGalleryMain.addClass('loading');
  if ($thumbImg.data('tile') == 1) {
    $tileSrc = $getThumbSrc.replace('gallery', 'gallery-tile');
    $imgGalleryMain.removeClass('loading').find('img').attr('src', $tileSrc);
  } else {
    $.get(fileSrc.admin, {
      src: $getThumbSrc,
      size: 'tile',
      action: "jr_resize"
    }, replaceMainImg);
    $thumbImg.data('tile', 1);
  }
}

function replaceMainImg(data) {
  var results = $.parseJSON(data);
  $newSrc = results;
  $imgGalleryMain.removeClass('loading').find('img').attr('src',$newSrc);
}

$imgGalleryPrev.click(function() {
  if ($imgGalleryNum == 0) {
    $imgGalleryNum = $imgGalleryThumb.length;
  }
  $imgGalleryNum--
  //console.log($imgGalleryNum);
  setMainImg($imgGalleryNum);
})

$imgGalleryNext.click(function() {
  if ($imgGalleryNum == ($imgGalleryThumb.length) - 1) {
    $imgGalleryNum = -1;
  }
  $imgGalleryNum++
  //console.log($imgGalleryNum);
  setMainImg($imgGalleryNum);
})

/* modal popups ---------------------------------------------------------------------- */
// eg zoom and enhance
var $imgGalleryModal  = $('#js-gallery-modal'),
    $imgGalleryOpen   = $('#js-gallery-zoom'),
    $imgGalleryClose  = $imgGalleryModal.find('.modal-close');
    $buyModal         = $('#js-buy-modal'),
    $buyModalOpen     = $('#js-buy-btn'),
    $buyModalClose    = $buyModal.find('.modal-close'),
    $queryModal         = $('#js-query-modal'),
    $queryModalOpen     = $('#js-query-btn'),
    $queryModalClose    = $queryModal.find('.modal-close');

function modalOpen(e) {
  e.addClass('is-active')
}
function modalOpenSmall(e) {
  e.addClass('is-active-small');
}
function modalClose(e) {
  e.removeClass('is-active');
  e.removeClass('is-active-small');
}

$imgGalleryOpen.click(function() {
  $getImgSrc = $imgGalleryMain.find('img').attr('src');
  $bigImgSrc = $getImgSrc.replace('gallery-tile','gallery');

  if ($imgGalleryModal.find('img').length) {

    $imgGalleryModal.find('img').attr('src',$bigImgSrc);
  } else {
    $bigImgNew = '<img src="' + $bigImgSrc + '" >';
    $imgGalleryModal.append($bigImgNew);
  }
  modalOpen($imgGalleryModal);
});

$imgGalleryClose.click(function() {
  modalClose($imgGalleryModal);
});

$buyModalOpen.click(function() {
  modalOpenSmall($buyModal)
})
$queryModalOpen.click(function() {
  modalOpenSmall($queryModal)
})
$buyModalClose.click(function() {
  modalClose($buyModal);
});
$queryModalClose.click(function() {
  modalClose($queryModal);
});

/* forms ------------------------------------------------------------------------------*/

var $form = $('.js_contact_form'),
    $formInputsReq = $form.find('.req'),
    $formInputsOptional = $form.find(':not(.req)'),
    $formNextBtn = $form.find('.js_nextBtn'),
    $formBackBtn = $form.find('.js_backBtn'),
    $formBlips = $form.next('.form-progress').find('.progress-blip'),
    formErrorList = [];

//turns off validation only if JS is available, since the script is trying to deal with it
$form.attr('novalidate', '');

$form.submit(function (e) {
  formErrorList = [];
  $thisForm = $(this);
  $response = $thisForm.find('.response');

  e.preventDefault();
  $thisForm.find($formInputsReq).each(function () {
    $el = $(this);
    formValidate($el);
  });

  $response.removeClass('success').removeClass('error').empty();

  if (formErrorList.length == 0) {
    $response.addClass('loading');
    $.get(fileSrc.admin, {
      keyword: $thisForm.serialize(),
      action: "jr_formsubmit",
      url: window.location.href
    }).done(formAjaxReply($thisForm));
    //formAjaxReply('Form mailed successfully');
  } else {
    //console.log(formErrorList);
    $response.addClass('error').html('Please fill in required items')
  }
})

$formNextBtn.click(function(e) {
  $thisSubForm = $(this).closest('fieldset.subform-active');
  $subFormIndex = $thisSubForm.index();
  formErrorList = [];
  $response = $thisSubForm.find('.response');

  $thisSubForm.find($formInputsReq).each(function () {
    $el = $(this);
    formValidate($el);
  });

  $response.removeClass('success').removeClass('error').empty();

  if (formErrorList.length == 0) {
    $thisSubForm.removeClass('subform-active').next('fieldset').addClass('subform-active');
    $formBlips.eq($subFormIndex).addClass('active');
  } else {
    $response.addClass('error').html('Please fill in required items')
  }
});

$formBackBtn.click(function(e) {
  $thisSubForm = $(this).closest('fieldset.subform-active');
  $thisSubForm.removeClass('subform-active').prev('fieldset').addClass('subform-active');
  $subFormIndex = $thisSubForm.index();
  $formBlips.eq($subFormIndex - 1).removeClass('active');
});

$formInputsReq.change(function (e) {
  $el = $(this);
  formValidate($el);
});

$formInputsOptional.change(function(e) {
  $el = $(this);

  if ($el.val().length > 0) {
    $el.addClass('success');
  } else {
    $el.removeClass('success');
  }
})

function formValidate($el) {
  var value = $el.val(),
    name = $el.attr('name'),
    type = $el.attr('type'),
    validEmail = value.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/);
  var formError = "",
      formIndex = $formInputsReq.index($el);

  $el.removeClass('error').removeClass('success').next('span').empty();

  if (type == 'email' && !validEmail) {
    formError = 'Please enter a valid email address';
    $el.addClass('error')
  }
  if (value.length < 1) {
    formError = 'Your ' + name + ' is required';
  }
  if (formError.length > 0) {
    $el.addClass('error').next('span').text(formError);
    formErrorList.push(formError);
  } else {
    $el.addClass('success');
  }
}

function formAjaxReply(el) {

  return function(data) {
    var result = $.parseJSON(data);
    //$resultOutcome = (result.success) ? 'success' : 'error';
    console.log (el);

    if (result.success) {
      el.parents('.modal-frame').addClass('modal-finished');
      output = document.createElement('span');
      output.textContent = result.output;
      output.className = 'form-output success';
      el.empty().append(output);
    } else {
      el.find('.response').removeClass('loading').addClass('error').html(result.output);
    }
  }
}

/* --- item page tabs -----------------------------------------------------------------*/
$itemTabFrame = $('#js-tabs-frame');
$itemTabToggle = $itemTabFrame.find('.tab-toggle');
//$itemTabSection = $itemTabToggle.closest('section');

$itemTabToggle.click(function() {
  $(this).closest('section').toggleClass('active').siblings('section').removeClass('active');
})

/* copy paste specs -------------------------------------------------------------------*/
//copys the specs list into a pastable string of text, rather than the list
//mostly for internal use, perhaps others could use

$itemSpecsBox = $('#js-specs-list');
$itemSpecsBtn = $('#js-specs-copy');

$itemSpecsBtn.click(function() {
  replaceTxt()
  $itemSpecsBtn.remove();
})

function replaceTxt() {
  content = $itemSpecsBox.html().replace(/(<li>)|(\s\s+)|(<img.*alt=")|("><a.*<\/a>)/g,"");
  fix = content.replace(/<\/li>/g,'<br>');
  $itemSpecsBox.html(fix);
}

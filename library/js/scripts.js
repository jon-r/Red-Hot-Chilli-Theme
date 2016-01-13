/*! Jon Richards 2015 | GPL-2.0+ | http://www.gnu.org/licenses/gpl-2.0.txt
 * INCLUDES
 * Jquery Menu Aim | https://github.com/kamens/jQuery-menu-aim
 * Get Viewport Dimensions | http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript
!*/


var app = angular.module('redHotChilli', []);

/*angular TO DO:

  - menu aim
  - scrolling filler
  - main menu to stay open on index
  - using arrow keys in auto complete
  - modal popouts
  - gallery prev/next (with thumbs gen ajax)
  - contact form prev/next + validate/submit
  - tabbed item page (on small screens)

*/


/* -- controllers ---------------------------------------------------------------------*/

app.controller('masterCtrl', ['$scope', '$window', 'stickify', function($scope, $window, stickify) {
  $scope.scroller = {};
  $window.onscroll = function() {
    stickify($scope);
  };
}])

app.controller('carouselCtrl', ['$interval', '$scope', 'throttled', function ($interval, $scope, throttled) {
  var slideNum = document.getElementById('js-carousel-main').children.length,
    n = 0;

  function push() {
    return throttled(function () {
      for (i = 0; i < slideNum; i++) {
        $scope['sl' + i] = ($scope['sl' + i] === 'is-active') ? 'go-away' : '';
      }
      $scope['sl' + n] = 'is-active';
    }, 1000);
  }

  $scope.sl0 = 'is-active';

  $scope.go = function (index) {
    n = index;
    push();
  };

  return $interval(function () {
    if (!$scope.slidePause) {
      n = (n < slideNum - 1) ? n + 1 : 0;
      push();
    }
  }, 8000);

}]);

app.controller('searchCtrl', ['$scope', 'search', 'vp', 'traverse', function ($scope, search, vp, traverse) {
  var page = {}, searchContainer = document.getElementById('search-box');
  $scope.searchValue = '';
  $scope.results = {};
  $scope.focus = NaN;
  $scope.$watch('searchValue', function (input) {
    page = vp();
    if (input.length > 2 && page.w > 1030) {
      search(input).then(function (response) {
        $scope.results = response.data;
      }, function (err) {
        console.log(err)
      });
    } else {
      $scope.results = {};
      //console.log(screen);
    }
  })

  $scope.searchList = function(index,e) {
    var list = $scope.searchValue.length;
    if (list > 0) {
      console.log(angular.element(searchContainer).find("li").length);
      //traverse.set($scope.searchValue.length);
      if (e.keyCode == '40' && index < list) {
        e.preventDefault();
        traverse.down(index,$scope);
      } else if (e.keyCode == '38' && index > -1) {
        e.preventDefault();
        traverse.up(index,$scope);
      }
    }
  }


}]);

app.controller('menuCtrl', ['$scope', function ($scope) {
  //placeholder for meun aim
}]);


  /* -- services ------------------------------------------------------------------------*/

app.service('throttled', function ($timeout) {
  var wait = false;
  return function (fn, delay) {
    delay = typeof delay !== 'undefined' ? delay : 300;
    if (!wait) {
      fn.call();
      wait = true;
      $timeout(function () {
        wait = false;
      }, delay);
    }
  };
});

app.service('stickify', function (throttled) {
  var marker = document.getElementById('scrollLock'),
    check = false;
    return function (scope) {
      return throttled(function () {
        scope.scroller.fix = marker.getBoundingClientRect().top < 40;
      }, 50);
    }
});

app.service('search', function ($http) {
  return function (searchIn) {
    return $http({
      method: 'GET',
      url: fileSrc.admin,
      params: {
        keyword: searchIn,
        action: "jr_autocomplete"
      }
    })
  }
});

app.service('traverse', function() {
  var out = {
    down : function(index,scope) {
        scope.focus = index++
        console.log(scope);

    },
    up : function(index,scope) {

      scope.focus = index--
     // console.log('up from ' + index);
    }
  }
  return out;
})

/*
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
}*/

app.service('vp', function ($window) {
  var win = $window;
  return function() {
    return {
      h : win.innerHeight,
      w : win.innerWidth
    }
  }
});



/* -- directives ----------------------------------------------------------------------*/

/*app.directive('searchList', [function () {
    return function (scope, elem, attrs) {
        var atomSelector = attrs.searchFocus;

        elem.bind('keyup', function (e) {
            var atoms = elem.find(atomSelector),
                toAtom = null;
          console.log(atoms.length);
            for (var i = atoms.length - 1; i >= 0; i--) {
                if (atoms[i] === e.target) {
                    if (e.keyCode === 38) {
                        toAtom = atoms[i - 1];
                    } else if (e.keyCode === 40) {
                        toAtom = atoms[i + 1];
                    }
                    break;
                }
            }

            if (toAtom) toAtom.focus();

        });

        elem.bind('keydown', function (e) {
            if (e.keyCode === 38 || e.keyCode === 40)
                e.preventDefault();
        });

    };
  */

/*  return {
    restrict: 'A',
    link: function(scope, elem, attrs) {
      elem.bind('keyup', function (e) {
        // up arrow

        if (e.keyCode == 38) {
          console.log(scope);
     //       elem[0].previousElementSibling.focus();
        }
        // down arrow
        else if (e.keyCode == 40) {
     //       elem[0].nextElementSibling.focus();
        }
      });
    }
  };
}]);*/


if (window.jQuery) {
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

/*-- Header scroll --------------------------------------------------------------------*/

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
      var h = $obj.height(), w = $obj.width();
      $obj.addClass('is-fixed').data('fixed', 1).after(divFiller).next('.js-filler').height(h).width(w);
    }
  })
  if (isIndex) {
    closeMainMenu();
    moveMenu('in');
  }
}

function unsetFixed($objArray) {
  $objArray.forEach(function ($obj) {
    if ($obj.data('fixed') == 1) {
      $obj.removeClass('is-fixed').data('fixed', 0).next('.js-filler').remove();
    }
  });
  if (isIndex) {
    moveMenu('out');
  }
}

function moveMenu(direction) {
  var theMenu = document.getElementById('primary-menu'),
    theFrame = document.getElementById('js-sticky-left'),
    vp = updateViewportDimensions();

    if (direction == 'in') {
      theFrame.appendChild(theMenu);
    } else if (direction == 'out' && vp.width >= 481) {
      theFrame.parentElement.insertBefore(theMenu, theFrame.nextElementSibling);
    }

}

if (isIndex) {
  moveMenu('out');
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
//*/

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
  $menuToggle.attr('checked', false);
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
//copys the specs list into a pastable string of text, rather than the annoying list/table that exists currently
//mostly for internal use, perhaps others could use

$itemSpecsBox = $('#js-specs-list');
$itemSpecsBtn = $('#js-specs-copy');

$itemSpecsBtn.click(function() {
  fix = $itemSpecsBox.html().replace(/(<li>)|(\s\s+)|(<img.*alt=")|("><a.*<\/a>)/g,"").replace(/<\/li>/g,'<br>');
  el = document.createElement('p');
  el.className = "item-dimensions tile-inner";
  el.innerHTML = fix;
  $itemSpecsBox.after(el);
  $itemSpecsBox.remove();
  $itemSpecsBtn.remove();
})

/* homepage force open ---------------------------------------------------------------*/
//when doing angular REMEMBER the little bit on the header template

//feedback form - session storage??
}

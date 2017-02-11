/*! Jon Richards 2015 | GPL-2.0+ | http://www.gnu.org/licenses/gpl-2.0.txt
 * INCLUDES
 * Jquery Menu Aim | https://github.com/kamens/jQuery-menu-aim
 * Get Viewport Dimensions | http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript
!*/

window.addEventListener('load', (function ($, isIndex, fileSrc) {
  'use strict';

  /*----- jquery menu aim ---------------------------------------------------------------*/
  /*region
  https://github.com/kamens/jQuery-menu-aim.git
  (minified)
  */
//  !function(e){function t(t){var n=e(this),i=null,o=[],u=null,r=null,c=e.extend({rowSelector:"> li",submenuSelector:"*",submenuDirection:"right",tolerance:75,enter:e.noop,exit:e.noop,activate:e.noop,deactivate:e.noop,exitMenu:e.noop},t),l=3,f=300,a=function(e){o.push({x:e.pageX,y:e.pageY}),o.length>l&&o.shift()},s=function(){r&&clearTimeout(r),c.exitMenu(this)&&(i&&c.deactivate(i),i=null)},h=function(){r&&clearTimeout(r),c.enter(this),v(this)},m=function(){c.exit(this)},x=function(){y(this)},y=function(e){e!=i&&(i&&c.deactivate(i),c.activate(e),i=e)},v=function(e){var t=p();t?r=setTimeout(function(){v(e)},t):y(e)},p=function(){function t(e,t){return(t.y-e.y)/(t.x-e.x)}if(!i||!e(i).is(c.submenuSelector))return 0;var r=n.offset(),l={x:r.left,y:r.top-c.tolerance},a={x:r.left+n.outerWidth(),y:l.y},s={x:r.left,y:r.top+n.outerHeight()+c.tolerance},h={x:r.left+n.outerWidth(),y:s.y},m=o[o.length-1],x=o[0];if(!m)return 0;if(x||(x=m),x.x<r.left||x.x>h.x||x.y<r.top||x.y>h.y)return 0;if(u&&m.x==u.x&&m.y==u.y)return 0;var y=a,v=h;"left"==c.submenuDirection?(y=s,v=l):"below"==c.submenuDirection?(y=h,v=s):"above"==c.submenuDirection&&(y=l,v=a);var p=t(m,y),b=t(m,v),d=t(x,y),g=t(x,v);return d>p&&b>g?(u=m,f):(u=null,0)};n.mouseleave(s).find(c.rowSelector).mouseenter(h).mouseleave(m).click(x),e(document).mousemove(a)}e.fn.menuAim=function(e){return this.each(function(){t.call(this,e)}),this}}(jQuery);

  /* endregion */


  /*-- Tools --------------------------------------------------------------------*/
  /*
   * Get Viewport Dimensions
   * returns object with viewport dimensions to match css in width and height properties
   * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
  */
  function updateViewportDimensions() {
    var w = window,
      d = document,
      e = d.documentElement,
      g = d.getElementsByTagName('body')[0],
      x = w.innerWidth || e.clientWidth || g.clientWidth,
      y = w.innerHeight || e.clientHeight || g.clientHeight;
    return {
      width: x,
      height: y
    };
  }


  function throttle(fn, threshhold, scope) {
    threshhold || (threshhold = 250);
    var last,
      deferTimer;
    return function () {
      var context = scope || this,
        now = +new Date(),
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

  /*-- main menu toggle -----------------------------------------------------------------*/
  /*region */
  var $navMain_ul = $('#js-main-list'),
    $navMain_li = $navMain_ul.find('li'),
    bigScreen = false;


  function showSubMenu(row) {
    if (bigScreen) {
      $(row).addClass('active-li');
    }
  }

  function hideSubMenu(row) {
    $(row).removeClass('active-li');
  }


  function hideAllMenus() {
    bigScreen = false;
    $navMain_li = $navMain_ul.find('li').removeClass('active-li');
  }

  function closeMainMenu() {
    $('#menu-toggle').attr('checked', false);
  }


  //menu aim for large screen
  $navMain_ul.mouseenter(function () {
    var vp = updateViewportDimensions();
    if (vp.width >= 1030) {
      bigScreen = true;
      $navMain_ul.menuAim({
        activate: showSubMenu,
        deactivate: hideSubMenu,
        exitMenu: hideAllMenus
      });
    } else {
      bigScreen = false;
    }
  });

  //much simpler touch toggle for small screens
  $navMain_li.click(function () {
    $(this).toggleClass('active-li');
  });

  $navMain_ul.mouseleave(function () {
    window.setTimeout(closeMainMenu, 300);
  });


  /*-- Header scroll --------------------------------------------------------------------*/

  var stickyRight = document.getElementById('js-sticky-right'),
    stickyLeft = document.getElementById('js-sticky-left'),
    $fixedHeader = [$(stickyLeft), $(stickyRight)],
    divFiller = '<div class="js-filler"></div>';

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


  function setFixed($objArray) {
    $objArray.forEach(function ($obj) {
      if ($obj.data('fixed') === 0) {
        var h = $obj.height(), w = $obj.width();
        $obj.addClass('is-fixed').data('fixed', 1).after(divFiller).next('.js-filler').height(h).width(w);
      }
    });
    if (isIndex) {
      closeMainMenu();
      moveMenu('in');
    }
  }

  function unsetFixed($objArray) {
    $objArray.forEach(function ($obj) {
      if ($obj.data('fixed') === 1) {
        $obj.removeClass('is-fixed').data('fixed', 0).next('.js-filler').remove();
      }
    });
    if (isIndex) {
      moveMenu('out');
    }
  }

  window.onscroll = throttle(function () {

    if (stickyLeft.parentElement.getBoundingClientRect().top < 40) {
      setFixed($fixedHeader);
    } else {
      unsetFixed($fixedHeader);
    }
  }, 100);


  if (isIndex) {
    moveMenu('out');
  }






  /*-- carousel scroller ----------------------------------------------------------------*/

  //redone in jquery
  var $carousel = $('#js-carousel-main'),
    $slide = $carousel.find('.slide'),
    $tabs = $('#js-carousel-blips > .blip'),

    slideCount = $slide.length - 1,
    slideTime = 8000, // miliseconds
    hoverLock = false,
    timerLock = false,
    tickerInt = 0;

  function slideActivate(i) {
    $carousel.find('.go-away').removeClass('is-active').removeClass('go-away');
    $carousel.find('.is-active').addClass('go-away');
    $slide.eq(i).removeClass('go-away').addClass('is-active');
    $tabs.removeClass('active').eq(i).addClass('active');
    setTimeout(function () {
      timerLock = false;
    }, 600);
  }

  function ticker() {
    var vp = updateViewportDimensions(); //the carousel is inactive on little screens.
    if (!hoverLock && !timerLock && vp.width >= 481) {
      tickerInt = (tickerInt === slideCount) ? 0 : tickerInt + 1;
      timerLock = true;
      slideActivate(tickerInt);
    }
  }

  if ($carousel.length > 0) {
    var carouselTimer = window.setInterval(ticker, slideTime);
    $carousel.mouseover(function () {
      hoverLock = true;
    });
    $carousel.mouseout(function () {
      hoverLock = false;
      clearInterval(carouselTimer);
      carouselTimer = window.setInterval(ticker, slideTime);
    });
    $tabs.mouseover(function () {
      hoverLock = true;
    });
    $tabs.mouseout(function () {
      hoverLock = false;
      clearInterval(carouselTimer);
      carouselTimer = window.setInterval(ticker, slideTime);
    });
  }

  $tabs.click(function () {
    if (tickerInt !== $(this).index() && !timerLock) {
      timerLock = true;
      tickerInt = $(this).index();
      slideActivate(tickerInt);
    }
  });

  /* js + ajax auto complete ------------------------------------------------------------*/
  // takes categories + key brands.
  /* region */
  var MIN_LENGTH = 3,
    $searchForm = $("#js-form-complete").find(".form-search"),
    $searchIn = $searchForm.find(".search-in"),
    $searchOut = $searchForm.find(".search-out");

  function searchToText(data) {
    var results = $.parseJSON(data);
    $searchOut.html('');
    $(results).each(function (i) {
      if (i < 4) {
        var link = fileSrc.site + 'products/' + this.filter + '/' + this.url + '/',
          extra = (this.filter === 'brand') ? '<span> - Brand</span>' : '<span> - Category</span>',
          output = '<li><a href="' + link + '" >' + this.name + extra + '</a></li>';
        $searchOut.append(output);
      }
    });
  }


  function searchTraverse(direction, i) {
    var $results = $searchOut.find('li > a'),
      $resultCount = $results.length,
      $target = $searchIn;
    if (direction == 'down' && i < $resultCount - 1) {
      i++;
      $target = $results.eq(i);
      $searchIn.val($target.text());
    } else if (direction == 'up' && i > 0) {
      i--;
      $target = $results.eq(i);
      $searchIn.val($target.text());
    }
    $target.focus();
    //console.log(i);
  }


  $searchIn.keyup(function () {
    var vp = updateViewportDimensions();
    if (vp.width >= 1030) {
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

  //adds arrow movment to the options
  $searchIn.on('keydown', function (e) {

    var $results = $searchOut.find('li > a');

    if (e.keyCode == 40 && $results.length > 0) {


      e.preventDefault();
      searchTraverse('down', -1);
    }
  });

  $searchOut.on('keydown', 'li > a', function (e) {

    var $focussed = $searchOut.find(':focus'),
      i = 0;
    if (e.keyCode == 40 && $focussed.length > 0) {
      e.preventDefault();
      i = $(this).parent('li').index();
      searchTraverse('down', i);
    } else if (e.keyCode == 38 && $focussed.length > 0) {
      e.preventDefault();
      i = $(this).parent('li').index();

      searchTraverse('up', i);
    }
  });

  /* endregion */
  /* item gallery buttons -------------------------------------------------------------- */

  var $imgGalleryMain   = $('#js-gallery-primary'),
    $imgGalleryFull   = $('#js-gallery-thumbs'),
    $imgGalleryThumb  = $imgGalleryFull.find('.product-thumb'),
    $imgGalleryNum    = ($imgGalleryThumb.length) - 1;

  //"gallery switch"
  // checks first to see if the tile sized image exists (possibly wont), need to ajax call the php resize function

  function replaceMainImg(data) {
    var results = $.parseJSON(data);
    $imgGalleryMain.removeClass('loading').find('img').attr('src', results);
  }

  function setMainImg(i) {
    var $thumbImg = $imgGalleryThumb.eq(i).find('img'),
      $getThumbSrc = $thumbImg.attr('src').replace('gallery-thumb', 'gallery');
    //$relSrc = $getThumbSrc;

    $imgGalleryMain.addClass('loading');
    if ($thumbImg.data('tile') == 1) {
      var $tileSrc = $getThumbSrc.replace('gallery', 'gallery-tile');
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

  $('#js-gallery-prev').click(function () {
    if ($imgGalleryNum == 0) {
      $imgGalleryNum = $imgGalleryThumb.length;
    }
    $imgGalleryNum--;
    //console.log($imgGalleryNum);
    setMainImg($imgGalleryNum);
  });

  $('#js-gallery-next').click(function () {
    if ($imgGalleryNum == ($imgGalleryThumb.length) - 1) {
      $imgGalleryNum = -1;
    }
    $imgGalleryNum++;
    //console.log($imgGalleryNum);
    setMainImg($imgGalleryNum);
  });

  $imgGalleryThumb.click(function () {
    setMainImg($(this).index());
  });

  /* modal popups ---------------------------------------------------------------------- */
  // eg zoom and enhance
  var $imgGalleryModal  = $('#js-gallery-modal'),
    $buyModal         = $('#js-buy-modal'),
    $queryModal         = $('#js-query-modal');

  function modalOpen(e) {
    e.addClass('is-active');
  }
  function modalOpenSmall(e) {
    e.addClass('is-active-small');
  }
  function modalClose(e) {

    emptyImageModal();

    e.removeClass('is-active');
    e.removeClass('is-active-small');
  }

  function emptyImageModal() {
    $imgGalleryModal.find('img').remove();
    $imgGalleryModal.find('iframe').remove();
  }

  $('#js-gallery-zoom').click(function () {
    var $getImgSrc = $imgGalleryMain.find('img').attr('src').replace('gallery-tile', 'gallery');


    var newImg = document.createElement('img');
    newImg.src = $getImgSrc;

    $imgGalleryModal.append(newImg);

    modalOpen($imgGalleryModal);
  });

  $imgGalleryModal.find('.modal-close').click(function () {
    modalClose($imgGalleryModal);
  });

  $('#js-buy-btn').click(function () {
    modalOpenSmall($buyModal);
  });

  $buyModal.find('.modal-close').click(function () {
    modalClose($buyModal);
  });


  $('#js-query-btn').click(function () {
    modalOpenSmall($queryModal);
  });

  $queryModal.find('.modal-close').click(function () {
    modalClose($queryModal);
  });
  /* video modal-------------------------------------------------------------------------*/

  var $imgGalleryVideo  = $imgGalleryFull.find('.product-video');

  function setVideo(data) {
    $imgGalleryModal.append($.parseJSON(data));
  }

  $imgGalleryVideo.click(function (e) {
    var $getVideo = $(this).data('video');

    $.get(fileSrc.admin, {
      src: $getVideo,
      action: "jr_getVid"
    }, setVideo);

    modalOpen($imgGalleryModal);
  });



  /* forms ------------------------------------------------------------------------------*/

  var $form = $('.js_contact_form'),
    $formInputsReq = $form.find('.req'),
    $formInputsOptional = $form.find(':not(.req)'),
    $formNextBtn = $form.find('.js_nextBtn'),
    $formBackBtn = $form.find('.js_backBtn'),
    $formBlips = $form.next('.form-progress').find('.progress-blip'),
    formErrorList = [];

  function formValidate($el) {
    var value = $el.val(),
      name = $el.attr('name'),
      type = $el.attr('type'),
      validEmail = value.match(/.+@.+\..+/),
      formError = "",
      formIndex = $formInputsReq.index($el);

    $el.removeClass('error').removeClass('success').next('span').empty();

    if (type == 'email' && !validEmail) {
      formError = 'Please enter a valid email address';
      $el.addClass('error');
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

    return function (data) {
      var result = $.parseJSON(data);

      if (result.success) {
        el.parents('.modal-frame').addClass('modal-finished');
        var output = document.createElement('span');
        output.textContent = result.output;
        output.className = 'form-output success';
        el.empty().append(output);
      } else {
        el.find('.response').removeClass('loading').addClass('error').html(result.output);
      }
    };
  }

  //turns off validation only if JS is available, since the script is trying to deal with it
  $form.attr('novalidate', '');

  $form.submit(function (e) {
    e.preventDefault();

    var $thisForm = $(this),
      $response = $thisForm.find('.response');

    formErrorList = [];


    $thisForm.find($formInputsReq).each(function () {
      formValidate($(this));
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
      $response.addClass('error').html('Please fill in required items');
    }
  });

  $formNextBtn.click(function (e) {
    var $thisSubForm = $(this).closest('fieldset.subform-active'),
      $subFormIndex = $thisSubForm.index(),
      $response = $thisSubForm.find('.response');

    formErrorList = [];


    $thisSubForm.find($formInputsReq).each(function () {
      formValidate($(this));
    });

    $response.removeClass('success').removeClass('error').empty();

    if (formErrorList.length == 0) {
      $thisSubForm.removeClass('subform-active').next('fieldset').addClass('subform-active');
      $formBlips.eq($subFormIndex).addClass('active');
    } else {
      $response.addClass('error').html('Please fill in required items');
    }
  });

  $formBackBtn.click(function (e) {
    var $thisSubForm = $(this).closest('fieldset.subform-active'),
      $subFormIndex = $thisSubForm.index();

    $thisSubForm.removeClass('subform-active').prev('fieldset').addClass('subform-active');
    $formBlips.eq($subFormIndex - 1).removeClass('active');
  });

  $formInputsReq.change(function (e) {
    formValidate($(this));
  });

  $formInputsOptional.change(function (e) {
    var $el = $(this);

    if ($el.val().length > 0) {
      $el.addClass('success');
    } else {
      $el.removeClass('success');
    }
  });


  /* --- item page tabs -----------------------------------------------------------------*/
  var $itemTabToggle =  $('#js-tabs-frame').find('.tab-toggle'),
    $itemSpecsBox = $('#js-specs-list'),
    $itemSpecsBtn = $('#js-specs-copy');
  //$itemTabSection = $itemTabToggle.closest('section');

  $itemTabToggle.click(function() {
    $(this).closest('section').toggleClass('active').siblings('section').removeClass('active');
  })

  /* copy paste specs -------------------------------------------------------------------*/
  //copys the specs list into a pastable string of text, rather than the annoying list/table that exists currently
  //mostly for internal use, perhaps others could use


  $itemSpecsBtn.click(function() {
    var fix = $itemSpecsBox.html().replace(/(<li>)|(\s\s+)|(<img.*alt=")|("><a.*<\/a>)/g, "").replace(/<\/li>/g, '<br>'),
      el = document.createElement('p');
    el.className = "item-dimensions tile-inner";
    el.innerHTML = fix;
    $itemSpecsBox.after(el);
    $itemSpecsBox.remove();
    $itemSpecsBtn.remove();
  });

  /* homepage force open ---------------------------------------------------------------*/
  //when doing angular REMEMBER the little bit on the header template

  //feedback form - session storage??

})(jQuery, isIndex, fileSrc));

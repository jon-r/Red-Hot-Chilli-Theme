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
// setting the viewport width
var viewport = updateViewportDimensions();

/*-- main menu toggle -----------------------------------------------------------------*/
/*region */
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

/*endregion*/

/*-- carousel scroller ----------------------------------------------------------------*/

//redone in jquery
var $carousel = $('#js-carousel-main'),
    $slide = $carousel.find('.slide'),
    $tabs = $('#js-carousel-blips > .blip');

var slideCount = $slide.length - 1,
    slideTime = 8000,
    slideDelay = 1000,
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
  if (!hoverLock && !timerLock) {

    if (tickerInt == slideCount) {
      tickerInt = -1;
    }
    tickerInt++;
    timerLock = true;
    slideActivate(tickerInt);
  }
}

$tabs.click(function() {
  if (timerLock == true) {
    console.log('spam');
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
      $.get(fileSrc.ajaxAdmin, {
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
      var link = fileSrc.site + '/products/' + this.filter + '/' + this.url + '/';
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
  if (direction == 'down' && (i + 1) < $resultCount) {
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
  console.log(i);
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

/* modal popups ---------------------------------------------------------------------- */
// eg zoom and enhance
var $imgGalleryModal  = $('#js-gallery-modal'),
    $imgGalleryOpen   = $imgGalleryMain.find('.tile-hover.zoom'),
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

/* faq response -----------------------------------------------------------------------*/

var $queryModalInput = $("#js-question-in"),
    //$queryOptions = $queryModalInput;
    $queryModaloutput = $("#js-question-out");

$queryModalInput.change(function () {
  var question = $(this).find('option:selected').val();
  console.log(question);
  $queryModaloutput.addClass('loading');
  $.get(fileSrc.ajaxAdmin, {
    keyword: question,
    action: "jr_getAnswers"
  }).done(questionToText);
});

function questionToText(data) {
  var results = $.parseJSON(data);

  $queryModaloutput.removeClass('loading').html(results.answer).append(results.next);
};

/* email + validate -------------------------------------------------------------------*/
/*
 * validate.js 1.4.1
 * Copyright (c) 2011 - 2014 Rick Harrison, http://rickharrison.me
 * validate.js is open sourced under the MIT license.
 * Portions of validate.js are inspired by CodeIgniter.
 * http://rickharrison.github.com/validate.js
 */
/*region*/
(function(q,r,m){var s={required:"Your %s is required.",matches:"The %s field does not match the %s field.","default":"The %s field is still set to default, please change.",valid_email:"Please check your %s.",valid_emails:"The %s field must contain all valid email addresses.",min_length:"The %s field must be at least %s characters in length.",max_length:"The %s field must not exceed %s characters in length.",exact_length:"The %s field must be exactly %s characters in length.",
greater_than:"The %s field must contain a number greater than %s.",less_than:"The %s field must contain a number less than %s.",alpha:"The %s field must only contain alphabetical characters.",alpha_numeric:"Please check your %s.",alpha_dash:"Please check your %s.",numeric:"The %s field must contain only numbers.",integer:"The %s field must contain an integer.",decimal:"The %s field must contain a decimal number.",
is_natural:"The %s field must contain only positive numbers.",is_natural_no_zero:"The %s field must contain a number greater than zero.",valid_ip:"The %s field must contain a valid IP.",valid_base64:"The %s field must contain a base64 string.",valid_credit_card:"The %s field must contain a valid credit card number.",is_file_type:"The %s field must contain only %s files.",valid_url:"The %s field must contain a valid URL."},t=function(a){},u=/^(.+?)\[(.+)\]$/,h=/^[0-9]+$/,v=/^\-?[0-9]+$/,k=/^\-?[0-9]*\.?[0-9]+$/,
p=/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,w=/^[a-z]+$/i,x=/^[a-z0-9]+$/i,y=/^[a-z0-9_\-]+$/i,z=/^[0-9]+$/i,A=/^[1-9][0-9]*$/i,B=/^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){3}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})$/i,C=/[^a-zA-Z0-9\/\+=]/i,D=/^[\d\-\s]+$/,E=/^((http|https):\/\/(\w+:{0,1}\w*@)?(\S+)|)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?$/,f=function(a,b,c){this.callback=c||t;this.errors=[];this.fields=
{};this.form=this._formByNameOrNode(a)||{};this.messages={};this.handlers={};this.conditionals={};a=0;for(c=b.length;a<c;a++){var d=b[a];if((d.name||d.names)&&d.rules)if(d.names)for(var g=0,f=d.names.length;g<f;g++)this._addField(d,d.names[g]);else this._addField(d,d.name)}var e=this.form.onsubmit;this.form.onsubmit=function(a){return function(b){try{return a._validateForm(b)&&(e===m||e())}catch(c){}}}(this)},n=function(a,b){var c;if(0<a.length&&("radio"===a[0].type||"checkbox"===a[0].type))for(c=
0,elementLength=a.length;c<elementLength;c++){if(a[c].checked)return a[c][b]}else return a[b]};f.prototype.setMessage=function(a,b){this.messages[a]=b;return this};f.prototype.registerCallback=function(a,b){a&&"string"===typeof a&&b&&"function"===typeof b&&(this.handlers[a]=b);return this};f.prototype.registerConditional=function(a,b){a&&"string"===typeof a&&b&&"function"===typeof b&&(this.conditionals[a]=b);return this};f.prototype._formByNameOrNode=function(a){return"object"===typeof a?a:r.forms[a]};
f.prototype._addField=function(a,b){this.fields[b]={name:b,display:a.display||b,rules:a.rules,depends:a.depends,id:null,element:null,type:null,value:null,checked:null}};f.prototype._validateForm=function(a){this.errors=[];for(var b in this.fields)if(this.fields.hasOwnProperty(b)){var c=this.fields[b]||{},d=this.form[c.name];d&&d!==m&&(c.id=n(d,"id"),c.element=d,c.type=0<d.length?d[0].type:d.type,c.value=n(d,"value"),c.checked=n(d,"checked"),c.depends&&"function"===typeof c.depends?c.depends.call(this,
c)&&this._validateField(c):c.depends&&"string"===typeof c.depends&&this.conditionals[c.depends]?this.conditionals[c.depends].call(this,c)&&this._validateField(c):this._validateField(c))}"function"===typeof this.callback&&this.callback(this.errors,a);0<this.errors.length&&(a&&a.preventDefault?a.preventDefault():event&&(event.returnValue=!1));return!0};f.prototype._validateField=function(a){for(var b=a.rules.split("|"),c=a.rules.indexOf("required"),d=!a.value||""===a.value||a.value===m,g=0,f=b.length;g<
f;g++){var e=b[g],l=null,h=!1,k=u.exec(e);if(-1!==c||-1!==e.indexOf("!callback_")||!d)if(k&&(e=k[1],l=k[2]),"!"===e.charAt(0)&&(e=e.substring(1,e.length)),"function"===typeof this._hooks[e]?this._hooks[e].apply(this,[a,l])||(h=!0):"callback_"===e.substring(0,9)&&(e=e.substring(9,e.length),"function"===typeof this.handlers[e]&&!1===this.handlers[e].apply(this,[a.value,l,a])&&(h=!0)),h){b=this.messages[a.name+"."+e]||this.messages[e]||s[e];c="An error has occurred with the "+a.display+" field.";b&&
(c=b.replace("%s",a.display),l&&(c=c.replace("%s",this.fields[l]?this.fields[l].display:l)));this.errors.push({id:a.id,element:a.element,name:a.name,message:c,rule:e});break}}};f.prototype._hooks={required:function(a){var b=a.value;return"checkbox"===a.type||"radio"===a.type?!0===a.checked:null!==b&&""!==b},"default":function(a,b){return a.value!==b},matches:function(a,b){var c=this.form[b];return c?a.value===c.value:!1},valid_email:function(a){return p.test(a.value)},valid_emails:function(a){a=a.value.split(",");
for(var b=0,c=a.length;b<c;b++)if(!p.test(a[b]))return!1;return!0},min_length:function(a,b){return h.test(b)?a.value.length>=parseInt(b,10):!1},max_length:function(a,b){return h.test(b)?a.value.length<=parseInt(b,10):!1},exact_length:function(a,b){return h.test(b)?a.value.length===parseInt(b,10):!1},greater_than:function(a,b){return k.test(a.value)?parseFloat(a.value)>parseFloat(b):!1},less_than:function(a,b){return k.test(a.value)?parseFloat(a.value)<parseFloat(b):!1},alpha:function(a){return w.test(a.value)},
alpha_numeric:function(a){return x.test(a.value)},alpha_dash:function(a){return y.test(a.value)},numeric:function(a){return h.test(a.value)},integer:function(a){return v.test(a.value)},decimal:function(a){return k.test(a.value)},is_natural:function(a){return z.test(a.value)},is_natural_no_zero:function(a){return A.test(a.value)},valid_ip:function(a){return B.test(a.value)},valid_base64:function(a){return C.test(a.value)},valid_url:function(a){return E.test(a.value)},valid_credit_card:function(a){if(!D.test(a.value))return!1;
var b=0,c=0,d=!1;a=a.value.replace(/\D/g,"");for(var g=a.length-1;0<=g;g--)c=a.charAt(g),c=parseInt(c,10),d&&9<(c*=2)&&(c-=9),b+=c,d=!d;return 0===b%10},is_file_type:function(a,b){if("file"!==a.type)return!0;var c=a.value.substr(a.value.lastIndexOf(".")+1),d=b.split(","),g=!1,f=0,e=d.length;for(f;f<e;f++)c==d[f]&&(g=!0);return g}};q.FormValidator=f})(window,document);
/*endregion*/
var $form = $('.js_contact_form'),
    $formInputs = $form.find('.text-input');

var validator = new FormValidator(
  'contact_form', [{
    name: 'name',
    display: 'Name',
    rules: 'required'
  }, {
    name: 'email',
    display: 'Email',
    rules: 'required|valid_email'
  }, {
    name: 'tel',
    display: 'Phone Number',
    rules: 'required|alpha_dash'
  }, {
    name: 'postcode',
    display: 'Postcode',
    rules: 'required'
  }],
  function (errors, event) {
    jsValidatorError(errors);
  });

function jsValidatorError(errors) {
  var errorString = "";
  var errorLength = errors.length;
  if (errorLength > 0) {
    for (var i = 0; i < errorLength; i++) {
      errorString = errors[i].message;
      $form.find(errors[i].element).addClass('error').next('span').text(errorString);
    }
  } else {
    //errorString = "success";
  }

}

$form.select(function(e) {
  e.preventDefault();
  console.log('submittedAttempt');
});

$formInputs.change(function(e) {
  console.log(this);
  $(this).removeClass('error').next('span').empty();
})

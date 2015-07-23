/*
function = fA fB etc
var = v1
*/

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

function fA() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y }
}


/*-- main menu toggle -----------------------------------------------------------------*/
/*region */
var $v1 = $('#js-main-list'),
    $v2 = $v1.find('li'),
    v3 = false;
//menu aim for large screen
$v1.mouseenter( function() {
  vp = fA();
  if ( vp.width >= 1030 ) {
    v3 = true;
    $v1.menuAim({
      activate: fB,
      deactivate: fC,
      exitMenu: fD
    })
  } else {
    v3 = false;
  }
});

function fB(row) {
  if (v3) {
    $row = $(row);
    $row.addClass('active-li');
  }
}

function fC(row) {
  $row = $(row);
  $row.removeClass('active-li');
}

function fD() {
  v3 = false;
  $v2 = $v1.find('li').removeClass('active-li');
}

//much simpler touch toggle for small screens
$v2.click( function() {
  $(this).toggleClass('active-li')
});

/*endregion*/

/*-- carousel scroller ----------------------------------------------------------------*/

//redone in jquery
var $v4 = $('#js-carousel-main'),
    $v5 = $v4.find('.slide'),
    $v6 = $('#js-carousel-blips > .blip');

var $v7 = $v5.length - 1,
    $v8 = 8000,
    $v9 = false,
    $v10 = false,
    $v11 = 0;

if ($v4.length > 0) {
  timer = window.setInterval(fE, $v8);
  $v4.mouseover(function() {
    $v9 = true;
  })
  $v4.mouseout(function() {
    $v9 = false;
    clearInterval(timer);
    timer = window.setInterval(fE, $v8);
  })
  $v6.mouseover(function() {
    $v9 = true;
  })
  $v6.mouseout(function() {
    $v9 = false;
    clearInterval(timer);
    timer = window.setInterval(fE, $v8);
  })
}

function fE() {
  if (!$v9 && !$v10) {

    if ($v11 == $v7) {
      $v11 = -1;
    }
    $v11++;
    $v10 = true;
    fF($v11);
  }
}

$v6.click(function() {
  if ($v11 != $(this).index() && !$v10) {
    $v10 = true;
    $v11 = $(this).index();
    fF($v11);
  }
});

function fF(i) {
  $v4.find('.go-away').removeClass('is-active').removeClass('go-away');
  $v4.find('.is-active').addClass('go-away');
  $v5.eq(i).removeClass('go-away').addClass('is-active');
  $v6.removeClass('active').eq(i).addClass('active');
  setTimeout(function () {
    $v10 = false;
  }, 600);
}


/* js + ajax auto complete ------------------------------------------------------------*/
// takes categories + key brands.
/* region */

var $v12 = $("#js-form-complete").find(".form-search"),
    $v13 = $v12.find(".search-in"),
    $v14 = $v12.find(".search-out");


$v13.keyup(function () {
  vp = fA();
  if ( vp.width >= 1030 ) {
    keyword = $(this).val();
    if (keyword.length >= 3) {
      $.get(fileSrc.admin, {
        keyword: keyword,
        action: "jr_autocomplete"
      }).done(fG);
    } else {
      $v14.html('');
    }
  }
});

function fG(data) {
  results = $.parseJSON(data);
  $v14.html('');
  $(results).each(function (i) {
    if (i < 4) {
      link = fileSrc.site + '/products/' + this.filter + '/' + this.url + '/';
      extra = (this.filter == 'brand') ? '<span> - Brand</span>' : '<span> - Category</span>';
      output = '<li><a href="' + link + '" >' + this.name + extra + '</a></li>';
      $v14.append(output);
    }
  })
};

//adds arrow movment to the options
$v13.on('keydown',function(e) {

  $results = $v14.find('li > a');
  if (e.keyCode == '40' && $results.length > 0) {
    e.preventDefault();
    fH('d', -1);
  }
});

$v14.on('keydown','li > a', function(e) {

  $focussed = $v14.find(':focus');
  if (e.keyCode == '40' && $focussed.length > 0) {
    e.preventDefault();
    $i = $(this).parent('li').index();
    fH('d', $i);
  } else if (e.keyCode == '38' && $focussed.length > 0) {
    e.preventDefault();
    $i = $(this).parent('li').index();

    fH('u', $i);
  }
});

function fH(direction, i) {
  $results = $v14.find('li > a');
  $resultCount = $results.length;
  if (direction == 'd' && (i + 1) < $resultCount) {
    i++
    $target = $results.eq(i);
    $text = $target.text();
    $v13.val($text);
  } else if (direction == 'u') {
    if (i > 0) {
      i--
      $target = $results.eq(i);
      $text = $target.text();
      $v13.val($text);
    } else {
      $target = $v13;
    }
  }
  $target.focus();
  console.log(i);
}
/* endregion */
/* item gallery buttons -------------------------------------------------------------- */

var $v15   = $('#js-gallery-primary'),
    $v16  = $('#js-gallery-thumbs').find('li'),
    $v17   = $('#js-gallery-prev'),
    $v18   = $('#js-gallery-next'),
    $v19    = ($v16.length) - 1;

//"gallery switch"
// checks first to see if the tile sized image exists (possibly wont), need to ajax call the php resize function
$v16.click(function() {
  i = $(this).index();
  fI(i);
});

function fI(i) {
  $thumbImg = $v16.eq(i).find('img');
  $getThumbSrc = $thumbImg.attr('src').replace('gallery-thumb', 'gallery').split('/').slice(-3).join('/');
  $fullThumbSrc = '../' + $getThumbSrc;
  $v15.addClass('loading');
  if ($thumbImg.data('tile') == 1) {
    $v15.removeClass('loading').find('img').attr('src', fileSrc.site + '/' + $getThumbSrc);
  } else {
    $.get(fileSrc.admin, {
      src: $fullThumbSrc,
      size: 'tile',
      action: "jr_resize"
    }, fJ);
    $thumbImg.data('tile', 1);
  }
}

function fJ(data) {
  results = $.parseJSON(data);
  $newSrc = results.replace('../', fileSrc.site +'/');
  $v15.removeClass('loading').find('img').attr('src',$newSrc);
}

$v17.click(function() {
  if ($v19 == 0) {
    $v19 = $v16.length;
  }
  $v19--
  fI($v19);
})

$v18.click(function() {
  if ($v19 == ($v16.length) - 1) {
    $v19 = -1;
  }
  $v19++
  fI($v19);
})

/* modal popups ---------------------------------------------------------------------- */
// eg zoom and enhance
var $v20  = $('#js-gallery-modal'),
    $v21   = $v15.find('.tile-hover.zoom'),
    $v22  = $v20.find('.modal-close');
    $v22         = $('#js-buy-modal'),
    $v23     = $('#js-buy-btn'),
    $v24    = $v22.find('.modal-close'),
    $v25         = $('#js-query-modal'),
    $v26     = $('#js-query-btn'),
    $v27    = $v25.find('.modal-close');

function fK(e) {
  e.addClass('is-active')
}
function fL(e) {
  e.addClass('is-active-small');
}
function fM(e) {
  e.removeClass('is-active').removeClass('is-active-small');
}

$v21.click(function() {
  $getImgSrc = $v15.find('img').attr('src');
  $bigImgSrc = $getImgSrc.replace('gallery-tile','gallery');

  if ($v20.find('img').length) {

    $v20.find('img').attr('src',$bigImgSrc);
  } else {
    $bigImgNew = '<img src="' + $bigImgSrc + '" >';
    $v20.append($bigImgNew);
  }
  fK($v20);
});

$v22.click(function() {
  fM($v20);
});

$v23.click(function() {
  fL($v22)
})
$v26.click(function() {
  fL($v25)
})
$v24.click(function() {
  fM($v22);
});
$v27.click(function() {
  fM($v25);
});

/* faq response -----------------------------------------------------------------------*/

var $v28 = $("#js-question-in").find('option'),
    $v29 = $("#js-question-out");

$v28.click(function () {
  question = $(this).val();
  $v29.addClass('loading');
  $.get(fileSrc.admin, {
    keyword: question,
    action: "jr_getAnswers"
  }).done(fN);
});

function fN(data) {
  results = $.parseJSON(data);

  $v29.removeClass('loading').html(results.answer).next('button').html(results.next);
};

/* forms ------------------------------------------------------------------------------*/

var $v30 = $('.js_contact_form'),
    $v31 = $v30.find('input.req'),
    $v32 = $v30.find('input:not(.req)'),
    $v33 = $v30.find('.js_nextBtn'),
    $v34 = $v30.find('.js_backBtn'),
    v35 = [];

//turns off validation only if JS is available, since the script is trying to deal with it
$v30.attr('novalidate', '');

$v30.submit(function (e) {
  v35 = [];
  $thisForm = $(this);
  $response = $thisForm.find('.response');

  e.preventDefault();
  $thisForm.find($v31).each(function () {
    $el = $(this);
    fO($el);
  });

  $response.removeClass('success').removeClass('error').empty();

  if (formErrorList.length == 0) {
    $response.addClass('loading');
    $.get(fileSrc.admin, {
      keyword: $thisForm.serialize(),
      action: "jr_formsubmit",
      url: window.location.href
    }).done(fP);
  } else {
    //console.log(formErrorList);
    $response.addClass('error').html('Please fill in required items')
  }
})

$v33.click(function(e) {
  $thisSubForm = $(this).parent('p.subform-active');
  v35= [];
  $response = $thisSubForm.find('.response');

  $thisSubForm.find($v31).each(function () {
    $el = $(this);
    fO($el);
  });

  $response.removeClass('success').removeClass('error').empty();
  console.log('click')

  if (formErrorList.length == 0) {
    $thisSubForm.removeClass('subform-active').next('p').addClass('subform-active');
  } else {
    //console.log(formErrorList);
    $response.addClass('error').html('Please fill in required items')
  }
});

$v34.click(function(e) {
  $(this).parent('p.subform-active').removeClass('subform-active').prev('p').addClass('subform-active');
});

$v31.change(function (e) {
  $el = $(this);
  fO($el);
});

$v32.change(function(e) {
  $el = $(this);

  if ($el.val().length > 0) {
    $el.addClass('success');
  } else {
    $el.removeClass('success');
  }
})

function fO($el) {
  value = $el.val();
  name = $el.attr('name');
  type = $el.attr('type');
  validEmail = value.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/);
  formError = "";
  formIndex = $v31.index($el);

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

function fP(data) {
  result = $.parseJSON(data);
  $resultOutcome = (result == "Form mailed successfully") ? 'success' : 'error';
  $v30.find('.response').removeClass('loading').addClass($resultOutcome).html(result);
}


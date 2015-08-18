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

function f01() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y }
}


/*-- main menu toggle -----------------------------------------------------------------*/
/*region */
var v01 = $('#js-main-list'),
    v02 = v01.find('li'),
    v03 = false,
    v04 = f01();
//menu aim for large screen
v01.mouseenter( function() {
  v04 = f01();
  if ( v04.width >= 1030 ) {
    v03 = true;
    v01.menuAim({
      activate: f02,
      deactivate: f03,
      exitMenu: f04
    })
  } else {
    v03 = false;
  }
});

function f02(r) {
  if (v03) {
    $(r).addClass('active-li');
  }
}

function f03(r) {
  $(r).removeClass('active-li');
}

function f04() {
  v03 = false;
  v02.removeClass('active-li');
}

//much simpler touch toggle for small screens
v02.click( function() {
  $(this).toggleClass('active-li')
});

/*endregion*/

/*-- carousel scroller ----------------------------------------------------------------*/

//redone in jquery
var v05 = $('#js-carousel-main'),
    v06 = v05.find('.slide'),
    v07 = $('#js-carousel-blips > .blip'),
    v08 = v06.length - 1,
    v09 = 8000,
    v10 = false,
    v11 = false,
    v12 = 0;

if (v05.length > 0) {
  var v13 = window.setInterval(f05, v09);
  v05.mouseover(function() {
    v10 = true;
  })
  v05.mouseout(function() {
    v10 = false;
    clearInterval(v13);
    v13 = window.setInterval(f05, v09);
  })
  v07.mouseover(function() {
    v10 = true;
  })
  v07.mouseout(function() {
    v10 = false;
    clearInterval(v13);
    v13 = window.setInterval(f05, v09);
  })
}

function f05() {
  if (!v10 && !v11) {
    v12 =  (v12 == v08) ? 0 : v12++;
    v11 = true;
    f06(v12);
  }
}

v07.click(function() {
  if (v12 != $(this).index() && !v11) {
    v11 = true;
    v12 = $(this).index();
    f06(v12);
  }
});

function f06(i) {
  v05.find('.go-away').removeClass('is-active').removeClass('go-away');
  v05.find('.is-active').addClass('go-away');
  v06.eq(i).removeClass('go-away').addClass('is-active');
  v07.removeClass('active').eq(i).addClass('active');
  setTimeout(function () {
    v11 = false;
  }, 600);
}


/* js + ajax auto complete ------------------------------------------------------------*/
// takes categories + key brands.
/* region */
var v13 = $("#js-form-complete").find(".form-search"),
    v14 = v13.find(".search-in"),
    v15 = v13.find(".search-out");

v14.keyup(function () {
  v04 = f01();
  if ( v04.width >= 1030 ) {
    var v16 = $(this).val();
    if (v16.length >= 3) {
      $.get(fileSrc.admin, {
        keyword: v16,
        action: "jr_autocomplete"
      }).done(f07);
    } else {
      v15.html('');
    }
  }
});

function f07(d) {
  var r = $.parseJSON(d);
  v15.html('');
  $(r).each(function (i) {
    if (i < 4) {
      var e = (this.filter == 'brand') ? '<span> - Brand</span>' : '<span> - Category</span>';
      var o = '<li><a href="' + fileSrc.site + '/products/' + this.filter + '/' + this.url + '/' + '" >' + this.name + e + '</a></li>';
      v15.append(o);
    }
  })
};

//adds arrow movment to the options
v14.on('keydown',function(e) {
  r = v15.find('li > a');
  if (e.keyCode == '40' && r.length > 0) {
    e.preventDefault();
    f08('d', -1);
  }
});

v15.on('keydown','li > a', function(e) {

  f = v15.find(':focus');
  if (e.keyCode == '40' && f.length > 0) {
    e.preventDefault();
    $i = $(this).parent('li').index();
    f08('d', $i);
  } else if (e.keyCode == '38' && f.length > 0) {
    e.preventDefault();
    $i = $(this).parent('li').index();

    f08('u', $i);
  }
});

function f08(d, i) {
  r = v15.find('li > a');
  rC = r.length;
  if (d == 'd' && (i + 1) < rC) {
    i++
    t = r.eq(i);
    tx = t.text();
    v14.val(tx);
  } else if (d == 'u') {
    if (i > 0) {
      i--
      t = r.eq(i);
      tx = t.text();
      v14.val(tx);
    } else {
      t = v14;
    }
  }
  t.focus();
}
/* endregion */
/* item gallery buttons -------------------------------------------------------------- */

var v16   = $('#js-gallery-primary'),
    v17   = $('#js-gallery-thumbs'),
    v18  = v17.find('li'),
    v19   = $('#js-gallery-prev'),
    v20   = $('#js-gallery-next'),
    v21    = (v18.length) - 1;

//"gallery switch"
// checks first to see if the tile sized image exists (possibly wont), need to ajax call the php resize function
v18.click(function() {
  i = $(this).index();
  f09(i);
});

function f09(i) {
  t = v18.eq(i).find('img');
  s = t.attr('src').replace('gallery-thumb', 'gallery').split('/').slice(-3).join('/');
  f = '../' + s;
  v16.addClass('loading');
  if (t.data('tile') == 1) {
    v16.removeClass('loading').find('img').attr('src', fileSrc.site + '/' + s);
  } else {
    $.get(fileSrc.admin, {
      src: f,
      size: 'tile',
      action: "jr_resize"
    }, f10);
    t.data('tile', 1);
  }
}

function f10(d) {
  var r = $.parseJSON(d);
  n = r.replace('../', fileSrc.site +'/');
  v16.removeClass('loading').find('img').attr('src',n);
}

v19.click(function() {
  if (v21 == 0) {
    v21 = v18.length;
  }
  v21--
  f09(v21);
})

v20.click(function() {
  if (v21 == (v18.length) - 1) {
    v21 = -1;
  }
  v21++
  f09(v21);
})

/* modal popups ---------------------------------------------------------------------- */
// eg zoom and enhance
var v22 = $('#js-gallery-modal'),
    v23 = v16.find('.tile-hover.zoom'),
    v24 = v22.find('.modal-close');
    v25 = $('#js-buy-modal'),
    v26     = $('#js-buy-btn'),
    v27    = v25.find('.modal-close'),
    v28         = $('#js-query-modal'),
    v29     = $('#js-query-btn'),
    v30    = v28.find('.modal-close');


function f11(e) {
  e.addClass('is-active-small');
}
function f12(e) {
  e.removeClass('is-active');
  e.removeClass('is-active-small');
}

v23.click(function() {
  i = v16.find('img').attr('src');
  b = i.replace('gallery-tile','gallery');

  if (v22.find('img').length) {

    v22.find('img').attr('src',b);
  } else {
    bN = '<img class="framed" src="' + b + '" >';
    v22.append(bN);
  }
  v22.addClass('is-active');
});

v24.click(function() {
  f12(v22);
});
v26.click(function() {
  f11(v25)
})
v29.click(function() {
  f11(v28)
})
v27.click(function() {
  f12(v25);
});
v30.click(function() {
  f12(v28);
});

/* faq response -----------------------------------------------------------------------*/

var v31 = $("#js-question-in").find('option'),
    v32 = $("#js-question-out");

v31.click(function () {
  var q = $(this).val();
  v32.addClass('loading');
  $.get(fileSrc.admin, {
    keyword: q,
    action: "jr_getAnswers"
  }).done(f13);
});

function f13(d) {
  var r = $.parseJSON(d);
  v32.removeClass('loading').html(r.answer).next('button').html(r.next);
};

/* forms ------------------------------------------------------------------------------*/

var v33 = $('.js_contact_form'),
    v34 = v33.find('input.req'),
    v35 = v33.find('input:not(.req)'),
    v36 = v33.find('.js_nextBtn'),
    v37 = v33.find('.js_backBtn'),
    v38 = [];

//turns off validation only if JS is available, since the script is trying to deal with it
v33.attr('novalidate', '');

v33.submit(function (e) {
  v38 = [];
  v39 = $(this);
  v40 = v39.find('.response');

  e.preventDefault();
  v39.find(v34).each(function () {
    $el = $(this);
    f14($el);
  });

  v40.removeClass('success').removeClass('error').empty();

  if (v38.length == 0) {
    v40.addClass('loading');
    $.get(fileSrc.admin, {
      keyword: v39.serialize(),
      action: "jr_formsubmit",
      url: window.location.href
    }).done(f15);
  } else {
    //console.log(v38);
    v40.addClass('error').html('Please fill in required items')
  }
})

v36.click(function(e) {
  v41 = $(this).parent('p.subform-active');
  v38 = [];
  v40 = v41.find('.response');

  v41.find(v34).each(function () {
    $el = $(this);
    f14($el);
  });

  v40.removeClass('success').removeClass('error').empty();
  console.log('click')

  if (v38.length == 0) {
    v41.removeClass('subform-active').next('p').addClass('subform-active');
  } else {
    //console.log(v38);
    v40.addClass('error').html('Please fill in required items')
  }
});

v37.click(function(e) {
  $(this).parent('p.subform-active').removeClass('subform-active').prev('p').addClass('subform-active');
});

v34.change(function (e) {
  $el = $(this);
  f14($el);
});

v35.change(function(e) {
  $el = $(this);

  if ($el.val().length > 0) {
    $el.addClass('success');
  } else {
    $el.removeClass('success');
  }
})

function f14($el) {
  var v42 = $el.val(),
      v43 = $el.attr('name'),
      v44 = $el.attr('type'),
      v45 = v42.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/),
      v46 = "";

  $el.removeClass('error').removeClass('success').next('span').empty();

  if (v44 == 'email' && !v45) {
    v46 = 'Please enter a valid email address';
    $el.addClass('error')
  }
  if (v42.length < 1) {
    v46 = 'Your ' + v43 + ' is required';
  }
  if (v46.length > 0) {
    $el.addClass('error').next('span').text(v46);
    v38.push(v46);
  } else {
    $el.addClass('success');
  }
}

function f15(d) {
  var r = $.parseJSON(d);
  o = (r == "Form mailed successfully") ? 'success' : 'error';
  v33.find('.response').removeClass('loading').addClass(o).html(r);
}





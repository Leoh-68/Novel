/* Validation form */

// validateForm('validation-contact');

// validateForm('validation-cart');

// validateForm('validation-user');



/* Lazys */

NN_FRAMEWORK.Lazys = function () {

	if (isExist($('.lazy'))) {

		var lazyLoadInstance = new LazyLoad({

			elements_selector: '.lazy'

		});

	}

};



/* Load name input file */

NN_FRAMEWORK.loadNameInputFile = function () {

	if (isExist($('.custom-file input[type=file]'))) {

		$('body').on('change', '.custom-file input[type=file]', function () {

			var fileName = $(this).val();

			fileName = fileName.substr(fileName.lastIndexOf('\\') + 1, fileName.length);

			$(this).siblings('label').html(fileName);

		});

	}

};



/* Back to top */

NN_FRAMEWORK.GoTop = function () {

	$(window).scroll(function () {

		if (!$('.scrollToTop').length)

			$('body').append('<div class="scrollToTop"><img src="' + GOTOP + '" alt="Go Top"/></div>');

		if ($(this).scrollTop() > 100) $('.scrollToTop').fadeIn();

		else $('.scrollToTop').fadeOut();

	});



	$('body').on('click', '.scrollToTop', function () {

		$('html, body').animate({ scrollTop: 0 }, 800);

		return false;

	});

};



/* Alt images */

NN_FRAMEWORK.AltImg = function () {

	$('img').each(function (index, element) {

		if (!$(this).attr('alt') || $(this).attr('alt') == '') {

			$(this).attr('alt', WEBSITE_NAME);

		}

	});

};



/* Menu */

NN_FRAMEWORK.Menu = function () {

	/* Menu remove empty ul */

	if (isExist($('.menu'))) {

		$('.menu ul li a').each(function () {

			$this = $(this);



			if (!isExist($this.next('ul').find('li'))) {

				$this.next('ul').remove();

				$this.removeClass('has-child');

			}

		});

	}



	/* Menu fixed */

	// $(window).scroll(function () {

	// 	var cach_top = $(window).scrollTop();

	// 	var heaigt_header = $('.heade').height() + $('.w-menu').height();



	// 	if (cach_top >= heaigt_header) {

	// 		if (!$('.w-menu').hasClass('fix_head animate__animated animate__fadeIn')) {

	// 			$('.w-menu').addClass('fix_head animate__animated animate__fadeIn');

	// 		}

	// 	} else {

	// 		$('.w-menu').removeClass('fix_head animate__animated animate__fadeIn');

	// 	}

	// });

	if ($(window).width() <= 1000) {

		$(".header").remove();

	}

	/* Menu fixed */

	// if (isExist($(".header"))) {

	// 	$(window).scroll(function () {

	// 		if ($(window).width() > 991) {

	// 			if ($(window).scrollTop() >= $(".header").height()) {

	// 				$(".wrap-menu").addClass("fixed animate__fadeInDown animate__animated");

	// 				$(".header").addClass("hidden-menu");

	// 				$(".header").css({ "margin-bottom": $(".wrap-menu").height() });

	// 				if (isExist($(".ul-product"))) {

	// 					$(".ul-product").removeClass("ul-spec");

	// 				}

	// 			} else {

	// 				$(".wrap-menu").removeClass(

	// 					"fixed animate__fadeInDown animate__animated"

	// 				);

	// 				$(".header").css({ "margin-bottom": "" });

	// 				if (isExist($(".wrap-home"))) {

	// 					$(".header").removeClass("hidden-menu");

	// 				}

	// 				if (isExist($(".ul-product"))) {

	// 					$(".ul-product").addClass("ul-spec");

	// 				}

	// 			}

	// 		} else {

	// 			if ($(window).scrollTop() >= $(".header").height()) {

	// 				$(".menu-res").addClass(

	// 					"fixed animate__fadeInDown animate__animated"

	// 				);

	// 				// $(".header").css({ "margin-bottom": $(".menu-res").height() });

	// 			} else {

	// 				$(".menu-res").removeClass(

	// 					"fixed animate__fadeInDown animate__animated"

	// 				);

	// 				// $(".header").css({ "margin-bottom": "" });

	// 			}

	// 		}

	// 	});

	// }

	if (isExist($('.ul-product'))) {

		$height = $('.ul-product').height() + 2;

		$('.fakeMenu').css({ height: $height });

	}



	/* Mmenu */

	if (isExist($('nav#menu'))) {

		$('nav#menu').mmenu({

			extensions: ['border-full', 'position-left', 'position-front']

		});

	}

};



/* Tools */

NN_FRAMEWORK.Tools = function () {

	if (isExist($('.toolbar'))) {

		$('.footer').css({ marginBottom: $('.toolbar').innerHeight() });

	}

};



/* Popup */

NN_FRAMEWORK.Popup = function () {

	if (isExist($('#popup'))) {

		validateForm('validation-popup');

		$('#popup').modal('show');

	}

};



/* Wow */

NN_FRAMEWORK.Wows = function () {

	new WOW().init();

};



/* Photobox */

NN_FRAMEWORK.Photobox = function () {

	if (isExist($('.album-gallery'))) {

		$('.album-gallery').photobox('a', { thumbs: true, loop: false });

	}

};



/* DatePicker */

NN_FRAMEWORK.DatePicker = function () {

	if (isExist($('#birthday'))) {

		$('#birthday').datetimepicker({

			timepicker: false,

			format: 'd/m/Y',

			formatDate: 'd/m/Y',

			minDate: '01/01/1950',

			maxDate: TIMENOW

		});

	}

};



/* Search */

NN_FRAMEWORK.Search = function () {

	if (isExist($('.icon-search'))) {

		$('.icon-search').click(function () {

			if ($(this).hasClass('active')) {

				$(this).removeClass('active');

				$('.search-grid').stop(true, true).animate({ opacity: '0', width: '0px' }, 200);

			} else {

				$(this).addClass('active');

				$('.search-grid').stop(true, true).animate({ opacity: '1', width: '230px' }, 200);

			}

			document.getElementById($(this).next().find('input').attr('id')).focus();

			$('.icon-search i').toggleClass('bi bi-x-lg');

		});

	}



	if (isExist($('.search-auto'))) {

		$('.show-search').hide();

		$('.search-auto').keyup(function () {

			$keyword = $(this).val();

			if ($keyword.length >= 2) {

				$.get('tim-kiem-goi-y?keyword=' + $keyword, function (data) {

					if (data) {

						$('.show-search').show();

						$('.show-search').html(data);

					}

				});

			}

		});

	}

};



/* Videos */

NN_FRAMEWORK.Videos = function () {

	Fancybox.bind('[data-fancybox]', {});

};



/* Owl Data */

NN_FRAMEWORK.OwlData = function (obj) {

	if (!isExist(obj)) return false;

	var items = obj.attr('data-items');

	var rewind = Number(obj.attr('data-rewind')) ? true : false;

	var autoplay = Number(obj.attr('data-autoplay')) ? true : false;

	var loop = Number(obj.attr('data-loop')) ? true : false;

	var lazyLoad = Number(obj.attr('data-lazyload')) ? true : false;

	var mouseDrag = Number(obj.attr('data-mousedrag')) ? true : false;

	var touchDrag = Number(obj.attr('data-touchdrag')) ? true : false;

	var animations = obj.attr('data-animations') || false;

	var smartSpeed = Number(obj.attr('data-smartspeed')) || 800;

	var autoplaySpeed = Number(obj.attr('data-autoplayspeed')) || 800;

	var autoplayTimeout = Number(obj.attr('data-autoplaytimeout')) || 5000;

	var dots = Number(obj.attr('data-dots')) ? true : false;

	var responsive = {};

	var responsiveClass = true;

	var responsiveRefreshRate = 200;

	var nav = Number(obj.attr('data-nav')) ? true : false;

	var navContainer = obj.attr('data-navcontainer') || false;

	var navTextTemp =

		"<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-chevron-left' width='44' height='45' viewBox='0 0 24 24' stroke-width='1.5' stroke='#fff' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><polyline points='15 6 9 12 15 18' /></svg>|<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-chevron-right' width='44' height='45' viewBox='0 0 24 24' stroke-width='1.5' stroke='#fff' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><polyline points='9 6 15 12 9 18' /></svg>";

	var navText = obj.attr('data-navtext');

	navText =

		nav &&

		navContainer &&

		(((navText === undefined || Number(navText)) && navTextTemp) ||

			(isNaN(Number(navText)) && navText) ||

			(Number(navText) === 0 && false));



	if (items) {

		items = items.split(',');



		if (items.length) {

			var itemsCount = items.length;



			for (var i = 0; i < itemsCount; i++) {

				var options = items[i].split('|'),

					optionsCount = options.length,

					responsiveKey;



				for (var j = 0; j < optionsCount; j++) {

					const attr = options[j].indexOf(':') ? options[j].split(':') : options[j];



					if (attr[0] === 'screen') {

						responsiveKey = Number(attr[1]);

					} else if (Number(responsiveKey) >= 0) {

						responsive[responsiveKey] = {

							...responsive[responsiveKey],

							[attr[0]]: (isNumeric(attr[1]) && Number(attr[1])) ?? attr[1]

						};

					}

				}

			}

		}

	}



	if (nav && navText) {

		navText = navText.indexOf('|') > 0 ? navText.split('|') : navText.split(':');

		navText = [navText[0], navText[1]];

	}



	obj.on('initialized.owl.carousel translate.owl.carousel', function (e) {

		idx = e.item.index;

		$(this).find('.owl-item.first').removeClass('first');

		$(this).find('.owl-item.second').removeClass('second');



		$(this).find('.owl-item').eq(idx).addClass('first');

		$(this)

			.find('.owl-item')

			.eq(idx + 1)

			.addClass('second');

		$(this)

			.find('.owl-item')

			.eq(idx + 2)

			.addClass('third');

	});



	obj.owlCarousel({

		rewind,

		autoplay,

		loop,

		lazyLoad,

		mouseDrag,

		touchDrag,

		smartSpeed,

		autoplaySpeed,

		autoplayTimeout,

		dots,

		nav,

		navText,

		navContainer: nav && navText && navContainer,

		responsiveClass,

		responsiveRefreshRate,

		responsive

	});



	if (autoplay) {

		obj.on('translate.owl.carousel', function (event) {

			obj.trigger('stop.owl.autoplay');

		});



		obj.on('translated.owl.carousel', function (event) {

			obj.trigger('play.owl.autoplay', [autoplayTimeout]);

		});

	}



	if (animations && isExist(obj.find('[owl-item-animation]'))) {

		var animation_now = '';

		var animation_count = 0;

		var animations_excuted = [];

		var animations_list = animations.indexOf(',') ? animations.split(',') : animations;



		obj.on('changed.owl.carousel', function (event) {

			$(this).find('.owl-item.active').find('[owl-item-animation]').removeClass(animation_now);

		});



		obj.on('translate.owl.carousel', function (event) {

			var item = event.item.index;



			if (Array.isArray(animations_list)) {

				var animation_trim = animations_list[animation_count].trim();



				if (!animations_excuted.includes(animation_trim)) {

					animation_now = 'animate__animated ' + animation_trim;

					animations_excuted.push(animation_trim);

					animation_count++;

				}



				if (animations_excuted.length == animations_list.length) {

					animation_count = 0;

					animations_excuted = [];

				}

			} else {

				animation_now = 'animate__animated ' + animations_list.trim();

			}

			$(this).find('.owl-item').eq(item).find('[owl-item-animation]').addClass(animation_now);

		});

	}

};



/* Owl Page */

NN_FRAMEWORK.OwlPage = function () {

	if (isExist($('.owl-page'))) {

		$('.owl-page').each(function () {

			NN_FRAMEWORK.OwlData($(this));

		});

	}

};



/* Dom Change */

NN_FRAMEWORK.DomChange = function () {

	/* Video Fotorama */

	if (isExist($('#fotorama-videos'))) {

		$('#fotorama-videos').fotorama();

	}

	/* Video Select */

	if (isExist($('.listvideos'))) {

		$('.listvideos').change(function () {

			var id = $(this).val();

			$.ajax({

				url: 'api/video.php',

				type: 'POST',

				dataType: 'html',

				data: {

					id: id

				},

				beforeSend: function () {

					holdonOpen();

				},

				success: function (result) {

					$('.video-main').html(result);

					holdonClose();

				}

			});

		});

	}



	/* Chat Facebook */

	$('#messages-facebook').one('DOMSubtreeModified', function () {

		$('.js-facebook-messenger-box').on('click', function () {

			$('.js-facebook-messenger-box, .js-facebook-messenger-container').toggleClass('open'),

				$('.js-facebook-messenger-tooltip').length && $('.js-facebook-messenger-tooltip').toggle();

		}),

			$('.js-facebook-messenger-box').hasClass('cfm') &&

			setTimeout(function () {

				$('.js-facebook-messenger-box').addClass('rubberBand animated');

			}, 3500),

			$('.js-facebook-messenger-tooltip').length &&

			($('.js-facebook-messenger-tooltip').hasClass('fixed')

				? $('.js-facebook-messenger-tooltip').show()

				: $('.js-facebook-messenger-box').on('hover', function () {

					$('.js-facebook-messenger-tooltip').show();

				}),

				$('.js-facebook-messenger-close-tooltip').on('click', function () {

					$('.js-facebook-messenger-tooltip').addClass('closed');

				}));

		$('.search_open').click(function () {

			$('.search_box_hide').toggleClass('opening');

		});

	});

};



NN_FRAMEWORK.aweOwlPage = function () {

	var owl = $('.owl-carousel.in-page');

	owl.each(function () {

		var xs_item = $(this).attr('data-xs-items');

		var md_item = $(this).attr('data-md-items');

		var lg_item = $(this).attr('data-lg-items');

		var sm_item = $(this).attr('data-sm-items');

		var margin = $(this).attr('data-margin');

		var dot = $(this).attr('data-dot');

		var nav = $(this).attr('data-nav');

		var height = $(this).attr('data-height');

		var play = $(this).attr('data-play');

		var loop = $(this).attr('data-loop');



		if (typeof margin !== typeof undefined && margin !== false) {

		} else {

			margin = 30;

		}

		if (typeof xs_item !== typeof undefined && xs_item !== false) {

		} else {

			xs_item = 1;

		}

		if (typeof sm_item !== typeof undefined && sm_item !== false) {

		} else {

			sm_item = 3;

		}

		if (typeof md_item !== typeof undefined && md_item !== false) {

		} else {

			md_item = 3;

		}

		if (typeof lg_item !== typeof undefined && lg_item !== false) {

		} else {

			lg_item = 3;

		}



		if (loop == 1) {

			loop = true;

		} else {

			loop = false;

		}

		if (dot == 1) {

			dot = true;

		} else {

			dot = false;

		}

		if (nav == 1) {

			nav = true;

		} else {

			nav = false;

		}

		if (play == 1) {

			play = true;

		} else {

			play = false;

		}



		$(this).owlCarousel({

			loop: loop,

			margin: Number(margin),

			responsiveClass: true,

			dots: dot,

			nav: nav,

			navText: [

				'<div class="owlleft"><svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;"><polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline></svg></div>',

				'<div class="owlright"><svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;"><polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline></svg></div>'

			],

			autoplay: play,

			autoplayTimeout: 4000,

			smartSpeed: 3000,

			autoplayHoverPause: true,

			autoHeight: false,

			responsive: {

				0: {

					items: Number(xs_item)

				},

				600: {

					items: Number(sm_item)

				},

				1000: {

					items: Number(md_item)

				},

				1200: {

					items: Number(lg_item)

				}

			}

		});

	});

};



function PaginateHome(eShow) {

	$(eShow + ' .page-link').click(function (e) {

		e.preventDefault();

		var url = $(this).attr('href');

		$.ajax({

			url: url,

			type: 'GET',

			success: function (result) {

				$(eShow).html(result);

				PaginateHome(eShow);

				// Scroll to the top of the eShow element after content update

				// $('html, body').animate({

				// 	scrollTop: $(eShow).offset().top

				// }, 500);

			}

		});

	});

}



NN_FRAMEWORK.Api = function () {

	if (isExist($('.load-product'))) {

		$('.load-product').each(function () {

			var thisClass = $(this);

			var url = thisClass.data('url');

			var type = thisClass.data('type');

			var id = thisClass.find('.title-cat-main .active').data('id');

			var TOKEN = window['TOKEN'];

			$.ajax({

				url: url,

				type: 'POST',

				data: {

					type: type,

					id: id,

					csrf_token: TOKEN

				},

				success: function (result) {

					thisClass.find('.paging-product').html(result);

					NN_FRAMEWORK.Lazys();

					NN_FRAMEWORK.OwlPage();

				}

			});

		});







		$('.title-cat-main span').click(function (e) {

			$('.title-cat-main span').removeClass('active');

			$(this).addClass('active');

			var thisClass = $(this).parents('.load-product');

			var url = thisClass.data('url');

			var type = thisClass.data('type');

			var id = $(this).data('id');

			var TOKEN = window['TOKEN'];

			$.ajax({

				url: url,

				type: 'POST',

				data: {

					type: type,

					id: id,

					csrf_token: TOKEN

				},

				success: function (result) {

					thisClass.find('.paging-product').html(result);

					NN_FRAMEWORK.Lazys();

					NN_FRAMEWORK.OwlPage();

				}

			});

		});

	}



	if (isExist($(".choose__item"))) {

		$(".choose__item").click(function () {

			var paginate = $(this).data('paginate'),

				type = $(this).data('type'),

				idList = $(this).data("list"),

				idCat = $(this).data("cat"),

				eShow = '.productListHome__main-' + idList,

				url = $(this).data('url');

			$(this).parents(".productList__cate").find(".choose__item.active").removeClass("active");

			$(this).addClass("active");

			$.ajax({

				url: url,

				type: "GET",

				dataType: 'html',

				data: {

					paginate: paginate,

					type: type,

					idList: idList,

					idCat: idCat,

					eShow: eShow,

				},

				success: function (result) {

					$(eShow).html(result);

					PaginateHome(eShow);

				}

			});

		});

		$(".choose_all").each(function () {

			var paginate = $(this).data('paginate'),

				type = $(this).data('type'),

				idList = $(this).data("list"),

				idCat = $(this).data("cat"),

				eShow = '.productListHome__main-' + idList,

				url = $(this).data('url');

			$.ajax({

				url: url,

				type: "GET",

				dataType: 'html',

				data: {

					paginate: paginate,

					type: type,

					idList: idList,

					idCat: idCat,

					eShow: eShow,

				},

				success: function (result) {

					$(eShow).html(result);

					PaginateHome(eShow);

				}

			});

		});

	}



	if (isExist($('.item-search'))) {

		$('.item-search input').click(function () {

			Filter();

		});

	}



	if (isExist($('.sort-select-main'))) {

		$('.sort-select-main p a').click(function () {

			$('.sort-select-main p a').removeClass('check');

			$(this).addClass('check');

			Filter();

		});

	}



	$('.filter').click(function (e) {

		$('.left-product').toggleClass('show');

	});



	TextSort();

};







NN_FRAMEWORK.Properties = function () {

	if (isExist($('.grid-properties'))) {

		$('.properties').click(function (e) {

			$(this).parents('.grid-properties').find('.properties').removeClass('active');

			// $('.properties').removeClass('outstock');

			$(this).addClass('active');

		});

	}

};

NN_FRAMEWORK.slickPage = function () {

	if ($('.slick.in-page').length > 0) {

		$('.slick.in-page').each(function () {

			var dots = $(this).attr('data-dots');

			var infinite = $(this).attr('data-infinite');

			var speed = $(this).attr('data-speed');

			var vertical = $(this).attr('data-vertical');

			var arrows = $(this).attr('data-arrows');

			var autoplay = $(this).attr('data-autoplay');

			var autoplaySpeed = $(this).attr('data-autoplaySpeed');

			var centerMode = $(this).attr('data-centerMode');

			var centerPadding = $(this).attr('data-centerPadding');

			var slidesDefault = $(this).attr('data-slidesDefault');

			var responsive = $(this).attr('data-responsive');

			var xs_item = $(this).attr('data-xs-items');

			var md_item = $(this).attr('data-md-items');

			var lg_item = $(this).attr('data-lg-items');

			var sm_item = $(this).attr('data-sm-items');

			var slidesDefault_ar = slidesDefault.split(':');

			var xs_item_ar = xs_item.split(':');

			var sm_item_ar = sm_item.split(':');

			var md_item_ar = md_item.split(':');

			var lg_item_ar = lg_item.split(':');

			var to_show = slidesDefault_ar[0];

			var to_scroll = slidesDefault_ar[1];

			if (responsive == 1) {

				responsive = true;

			} else {

				responsive = false;

			}

			if (dots == 1) {

				dots = true;

			} else {

				dots = false;

			}

			if (arrows == 1) {

				arrows = true;

			} else {

				arrows = false;

			}

			if (infinite == 1) {

				infinite = true;

			} else {

				infinite = false;

			}

			if (autoplay == 1) {

				autoplay = true;

			} else {

				autoplay = false;

			}

			if (centerMode == 1) {

				centerMode = true;

			} else {

				centerMode = false;

			}

			if (vertical == 1) {

				vertical = true;

			} else {

				vertical = false;

			}

			if (typeof speed !== typeof undefined && speed !== false) {

			} else {

				speed = 300;

			}

			if (typeof autoplaySpeed !== typeof undefined && autoplaySpeed !== false) {

			} else {

				autoplaySpeed = 2000;

			}

			if (typeof centerPadding !== typeof undefined && centerPadding !== false) {

			} else {

				centerPadding = '0px';

			}

			var reponsive_json = [

				{

					breakpoint: 1024,

					settings: {

						slidesToShow: Number(lg_item_ar[0]),

						slidesToScroll: Number(lg_item_ar[1])

					}

				},

				{

					breakpoint: 992,

					settings: {

						slidesToShow: Number(md_item_ar[0]),

						slidesToScroll: Number(md_item_ar[1])

					}

				},

				{

					breakpoint: 768,

					settings: {

						slidesToShow: Number(sm_item_ar[0]),

						slidesToScroll: Number(sm_item_ar[1]),

						vertical: false

					}

				},

				{

					breakpoint: 480,

					settings: {

						slidesToShow: Number(xs_item_ar[0]),

						slidesToScroll: Number(xs_item_ar[1]),

						vertical: false

					}

				}

			];

			if (responsive == 1) {

				$(this).slick({

					dots: dots,

					infinite: infinite,

					arrows: arrows,

					speed: Number(speed),

					vertical: vertical,

					slidesToShow: Number(to_show),

					slidesToScroll: Number(to_scroll),

					autoplay: autoplay,

					autoplaySpeed: Number(autoplaySpeed),

					responsive: reponsive_json

				});

			} else {

				$(this).slick({

					dots: dots,

					infinite: infinite,

					arrows: arrows,

					speed: Number(speed),

					vertical: vertical,

					slidesToShow: Number(to_show),

					slidesToScroll: Number(to_scroll),

					autoplay: autoplay,

					autoplaySpeed: Number(autoplaySpeed)

				});

			}

		});

	}

};



NN_FRAMEWORK.load_token = (callback) => {

	if (typeof CSRF_TOKEN != 'undefined' && CSRF_TOKEN) {

		if (typeof window['TOKEN'] == 'undefined') {

			fetch(CSRF_TOKEN)

				.then((json) => json.text())

				.then((result) => {

					window['TOKEN'] = result;

					callback(result);

				});

		} else {

			callback(window['TOKEN']);

		}

	}

};



NN_FRAMEWORK.addTokenToForms = (token) => {

	const items = document.querySelectorAll('.csrf_token:not([value]), .csrf_token[value=""]');

	if (items) {

		for (const v of items) {

			v.value = token;

		}

	}

};

NN_FRAMEWORK.slickPageH = function () {



	$('.slick-slide-show').slick({

		autoplay: true,

		autoplaySpeed: 3000,

		dots: true,

		arrows: false,

		fade: true,

		speed: 1000,

		cssEase: 'linear'

	});



	$('.slick-slide.slick-current.slick-active').find('.left').children().children().addClass('animate__animated animate__fadeInUp');

	$('.slick-slide.slick-current.slick-active').find('.right').addClass('animate__animated animate__fadeInRight');



	$('.slick-slide-show').on('beforeChange', function (event, slick, currentSlide, nextSlide) {

		var currentSlideElement = $(slick.$slides[currentSlide]);

		var nextSlideElement = $(slick.$slides[nextSlide]);

		currentSlideElement.find('.animate__animated').removeClass('animate__fadeInUp animate__fadeInRight');

		nextSlideElement.find('.left').children().children().addClass('animate__animated animate__fadeInUp');

		nextSlideElement.find('.right').addClass('animate__animated animate__fadeInRight');

	});





	if (isExist($(".slick-custom.in-page"))) {

		$('.slick-custom.in-page').each(function () {

			var dots = $(this).attr('data-dots');

			var infinite = $(this).attr('data-infinite');

			var speed = $(this).attr('data-speed');

			var fade = $(this).attr('data-fade');

			var vertical = $(this).attr('data-vertical');

			var verticalSwiping = $(this).attr('data-verticalSwiping');

			var arrows = $(this).attr('data-arrows');

			var autoplay = $(this).attr('data-autoplay');

			var autoplaySpeed = $(this).attr('data-autoplaySpeed');

			var navFor = $(this).attr('data-navfor');

			var classRun = $(this).attr('data-class');

			var centerMode = $(this).attr('data-centerMode');

			var centerPadding = $(this).attr('data-centerPadding');

			var slidesDefault = $(this).attr('data-slidesDefault');

			var responsive = $(this).attr('data-responsive');

			var xs_item = $(this).attr('data-xs-items');

			var md_item = $(this).attr('data-md-items');

			var lg_item = $(this).attr('data-lg-items');

			var sm_item = $(this).attr('data-sm-items');

			var slidesDefault_ar = slidesDefault.split(":");

			var xs_item_ar = xs_item.split(":");

			var sm_item_ar = sm_item.split(":");

			var md_item_ar = md_item.split(":");

			var lg_item_ar = lg_item.split(":");

			var to_show = slidesDefault_ar[0];

			var to_scroll = slidesDefault_ar[1];

			if (responsive == 1) { responsive = true; } else { responsive = false; }

			if (dots == 1) { dots = true; } else { dots = false; }

			if (arrows == 1) { arrows = true; } else { arrows = false; }

			if (infinite == 1) { infinite = true; } else { infinite = false; }

			if (autoplay == 1) { autoplay = true; } else { autoplay = false; }

			if (centerMode == 1) { centerMode = true; } else { centerMode = false; }



			if (navFor != '') { asNavFor = navFor; }

			if (fade == 1) {

				fade = true;

			}



			if (vertical == 1) {

				vertical = true;

				verticalSwiping = true;



			} else { vertical = false; }

			if (verticalSwiping == 1) {

				verticalSwiping = true;



			} else { verticalSwiping = false; }

			if (typeof speed !== typeof undefined && speed !== false) {

			} else { speed = 300; }

			if (typeof autoplaySpeed !== typeof undefined && autoplaySpeed !== false) {

			} else { autoplaySpeed = 2000; }

			if (typeof centerPadding !== typeof undefined && centerPadding !== false) {

			} else { centerPadding = "0px"; }

			var reponsive_json = [{

				breakpoint: 1024,

				settings: {

					slidesToShow: Number(lg_item_ar[0]),

					slidesToScroll: Number(lg_item_ar[1])

				}

			}, {

				breakpoint: 992,

				settings: {

					slidesToShow: Number(md_item_ar[0]),

					slidesToScroll: Number(md_item_ar[1])

				}

			}, {

				breakpoint: 768,

				settings: {

					slidesToShow: Number(sm_item_ar[0]),

					slidesToScroll: Number(sm_item_ar[1]),

					vertical: false

				}

			}, {

				breakpoint: 480,

				settings: {

					slidesToShow: Number(xs_item_ar[0]),

					slidesToScroll: Number(xs_item_ar[1]),

					vertical: false

				}

			}];

			if (responsive) {

				$(classRun).slick({

					dots: dots,

					infinite: infinite,

					arrows: arrows,

					fade: fade,

					speed: Number(speed),

					vertical: vertical,

					verticalSwiping: verticalSwiping,

					slidesToShow: Number(to_show),

					slidesToScroll: Number(to_scroll),

					autoplay: autoplay,

					centerMode: centerMode,

					centerPadding: centerPadding,

					asNavFor: asNavFor,

					focusOnSelect: true,

					autoplaySpeed: Number(autoplaySpeed),

					centerMode: centerMode,

					centerPadding: centerPadding,

					responsive:

						reponsive_json

					, initialSlide: 2

				});

			} else {

				$(classRun).slick({

					dots: dots,

					infinite: infinite,

					arrows: arrows,

					speed: Number(speed),

					fade: fade,

					vertical: vertical,

					focusOnSelect: true,

					verticalSwiping: verticalSwiping,

					slidesToShow: Number(to_show),

					slidesToScroll: Number(to_scroll),

					autoplay: autoplay,

					centerMode: centerMode,

					centerPadding: centerPadding,

					asNavFor: asNavFor,

					autoplaySpeed: Number(autoplaySpeed)

					, initialSlide: 2

				});

			}

		});

	}

	$(document).ready(function () {

		$('.slick-news').on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {

			$(this).find('.slick-slide').removeClass('left-item right-item');

			var leftItem = $(this).find('.slick-active').first();

			leftItem.addClass('left-item');

			leftItem.nextAll('.slick-active').addClass('right-item');

		});

	});

};



function resizeFlipbook() {

	var w_book = 1020;

	var h_book = 570;

	var w_rs_body = $("body").outerWidth();

	var w_rs_boook = w_book;

	var h_rs_boook = h_book;

	if (w_rs_body < w_book) {

		w_book = 510;

		h_book = 570;

		w_rs_boook = (w_rs_body - 30);

		h_rs_boook = ((w_rs_boook - 20 * 4 - 34 * 2) / 2) / (w_book / h_book) + 20 * 2;

	}

	$(".flipbook").turn("size", w_rs_boook, h_rs_boook);

}



NN_FRAMEWORK.Flipbook = function () {

	if (isExist($('.flipbook'))) {

		$('.flipbook').turn({

			width: 1020,

			height: 570,

			elevation: 50,

			gradients: true,

			autoCenter: true,

			display: 'double',

			page: 2,



		});



		$(".turn-next").click(function (event) {

			$(".flipbook").turn("next");

		});



		$(".turn-prev").click(function (event) {

			$(".flipbook").turn("previous");

		});



		resizeFlipbook();

		$(window).resize(function () {

			resizeFlipbook();

		});



	}

};



NN_FRAMEWORK.SearchClick = function () {

	if (isExist($(".li-tim"))) {

		$(".li-tim i").click(function () {

			if ($(this).hasClass('active')) {

				$(this).removeClass('active');

				$(".search-btn").stop(true, true).animate({ opacity: "0", width: "0px" }, 200);

			}

			else {

				$(this).addClass('active');

				$(".search-btn").stop(true, true).animate({ opacity: "1", width: "230px" }, 200);

			};

		});

	};

};

/* MutationObserverChange */

NN_FRAMEWORK.MutationObserverChange = function () {

	function handleMutation(callback) {

		return function (mutationsList, observer) {

			for (const mutation of mutationsList) {

				if (mutation.type === 'childList' || mutation.type === 'attributes') {

					callback();

					observer.disconnect();

					break;

				}

			}

		};

	}



	/* Video Fotorama */

	const videoFotoramaNode = document.getElementById('video-fotorama');

	if (videoFotoramaNode) {

		const videoFotoramaCallback = () => {

			$('#fotorama-videos').fotorama();

		};

		const videoFotoramaObserver = new MutationObserver(handleMutation(videoFotoramaCallback));

		videoFotoramaObserver.observe(videoFotoramaNode, { childList: true, subtree: true });

	}



	/* Video Select */

	const videoSelectNode = document.getElementById('video-select');

	if (videoSelectNode) {

		const videoSelectCallback = () => {

			$('.listvideos').change(function () {

				var id = $(this).val();

				$.ajax({

					url: 'api/video.php',

					type: 'POST',

					dataType: 'html',

					data: { id: id },

					beforeSend: function () {

						holdonOpen();

					},

					success: function (result) {

						$('.video-main').html(result);

						holdonClose();

					}

				});

			});

		};

		const videoSelectObserver = new MutationObserver(handleMutation(videoSelectCallback));

		videoSelectObserver.observe(videoSelectNode, { childList: true, subtree: true });

	}



	/* Chat Facebook */

	const messagesFacebookNode = document.getElementById('messages-facebook');

	if (messagesFacebookNode) {



		const messagesFacebookCallback = () => {

			$('.js-facebook-messenger-box').on('click', function () {

				$('.js-facebook-messenger-box, .js-facebook-messenger-container').toggleClass('open');

				if ($('.js-facebook-messenger-tooltip').length) {

					$('.js-facebook-messenger-tooltip').toggle();

				}

			});

			if ($('.js-facebook-messenger-box').hasClass('cfm')) {

				setTimeout(function () {

					$('.js-facebook-messenger-box').addClass('rubberBand animated');

				}, 3500);

			}

			if ($('.js-facebook-messenger-tooltip').length) {

				if ($('.js-facebook-messenger-tooltip').hasClass('fixed')) {

					$('.js-facebook-messenger-tooltip').show();

				} else {

					$('.js-facebook-messenger-box').on('hover', function () {

						$('.js-facebook-messenger-tooltip').show();

					});

				}

				$('.js-facebook-messenger-close-tooltip').on('click', function () {

					$('.js-facebook-messenger-tooltip').addClass('closed');

				});

			}

			$('.search_open').click(function () {

				$('.search_box_hide').toggleClass('opening');

			});

		};

		const messagesFacebookObserver = new MutationObserver(handleMutation(messagesFacebookCallback));

		messagesFacebookObserver.observe(messagesFacebookNode, { childList: true, subtree: true });

	}

};



NN_FRAMEWORK.Counter = function () {

	if (isExist($('#counter'))) {

		let a = 0;

		$(window).scroll(function () {

			let oTop = $('#counter').offset().top - window.innerHeight;

			if (a == 0 && $(window).scrollTop() > oTop) {

				$('.counter-value').each(function () {

					let $this = $(this),

						countTo = $this.attr('data-count');

					$({

						countNum: $this.text(),

					}).animate(

						{

							countNum: countTo,

						},

						{

							duration: 1000,

							easing: 'swing',

							step: function () {

								$this.text(Math.floor(this.countNum));

							},

							complete: function () {

								$this.text(this.countNum);

							},

						}

					);

				});

				a = 1;

			}

		});

	}

};

NN_FRAMEWORK.AosAnimation = function () {

	AOS.init({});

};

/* Ready */

NN_FRAMEWORK.Wows = function () {

	new WOW().init();

};



NN_FRAMEWORK.Swipper = function () {

	var galleryThumbs = new Swiper(".slider-novel-right", {

		slidesPerView: 2,
		spaceBetween: 20,
		freeMode: false,
		watchOverflow: true,
		watchSlidesVisibility: true,
		watchSlidesProgress: true,
		direction: 'vertical',
		on: {
			init: function () {

				setSlideHeight(this);

			},
		}
	});
	var galleryMain = new Swiper(".slider-novel-left", {
		watchOverflow: true,
		watchSlidesVisibility: true,
		watchSlidesProgress: true,
		preventInteractionOnTransition: true,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		effect: 'fade',
		fadeEffect: {
			crossFade: true
		},
		thumbs: {
			swiper: galleryThumbs
		}
	});

	galleryThumbs.on('slideChangeTransitionStart', function () {
		galleryMain.slideTo(galleryThumbs.activeIndex);
	});

	galleryMain.on('transitionStart', function () {
		galleryThumbs.slideTo(galleryMain.activeIndex);
	});


	if ($('#productSwiper').length > 0) {

		new Swiper("#productSwiper", {

			speed: 800,

			spaceBetween: 10,

			slidesPerView: 3,

			rewind: false,

			loop: true,

			freeMode: false,

			allowTouchMove: true,

			direction: "vertical",

			lazy: true,



			autoplay: { delay: 2000, pauseOnMouseEnter: true, },

			on: {

				init: function () {

					setSlideHeight(this);

				},

				slideChangeTransitionEnd: function () {

					setSlideHeight(this);

				}

			}

		});

	}

};

function setSlideHeight(that) {

	$(that.hostEl).find('.swiper-slide').css({ height: 'auto' });

	var currentSlide = that.activeIndex;



	// Handle breakpoints

	var currentBreakpoint = that.currentBreakpoint;

	var slidesPerView = that.passedParams.slidesPerView ? that.passedParams.slidesPerView : 1;

	var spaceBetween = that.passedParams.spaceBetween ? that.passedParams.spaceBetween : 0;



	// var breakpointParams = that.passedParams.breakpoints[currentBreakpoint];



	// if (breakpointParams) {

	// 	slidesPerView = breakpointParams.slidesPerView || slidesPerView;

	// 	spaceBetween = breakpointParams.spaceBetween || spaceBetween;

	// }





	var newHeight = ($(that.slides[currentSlide]).height() * slidesPerView) + (spaceBetween * (slidesPerView - 1));

	$(that.hostEl).find('.swiper-wrapper').css({ height: newHeight })

	that.update();

}







NN_FRAMEWORK.Shiner = function () {

	if (isExist($(".peShine"))) {

		$(window).bind("load resize", function () {

			var api = $(".peShine").peShiner({

				api: true,

				paused: true,

				reverse: true,

				repeat: 1,

				color: 'oceanHL'

			});

			api.resume();

		});

	}

};



NN_FRAMEWORK.moveMenu = function () {



	var menuDestop = document.getElementById('menu-main').innerHTML;



	var tempDiv = document.createElement('div');



	tempDiv.innerHTML = menuDestop;



	var menuMobile = document.getElementById('menu-mobile-ul');



	var children = tempDiv.children;

	menuMobile.appendChild(children[0].cloneNode(true));



	for (var i = 1; i < children.length; i++) {



		if (children[i].tagName === 'LI' && !children[i].classList.contains('detect-search')) {



			menuMobile.appendChild(children[i].cloneNode(true));



		}

	}

};


NN_FRAMEWORK.subscribeNovel = function () {
	if (isExist($(this))) {
		let novelId = $(this).data('novel');
		let idMember = $(this).data('idMember');
		console.log(novelId, idMember);
	}
}

NN_FRAMEWORK.myJs = function () {

	if (isExist($('.buynovel'))) {
		$('.buynovel').click(function () {
			let novelId = $(this).attr('data-idProduct');
			let idMember = $(this).attr('data-idMember');
			let userCoin = $(this).attr('data-userCoin');
			let novelPrice = $(this).attr('data-novelPrice');

			if (userCoin < novelPrice) {
				Swal.fire({
					title: 'Bạn không có đủ hoa để nhận truyện',
					icon: 'error',
				});
			} else {

				Swal.fire({
					title: "Bạn có muốn truyện này không",
					text: "Bạn còn " + userCoin + " hoa, truyện này có giá " + novelPrice + " hoa",
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: "Mua truyện"
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url: 'getNovel',
							type: 'POST',
							data: { csrf_token: window['TOKEN'], novelId: novelId, idMember: idMember, type: 'buy' },
							success: function (response) {
								if (response.status == 'success') {
									Swal.fire({
										title: 'Bạn đã mua truyện thành công',
										icon: 'success',
									});
									window.location.reload();
								}
							}
						});
					}
				});
			}
		});
	}
	if (isExist($('#modalDonate'))) {
		$('#input-donate').on('input', function () {
			let inputDonate = $(this);
			let userCoin = $('.donate-desc').attr('data-user-coin');
			let donateCoin = $(this).val();
			let donateDesc = $('.donate-desc');
			
			if (userCoin - donateCoin < 0) {
				Swal.fire({
					title: 'Bạn hết hoa ròi',
					icon: 'error',
				});
			} else {
				donateDesc.text('Bạn sẽ còn ' + (userCoin - donateCoin) + ' hoa.');
			}
		});

	}
	if (isExist($('.btn-subscribe'))) {
		$('.btn-subscribe').click(function () {
			let novelId = $(this).data('novel-id');
			let idMember = $(this).data('id-member');
			let type = $(this).data('type') ?? 'follow';
			let btn = $(this);
			holdonOpen();
			$.ajax({
				url: 'subscribeNovel',
				type: 'POST',
				data: { csrf_token: window['TOKEN'], novelId: novelId, idMember: idMember, type: type },
				success: function (response) {
					holdonClose();
					if (response.status == 'success') {
						btn.addClass('active');
						if (type == 'recommend') {
							btn.find('span').text('Đã đề cử');
						} else {
							btn.find('span').text('Đã trong giá sách');
						}
					} else {
						btn.removeClass('active');
						if (type == 'recommend') {
							btn.find('span').text('Đề cử');
						} else {
							btn.find('span').text('Thêm vào giá sách');
						}
					}
				}
			});
		});
	}


	if (isExist($('#product-detail-content'))) {

		let p = document.getElementById('product-detail-content');

		p.removeAttribute("hidden");

	}


	$(window).bind("load resize", function () {
		$('.item').each(function (index, element) {
			// element == this
			mw = $(this).width();
			$(this).find('.info-content').width((mw * 2) - 40);
		});
	});


	if (isExist($('.check-form'))) {

		$('.check-form .check-btn').click(function (e) {

			e.preventDefault();

			var type = $(this).data('type');

			var ten = $('#fullname-' + type);

			var phone = $('#phone-' + type);

			var email = $('#email-' + type);

			if (type == 'newsletter') {

				if (isEmpty(ten.val(), LANG['nhaphoten'])) { ten.focus(); return false; }

				if (isEmpty(phone.val(), LANG['nhapdienthoai'])) { phone.focus(); return false; }

				if (isPhone(phone.val(), LANG['nhapdienthoaihople'])) { phone.focus(); return false; }

				if (isEmpty(email.val(), LANG['nhapemail'])) { email.focus(); return false; }

				if (isEmail(email.val(), LANG['nhapemailhople'])) { email.focus(); return false; }

			}

		});

	}

}

/* Ready */

$(document).ready(function () {

	NN_FRAMEWORK.load_token((value) => {

		NN_FRAMEWORK.Api();

		NN_FRAMEWORK.addTokenToForms(value);

	});

	NN_FRAMEWORK.Lazys();

	NN_FRAMEWORK.Popup();

	NN_FRAMEWORK.AltImg();

	NN_FRAMEWORK.GoTop();

	NN_FRAMEWORK.Menu();

	NN_FRAMEWORK.OwlPage();

	NN_FRAMEWORK.slickPage();

	NN_FRAMEWORK.Videos();

	NN_FRAMEWORK.Photobox();

	NN_FRAMEWORK.Search();

	NN_FRAMEWORK.DomChange();

	NN_FRAMEWORK.DatePicker();

	NN_FRAMEWORK.loadNameInputFile();

	NN_FRAMEWORK.Properties();

	NN_FRAMEWORK.MutationObserverChange();

	NN_FRAMEWORK.slickPageH();

	NN_FRAMEWORK.Swipper();

	NN_FRAMEWORK.Api();

	// NN_FRAMEWORK.moveMenu();

	// NN_FRAMEWORK.Shiner();

	// NN_FRAMEWORK.AosAnimation();

	// NN_FRAMEWORK.Wows();

	// NN_FRAMEWORK.Counter();

	// NN_FRAMEWORK.SearchClick();

	// NN_FRAMEWORK.Flipbook();

	NN_FRAMEWORK.myJs();





	if (isExist($('.comment-page'))) {

		new Comments('.comment-page', BASE);

	}



	// new Cart(BASE);

});
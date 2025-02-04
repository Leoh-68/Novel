

async function loadImage(imageLink, targetId) {
    const response = await fetch(imageLink); // Tải ảnh
    const blob = await response.blob(); // Chuyển thành Blob
    const file = new File([blob], "avt" + Math.random() + ".png", { type: blob.type }); // Tạo file
    const dataTransfer = new DataTransfer(); // Tạo DataTransfer
    dataTransfer.items.add(file); // Thêm file vào DataTransfer
    document.getElementById(targetId).files = dataTransfer.files; // Gán vào input file
	console.log('Complete');
	
}

function mergeCircularAvatarWithBorder(avatarSrc, borderSrc, callback) {
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');

    const borderImg = new Image();
    const avatarImg = new Image();

    borderImg.onload = function() {
        canvas.width = borderImg.width;
        canvas.height = borderImg.height;

        avatarImg.onload = function() {
            // Create circular avatar
            const size = Math.min(200, Math.min(avatarImg.width, avatarImg.height));
            const centerX = (canvas.width - size) / 2;
            const centerY = (canvas.height - size) / 2;

            // Draw avatar first
            ctx.save();
            ctx.beginPath();
            ctx.arc(centerX + size/2, centerY + size/2, size/2, 0, Math.PI * 2);
            ctx.closePath();
            ctx.clip();
            ctx.drawImage(avatarImg, centerX, centerY, size, size);
            ctx.restore();

            // Draw border on top
            ctx.drawImage(borderImg, 0, 0);

            // Invoke callback with result
            callback(canvas.toDataURL('image/png'));
        };
        avatarImg.src = avatarSrc;
    };
    borderImg.src = borderSrc;
}

// Usage

$('.avatar-user-merger').each(function() {
    const avatarSrc = $(this).attr('data-avt');
    const borderSrc = $(this).attr('data-border');
    mergeCircularAvatarWithBorder(avatarSrc, borderSrc, (mergedImage) => {
        $(this).find('img').attr('src', mergedImage).attr('onerror', "this.src='{{ thumbs('thumbs/660x580x1/assets/images/noimage.png') }}';");
    });
});



function isExist(ele) {

	return ele.length;

}



function isNumeric(value) {

	return /^\d+$/.test(value);

}



function getLen(str) {

	return /^\s*$/.test(str) ? 0 : str.length;

}





function useStrict(value) {

	try {

		return JSON.parse(value);

	} catch (e) {

		return value;

	}

}



function isEmpty(value, message) {

	if (value == "") {

		if (typeof message !== 'undefined') {

			showNotify(LANG['thongbao'], message, 'error');

		}

		return true;

	}

	return false;

}



function isPhone(phone, message) {

	if (phone.length != 10 || phone.substr(0, 1) != 0) {

		if (typeof message !== 'undefined') {

			showNotify(LANG['thongbao'], message, 'error');

		}

		return true;

	}

	return false;

}



function isEmail(email, message) {

	const emailRegExp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;



	if (!emailRegExp.test(email.toLowerCase())) {

		if (typeof message !== 'undefined') {

			showNotify(LANG['thongbao'], message, 'error');

		}

		return true;

	}

	return false;

}



function showNotify(text = 'Notify text', title = LANG['thongbao'], status = 'success') {

	new Notify({

		status: status, // success, warning, error

		title: title,

		text: text,

		effect: 'fade',

		speed: 400,

		customClass: null,

		customIcon: null,

		showIcon: true,

		showCloseButton: true,

		autoclose: true,

		autotimeout: 3000,

		gap: 10,

		distance: 10,

		type: 3,

		position: 'right top'

	});

}



function notifyDialog(content = '', title = LANG['thongbao'], icon = 'fas fa-exclamation-triangle', type = 'blue') {

	$.alert({

		title: title,

		icon: icon, // font awesome

		type: type, // red, green, orange, blue, purple, dark

		content: content, // html, text

		backgroundDismiss: true,

		animationSpeed: 600,

		animation: 'zoom',

		closeAnimation: 'scale',

		typeAnimated: true,

		animateFromElement: false,

		autoClose: 'accept|3000',

		escapeKey: 'accept',

		buttons: {

			accept: {

				text: LANG['dongy'],

				btnClass: 'btn-sm btn-primary'

			}

		}

	});

}



function confirmDialog(

	action,

	text,

	value,

	title = LANG['thongbao'],

	icon = 'fas fa-exclamation-triangle',

	type = 'blue'

) {

	$.confirm({

		title: title,

		icon: icon, // font awesome

		type: type, // red, green, orange, blue, purple, dark

		content: text, // html, text

		backgroundDismiss: true,

		animationSpeed: 600,

		animation: 'zoom',

		closeAnimation: 'scale',

		typeAnimated: true,

		animateFromElement: false,

		autoClose: 'cancel|3000',

		escapeKey: 'cancel',

		buttons: {

			success: {

				text: LANG['dongy'],

				btnClass: 'btn-sm btn-primary',

				action: function () {

					if (action == 'delete-procart') deleteCart(value);

				}

			},

			cancel: {

				text: LANG['huy'],

				btnClass: 'btn-sm btn-danger'

			}

		}

	});

}



function validateForm(ele = '') {

	if (ele) {

		$('.' + ele)

			.find('input[type=submit]')

			.removeAttr('disabled');

		var forms = document.getElementsByClassName(ele);

		var validation = Array.prototype.filter.call(forms, function (form) {

			form.addEventListener(

				'submit',

				function (event) {

					if (form.checkValidity() === false) {

						event.preventDefault();

						event.stopPropagation();

					}

					form.classList.add('was-validated');

				},

				false

			);

		});

	}

}



function readImage(inputFile, elementPhoto) {

	if (inputFile[0].files[0]) {

		if (inputFile[0].files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {

			var size = parseInt(inputFile[0].files[0].size) / 1024;



			if (size <= 4096) {

				var reader = new FileReader();

				reader.onload = function (e) {

					$(elementPhoto).attr('src', e.target.result);

				};

				reader.readAsDataURL(inputFile[0].files[0]);

			} else {

				notifyDialog(LANG['dungluonghinhanhlon']);

				return false;

			}

		} else {

			$(elementPhoto).attr('src', '');

			notifyDialog(LANG['dinhdanghinhanhkhonghople']);

			return false;

		}

	} else {

		$(elementPhoto).attr('src', '');

		return false;

	}

}



function photoZone(eDrag, iDrag, eLoad) {

	if ($(eDrag).length) {

		/* Drag over */

		$(eDrag).on('dragover', function () {

			$(this).addClass('drag-over');

			return false;

		});



		/* Drag leave */

		$(eDrag).on('dragleave', function () {

			$(this).removeClass('drag-over');

			return false;

		});



		/* Drop */

		$(eDrag).on('drop', function (e) {

			e.preventDefault();

			$(this).removeClass('drag-over');



			var lengthZone = e.originalEvent.dataTransfer.files.length;



			if (lengthZone == 1) {

				$(iDrag).prop('files', e.originalEvent.dataTransfer.files);

				readImage($(iDrag), eLoad);

			} else if (lengthZone > 1) {

				notifyDialog(LANG['banchiduocchon1hinhanhdeuplen']);

				return false;

			} else {

				notifyDialog(LANG['dulieukhonghople']);

				return false;

			}

		});



		/* File zone */

		$(iDrag).change(function () {

			readImage($(this), eLoad);

		});

	}

}





function generateCaptcha(action, id, id_form) {

	if (RECAPTCHA_ACTIVE && action && id && $("#" + id).length) {

		grecaptcha

			.execute(RECAPTCHA_SITEKEY, { action: action })

			.then(function (token) {

				var recaptchaResponse = document.getElementById(id);

				recaptchaResponse.value = token;

				document.getElementById(id_form).submit();

			});

	}

}



function loadPaging(url = '', eShow = '') {

	if (url) {

		$.ajax({

			url: url,

			type: 'GET',

			data: {

				eShow: eShow

			},

			success: function (result) {

				thisClass.find('.paging-product').html(result);

				NN_FRAMEWORK.Lazys();

			}

		});

	}

}



function doEnter(event, obj) {

	if (event.keyCode == 13 || event.which == 13) onSearch(obj);

}
function doEnter2(event, obj) {

	if (event.keyCode == 13 || event.which == 13) onSearchMember(obj);

}




function onSearch(obj) {

	var keyword = $('#' + obj).val();



	if (keyword == '') {

		notifyDialog(LANG['no_keywords']);

		return false;

	} else {

		location.href = 'tim-kiem?keyword=' + encodeURI(keyword);

	}

}
function onSearchMember(obj) {

	var keyword = $('#' + obj).val();



	if (keyword == '') {

		notifyDialog(LANG['no_keywords']);

		return false;

	} else {

		location.href = 'member/list/product/man/san-pham?keyword=' + encodeURI(keyword);

	}

}




function goToByScroll(id, minusTop) {

	minusTop = parseInt(minusTop) ? parseInt(minusTop) : 0;

	id = id.replace('#', '');

	$('html,body').animate(

		{

			scrollTop: $('#' + id).offset().top - minusTop

		},

		'slow'

	);

}



function holdonOpen(

	theme = 'sk-circle',

	text = 'Loading...',

	backgroundColor = 'rgba(0,0,0,0.8)',

	textColor = 'white'

) {

	var options = {

		theme: theme,

		message: text,

		backgroundColor: backgroundColor,

		textColor: textColor

	};



	HoldOn.open(options);

}



function holdonClose() {

	HoldOn.close();

}



function FirstLoadAPI(div, url, name_api) {

	$(div).addClass('active');

	var id = $(div).data('id');

	var tenkhongdau = $(div).data('tenkhongdau');

	FrameAjax(

		url,

		'POST',

		{

			id: id,

			tenkhongdau: tenkhongdau

		},

		name_api

	);

}



function LoadAPI(div, url, name_api) {

	$(div).click(function (event) {

		$(div).removeClass('active');

		$(this).addClass('active');

		var id = $(this).data('id');

		var tenkhongdau = $(this).data('tenkhongdau');

		FrameAjax(

			url,

			'POST',

			{

				id: id,

				tenkhongdau: tenkhongdau

			},

			name_api

		);

	});

}



function FrameAjax(url, type, data, name) {

	$.ajax({

		url: url,

		type: type,

		data: data,

		success: function (data) {

			$(name).html(data);

			NN_FRAMEWORK.Lazys();

		}

	});

}



function Filter() {

	holdonOpen();

	var url = $('.url-search').val();

	var sort = $('.sort-select-main p .check').data('sort');

	var idCat = {};

	$('input[name="ip-search"]:checked').each(function (index, element) {

		var id = $(this).data('list');

		if (!idCat[id]) idCat[id] = [];

		idCat[id].push($(this).val());

	});

	var queryString = Object.keys(idCat)

		.map(function (key) {

			return key + '=' + idCat[key].join(',');

		})

		.join('&');

	url += '?sort=' + sort + (queryString ? '&' + queryString : '');

	window.location.href = url;



}



function TextSort() {

	var text = $('.sort-select-main p .check').text();

	$('.sort-show').text(text);

}


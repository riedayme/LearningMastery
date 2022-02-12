/*
* jQuery Textarea Characters Counter Plugin v 2.0
* Examples and documentation at: http://roy-jin.appspot.com/jsp/textareaCounter.jsp
* Copyright (c) 2010 Roy Jin
* Version: 2.0 (11-JUN-2010)
* Dual licensed under the MIT and GPL licenses:
* http://www.opensource.org/licenses/mit-license.php
* http://www.gnu.org/licenses/gpl.html
* Requires: jQuery v1.4.2 or later
*/
(function($){$.fn.textareaCount=function(options,fn){var defaults={maxCharacterSize:-1,originalStyle:'originalTextareaInfo',warningStyle:'warningTextareaInfo',warningNumber:20,displayFormat:'#input characters | #words words'};var options=$.extend(defaults,options);var container=$(this);$("<div class='charleft'>&nbsp;</div>").insertAfter(container);var charLeftCss={'width':container.width()};var charLeftInfo=getNextCharLeftInformation(container);charLeftInfo.addClass(options.originalStyle);charLeftInfo.css(charLeftCss);var numInput=0;var maxCharacters=options.maxCharacterSize;var numLeft=0;var numWords=0;container.bind('keyup',function(event){limitTextAreaByCharacterCount()}).bind('mouseover',function(event){setTimeout(function(){limitTextAreaByCharacterCount()},10)}).bind('paste',function(event){setTimeout(function(){limitTextAreaByCharacterCount()},10)});function limitTextAreaByCharacterCount(){charLeftInfo.html(countByCharacters());if(typeof fn!='undefined'){fn.call(this,getInfo())}
return!0}
function countByCharacters(){var content=container.val();var contentLength=content.length;if(options.maxCharacterSize>0){if(contentLength>=options.maxCharacterSize){content=content.substring(0,options.maxCharacterSize)}
var newlineCount=getNewlineCount(content);var systemmaxCharacterSize=options.maxCharacterSize-newlineCount;if(!isWin()){systemmaxCharacterSize=options.maxCharacterSize}
if(contentLength>systemmaxCharacterSize){var originalScrollTopPosition=this.scrollTop;container.val(content.substring(0,systemmaxCharacterSize));this.scrollTop=originalScrollTopPosition}
charLeftInfo.removeClass(options.warningStyle);if(systemmaxCharacterSize-contentLength<=options.warningNumber){charLeftInfo.addClass(options.warningStyle)}
numInput=container.val().length+newlineCount;if(!isWin()){numInput=container.val().length}
numWords=countWord(getCleanedWordString(container.val()));numLeft=maxCharacters-numInput}else{var newlineCount=getNewlineCount(content);numInput=container.val().length+newlineCount;if(!isWin()){numInput=container.val().length}
numWords=countWord(getCleanedWordString(container.val()))}
return formatDisplayInfo()}
function formatDisplayInfo(){var format=options.displayFormat;format=format.replace('#input',numInput);format=format.replace('#words',numWords);if(maxCharacters>0){format=format.replace('#max',maxCharacters);format=format.replace('#left',numLeft)}
return format}
function getInfo(){var info={input:numInput,max:maxCharacters,left:numLeft,words:numWords};return info}
function getNextCharLeftInformation(container){return container.next('.charleft')}
function isWin(){var strOS=navigator.appVersion;if(strOS.toLowerCase().indexOf('win')!=-1){return!0}
return!1}
function getNewlineCount(content){var newlineCount=0;for(var i=0;i<content.length;i++){if(content.charAt(i)=='\n'){newlineCount++}}
return newlineCount}
function getCleanedWordString(content){var fullStr=content+" ";var initial_whitespace_rExp=/^[^A-Za-z0-9]+/gi;var left_trimmedStr=fullStr.replace(initial_whitespace_rExp,"");var non_alphanumerics_rExp=rExp=/[^A-Za-z0-9]+/gi;var cleanedStr=left_trimmedStr.replace(non_alphanumerics_rExp," ");var splitString=cleanedStr.split(" ");return splitString}
function countWord(cleanedWordString){var word_count=cleanedWordString.length-1;return word_count}}})(jQuery)

$(document).ready(function(){
	$('#textarea-review').textareaCount({
		'maxCharacterSize': 300,
		'originalStyle': 'originalTextareaInfo',
		'warningStyle' : 'warningTextareaInfo',
		'warningNumber': 40,
		'displayFormat' : '#left Characters Left / #max'
	});
});

/**
 * to top
 */
 $(window).scroll(function() {
 	if ($(this).scrollTop() > 100) {
 		$('#toTop').fadeIn();
 	} else {
 		$('#toTop').fadeOut();
 	}
 });

 $("#toTop").click(function () {
 	$("html, body").animate({scrollTop: 0}, 500);
 });

/**
* Footer collapse
*/
$(window).on("load resize", function() {
	$(window).outerWidth() <= 575 ? $(".mobile-collapse").next().slideUp(0) : $(".mobile-collapse").next().slideDown(0)
});
$(".mobile-collapse").on("click", function() {
	if (!($(window).outerWidth() >= 575)) {
		var t = $(this).next();
		t.hasClass("show") ? $(".c-panel__widget .show").removeClass("show").slideUp(300) : ($(".c-panel__widget .show").removeClass("show").slideUp(300), t.addClass("show").slideDown(300)), $(this).hasClass("active") ? $(".c-panel__widget .active").removeClass("active") : ($(".c-panel__widget .active").removeClass("active"), $(this).addClass("active"))
	}
}); 

/**
* Module Add Courses 
*/
$('.btn-process-courses').on('click', function(e) {
	e.preventDefault();

	let button = $(this);

	button.prop("disabled", true);

	var data = [];
	data.push({ name: "id", value: button.data('id') });
	data.push({ name: "redirect", value: button.data('redirect') });

	$.ajax({
		url: button.data('action'),
		method: "POST",
		data: data,
		dataType: 'JSON',
		success: function(data) {

			if (data.status == true) {

				Swal.fire({
					title: data.message,
					icon: 'success',
					confirmButtonColor: '#3085d6',
				})
				.then((result) => {
					window.location.href = data.redirect;
				})                    

			}else {

				Swal.fire({
					title: data.message,
					icon: 'error',
					confirmButtonColor: '#3085d6',
				})

			}

			button.prop("disabled", false);
		},
		error: function(xhr, ajaxOptions, thrownError) {

			Swal.fire({
				title: 'Error Processing !',
				icon: 'error',
				confirmButtonColor: '#3085d6',
			})

			button.prop("disabled", false);

		}
	});

});	

/**
* Module user lesson
*/
$('.btn-process-lesson').on('click', function(e) {
	e.preventDefault();

	let button = $(this);

	button.prop("disabled", true);

	var data = [];
	data.push({ name: "id_courses", value: button.data('id-courses') });
	data.push({ name: "id_lesson", value: button.data('id-lesson') });	

	$.ajax({
		url: button.data('action'),
		method: "POST",
		data: data,
		dataType: 'text',
		success: function(status) {

			if (status == 'set_false') {

				$("i",button).removeClass().addClass('fa fa-check u-color-white u-m-zero');            
			}
			else if (status == 'set_true') {

				$("i",button).removeClass().addClass('fa fa-check u-color-success u-m-zero');             
			}else{

				/** error */
			}

			button.prop("disabled", false);
		},
		error: function(xhr, ajaxOptions, thrownError) {

			Swal.fire({
				title: 'Error Processing !',
				icon: 'error',
				confirmButtonColor: '#3085d6',
			})

			button.prop("disabled", false);

		}
	});

});	


/**
* Module add to wishlist 
*/
$('.btn-process-wishlist').on('click', function(e) {
	e.preventDefault();

	let button = $(this);

	button.prop("disabled", true);

	var data = [];
	data.push({ name: "id", value: button.data('id') });

	$.ajax({
		url: button.data('action'),
		method: "POST",
		data: data,
		dataType: 'text',
		success: function(status) {

			if (status == 'success_remove') {

				$("i",button).removeClass().addClass('fa fa-heart-o');            
			}
			else if (status == 'success_add') {


				$("i",button).removeClass().addClass('fa fa-heart u-text-danger');             
			}else{

				/** error */
			}

			button.prop("disabled", false);
		},
		error: function(xhr, ajaxOptions, thrownError) {

			Swal.fire({
				title: 'Error Processing !',
				icon: 'error',
				confirmButtonColor: '#3085d6',
			})

			button.prop("disabled", false);

		}
	});

});	

/**
 * Module remove wish list
 */

 $('.btn-remove-wishlist').on('click', function(e) {
 	e.preventDefault();
 	Swal.fire({
 		title: $(this).data('title'),
 		text: $(this).data('text'),
 		icon: 'warning',
 		showCancelButton: true,
 		confirmButtonColor: '#3085d6',
 		cancelButtonColor: '#d33',
 		confirmButtonText: 'Yes',
 		cancelButtonText: 'No'        
 	}).then((result) => {
 		if (result.value) {
 			window.location.href = $(this).data('action');
 		}
 	})
 }); 

/**
* Payment
*/
$('#form-payment').on('keyup keypress', function(e) {
	var keyCode = e.keyCode || e.which;
	if (keyCode === 13) { 
		e.preventDefault();
		return false;
	}
});
$("#form-payment").submit(function(e) {
	e.preventDefault();

	$("button[type='submit']").prop("disabled", true); /* disable submit button */

	let	payment_method = $("input[name='payment_method']").val(),
	free_code = $("input[name='free_code']").val();

	if (free_code) {
		process_free($("input[name='free_action']").val(),$(this).serialize());
	}
	else if (payment_method == 'Midtrans' && free_code == '') {
		process_midtrans()
	}
	else if (payment_method == 'Manual' && free_code == '') {
		process_manual($("input[name='action']").val(),$(this).serialize());
	}

	$("button[type='submit']").prop("disabled", false);
})

/**
* Payment Free
*/
var process_free = function(url,data){
	$.ajax({
		url: url,
		method: "POST",
		data: data,
		dataType: 'JSON',
		success: function(data) {

			if (data.status == true) {
				window.location.href = data.redirect;
			}else {
				Swal.fire({
					title: data.error,
					icon: 'error',
					confirmButtonColor: '#3085d6',
				})
			}

		},
		error: function(xhr, ajaxOptions, thrownError) {
			Swal.fire({
				title: 'Error Processing !',
				icon: 'error',
				confirmButtonColor: '#3085d6',
			})
		}
	}); 
}

/**
* Payment Manual
*/
var process_manual = function(url,data){
	$.ajax({
		url: url,
		method: "POST",
		data: data,
		dataType: 'JSON',
		success: function(data) {

			if (data.status == true) {

				$("#form-payment").trigger("reset");
				top.location.href = data.redirect;
				
			}else {
				Swal.fire({
					title: data.error,
					icon: 'error',
					confirmButtonColor: '#3085d6',
				})
			}

		},
		error: function(xhr, ajaxOptions, thrownError) {
			Swal.fire({
				title: 'Error Processing !',
				icon: 'error',
				confirmButtonColor: '#3085d6',
			})
		}
	}); 
}

/**
* Payment Midtrans
*/
var process_midtrans = function(){
	let token = $("input[name='token']").val(),
	lang = $("input[name='lang']").val(),
	action = $("input[name='action']").val();

	snap.pay(token, {
		language: lang,
		onSuccess: function(result){
			result['token'] = token;
			insert_order(result,action)	
		},
		onPending: function(result){
			result['token'] = token;
			insert_order(result,action)
		},
		onClose: function(){
			$("button[type='submit']").prop("disabled", false);
			console.log('customer closed the popup without finishing the payment');
		}
	});
}	
var insert_order = function(result,action){


	result.id_courses_user = $("input[name='id_courses_user']").val();
	result.coupon = $("input[name='code']").val();

	$.ajax({
		url: action,
		method: "POST",
		data: JSON.stringify(result),
		contentType: "application/json; charset=utf-8",
		dataType: 'JSON',
		success: function(data) {

			if (data.status == true) {                  

				window.location.href = data.redirect;

			}else {

				Swal.fire({
					title: data.message,
					icon: 'error',
					confirmButtonColor: '#3085d6',
				})

			}

		},
		error: function(xhr, ajaxOptions, thrownError) {

			Swal.fire({
				title: 'Error Processing !',
				icon: 'error',
				confirmButtonColor: '#3085d6',
			})

		}
	}); 
}

/**
* Midtrans Check
*/
$('.btn-check-payment').on('click', function(e) {
	e.preventDefault();

	let  button = $(this),
	token = button.data("token"),
	lang = button.data("lang");

	button.prop("disabled", true);

	snap.pay(token, {
		language: lang,
		onPending: function(result){
			button.prop("disabled", false);			
			check_order(result)	
		},
		onError: function(){
			button.prop("disabled", false);
			return false; 
		},
		onClose: function(){
			button.prop("disabled", false);
			return false; 
		}
	});
});	

var check_order = function(result){

	$.ajax({
		url: result.finish_redirect_url,
		method: "POST",
		data: JSON.stringify(result),
		contentType: "application/json; charset=utf-8",
		dataType: 'JSON',
		success: function(data) {

			if (data.status == true) {                  

				window.location.href = data.redirect;

			}

		},
		error: function(xhr, ajaxOptions, thrownError) {
			Swal.fire({
				title: 'Error Processing !',
				icon: 'error',
				confirmButtonColor: '#3085d6',
			})
		}
	}); 
}

/**
 * Module Coupon
 */
 $('#check-coupon').on('click', function(e) {

 	e.preventDefault();

 	if ($("input[name='code']").val() == '') {
 		$("input[name='code']").focus();
 		return false;
 	}

 	let button = $(this);
 	button.prop("disabled", true);

 	$.ajax({
 		url: button.data('action'),
 		method: "POST",
 		data: $("#form-payment").serialize(),
 		dataType: 'JSON',
 		success: function(data) {

 			if (data.status == 'valid_not_free_manual') {
 				$("input[name='code']").prop("readonly", true); /* set input voucher disable */
 				$("input[name='free_code']").val(''); /* set value input free_code */
 				$("#order-discount-coupon, #remove-coupon").removeClass('u-hidden'); /* show coupon meessage, show remove coupon button */
 				$("#check-coupon").addClass('u-hidden'); /* hide coupon check button */
 				$("#order-discount-coupon > h4").html(data.discount_coupon); /* show discount price */
 				$("#order-price-total").html(data.price_total); /* set price total */
 				$("#coupon-respon").html('<small class="c-field__message u-color-success"><i class="fa fa-check"></i> ' + data.message + '</small>'); 				
 			} 
 			else if (data.status == 'valid_not_free_midtrans') {
 				$("input[name='code']").prop("readonly", true); /* set input voucher disable */
 				$("input[name='free_code']").val(''); /* set value input free_code */
 				$("#order-discount-coupon, #remove-coupon").removeClass('u-hidden'); /* show coupon meessage, show remove coupon button */
 				$("#check-coupon").addClass('u-hidden'); /* hide coupon check button */
 				$("#order-discount-coupon > h4").html(data.discount_coupon); /* show discount price */
 				$("#order-price-total").html(data.price_total); /* set price total */
 				$("input[name='token']").val(data.midtrans_token); /* set input midtrans token */
 				$("#coupon-respon").html('<small class="c-field__message u-color-success"><i class="fa fa-check"></i> ' + data.message + '</small>'); 				
 			}  			
 			else if (data.status == 'valid_to_free') {
 				$("input[name='code']").prop("readonly", true); /* set input voucher disable */
 				$("input[name='free_code']").val(data.free_code); /* set input free code */
 				$("#order-discount-coupon, #remove-coupon").removeClass('u-hidden'); /* show coupon meessage, show remove coupon button */
 				$("#check-coupon").addClass('u-hidden'); /* hide coupon check button */
 				$("#order-discount-coupon > h4").html(data.discount_coupon); /* show discount price */
 				$("#order-price-total").html(data.price_total); /* set price total */
 				$("#coupon-respon").html('<small class="c-field__message u-color-success"><i class="fa fa-check"></i> ' + data.message + '</small>');

 				$("button[type='submit']").prop("disabled", false); /* enable order button */
 			}
 			else if (data.status == 'invalid') {
 				$("#coupon-respon").html('<small class="c-field__message u-color-danger"><i class="fa fa-times-circle"></i> ' + data.message + '</small>');
 			}else {
 				Swal.fire({
 					title: 'Error Processing !',
 					icon: 'error',
 					confirmButtonColor: '#3085d6',
 				})
 			}

 			button.prop("disabled", false);
 		},
 		error: function(xhr, ajaxOptions, thrownError) {
 			Swal.fire({
 				title: 'Error Processing !',
 				icon: 'error',
 				confirmButtonColor: '#3085d6',
 			})
 		}
 	});
 })

 $('#remove-coupon').on('click', function(e) {
 	e.preventDefault();

 	let	payment_method = $("input[name='payment_method']").val();

 	$("input[name='free_code']").val(''); /* remove value free code */
 	$("input[name='code']").val('').prop("readonly", false); /* remove discount price, enable input */
 	$("#order-discount-coupon").addClass('u-hidden'); /* hidden coupon message */
 	$("#order-price-total").html($('#order-price-total').data('price-total')); /* set price total to default */ 				
 	$("#coupon-respon").html(''); /* remove coupon message */

 	if (payment_method == 'Midtrans') {
 		$("input[name='token']").val($("input[name='token']").data('value')); /* set token default */
 	}

 	if (payment_method == 'Manual' && $("input:radio[name=transaction]:checked").val() == undefined) {
 		$("button[type='submit']").prop("disabled", true); /* enable order button */
 	}

 	$("#check-coupon").removeClass('u-hidden'); /* show check coupon button */
 	$("#remove-coupon").addClass('u-hidden'); /* hidden remove coupon button */
 });

 /**
 * Module transaction
 */
 $('input:radio[name="transaction"]').change(function(){
 	if($(this).is(":checked")){
 		$("button[type='submit']").prop("disabled", false); /* disable order button */
 	}
 });

/**
* Module confirmation
*/
$(".custom-input-file-trigger").on( "keydown", function( event ) {  
	if ( event.keyCode == 13 || event.keyCode == 32 ) {  
		$(".custom-input-file").click();  
	}  
});
$(".custom-input-file-trigger").on( "click", function( event ) {
	$(".custom-input-file").click();
	return false;
});  
$(".custom-input-file").on( "change", function( event ) {  

	var reader = new FileReader();
	reader.onload = function(){
		$(".file-return").attr('src',reader.result);
	};

	reader.readAsDataURL(event.target.files[0]);
});  

/**
 * Module rating
 */
 $(document).ready(function(){

 	/* pagination */
 	$('.btn-review-pagination').on('click', function(e) {

 		e.preventDefault();

 		$(this).html('<img src="data:image/gif;base64,R0lGODlhKwALAPAAAKrD2AAAACH5BAEKAAEAIf4VTWFkZSBieSBBamF4TG9hZC5pbmZvACH/C05FVFNDQVBFMi4wAwEAAAAsAAAAACsACwAAAjIMjhjLltnYg/PFChveVvPLheA2hlhZoWYnfd6avqcMZy1J14fKLvrEs/k+uCAgMkwVAAAh+QQBCgACACwAAAAAKwALAIFPg6+qw9gAAAAAAAACPRSOKMsSD2FjsZqEwax885hh3veMZJiYn8qhSkNKcBy4B2vNsa3pJA6yAWUUGm9Y8n2Oyk7T4posYlLHrwAAIfkEAQoAAgAsAAAAACsACwCBT4OvqsPYAAAAAAAAAj1UjijLAg9hY6maalvcb+IPBhO3eeF5jKTUoKi6AqYLwutMYzaJ58nO6flSmpisNcwwjEfK6fKZLGJSqK4AACH5BAEKAAIALAAAAAArAAsAgU+Dr6rD2AAAAAAAAAJAVI4oy5bZGJiUugcbfrH6uWVMqDSfRx5RGnQnxa6p+wKxNpu1nY/9suORZENd7eYrSnbIRVMQvGAizhAV+hIUAAA7"/>');
 		var link = $(".c-pagination__item.news .c-pagination__link").attr('href');
 		if (link == undefined) {
 			$(".btn-review-pagination").remove();
 		}else {
 			$.ajax({
 				url : link,
 				dataType: 'html',
 				success: function(data){
 					var source = $(data).find('.review-content').length ? $(data) : $('<div></div>');
 					var el = $(source.find('.review-content').html());

 					setTimeout(function () {
 						$(".review-content").append(el);
 						$(".c-pagination__item.news").html(source.find('.c-pagination__item.news .c-pagination__link').clone());
 						$(".btn-review-pagination").html($(".btn-review-pagination").data('text'));
 						if (source.find('.c-pagination__item.news .c-pagination__link').length < 1) {
 							$(".btn-review-pagination").remove();
 						}
 					}, 100);

 				}
 			})       
 		} 
 	});	  	

 	/* 1. Visualizing things on Hover - See next part for action on click */
 	$('#stars li').on('mouseover', function(){
 		var onStar = parseInt($(this).data('value'), 10); 

 		$(this).parent().children('li.star').each(function(e){
 			if (e < onStar) {
 				$(this).addClass('hover');
 			}
 			else {
 				$(this).removeClass('hover');
 			}
 		});

 	}).on('mouseout', function(){
 		$(this).parent().children('li.star').each(function(e){
 			$(this).removeClass('hover');
 		});
 	});


 	/* 2. Action to perform on click */
 	$('#stars li').on('click', function(){
 		var onStar = parseInt($(this).data('value'), 10); 
 		var stars = $(this).parent().children('li.star');

 		for (i = 0; i < stars.length; i++) {
 			$(stars[i]).removeClass('selected');
 		}

 		for (i = 0; i < onStar; i++) {
 			$(stars[i]).addClass('selected');
 		}

 		var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);

 		$("#rating-input").val(ratingValue);
 	});

 	$('.btn-review').on('click', function(e) {
 		e.preventDefault();

 		$("#textarea-review").val(''); 

 		$('#form-review').on('shown.bs.modal', function() {
 			$("#textarea-review").focus();
 		})

 		let form_data = [];
 		form_data.push({ name: "id_courses", value: $(this).data('id') });

 		$.ajax({
 			url: $(this).data('action'),
 			method: "POST",
 			data: form_data,
 			dataType: 'JSON',
 			success: function(data) {



 				$("#textarea-review").val(data.review); 

 				/* update rating */
 				var onStar = data.rating; 
 				var stars = $("#stars li").parent().children('li.star');

 				for (i = 0; i < stars.length; i++) {
 					$(stars[i]).removeClass('selected');
 				}

 				for (i = 0; i < onStar; i++) {
 					$(stars[i]).addClass('selected');
 				}

 				$("#rating-input").val(data.rating);
 			}
 		});

 	});

 	$("#form-review").submit(function(e) {
 		e.preventDefault();

 		$("button[type='submit']").prop("disabled", true); /* disable submit button */

 		$.ajax({
 			url: $(this).data('action'),
 			method: "POST",
 			data: $(this).serialize(),
 			dataType: 'JSON',
 			success: function(data) {

 				if (data.status) {

 					Swal.fire({
 						title: data.message,
 						icon: 'success',
 						confirmButtonColor: '#3085d6',
 						timer: 1000
 					})
 					.then((result) => {

 						/* close modal */
 						$('.modal').each(function() {
 							$(this).modal('hide');
 						});

 					}) 
 				}else{
 					Swal.fire({
 						title: data.message,
 						icon: 'error',
 						confirmButtonColor: '#3085d6',
 						timer: 1000
 					})
 				}

 				$("button[type='submit']").prop("disabled", false);


 			},
 			error: function(xhr, ajaxOptions, thrownError) {

 				Swal.fire({
 					title: 'Error Processing !',
 					icon: 'error',
 					confirmButtonColor: '#3085d6',
 				})

 				$("button[type='submit']").prop("disabled", false);
 			}
 		}); 

 	})

 });
// jQuery(document).ready(function($) {
//     console.log( "Require!" );

//     var ticky = $('#edd_mailchimp_signup');
//     var button = $('#edd-purchase-button');
//     var fieldset = $('#edd_mailchimp');
//     var msg = '<p id="mailchimp-required-alert" class="alert">Es requisito inscribirte en nuestra lista de correos para aplicar el descuento.</p>';
//     var discount_btn = $('.edd-apply-discount');

//     ticky.change(function() {
//  		if($(this).is(':checked')){
//         	console.log("CCCCheckeddddddd");
//         	button.prop("disabled",false);
//           $('#mailchimp-required-alert').remove();

//         	// msg.removeClass('alert');

//        	} else {
//            	console.log("UNCheckeddddddd");


//             var discount = $('.edd_discount_rate').text();
//             console.log('discount is '+discount);
//             var pattern = /PREVENTA2016/;
//             var exists = pattern.test(discount);
//             if ( exists ) {
//               console.log('yes');
//               button.prop("disabled",true);
//               fieldset.append(msg);
//             }
//            	// msg.addClass('alert');
// 		}
//     });

// });
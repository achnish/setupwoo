<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
 
    $parent_style = 'parent-style'; 
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
/*add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', PHP_INT_MAX);
function enqueue_child_theme_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}
*/


add_action('wp_footer', 'add_action_data_second', 10, 3);
function add_action_data_second() {

	?>

<div class="callout-wrapper " style="margin-right: -455px;">
    <div class="cta-buttons">
        <div class="cta-brochure popBrochure" data-callout="brochure-callout"><span>Brochure</span></div>
        <div class="cta-enquiry popEnquiry" data-callout="enquiry-callout"><span>Enquiry</span></div>
    </div>

    <div class="cta-callout">



        <div id="brochure-callout" class="callout" style="position: inherit; padding-top: 28.5px;display: none;">
            <!-- <div class="cta-buttons cta-buttons-cross"> -->
                <div class="cta-brochure brochure-callout mobile-cross" data-callout="brochure-callout">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </div>
            <!-- </div> -->
            <div class="div-brocher-form">
            <?php // Use shortcode in a PHP file (outside the post editor).
	echo do_shortcode('[contact-form-7 id="3298" title="Brochure Form"]');
	?>
            </div>
            <div class="div-postal-form" style="display:none">
            <?php // Use shortcode in a PHP file (outside the post editor).
	echo do_shortcode('[contact-form-7 id="7973" title="Postal Brochure Form"]');

	?>
            </div>
        </div>
        <div id="enquiry-callout" class="callout" style="display: block; position: inherit;display: none;">
            <!-- <div class="cta-buttons cta-buttons-cross"> -->
                <div class="cta-enquiry enquiry-callout mobile-cross" data-callout="enquiry-callout">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </div>
            <!-- </div> -->
            <?php // Use shortcode in a PHP file (outside the post editor).
	echo do_shortcode('[contact-form-7 id="3299" title="Enquiry Form"]');
	?>
        </div>

    </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($) {
    jQuery('.how-other-one').hide();
    jQuery('.how-other-two').hide();
    jQuery('.how-other-three').hide();

    jQuery(".how-about-first").live("change", function(){
        $countrydropdown    = jQuery(this).val();
        //$othervalue         = jQuery('.other-value').val();
        if($countrydropdown == 'Other'){
           jQuery('.how-other-one').show();
        }else{
           jQuery('.how-other-one').hide();
        }
    });
    jQuery(".how-about-two").live("change", function(){
        $countrydropdown    = jQuery(this).val();
        //$othervalue         = jQuery('.other-value').val();
        if($countrydropdown == 'Other'){
           jQuery('.how-other-two').show();
        }else{
           jQuery('.how-other-two').hide();
        }
    });
    jQuery(".how-about-theree").live("change", function(){
        $countrydropdown    = jQuery(this).val();
        //$othervalue         = jQuery('.other-value').val();
        if($countrydropdown == 'Other'){
           jQuery('.how-other-three').show();
        }else{
           jQuery('.how-other-three').hide();
        }
    });

    // jQuery(".how-about-two").live("change", function(){
    //     $countrydropdown    = jQuery(this).val();
    //     //$othervalue         = jQuery('.other-value').val();
    //     if($countrydropdown == 'Other'){
    //        jQuery('.how-other-two').show();
    //     }else{
    //        jQuery('.how-other-two').hide();
    //     }
    //  });

    jQuery( ".other-form-postal" ).live( "click", function() {
     //alert( "Goodbye!" ); // jQuery 1.3+
       // jQuery('#brochure-callout').fadeIn(500);
        jQuery('.div-brocher-form').hide();
        jQuery('.div-postal-form').fadeIn(500);

       // jQuery('#brochure-callout').html(jQuery('.post-callout-form').html());
    });
    jQuery( ".other-form-brocher" ).live( "click", function() {
        jQuery('.div-postal-form').hide();
        jQuery('.div-brocher-form').fadeIn(500);

       // jQuery('.brochure-callout').fadeIn(500);
       // jQuery('.brochure-callout').html(jQuery('.brochure-callout-form').html());
    });
    var containerwidth = jQuery(".callout-wrapper").outerWidth();
    jQuery('.callout-wrapper').animate({
        marginRight: "-"+containerwidth+"px"
    }, 500, function() {
        jQuery('.callout').hide()
    });
    if ($(window).width() < 800){
// do stuff
   /*jQuery('.callout-wrapper').animate({
        marginRight: "0px",
        width:"100%"
    }, 500);*/
   // jQuery('.cta-buttons').css('margin-left','-50px');

    }
    jQuery(".bcta-salutation-two option:first").val('');
    jQuery(".bcta-salutation option:first").val('');
    jQuery(".bcta-salutation1 option:first").val('');
    jQuery("#holiday-budget option:first").val('');
    jQuery(".00N30000004L3a1 option:first").val('');
    jQuery(".how-about option:first").val('');

    jQuery(".how-about-first option:first").val('');
    jQuery(".how-about-two option:first").val('');
    jQuery(".how-about-one option:first").val('');
    jQuery(".how-about-theree option:first").val('');
   // jQuery(".N29999994L3a1 option:first").val('');
    jQuery("#holiday-budget option:first").val('');

// jQuery( ".popBrochure" ).click(function() {
//     jQuery('#brochure-callout').show();
//     jQuery('#enquiry-callout').hide();
// });
// jQuery( ".popEnquiry" ).click(function() {
//      jQuery('#brochure-callout').hide();
//      jQuery('#enquiry-callout').show();
// });
var calloutExpanded = false,
    ctaURLs = {
        'brochure-callout-form': '/brochurerequest',
        'enquiry-callout-form': '/contactus',
        'brochureForm-thanks': '/brochure',
        'enquiryForm-thanks': '/contactus-thanks',
        'newsletter_form-thanks': '/'
    },
    ctaTitles = {
        'brochure-callout-form': 'Request a brochure | Powder Byrne',
        'brochureForm-thanks': 'Thank you | Powder Byrne',
        'enquiry-callout-form': 'Contact Us | Powder Byrne',
        'enquiryForm-thanks': 'Thank you | Powder Byrne'
    },
    ctaPixels = {
        'brochure-callout-shown': 'https://mpp.emea.mxptint.net/2/18017/?rnd=%n',
        'brochureForm-submitted': 'https://mpp.emea.mxptint.net/2/18324/?rnd=%n',
        'enquiry-callout-shown': 'https://mpp.emea.mxptint.net/2/17601/?rnd=%n',
        'enquiryForm-submitted': 'https://mpp.emea.mxptint.net/2/18323/?rnd=%n'
    },
    hash = window.location.hash;
    if (hash == "#brochure") setTimeout(function(e) {
        jQuery('.popBrochure').trigger('click')
    }, 500);
    if (hash == "#enquiry") setTimeout(function(e) {
        jQuery('.popEnquiry').trigger('click')
    }, 500);

var flag = 0;
jQuery("a[href='/#enquiry']").click(function(e){
	e.preventDefault();
	var hashnew = $(this).prop("hash");

/*	if(hashnew == "#brochure"){
		jQuery('.popBrochure').trigger('click'); 
		return false;
	}
*/
	if(hashnew == "#enquiry"){
		jQuery('.popEnquiry').trigger('click'); 
		return false;
	}
});



jQuery(".mobile-cross").click(function(){
	var containerwidth = jQuery(".callout-wrapper").outerWidth();
    $('.callout-wrapper').animate({
            marginRight: "-"+containerwidth+"px"
        }, 500, function() {
            $('.callout').hide()
        })
});
jQuery('.cta-buttons div').on('click', function(e) {
	var containerwidth = jQuery(".callout-wrapper").outerWidth();
    var button = jQuery(e.target),
        callout = button.is('div') ? button.attr('data-callout') : button.parent().attr('data-callout'),
        height = jQuery(window).height();
        jQuery('#enquiryForm .thanks').hide();
        jQuery('#enquiry-callout').css('position', 'inherit');
        jQuery('#brochureForm .thanks').hide();
        jQuery('#brochure-callout').css('position', 'inherit');

        if ($('#' + callout).is(':visible')) {
        $('.callout-wrapper').removeClass('isExpand');
        $('.callout-wrapper').animate({
            marginRight: "-"+containerwidth+"px"
        }, 500, function() {
            $('.callout').hide()
        })
        } else {
                 $('.callout-wrapper').addClass('isExpand');
        $('.callout').hide();
        $('#' + callout).show();
        // $('#' + callout).css('paddingTop', (height - $('#' + callout + ' form').height()) / 2);
        // history.pushState({}, ctaTitles[callout + '-form'], ctaURLs[callout + '-form']);
        $('.callout-wrapper').animate({
            marginRight: "0px"
        }, 500);
        if (ctaPixels[callout + '-shown'] != '') {
            var img = $('<img style="display: none;">');
            img.attr('src', ctaPixels[callout + '-shown']);
            img.appendTo('body');
            ctaPixels[callout + '-shown'] = '';
            if (callout == 'enquiry-callout') fbq('track', "PageView")
        }
        }

   /* if (jQuery('#' + callout).is(':visible')) {
        jQuery('.callout-wrapper').animate({
            marginRight: "-350px"
        }, 500, function() {
            jQuery('.callout').hide()
        })
    } else {
        jQuery('.callout').hide();
        jQuery('#' + callout).show();
        jQuery('#' + callout).css('paddingTop', (height - jQuery('#' + callout + ' form').height()) / 2);
        //history.pushState({}, ctaTitles[callout + '-form'], ctaURLs[callout + '-form']);
        jQuery('.callout-wrapper').animate({
            marginRight: "0px"
        }, 500);
        if (ctaPixels[callout + '-shown'] != '') {
            var img = jQuery('<img style="display: none;">');
            img.attr('src', ctaPixels[callout + '-shown']);
            img.appendTo('body');
            //ctaPixels[callout + '-shown'] = '';
            //if (callout == 'enquiry-callout') fbq('track', "PageView")
        }
    } */
});
});
</script>
<?php
}
add_action('wpcf7_before_send_mail', 'wpcf7_add_text_to_mail_body', 10);
function wpcf7_add_text_to_mail_body($contact_form) {
	//print_r($contact_form);
	//$wpcf = WPCF7_ContactForm::get_current();
	$form_id = $_POST['_wpcf7'];
	if ($form_id == 3298) {
		unset($_POST['_wpcf7']);
		unset($_POST['_wpcf7_version']);
		unset($_POST['_wpcf7_locale']);
		unset($_POST['_wpcf7_unit_tag']);
		unset($_POST['_wpcf7_container_post']);
		unset($_POST['g-recaptcha-response']);
		$_POST['00N30000004L3a1'] = $_POST['N30000004L3a1'];
		if ($_POST['N30000004L3a1'] == 'Other') {
			$_POST['00N30000004L3a1'] = $_POST['other'];
		}
		
		unset($_POST['N30000004L3a1']);
		
		if ($_POST['emailOptOut'] == 'Yes please') {
			$_POST['emailOptOut'] = 0;
		} else {
			$_POST['emailOptOut'] = 1;
		}
		
	}
	if ($form_id == 3299) {
		unset($_POST['_wpcf7']);
		unset($_POST['_wpcf7_version']);
		unset($_POST['_wpcf7_locale']);
		unset($_POST['_wpcf7_unit_tag']);
		unset($_POST['_wpcf7_container_post']);
		unset($_POST['g-recaptcha-response']);
		$_POST['00N30000004L3a1'] = $_POST['N30000004L3a1'];
		$_POST['00N30000004L3Zx'] = $_POST['N30000004L3Zx'];
		if ($_POST['N30000004L3a1'] == 'Other') {
			$_POST['00N30000004L3a1'] = $_POST['other'];
		}
		
		
		$_POST['00N30000004L3aV'] = $_POST['N30000004L3aV'];
		unset($_POST['N30000004L3a1']);
		unset($_POST['N30000004L3aV']);
		
		if ($_POST['emailOptOut'] == 'Yes please') {
			$_POST['emailOptOut'] = 0;
		} else {
			$_POST['emailOptOut'] = 1;
		}
	}
	if ($form_id == 7973) {
		unset($_POST['_wpcf7']);
		unset($_POST['_wpcf7_version']);
		unset($_POST['_wpcf7_locale']);
		unset($_POST['_wpcf7_unit_tag']);
		unset($_POST['_wpcf7_container_post']);
		unset($_POST['g-recaptcha-response']);
		$_POST['00N30000004L3a1'] = $_POST['N30000004L3a1'];
		if ($_POST['N30000004L3a1'] == 'Other') {
			$_POST['00N30000004L3a1'] = $_POST['other'];
		}
		if ($_POST['emailOptOut'] == 'Yes please') {
			$_POST['emailOptOut'] = 0;
		} else {
			$_POST['emailOptOut'] = 1;
		}
		unset($_POST['N30000004L3a1']);
	}

	$http_codes = array(
		100 => 'Continue',
		101 => 'Switching Protocols',
		102 => 'Processing',
		200 => 'OK',
		201 => 'Created',
		202 => 'Accepted',
		203 => 'Non-Authoritative Information',
		204 => 'No Content',
		205 => 'Reset Content',
		206 => 'Partial Content',
		207 => 'Multi-Status',
		300 => 'Multiple Choices',
		301 => 'Moved Permanently',
		302 => 'Found',
		303 => 'See Other',
		304 => 'Not Modified',
		305 => 'Use Proxy',
		306 => 'Switch Proxy',
		307 => 'Temporary Redirect',
		400 => 'Bad Request',
		401 => 'Unauthorized',
		402 => 'Payment Required',
		403 => 'Forbidden',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		406 => 'Not Acceptable',
		407 => 'Proxy Authentication Required',
		408 => 'Request Timeout',
		409 => 'Conflict',
		410 => 'Gone',
		411 => 'Length Required',
		412 => 'Precondition Failed',
		413 => 'Request Entity Too Large',
		414 => 'Request-URI Too Long',
		415 => 'Unsupported Media Type',
		416 => 'Requested Range Not Satisfiable',
		417 => 'Expectation Failed',
		418 => 'I\'m a teapot',
		422 => 'Unprocessable Entity',
		423 => 'Locked',
		424 => 'Failed Dependency',
		425 => 'Unordered Collection',
		426 => 'Upgrade Required',
		449 => 'Retry With',
		450 => 'Blocked by Windows Parental Controls',
		500 => 'Internal Server Error',
		501 => 'Not Implemented',
		502 => 'Bad Gateway',
		503 => 'Service Unavailable',
		504 => 'Gateway Timeout',
		505 => 'HTTP Version Not Supported',
		506 => 'Variant Also Negotiates',
		507 => 'Insufficient Storage',
		509 => 'Bandwidth Limit Exceeded',
		510 => 'Not Extended',
	);
	// For testing...
	// $http_code = 200;
	// header('HTTP/1.1 '.$http_code.' '.\TFN\V($http_codes, $http_code, '500 Internal Server Error'));
	// exit;

	// Reverse the emailOptOut field because the form is opt in!

//      $_POST['emailOptOut'] = \TFN\V($_POST, 'emailOptOut', 1) ? 0 : 1;

	//$function = 'validate_'.$form;
	$res = true;
	// if (function_exists($function)) {
	//  $res = $function($_POST);
	// }
	if ($res === true) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$res = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		$res = '';
	} else {
		$http_code = 400;
		$res = 'error500';
		$error = true;
		$err_msg = '<p class="error">Something Went Wrong during submission.<p>';

	}
	if (empty($http_codes[$http_code])) {
		$http_code = 500;
		$error = true;
		$err_msg = '<p class="error">Something Went Wrong during submission.<p>';

	} elseif ($http_code == 200) {
		$http_code = 202;
		$res = 'successful';
		?>
    <?php
	}
	//$contact_form->skip_mail = true;
	// return $wpcf;
	//echo $http_code;
	$error = true;
	if (isset($error) && $error === true) {
		$msgs = $contact_form->prop('messages');
		$msgs['mail_sent_ok'] = $err_msg;
		$contact_form->set_properties(array('messages' => $msgs));
		add_filter('wpcf7_skip_mail', 'abort_mail_sending');
	}
	return $contact_form;
	//wp_die();

}
add_action('wpcf7_before_send_mail', 'wpcf7_register_user');

function abort_mail_sending($contact_form) {
	return true;
}

// // add the action

add_action('wp_footer', 'redirect_cf7');

//add_action( 'wpcf7_submit', 'action_wpcf7_submit', 10, 2 );

function redirect_cf7() {
?>
<script type="text/javascript">
 document.addEventListener( 'wpcf7mailsent', function( event ) {
    if ( '3298' == event.detail.contactFormId ) { // Sends sumissions on form 947 to the first thank you page
         location = 'https://www.powderbyrne.com/brochure'; //brochure form
     } else if ( '3299' == event.detail.contactFormId ) { // Sends submissions on form 1070 to the second thank you page
         location = 'https://www.powderbyrne.com/enquiry-thank-you/';  // enquiry form
     }else if ( '7973' == event.detail.contactFormId ) { // Sends submissions on form 1070 to the second thank you page
         location = 'https://www.powderbyrne.com/brochure-thank-you'; //postalform
     }

 }, false );
</script>
<?php
}

add_action('plethora_header_main', 'header_code_adda', 10);
function header_code_adda() {
// if(isset($_REQUEST['admin'])){ ?>
    <div class="tel-search-div">
        <div class="telephone">
            <a href="tel:02082465300">
                <span>CALL 020 8246 5300</span>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/phone-call.png" style="display: none;">
            </a>
        </div>
        <div class="search-box">
            <input id="searchBox" type="text" placeholder="search" />
        </div>
    </div>
<?
	//  }
}
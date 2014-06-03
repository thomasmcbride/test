// DOM Ready
$(function() {
	
	// SVG fallback
	// toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script#update
	if (!Modernizr.svg) {
		var imgs = document.getElementsByTagName('img');
		var dotSVG = /.*\.svg$/;
		for (var i = 0; i != imgs.length; ++i) {
			if(imgs[i].src.match(dotSVG)) {
				imgs[i].src = imgs[i].src.slice(0, -3) + "png";
			}
		}
	}

});


(function ( $ ) {

	$(function () {

		/**
		* Click function to show/hide the mobile menu
		**/
		$('a.mobile-menu-btn').on('click', function(event) {
			event.preventDefault();
			$('nav.mobile-nav').toggle('slide');
		});


	});

}(jQuery));


function contactForm(template, uri) {
	/**
	 * Validate the contact form and post to contact-mail.php
	 * @return json data
	 */
	
	var contactForm = $('.formSubmit');

	contactForm.submit(function(event) {
		event.preventDefault();

		var submitButton = $(this).children('input[type=submit]');

		if ($(contactForm).parsley('validate') ) {
            var formData = $(contactForm).serialize();
            $('img.loader2').show();
            $('.formSubmit input[type=submit]').hide();
            $.ajax({
				  url: template+'/logic/contact-mail.php',
				  type: 'POST', 
				  dataType: 'json',
				  data: formData,
				  success: function(data) {
					  if (data.status == 'error') { 	
							console.log(data.message);
							$('img.loader2').hide();
							$(submitButton).show();
					  } // end if		
					  else  { 
					  		window.location = uri+'/thank-you';
					  } // end else		 
			 	  },
				dataType: 'json'
			}); 			
        }
	});

}
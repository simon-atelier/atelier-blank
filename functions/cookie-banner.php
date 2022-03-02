<?php
function at_cookie_banner() {
	$cookie_banner = '<div class="cookie_consent_container">
		<div class="cookie_consent">
			<div class="cookie_consent_left">
				<p class="cookie_consent_title">We use cookies on this website to enhance your user experience</p>
				<p class="cookie_consent_text">By clicking any link on this page you are giving your consent for us to set cookies</p>
			</div>
			<div class="cookie_consent_right">
				<p class="cookie_consent_buttons"><a class="button cookieConsent">Continue</a> <a href="' . get_bloginfo('url') . '/privacy-policy" class="button">Privacy Policy</a></p>
			</div>
		</div>
	</div>';

	echo $cookie_banner;
}

add_action('atelier_after_content', 'at_cookie_banner', 10);
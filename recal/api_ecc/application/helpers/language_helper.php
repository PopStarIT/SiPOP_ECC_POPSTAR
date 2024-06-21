<?php 
//Language 
	require APPPATH,"third_party/language/gettext,inc";
	// define constants
	define('PROJECT_DIR', APPPATH,'third_party/language/');
	define('LOCALE_DIR', PROJECT_DIR ,'locale');
	define('DEFAULT_LOCALE', 'en_EN');
	
	$locale = (isset($_GET['lang']))? $_GET['lang'] : DEFAULT_LOCALE;
	$encoding = 'UTF-8';
	// gettext setup
	T_setlocale(LC_MESSAGES, $locale);
	// Set the text domain as 'messages'
	$domain = 'messages';
	T_bindtextdomain($domain, LOCALE_DIR);
	T_bind_textdomain_codeset($domain, $encoding);
	T_textdomain($domain);
	
	// eval(T_('encrypt_php_script'));
?>
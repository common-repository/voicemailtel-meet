<?php

class VMTPublic
{
	public function __construct()
	{
		$this->enqueue_html();
		$this->enqueue_scripts();
		$this->enqueue_styles();
	}

	public function enqueue_styles()
	{
		wp_enqueue_style( 'public_css_style', plugin_dir_url(__FILE__) . '/css/vmtPublicStyle.css' );
	}

	public function enqueue_scripts()
	{
		wp_enqueue_script( 'public_min_script', plugin_dir_url(__FILE__) . '../includes/jQuery/jquery.min.js' );
		wp_enqueue_script( 'public_js_script', plugin_dir_url(__FILE__) . '/js/vmtPublicScript.js' );
	}

	public function enqueue_html()
	{
		include_once( plugin_dir_path(__FILE__) . '/html/vmtPublicHtml.php' );
		vmtMeetWpPhpPublicDesign();
	}
}
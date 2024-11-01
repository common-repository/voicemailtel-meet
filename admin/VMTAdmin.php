<?php

class VMTAdmin
{
	public function __construct()
	{
		$this->enqueue_html();
		$this->enqueue_scripts();
		$this->enqueue_styles();
	}

	public function enqueue_styles()
	{
		wp_enqueue_style('admin_css_style', plugin_dir_url(__FILE__) . '/css/vmtAdminStyle.css');
	}

	public function enqueue_scripts()
	{
		wp_enqueue_script('admin_min_script', plugin_dir_url(__FILE__) . '../includes/jQuery/jquery.min.js');
		wp_enqueue_script('admin_js_script', plugin_dir_url(__FILE__) . '/js/vmtAdminScript.js');
	}

	public function enqueue_html()
	{
		include_once(plugin_dir_path(__FILE__) . '/html/vmtAdminHtml.php');
		vmtMeetWpPhpAdminDesign();
	}
}
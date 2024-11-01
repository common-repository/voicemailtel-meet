<?php

/**
 * During plugin activation
 * 
 * */

class VMTPluginActivator
{
	public static function activate()
	{
		flush_rewrite_rules();
	}
}
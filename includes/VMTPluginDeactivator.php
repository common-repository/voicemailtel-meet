<?php

/**
 * Called during plugin deactivation
 *  
 * 
 */

class VMTPluginDeactivator
{
    public static function deactivate()
    {
        flush_rewrite_rules();
    }
}
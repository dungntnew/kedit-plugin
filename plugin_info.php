<?php

class plugin_info{
static $PLUGIN_CODE           = "SamplePlugin";
    static $PLUGIN_NAME       = "SamplePlugin";
    static $PLUGIN_VERSION    = "1.1";
    static $COMPLIANT_VERSION = "2.12.3en-p1,2.12.3en-p2";
    static $AUTHOR            = "Your Name";
    static $DESCRIPTION       = "My sample plug-in";
    static $PLUGIN_SITE_URL   = "http://example.com";
    static $AUTHOR_SITE_URL   = "http://example.com";
//The class name is very important. You will write your code in the class you define here.
    static $CLASS_NAME       = "plg_SamplePlugin";  
   //***Add hook points here***
    static $HOOK_POINTS       = array(
	        array("prefilterTransform", 'prefilterTransform'),
		array("LC_Page_Products_Detail_action_after", 'dataafter'));
    static $LICENSE        = "LGPL";
}
?>
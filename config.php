<?php
require_once PLUGIN_UPLOAD_REALDIR .  'SamplePlugin/LC_Page_Plugin_SamplePluginConfig.php';

$objPage = new LC_Page_Plugin_SamplePluginConfig();
register_shutdown_function(array($objPage, 'destroy'));
$objPage->init();
$objPage->process();
?>

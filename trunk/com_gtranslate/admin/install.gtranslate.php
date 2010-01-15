<?php
defined("_JEXEC") or die("Restricted access");

// installing module
$module_installer = new JInstaller;
if($module_installer->install(dirname(__FILE__).DS.'module'))
    echo 'Module installed successfully', '<br />';
else
    echo 'Module installaltion failed', '<br />';
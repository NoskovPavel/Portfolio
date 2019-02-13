<?php 
if( ! defined('WP_UNINSTALL_PLUGIN') )
	exit;

delete_option('wpcumulus_options');
delete_option('wpcumulus_widget');

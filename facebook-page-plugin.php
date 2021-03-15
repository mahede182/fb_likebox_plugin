<?php
/*plugin Name: facebook page plugin
description: Shows a facebook page plugin(likebox)
version: 1.00
author: practice mode
*/

// exit if accessed directly
if(!defined('ABSPATH')){
    exit;
}

// load script
require_once(plugin_dir_path(__FILE__).'/includes/facebook-page-plugin-scripts.php');

// load all classes
require_once(plugin_dir_path(__FILE__).'/includes/facebook-page-plugin-class.php');

// register the widgets
function register_facebook_page_plugin(){
    register_widget('facebook_page_plugin_widget');
}
add_action('widgets_init','register_facebook_page_plugin');



?>
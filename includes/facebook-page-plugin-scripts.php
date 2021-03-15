<?php
// add script
function fpp_add_script(){
    wp_enqueue_style('fpp-main-style',plugins_url().'/facebook-page-plugin/css/style.css');
    wp_enqueue_script('fpp-main-script',plugins_url().'/facebook-page-plugin/js/main.js');
    
    wp_enqueue_script( 'fpp-fb-likebox', 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0');
}
add_action('wp_enqueue_scripts', 'fpp_add_script');

?>
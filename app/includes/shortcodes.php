<?php

add_shortcode('authorizator_page', 'authorizator_page_view_function');
function authorizator_page_view_function()
{
    require plugin_dir_path(__FILE__) . '/../templates/index.php';
}

<?php

add_action('wp_enqueue_scripts', 'authorizator_scripts');
function authorizator_scripts()
{

        wp_enqueue_style('authorizator-style', AUTHORIZATOR_PLUGIN_URI . '/app/assets/authorizator.css');
        wp_enqueue_script('authorizator-script', AUTHORIZATOR_PLUGIN_URI . '/app/assets/authorizator.js', array('jquery'), false, true);
        wp_localize_script('authorizator-script', 'myAction', array('url' => admin_url('admin-ajax.php')));

}

/**
 * User register
 */
add_action('wp_ajax_register', 'authorizator_register_function');
add_action('wp_ajax_nopriv_register', 'authorizator_register_function');
function authorizator_register_function()
{
    $register = (new \Authorizator\classes\Register())->register();
    wp_send_json($register);
    wp_die();
}


/**
 * User authorization
 */
add_action('wp_ajax_login', 'authorizator_login_function');
add_action('wp_ajax_nopriv_login', 'authorizator_login_function');
function authorizator_login_function()
{
    $login = (new \Authorizator\classes\Login())->login();
    wp_send_json($login);
    wp_die();
}

/**
 * Update user data
 */
add_action('wp_ajax_update', 'authorizator_update_function');
add_action('wp_ajax_nopriv_update', 'authorizator_update_function');
function authorizator_update_function()
{
    $update = (new \Authorizator\classes\User())->update();
    wp_send_json($update);
    wp_die();
}

/**
 * Update password
 */
add_action('wp_ajax_password', 'authorizator_password_function');
add_action('wp_ajax_nopriv_password', 'authorizator_password_function');
function authorizator_password_function()
{
    $password = (new \Authorizator\classes\Password())->password();
    wp_send_json($password);
    wp_die();
}

/**
 * User logout
 */
add_action('plugins_loaded', 'authorizator_logout_function');
function authorizator_logout_function()
{
    $user = wp_get_current_user();
    if(isset($user->ID) && $user->ID && isset($_GET['user_id']) && $user->ID == $_GET['user_id']
    && isset($_GET['logout']) && $_GET['logout']) {
        wp_logout();
        wp_redirect(home_url());
        exit();
    }
}


/**
 * Upload file
 */
add_action('wp_ajax_upload_file', 'authorizator_upload_file_function');
add_action('wp_ajax_nopriv_upload_file', 'authorizator_upload_file_function');
function authorizator_upload_file_function()
{
    $upload = (new \Authorizator\classes\Upload())->upload();
    wp_send_json($upload);
    wp_die();
}

/**
 * Delete user avatar if user has been deleted
 */
add_action( 'delete_user', 'authorizator_deleted_user_action', 10, 3 );
function authorizator_deleted_user_action($id, $reassign, $user)
{

    if($avatar = get_user_meta($id, '_avatar', true)){
        $path = wp_upload_dir()['basedir'] . "/authorizator/$id";
        $file = $path . '/' . $avatar;

        if(file_exists($file)){
           $delete = unlink($file);
           if($delete){
               rmdir($path);
           }
        }
    }
}





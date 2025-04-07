

<div class="auth-page-content">

    <div class="auth-wrap">

        <?php if(is_user_logged_in()){
            require plugin_dir_path(__FILE__) . 'details.php';
        } else {
            require plugin_dir_path(__FILE__) . 'forms.php';
        } ?>

    </div>
</div>
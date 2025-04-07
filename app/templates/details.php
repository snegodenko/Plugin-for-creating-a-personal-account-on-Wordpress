<?php

$user = \Authorizator\classes\User::userData();

?>
<div class="auth-profile">

    <h1 class="auth-title">Details</h1>
    <a href="?logout=true&user_id=<?php echo $user->id; ?>" class="logout">Logout</a>
    <div class="auth-details">

        <div class="auth-avatar">
            <form id="avatar" class="auth-form" action="" enctype="multipart/form-data">
                <label for="file">
                    <div class="avatar-image">
                        <img src="<?php echo $user->avatar; ?>" alt="Avatar">
                        <div class="avatar-image-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                            </svg>
                        </div>
                    </div>
                    <input type="file" name="file" id="file">
                </label>
                <div class="form-mess"></div>
            </form>

        </div>
        
        <div class="auth-settings">

        <div class="auth-details">

            <form id="details" action="" class="auth-form">
                <div class="auth-form-row">
                    <div class="auth-form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="<?php echo $user->name; ?>">
                    </div>
                    <div class="auth-form-group">
                        <label for="surname">Surname</label>
                        <input type="text" name="surname" value="<?php echo $user->last_name; ?>">
                    </div>
                </div>
                <div class="auth-form-row">
                    <div class="auth-form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" value="<?php echo $user->email; ?>">
                    </div>
                    <div class="auth-form-group">
                        <label for="login">Login</label>
                        <input type="text" name="login" readonly value="<?php echo $user->login; ?>">
                    </div>
                </div>

                <div class="form-mess"></div>
                <button type="submit" class="auth-btn">Submit</button>
            </form>

        </div>

            <div class="auth-password">
                <h5 class="update-password-title">Update password</h5>
                <form action="" id="password" class="auth-form">
                    <div class="auth-form-row">
                        <div class="auth-form-group">
                            <label for="">Old Password</label>
                            <input type="password" name="old_password" id="old_password">
                        </div>
                        <div class="auth-form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password">
                        </div>
                    </div>
                    <div class="auth-form-row">
                        <div class="auth-form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password">
                        </div>
                    </div>
                    <div class="form-mess"></div>
                    <button type="submit" class="auth-btn">Submit</button>
                </form>

            </div>


            
        </div><!-- auth-settings -->

    </div>

</div>

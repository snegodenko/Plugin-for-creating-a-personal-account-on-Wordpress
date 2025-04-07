
<div class="auth-forms">

    <div class="tab-titles">
        <div class="tab-title active" data-tab="login">Login</div>
        <div class="tab-title" data-tab="register">Register</div>
    </div>

    <div class="auth-login-form auth-forms-item active" data-item="login">
        <form id="login" class="auth-form" action="">
            <div class="auth-form-group">
                <label for="login">Login</label>
                <input type="text" id="login" name="login">
            </div>
            <div class="auth-form-group">
                <label for="">Password</label>
                <input type="password" name="password">
            </div>
            <div class="form-mess" style="color:red"></div>
            <button type="submit" class="auth-btn">Submit</button>
        </form>
    </div>

    <div class="auth-register-form auth-forms-item" data-item="register">
        <form id="register" action="/login" method="POST" class="auth-form">
            <div class="auth-form-group">
                <label for="login">Login</label>
                <input type="text" id="login" name="login">
            </div>
            <div class="auth-form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="auth-form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email">
            </div>
            <div class="auth-form-group">
                <label for="password-input">Password</label>
                <input type="password" id="password-input" name="password">
            </div>
            <div class="form-mess" style="color:red"></div>
            <button type="submit" class="auth-btn">Submit</button>
        </form>
    </div>

</div><!-- auth-forms -->

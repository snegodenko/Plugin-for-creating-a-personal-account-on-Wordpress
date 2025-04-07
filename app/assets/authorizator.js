
jQuery(document).ready(function ($){

    /**
     * Logout
     */
    $('#logout').on('click', function(){

        $.ajax({
            type: 'POST',
            url: myAction.url,
            data: {action: 'logout', logout: true},
            success: function(res){
                console.log(res);
            }
        })
    })
})


document.addEventListener('DOMContentLoaded', function(){

    /**
     *  User login
     */
    const loginForm = document.querySelector('#login');
    if(loginForm){
        const loginFormButton = loginForm.querySelector('button');
        loginFormButton.addEventListener('click', (e) => {
            e.preventDefault();

            const formData = new FormData();
            formData.append('action', 'login');
            formData.append('login', loginForm.login.value);
            formData.append('password', loginForm.password.value);

            requestHandler('login', formData);

        })
    }

    /**
     * User register
     */
    const registerForm = document.querySelector('#register');
    if(registerForm){
        registerForm.querySelector('button').addEventListener('click', (e) => {
            e.preventDefault();
            const formData = new FormData();
            formData.append('action', 'register');
            formData.append('login', registerForm.login.value);
            formData.append('name', registerForm.name.value);
            formData.append('email', registerForm.email.value);
            formData.append('password', registerForm.password.value);

            requestHandler('register', formData);
        })
    }

    /**
     * Update user data
     */
    const details = document.querySelector('#details');
    if(details){
        details.querySelector('button').addEventListener('click', (e) => {
            e.preventDefault();
            const formData = new FormData();
            formData.append('action', 'update');
            formData.append('name', details.name.value);
            formData.append('surname', details.surname.value);
            formData.append('email', details.email.value);

            requestHandler('details', formData);
        })
    }

    /**
     * Update password
     */
    const passwordForm = document.querySelector('#password');
    if(passwordForm){
        passwordForm.querySelector('button').addEventListener('click', (e) => {
            e.preventDefault();
            const formData = new FormData();
            formData.append('action', 'password');
            formData.append('old_password', passwordForm.old_password.value);
            formData.append('password', passwordForm.password.value);
            formData.append('confirm_password', passwordForm.confirm_password.value);

            requestHandler('password', formData);
        })
    }

    /**
     * Upload image
     */
    const fileInput = document.querySelector('input#file');
    if(fileInput){
        fileInput.addEventListener('change', (e) => {
            e.preventDefault();

            const formData = new FormData();
            formData.append('action', 'upload_file');
            formData.append('file', fileInput.files[0]);

            requestHandler('avatar', formData);
        })
    }




    function requestHandler(id, formData)
    {
        const formMess = document.querySelector(`#${id} .form-mess`);

        fetch(myAction.url, {
            method: 'POST',
            body: formData
        }).then(response => response.json())
            .then(data => {
                console.log(data);

                formMess.innerHTML = '';

                if(data.success < 1){
                    const errors = data.errors;
                    let mess = '';
                    for(let key in errors) {
                        const error = errors[key];
                        if(typeof error === 'object'){
                            error.forEach((item,i) => {
                                mess += `<div class="error">${item}</div>`;

                            })
                        } else {
                            mess += `<div class="error">${error}</div>`;
                        }
                    }
                    formMess.innerHTML = mess;
                } else {
                    if(id == 'password'){
                        formMess.innerHTML = data.message;
                    } else if(id == 'avatar'){

                        document.querySelector('#avatar .avatar-image img').setAttribute('src', data.path);

                    } else {
                        window.location = location.href;
                    }

                }

            })
            .catch(error => {
                console.log(error);
            });
    }


    const tabTitle = document.querySelectorAll('.auth-forms .tab-title');
    const forms = document.querySelectorAll('.auth-forms-item');
    if(tabTitle){

        document.addEventListener('click', (e) => {
            if(e.target.classList.contains('tab-title')){
                forms.forEach((elem,a) => {
                    elem.classList.remove('active');
                })
                tabTitle.forEach((item,i) => {
                    item.classList.remove('active');
                })
                e.target.classList.add('active');
                const dataItem = e.target.getAttribute('data-tab'); console.log(dataItem);
                document.querySelector(`.auth-forms-item[data-item="${dataItem}"]`).classList.add('active');
            }
        })

    }

})






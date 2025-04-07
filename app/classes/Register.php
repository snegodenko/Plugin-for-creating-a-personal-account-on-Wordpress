<?php

namespace Authorizator\classes;

use Authorizator\classes\Validate;

class Register
{
    private Validate $validate;
    private array $fields = ['login', 'name', 'email', 'password'];
    private string $role = 'subscriber';


    public function __construct()
    {
        $this->validate = new Validate($this->fields);
    }

    /**
     * Register new user
     * @return array
     */
    public function register(): array
    {
        if($this->validate->validate($this->rules())){

            $userId = wp_insert_user($this->userData());

            if(is_numeric($userId)){
                wp_set_auth_cookie($userId);
                return ['success' => 1, 'message' => 'You have registered successfully!'];
            } else {
                return ['success' => 0, 'errors' => ['Registration error!']];
            }
        }

        return ['success' => 0, 'errors' => $this->validate->errors];
    }



    /**
     * @return array
     */
    private function userData(): array
    {
        return  [
            'user_login' => $this->validate->values['login'],
            'user_pass' => $this->validate->values['password'],
            'user_nicename' => $this->validate->values['name'],
            'display_name' => $this->validate->values['name'],
            'user_email' => $this->validate->values['email'],
            'role' => $this->role
        ];
    }

    /**
     * Validation rules
     * @return array
     */
    private function rules(): array
    {
        return [
            'required' => ['login', 'name', 'email', 'password'],
            'email' => ['email'],
            'regex' => [
                ['login', '#^[a-zA-Z0-9-]+$#'],
                ['password', '#^[a-zA-Z0-9!@\#\$%\^&\*]+$#']
            ],
            'lengthMin' => [
                ['password', 6]
            ],
            'notIn' => [
                ['login', [$this->checkLogin()]],
                ['email', [$this->checkEmail()]]
            ],
        ];
    }

    /**
     * Checking user existence by email
     * @return string|null
     */
    public function checkEmail(): string|null
    {
        $email = (array_key_exists('email', $this->validate->values)) ? $this->validate->values['email'] : null;
        if($email){
            $user = get_user_by('email', $email);
            if($user){
                return $user->user_email;
            }
        }
        return null;
    }

    /**
     * Checking user existence by login
     * @return string|null
     */
    private function checkLogin(): string|null
    {
        $login = (array_key_exists('login', $this->validate->values)) ? $this->validate->values['login'] : null;
        if($login){
            $user = get_user_by('login', $login);
            if($user){
                return $user->user_login;
            }
        }
        return null;
    }


}
<?php

namespace Authorizator\classes;

use Authorizator\classes\Validate;

class Login
{
    private Validate $validate;
    private array $fields = ['login', 'password'];


    public function __construct()
    {
        $this->validate = new Validate($this->fields);
    }


    /**
     * User authorization
     * @return array
     */
    public function login(): array
    {
        if($this->validate->validate($this->rules())){
            $user = wp_signon([
                'user_login' => $this->validate->values['login'],
                'user_password' => $this->validate->values['password'],
                'remember' => true
            ]);

            if(isset($user->ID)){
                return ['success' => 1];
            }
        }

        return ['success' => 0, 'errors' => ($this->validate->errors) ? $this->validate->errors : ['Incorrect login or password!']];
    }


    /**
     * Validation rules
     * @return array[]
     */
    private function rules(): array
    {
        return [
            'required' => ['login', 'password']
        ];
    }


}
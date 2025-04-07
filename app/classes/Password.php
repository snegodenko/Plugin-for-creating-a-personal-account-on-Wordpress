<?php

namespace Authorizator\classes;

use Authorizator\classes\Validate;

class Password
{
    private Validate $validate;
    private array $fields = ['old_password', 'password', 'confirm_password'];
    private const MAX_LENGTH = 6;


    public function __construct()
    {
        $this->validate = new Validate($this->fields);
    }

    /**
     * Update user password
     * @return array
     */
    public function password(): array
    {
        $user = wp_get_current_user();
        if($this->validate->validate($this->rules()) && wp_check_password($this->validate->values['old_password'], $user->data->user_pass, $user->ID)){

            wp_set_password($this->validate->values['password'], $user->ID);
            wp_set_auth_cookie($user->ID);

            return ['success' => 1, 'message' => 'The password was successfully changed!'];
        }

        return ['success' => 0, 'errors' => ($this->validate->errors) ? $this->validate->errors : ['Something went wrong!']];
    }



    /**
     * Validation rules
     * @return array[]
     */
    private function rules(): array
    {
        return [
            'required' => ['old_password', 'password', 'confirm_password'],
            'lengthMin' => [
                ['password', self::MAX_LENGTH]
            ],
            'regex' => [
                ['password', '#^[a-zA-Z0-9!@\#\$%\^&\*]+$#'],
            ],
            'equals' => [
                ['password', 'confirm_password']
            ]
        ];
    }

}
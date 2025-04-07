<?php

namespace Authorizator\classes;

use Authorizator\classes\Validate;

class User
{
    private Validate $validate;
    private array $fields = ['name', 'email', 'surname'];


    public function __construct()
    {
        $this->validate = new Validate($this->fields);
    }



    /**
     * Get user data
     * @return object
     */
    public static function userData(): object
    {
        $user = wp_get_current_user();

        return (object) [
            'id' => $user->ID,
            'login' => $user->user_login,
            'name' => $user->display_name,
            'last_name' => get_user_meta($user->ID, 'last_name', true),
            'email' => $user->user_email,
            'avatar' => self::getAvatar($user->ID)
        ];
    }

    /**
     * User avatar
     * @param int $userId
     * @return string
     */
    public static function getAvatar(int $userId): string
    {
        return ($avatar = get_user_meta($userId, '_avatar', true))
            ? wp_upload_dir()['baseurl'] . "/authorizator/$userId/" . $avatar
            : AUTHORIZATOR_PLUGIN_URI . 'app/assets/no_image.png';
    }

    /**
     * Update user data
     * @return array
     */
    public function update(): array
    {

        if($this->validate->validate($this->rules())){
            $userId = wp_update_user([
                'ID' => self::userData()->id,
                'user_nicename' => $this->validate->values['name'],
                'display_name' => $this->validate->values['name'],
                'last_name' => $this->validate->values['surname'],
                'user_email' => $this->validate->values['email'],
            ]);

            if(is_numeric($userId)){
                return ['success' => 1, 'message' => 'Your data has been successfully updated!' ];
            }
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
            'required' => ['name', 'email'],
            'email' => ['email']
        ];
    }



}
<?php

namespace Authorizator\classes;

use Valitron\Validator;

class Validate
{
    public array $values = [];
    public array $errors = [];


    public function __construct(array $fields)
    {
        $this->getPostValues($fields);
    }


    /**
     * Gets the value from the $_POST array, clears it and returns it
     * @param $key
     * @return string
     */
    private function getPostValue($key): string
    {
        return (isset($_POST[$key])) ? trim(esc_html($_POST[$key])) : '';
    }

    /**
     * @param array $fields
     * @return void
     */
    private function getPostValues(array $fields): void
    {
        foreach($fields as $field){
            $this->values[$field] = $this->getPostValue($field);
        }
    }

    /**
     * Validate
     * @param array $fields
     * @param array $rules
     * @return bool
     */
    public function validate(array $rules): bool
    {

        $validate = new Validator($this->values);
        $validate->rules($rules);

        if(!$validate->validate()){
            $this->errors = $validate->errors();
            return false;
        }

        return true;
    }

}
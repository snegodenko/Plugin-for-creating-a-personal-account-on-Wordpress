<?php

namespace Authorizator\classes;

use Authorizator\classes\Validate;
use Valitron\Validator;

class Upload
{
    private array $file = [];
    private array $types = ['image/png', 'image/jpeg', 'image/jpg'];
    private object $user;
    private array $errors = [];
    private const MAX_FILE_SIZE = 1048576;



    public function __construct()
    {
        $this->user = User::userData();
        $this->file = $_FILES['file'] ?? [];
    }


    /**
     * Upload image
     * @return array
     */
    public function upload(): array
    {
        if($this->validate()){
            $this->removeFile();
            $upload = move_uploaded_file($this->file['tmp_name'], $this->fileName());
            if($upload){
                update_user_meta($this->user->id, '_avatar', $this->uniqueFileName());
                return ['success' => 1, 'path' => $this->filePath()];
            }
        }

        return ['success' => 0, 'errors' => ($this->errors) ? $this->errors : ['Something went wrong!']];
    }


    /**
     * Download directory
     * @return string
     */
    private function uploadDir(): string
    {
        $uploadDir = wp_upload_dir();
        $path = $uploadDir['basedir'] . "/authorizator/{$this->user->id}";
        if(!file_exists($path)){
            wp_mkdir_p($path);
        }

        return $path;
    }

    /**
     * Path of the downloaded file
     * @return string
     */
    private function fileName(): string
    {
        return $this->uploadDir() . "/" . $this->uniqueFileName();
    }

    /**
     * URL of the downloaded file
     * @return string
     */
    private function filePath(): string
    {
        $uploadDir = wp_upload_dir();
        return $uploadDir['baseurl'] . "/authorizator/{$this->user->id}/{$this->uniqueFileName()}";
    }

    /**
     * Create unique filename
     * @return string
     */
    private function uniqueFileName(): string
    {
        $ext = pathinfo($this->file['name'], PATHINFO_EXTENSION);
        return time() . ".$ext";
    }



    /**
     * Files validate
     * @return mixed
     */
    private function validate(): mixed
    {
        $validate = new Validator($this->file);
        $validate->rules($this->rules());

        if(!$validate->validate()){
            $this->errors = $validate->errors();
            return false;
        }

        return true;
    }

    /**
     * Validation rules
     * @return \array[][]
     */
    private function rules(): array
    {
        return [
            'max' => [
                ['size', self::MAX_FILE_SIZE]
            ],
            'integer' => [
                ['error']
            ],
            'in' => [
                ['type', $this->types]
            ],
        ];
    }

    /**
     * Delete old avatar
     * @return void
     */
    private function removeFile(): void
    {
        foreach(scandir($this->uploadDir()) as $file){
            $path = $this->uploadDir() . '/' . $file;
            if(is_file($path)){
                unlink($path);
            }
        }
    }
}
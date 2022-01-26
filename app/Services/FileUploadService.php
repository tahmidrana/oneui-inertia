<?php
namespace App\Services;

use Exception;

class FileUploadService
{
    public function __construct()
    {
        //
    }

    public function upload($fileName, $path = '')
    {
        try {
            return request()->file($fileName)->store("{$path}", 'public');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function uploadImage($fileName, $path = '')
    {
        try {
            $file = request()->file($fileName);
            $extension = $file->extension();

            // $name = Str::slug($file->getClientOriginalName()).'_'.time().'.'.$extension;
            // return request()->file($fileName)->storeAs("images/{$path}", 'public');
            return request()->file($fileName)->store("images/{$path}", 'public');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}

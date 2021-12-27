<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait File
{
    public $public_path = "/public/uploaded";
    public $storage_path = "/storage/uploaded";

    public function file($file, $path, $width, $height)
    {
        if ($file) {
            $extension = $file->getClientOriginalExtension();
            $file_name = $path . '-' . Str::random(30) . '.' . $extension;
            $url = $file->storeAs($this->public_path, $file_name);
            $public_path = public_path($this->storage_path . $file_name);
            $img = Image::make($public_path)->resize($width, $height);
            $url = str_replace("public", "", $url);
            return $img->save($public_path) ? $url : '';
        }
    }
}

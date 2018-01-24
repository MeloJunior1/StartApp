<?php

namespace App\Utils;

use Storage;
use App\Contracts\IFileUploadable;

class FileUpload implements IFileUploadable
{
    public function upload($fileName, $fileContent, $permission)
    {
        return Storage::disk('s3')->put($fileName, $fileContent, $permission);
    }
    public function download()
    {

    }
    public function remove()
    {
        
    }
}
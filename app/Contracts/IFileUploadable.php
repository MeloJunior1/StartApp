<?php

namespace App\Contracts;

interface IFileUploadable
{
    public function upload($fileName, $fileContent, $permission);
    public function download();
    public function remove();
}
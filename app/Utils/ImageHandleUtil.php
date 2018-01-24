<?php

namespace App\Utils;

use Image;
use Storage;

class ImageHandleUtil
{
    protected $file, $width, $heigth, $bgColor;

    public function __construct($file, $width, $heigth, $bgColor = '000000')
    {
        $this->file = $file;
        $this->width = $width;
        $this->heigth = $heigth;
        $this->bgColor = $bgColor;
    }

    public function adjustImage()
    {
        
        $this->file = Image::make($this->file)
                        ->resizeCanvas($this->width, $this->heigth, 'center', true, $this->bgColor)
                        ->save('temp/'.time().'.jpg');
        
        return $this->file;
    }    

    public function removeImage()
    {
        \File::delete(public_path('temp/'.$this->file->basename));
    }
}
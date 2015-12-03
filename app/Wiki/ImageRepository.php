<?php namespace App\Wiki;

use App\Wiki\ImageInterface;
use \Image;

class ImageRepository implements ImageInterface
{
    public function getImage($filename)
    {
        $image = Image::make(storage_path('app/content/images/').$filename);
        
        if(! $this->isLessThanSize($image, 500)) {
            $image->widen(500);
        }
        
        return $image;
    }
    
    public function getExtension($filename)
    {
        $parts = explode('.',$filename);
        
        $ext = $parts[count($parts) - 1];
        
        return $ext;
    }
    
    protected function isLessThanSize($image, $size) 
    {
        $width = $image->width();
        
        if($width <= $size) {
            return true;
        }
        else {
            return false;
        }
    }
}
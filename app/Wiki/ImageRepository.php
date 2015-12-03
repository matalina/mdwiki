<?php namespace App\Wiki;

use App\Wiki\ImageInterface;
use \Image;
use \Config;
use \Storage;

class ImageRepository implements ImageInterface
{
    public function getImage($filename)
    {
        switch(Config::get('wiki.storage_type')) {
            case 'local':
                $path = storage_path('app/content/images/').$filename;
                $image = Image::make($path);
                break;
            default:
                $temp_image = Storage::get('images/'.$filename);
                $partial_path = 'temp/'.$filename;
                $path = storage_path('app/'.$partial_path);
                Storage::disk('local')->put($partial_path, $temp_image);
                $image = Image::make($path);
                
                Storage::disk('local')->delete($partial_path);
        }
        
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
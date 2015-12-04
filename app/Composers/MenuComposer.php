<?php
namespace App\Composers;

use Illuminate\Contracts\View\View;
use \Storage;
use \Config;
use \Cache;
use Illuminate\Support\Collection;

class MenuComposer
{
    protected $disk;
    protected $path;
    
    public function __construct()
    {
        $this->disk = Storage::disk(Config::get('wiki.storage_type'));
        
        switch(Config::get('wiki.storage_type')) {
            case 'local':
                $path = 'content/';
                break;
            default:
                $path = '';
                break;
        }
        $this->path = $path;
    }
    
    public function create(View $view)
    {
        $menu = '';
        
        $all_files = $this->disk->allFiles($this->path);
        
        $hash = $this->hashFileList($all_files);
        
        /*if(Cache::get('hash') == $hash) {
            $menu = Cache::get('menu');
        }
        ele {*/
            Cache::put('hash', $hash, 60);
            
            $items = new Collection();
            
            $items = $this->recursiveMenuCreation($items, $this->path);
            
            $menu = $this->recursiveMenuGeneration($items);
            
            Cache::put('menu', $menu, 60);
        //}
        
        $view->with('menu', $menu);
    }
    
    protected function recursiveMenuGeneration(Collection $items, $menu = '', $nested = false)
    {
        $menu .= '<ul'.(!$nested?' data-drilldown':'').' class="vertical menu">';
        $sub_menu = '';
        foreach($items->all() as $name => $output) {
            if(is_string($output)) {
                $menu .= '<li><a href="'.url($output).'">'.$name.'</a></li>';
            }
            else {
                $menu .= '<li><a href="#">'.$name.'</a>'.$this->recursiveMenuGeneration($output, $sub_menu, true).'</li>';
            }
        }
        $menu .= '</ul>';
        return $menu;
    }
    
    protected function recursiveMenuCreation($items, $path) 
    {
        $dirs = $this->disk->directories($path);
        $files = $this->disk->files($path);
        
        foreach($files as $file) {
            $segments = explode('/',$file);
            $uri = explode('.', $segments[count($segments) - 1]);
            preg_match('/[0-9]*\-?(.+)/', $uri[0], $match);
            $name = str_replace('-', ' ', $match[1]);
            $link = explode('.', $file);
            $items->put($name, $link[0]);
        }
        
        foreach($dirs as $dir) {
            if($dir == 'images') {
                continue;
            }
            
            $segments = explode('/',$dir);
            $uri = $segments[count($segments) - 1];
            
            $new_dir = new Collection();
            $new_dir = $this->recursiveMenuCreation($new_dir, $dir);
            $name = str_replace('-', ' ', $uri);
            $items->put($name, $new_dir);
        }
        
        return $items;
    }
    
    protected function hashFileList($files)
    {
        $string = implode('',$files);
        
        return sha1($string);
    }
}
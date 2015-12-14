<?php
namespace App\Composers;

use Illuminate\Contracts\View\View;
use \Storage;
use \Config;
use \Cache;
use Illuminate\Support\Collection;

class NextPreviousComposer
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
    
    public function compose(View $view)
    {
        $all_files = $this->disk->allFiles($this->path);
        
        $route = \Route::current()->parameters();
        
        $current = $this->path.implode('/',$route).'.'.\Config::get('wiki.extension');
        
        $key = array_search($current, $all_files);
        
        
        if($key == 0) {
            $previous = null;
        }
        else {
            $previous = $all_files[$key - 1];
        }
        
        if($key == (count($all_files) - 1)) {
            $next = null;
        }
        else {
            $next = $all_files[$key + 1];
        }
        
        switch(Config::get('wiki.storage_type')) {
            case 'local':
                $next = str_replace('content/','',$next);
                $previous = str_replace('content/','',$previous);
                break;
            default:
                // do nothing
                break;
        }
        
        $next = str_replace('.'.\Config::get('wiki.extension'), '', $next);
        $previous = str_replace('.'.\Config::get('wiki.extension'), '', $previous);
        
        $output = [
            'previous' => $previous,
            'next' => $next,
        ];
        
        if(empty($route) || $route['arg1'] == 'home') {
            $view->with('home',true);
        }
        else {
            $view->with('home',false);
        }
        
        $view->with('next_previous', $output);
    }
}
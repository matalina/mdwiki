<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Wiki\PageInterface;
use App\Wiki\ImageInterface;
use \View;
use \Image;

class WikiController extends Controller
{
    protected $page; 
    protected $image;
    
    public function __construct(PageInterface $page, ImageInterface $image)
    {
        $this->page = $page;
        $this->image = $image;
    }
    
    public function getPage($arg1 = 'home', $arg2 = null, $arg3 = null, $arg4 = null, $arg5 = null)
    {
        $path = $this->page->getFilePath($arg1, $arg2, $arg3, $arg4, $arg5);
        $html = $this->page->getContentsOfFile($path);
        $title = $this->page->getTitleOfFile($path);
        
        View::share('page',$html);
        View::share('title',$title);
        return View::make('pages.content');
    }
    
    public function getImage($filename) {
        
        $image = $this->image->getImage($filename);
        $ext = $this->image->getExtension($filename);
        
        return $image->response($ext);
    }
}
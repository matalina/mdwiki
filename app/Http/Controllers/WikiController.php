<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Wiki\PageInterface;
use \View;

class WikiController extends Controller
{
    protected $page; 
    
    public function __construct(PageInterface $page)
    {
        $this->page = $page;    
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
}
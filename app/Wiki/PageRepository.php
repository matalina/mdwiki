<?php namespace App\Wiki;

use App\Wiki\PageInterface;
use \Storage;
use \Config;
use League\CommonMark\CommonMarkConverter as MarkDown;

class PageRepository implements PageInterface
{
    protected $disk;
    protected $markdown;
    
    public function __construct(MarkDown $markdown)
    {
        $this->disk = Storage::disk(Config::get('storage_type'));    
        $this->markdown = $markdown;
    }
    
    public function getFilePath($arg1, $arg2, $arg3, $arg4, $arg5)
    {
        $path = htmlspecialchars($arg1);
        
        if($arg2 != null) {
            $path .= '/'.htmlspecialchars($arg2);
        }
        
        if($arg3 != null) {
            $path .= '/'.htmlspecialchars($arg3);
        }
        
        if($arg4 != null) {
            $path .= '/'.htmlspecialchars($arg4);
        }
        
        if($arg5 != null) {
            $path .= '/'.htmlspecialchars($arg5);
        }
        
        $path .= '.'.Config::get('wiki.extension');
        
        if(Config::get('wiki.storage_type') === 'local')
        {
            $path = 'content/'.$path;
        }
        
        if($this->disk->exists($path)) {
            return $path;
        }
        
        abort(404);
        
    }
    
    public function getContentsOfFile($path)
    {
        $file = $this->disk->get($path);
        
        $contents = $this->markdown->convertToHtml($file);
        
        return $contents;
    }
    
    public function getTitleOfFile($path)
    {
        $file = $this->disk->get($path);
        
        $lines = explode(PHP_EOL, $file);
        
        $previous_line = '';
        foreach($lines as $line) {
            if(preg_match('/^#[^#]/',$line)) {
                $title = str_replace('#','',$line);
                return $title;
            }
            
            if(preg_match('/^=/',$line)) {
                return $previous_line;
            }
            
            $previous_line = $line;
        }
        
        return 'Untitled';
    }
}
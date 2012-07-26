<?php 

class Wiki {
  /**
   * Parse MediaWiki Syntax Internal Links to Markdown Links
   
  public static function _parseLinks($raw) 
  {
    $pattern = '/\[\[([^\|\]]*)\|?([^\]]*)\]\]/';
    
    $callback = function ($matches) 
    {
      $slug = Str::slug($matches[1]);
      
      if(isset($matches[2]) && $matches[2] != '') {
        $label = $matches[2];
      }
      else {
        $label = $matches[1];
      }
      
      $replace = '['.$label.'](/page/'.$slug.')';
      
      return $replace;
    };
    
    $raw = preg_replace_callback($pattern, $callback, $raw);
    
    return $raw;
  }*/
  
  public static function parseLinks($raw) 
  {
    $dropbox = IoC::resolve('dropbox::api');
    $file = $dropbox->getFile('index.csv');
    $lines = explode(PHP_EOL,$file['data']);
    
    function callback($matches)
      {
        global $page;
        $label = $matches[0];
        
        $replace = '['.$label.']('.$page.')';
        
        return $replace;
      };
    
    foreach($lines as $line) {
      $index = explode(',',$line);
      $temp = explode('.',$index[0]);
      $page = $temp[0];
      $count = count($index);
      
      $callback = function ($matches) use ($page)
      {
        $label = $matches[0];
        
        $replace = '['.$label.']('.$page.')';
        
        return $replace;
      };
      
      for($i = 1; $i < $count; $i++) {
        $keyword = $index[$i];
        $pattern = '/(?![\[\(])\b'.$keyword.'\b(?<![\]\)])/i';
        $raw = preg_replace_callback($pattern, $callback, $raw);
      }
    }
    
    return $raw;
  }
  
  public static function showIndex() 
  {
    $dropbox = IoC::resolve('dropbox::api');
    $file = $dropbox->getFile('index.csv');
    $lines = explode(PHP_EOL,$file['data']);
    $output = '';

    foreach($lines as $line) {
      if(!empty($line)) {
        $index = explode(',',$line);
        $temp = explode('.',$index[0]);
        $page = $temp[0];
        $label = $index[1];
        $output .= '* ['.$label.']('.$page.')'.PHP_EOL;
      }
    }
    return $output;
  }
}

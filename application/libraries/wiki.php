<?php 

class Wiki {
  /**
   * Parse Internal Wiki LInks
   */
  public static function parseLinks($raw) 
  {
    $dropbox = IoC::resolve('dropbox::api');
    $file = $dropbox->getFile('index.csv');
    $file = str_replace("\r",'',$file);
    $lines = explode("\n",$file['data']);
    
    foreach($lines as $line) {
      $index = explode(',',$line);
      $temp = explode('.',$index[0]);
      $page = $temp[0];
      $count = count($index);
      
      for($i = 1; $i < $count; $i++) {
        $keyword = $index[$i];
        $pattern = '/(?<![\[\(])\b'.$keyword.'\b(?<![\]\)])/i';
        $replace = '[$0]('.$page.')';
        $raw = preg_replace($pattern, $replace,$raw,-1,$count);
        preg_match_all($pattern,$raw,$matches);
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
  
  public static function getPage($page)
  {
    $result = array();
    $dropbox = IoC::resolve('dropbox::api');
    $file = $dropbox->getFile($page.'.md');
    $name = explode('.',$file['name']);
    $output = $file['data'];
    $description = preg_replace('/[^a-zA-Z0-9 ]/','',Str::words($output,20));
    $output = Wiki::parseLinks($output);
    $content =  Sparkdown\Markdown($output);
    $result['title'] = Str::title($name[0]);
    $result['content'] = $content;
    $result['description'] = $description;
    return $result;
  }
}
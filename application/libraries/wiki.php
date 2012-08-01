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
  
  public static function _showIndex() 
  {
    $dropbox = IoC::resolve('dropbox::api');
    $file = $dropbox->getFile('index.csv');
    
    $lines = explode(PHP_EOL,$file['data']);
    sort($lines);
    $output = '#Site Map'.PHP_EOL;
    $array = array();

    foreach($lines as $line) {
      if(!empty($line)) {
        $index = explode(',',$line);
        $temp = explode('.',$index[0]);
        $label = $index[1];
        $page = $temp[0];
        $dir = explode('/',$page);
        
        $link = '['.$label.']('.$page.') (_'.$page.'_)'.PHP_EOL;
        $output .= '* '.$link;
      }
    }
    
    return $output;
  }
  
  public static function showIndex() 
  {
    $dropbox = IoC::resolve('dropbox::api');
    $file = $dropbox->getFile('index.csv');
    
    $lines = explode(PHP_EOL,$file['data']);
    sort($lines);
    $output = '#Site Map'.PHP_EOL;
    $array = array();

    foreach($lines as $line) {
      if(!empty($line)) {
        $index = explode(',',$line);
        $temp = explode('.',$index[0]);
        $label = $index[1];
        $page = $temp[0];
        $dir = explode('/',$page);
        $dir = array_reverse($dir);
        $result = directory($dir,$label,$page);
        $array = array_merge_recursive($array,$result);
      }
    }
    //echo '<pre>'; print_r($array); echo '<pre/>'; exit();
    $output .= '<ul>'.structure($array,0).'</ul>';
    
    //echo '<pre>'; print_r($output); echo '<pre/>'; exit();
    return $output;
  }
  
  public static function getPage($page)
  {
    $result = array();
    $dropbox = IoC::resolve('dropbox::api');
    $file = $dropbox->getFile($page.'.md');
    if($file['code'] == 404 && $page == 'home') {
      $dropbox->putFile(path('storage').'wiki/home.md','home.md');
      $dropbox->putFile(path('storage').'wiki/index.csv','index.csv');
      $file = $dropbox->getFile($page.'.md');
    }
    $name = explode('.',$file['name']);
    $output = strip_tags($file['data']);
    $description = preg_replace('/[^a-zA-Z0-9 ]/','',Str::words($output,20));
    $output = Wiki::parseLinks($output);
    $content =  Sparkdown\Markdown($output);
    $result['title'] = Str::title($name[0]);
    $result['content'] = $content;
    $result['description'] = $description;
    return $result;
  }
  
  public static function randomPage()
  {
    $result = array();
    $dropbox = IoC::resolve('dropbox::api');
    
    $file = $dropbox->getFile('index.csv');
    $lines = explode(PHP_EOL,$file['data']);
    
    $random = array_rand($lines);
    
    $index = explode(',',$lines[$random]);
    $temp = explode('.',$index[0]);
    $page = $temp[0];
    
    return $page;
  }
}

function directory($array,$label,$page) {
  if(count($array) != 1) {
    $dir = array_pop($array);
    $result[$dir] = directory($array,$label,$page);
    return $result;
  }
  else {
    //return '['.$label.']('.$page.')';
    return HTML::link($page,$label);  
  }
}

function structure($array, $count) {
  $output = '';
  ksort($array,SORT_NATURAL);
  foreach($array as $dir1 => $arr1) {
    if(!is_array($arr1)) {
      $arr = preg_replace('#[^[(]]\/([^\)])#','$1',$arr1);
      for($i = 0; $i < $count / 2 + 1;  $i++) {
        $output .= ' ';
      }
      $output .= '<li>'.$arr1.'</li>'; 
    }
    else {
      for($i = 0; $i < $count / 2; $i++) {
        $output .= ' ';
      }
      $count++;
      if(empty($dir1)) {
        $output .= structure($arr1, $count);
      }
      else {
        $output .= '<li>'.ucwords($dir1).PHP_EOL;
        $output .= '<ul>'.structure($arr1, $count).'</ul>';
        $output .= '</li>';
      }
    }
  }
  return $output;
}

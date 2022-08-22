<?php

class Autoloader
{

  protected $prefixes;

  public function addNamespace(string $prefix, string $dir)
  {
    if (!isset($this->prefixes[$prefix]))
      $this->prefixes[$prefix] = $dir;
  }

  public function register()
  {
    spl_autoload_register(array($this, "autoload"));
  }

  public function autoload($link)
  {
    $prs = explode("\\", $link);
	
    foreach($prs as $value)
    {	
      if (isset($this->prefixes[$value])) 
	$array[] = $this->prefixes[$value];	
      else	
        $array[]= $value;
    }

    $path = implode("/", $array).".php";

    echo "<pre>";    
    var_dump($path);
    echo "</pre>";
    require_once $path;
  }
}

$registrator = new Autoloader;
$registrator->addNamespace("Hillel", "/src");
$registrator->register(); 


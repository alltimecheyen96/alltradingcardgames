<?php
class Singleton{
  //simple singelton class
  private static $instance = null;

  private function __construct()
  {
  }

  public static function getInstance()
  {
    if (self::$instance == null)
    {
      self::$instance = new mysqli('localhost', 'root', '', 'lotrtcgd_lotrDatabase');
    }
    return self::$instance;
  }
}

?>

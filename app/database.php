<?php

namespace App;
use \Illuminate\Database\Capsule\Manager as Capsule;

class database
{
    public function __construct()
    {
      $capsule=new Capsule();
      $capsule->addConnection([
        'driver' => constant('DRIVER'),
        'host' => constant('HOST'), 
        'database' => constant('DB'),
        'username' => constant('USER'),
        'password' => constant('PASSWORD'),
        'charset' => constant('CHARSET'),
        'collation' => constant('COLLATION'),
        'prefix' =>''
      ]);
      $capsule->setAsGlobal();
      $capsule->bootEloquent();
    } 
}

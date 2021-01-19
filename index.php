<?php
namespace projet4;

session_start();
use projet4\model\Routeur;
require 'Autoloader.php';
require 'model/Vue.php';

Autoloader::register();

$routeur = new Routeur();
$routeur->route();

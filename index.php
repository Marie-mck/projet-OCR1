<?php

session_start();
//define('ROOT', dirname(__DIR__));
//echo ROOT;
//namespace tpnews5a;

require 'controller/Routeur.php';

$routeur = new Routeur();
$routeur->route();


/*
//constante contenant le dossier racine du projet

define ('WEBROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
echo ('ROOT');
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

//require('ROOT', 'model/Manager.php');
//require('ROOT', 'controller/controller.php');

$params = explode('/', $_GET['p']);
print_r($params);*/
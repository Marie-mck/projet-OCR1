<?php
namespace projet4;
//quelle methode ou quelle fct on doit executer si on tombe sur une class inconnue

class Autoloader {

    static function register() {
        spl_autoload_register(array(__CLASS__, 'autoload'));
        // chargement automatique de la fct autoload a chaque fois qu'on fait un new sur une classe
    }

// va lancer une méthode appellée autoload
    static function autoload($class) {
        $class = str_replace(__NAMESPACE__. '\\','',$class);
        $class = str_replace('\\','/',$class); 
        if(file_exists(__DIR__ . '/' . $class . '.php')) {
        require __DIR__ . '/' . $class . '.php'; 
        }
    }
}
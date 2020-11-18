<?php

namespace tpnews5a;
//quelle methode ou quelle fct on doit executer si on tombe sur une class inconnue

class Autoloader {

    static function register() {
        spl_autoload_register(array(__CLASS__, 'autoload'));
        // chargement automatique de la fct autoload a chaque fois qu'on fait un new sur une classe
        //spl_autoload_register([(__CLASS__, 'autoload')]); constante __CLASS__
    }
// va lancer une méthode appellée autoload

    static function autoload($class) {
        // recupere la totalité du namespace de la classe concernée
        
        $class = str_replace(__NAMESPACE__ . '\\', '', $class); //sup App
        var_dump($class);

        $class = str_replace('\\', '/', $class); //change \
        
        $fichier = __DIR__ . '/' . $class . '.php';
        
        //echo __DIR__;
        //echo __FILE__;
        //$fichier = $class .'.php';
        //require_once __DIR__ . '/' . $class . '.php';
        //require $class .'.php';
        if(file_exists($fichier)) {
            //die($fichier);
            require $fichier;
            echo 'le fichier'.$fichier.'existe';
        }

        /*if (strpos($class, __NAMESPACE__ . '\\') === 0) {

            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            
            $class = str_replace('\\', '/', $class);
            
            require $class.'.php';
        }*/
        


    }
}

//static pour pouvoir lancer register directement
//sans faire $autoload = new Autoloader; et $autoload->register;
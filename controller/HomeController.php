<?php

//namespace tpnews5a\controller;
//require 'controller/controller';
require 'model/PostManager.php';
//require 'view/Vue.php';
// Affiche la liste des x derniers posts sur la page d'accueil

class HomeController {
    protected $postManager;

    public function __construct() {
        $this->postManager = new PostManager();
    }

    //vue 1ere page avec liste des posts
    public function listPosts() {
        //die('test');
        //$postManager = new PostManager(); // Création d'un objet
        $posts = $this->postManager->getLast(); // Appel d'une fonction de cet objet
        /*ob_start();
        require ('view/HomeView.php');
        $content = ob_get_clean();
        require ('view/template.php');*/
        $vue = new Vue("Home");
        $vue->generer(array('posts' => $posts));
    }

}
<?php

//namespace tpnews5a\controller;

//use tpnews5a\Autoloader;

require ('model/PostManager.php');
require ('model/CommentManager.php');
//require('view/HomeView.php');
//require('view/VoirPlusView.php');

class Controller {
    protected $postManager;
    protected $commentManager;

    public function __construct() {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
    }

    //vue 1ere page avec liste des posts
    public function listPosts() {
        //die('test');
        $postManager = new PostManager(); // Création d'un objet
        $posts = $this->postManager->getLast(); // Appel d'une fonction de cet objet
        ob_start();
        require ('view/HomeView.php');
        $content = ob_get_clean();
        require ('view/template.php');
    }
    
    //vue 2nd page avec 1 post et ses comments
    public function post($idNews) {
        //$postManager = new PostManager();
        //$commentManager = new CommentManager();
        
        $post = $this->postManager->getNews($idNews);
        $comments = $this->commentManager->getComment($idNews);
        require ('view/VoirPlusView.php');
        
    }
    
    //vue3eme page avec form pour ajouter un nouveau comment
    public function ajoutComment($idNews, $authorComment, $commentaire) {
        //$commentManager = new CommentManager();
        $affectedLines = $commentManager->addComment($idNews, $authorComment, $commentaire);
        $this->post($idNews);
        /*if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=post&id=' . $idNews);
        }*/
    }
}





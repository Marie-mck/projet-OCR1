<?php

//namespace tpnews5a\controller;

//require 'controller/controller';
//require 'model/PostManager.php';
require 'model/CommentManager.php';
//require 'view/Vue.php';

class VoirPlusController {
    protected $postManager;
    protected $commentManager;

    public function __construct() {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
    }
    //vue 2nd page avec 1 post et ses comments
    public function post($idNews) {
        $post = $this->postManager->getNews($_GET['id']);
        $commentaires = $this->commentManager->getComments($_GET['id']);
        //var_dump($post);
        //var_dump($commentaires);
        $vue = new Vue("VoirPlus");
        $vue->generer(array('post' => $post, 'commentaires' => $commentaires));
    }

    public function ajoutComment($idNews) {
        $commentsAjouts = null;
        if (isset($_POST) && !empty($_POST)) {
            if (isset($_POST['authorComment']) && isset($_POST['commentaire'])) {
                $commentsAjouts = $this->commentManager->ajouterCommentaire($idNews, $_POST['authorComment'], $_POST['commentaire']);
                $message = 'Votre commentaire a bien été posté';
            } else {
                $message = 'Veuillez remplir tous les champs';
            }
        }
        $post = $this->postManager->getNews($idNews);
        $vue = new Vue("AddComment");
        $vue->generer(array('post' => $post, 'commentsAjouts' => $commentsAjouts));
    }
}
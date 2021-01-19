<?php

namespace projet4\controller;

use projet4\model\CommentManager;
use projet4\model\PostManager;
use projet4\model\Vue;

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
        $vue = new Vue("visiteur/VoirPlus");
        $vue->generer(array('post' => $post, 'commentaires' => $commentaires));
    }
    
    public function ajoutComment($idNews) {
        $commentsAjouts = null;
        if(isset($_POST['Commenter'])) {
        if (isset($_POST) && !empty($_POST)) {
            if (isset($_POST['authorComment']) && isset($_POST['commentaire'])) {
                $commentsAjouts = $this->commentManager->ajouterCommentaire($idNews, $_POST['authorComment'], $_POST['commentaire'], $_POST['signalerComment']);
            } else {
                $message = 'Veuillez remplir tous les champs';
            }
        }
        $message = 'Votre commentaire a bien été posté';
        }
        $post = $this->postManager->getNews($idNews);
        $message = 'Votre commentaire a bien été posté';
        $vue = new Vue("visiteur/AddComment");
        $vue->generer(array('post' => $post, 'commentsAjouts' => $commentsAjouts, 'message' => $message));
    }
}
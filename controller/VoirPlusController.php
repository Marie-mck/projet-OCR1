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
        $post = $this->postManager->getNews($idNews);
        $commentaires = $this->commentManager->getComment($idNews);
        /*ob_start();
        require ('view/VoirPlusView.php');
        $content = ob_get_clean();
        require ('view/template.php');*/
        $vue = new Vue("VoirPlus");
        $vue->generer(array('post' => $post, 'commentaires' => $commentaires));
    }
    
     // Ajoute un commentaire
    /*public function ajoutComment($idNews, $authorComment, $commentaire) {
        $post = $this->postManager->getNews($idNews);
        $commentsAjouts = $this->commentManager->ajouterCommentaire($idNews, $authorComment, $commentaire); 
        $vue = new Vue("AddComment");
        $vue->generer(array('post' => $post, 'commentsAjouts' => $commentsAjouts));
        //$this->post($idNews);
    }*/
    public function ajoutComment($idNews) {
        $commentsAjouts = null;
        if (isset($_POST) && !empty($_POST)) {
            if (isset($_POST['authorComment']) && isset($_POST['commentaire']))
                $commentsAjouts = $this->commentManager->ajouterCommentaire($idNews, $_POST['authorComment'], $_POST['commentaire']); 
        }
        $post = $this->postManager->getNews($idNews);
        
        $vue = new Vue("AddComment");
        $vue->generer(array('post' => $post, 'commentsAjouts' => $commentsAjouts));
        //$this->post($idNews);
    }
    /*public function ajoutComment($idNews, $authorComment, $commentaire) {
      //$commentManager = new CommentManager();
        $commentsAjouts = $this->commentManager->ajouterCommentaire($idNews, $authorComment, $commentaire);
        $vue = new Vue("AddCommentView");
        $vue->generer(array('commentsAjouts' => $commentsAjouts));
        /*if ($commentsAjouts === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=post&id=' . $idNews);
        }
    }
    //vue3eme page avec form pour ajouter un nouveau comment
    public function ajoutComment() {
        //$commentaires = $this->commentManager->getComment($idNews);
        //$affectedLines = $this->commentManager->addComment($idNews, $authorComment, $commentaire);
        $affectedLines = $this->commentManager->postComment($idNews, $authorComment, $commentaire);
        //$ajouterComment = $this->commentManager->addComment();
        //$recup = $this->commentManager->getOneComment($id);
        //$this->post($idNews);
        var_dump($ajouterComment);
        $vue = new Vue("AddCommentView");
        $vue->generer(array('ajouterComment' => $ajouterComment));
        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=post&id=' . $idNews);
        }*/
}
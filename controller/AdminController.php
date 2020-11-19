<?php

//namespace tpnews5a\controller;

//require 'controller/controller';
//require 'model/PostManager.php';
//require 'model/CommentManager.php';
//require 'view/Vue.php';

class AdminController {
    protected $postManager;
    protected $commentManager;

    public function __construct() {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
    }

//nbr de posts


//créer un post


//modifier un post


//tableau des commentaires sur la page modifier, approuver, supprimer un commentaire
    public function commentTable() {
        $comments = $this->commentManager->getListComment();
        $vue = new Vue("UpdateDeleteComment");
        $vue->generer(array('comments' => $comments));
    }
//affiche un commentaire pour l'approuver ou le supp ??
    public function afficherComment($id) {
        $oneComment = $this->commentManager->getOneComment($id);
        $vue = new Vue("UpdateDeleteComment");
        $vue->generer(array('oneComment' => $oneComment));
    }

//supprimer un comment
    public function deleteComment($id){
        //$comment['id'] = $this->request->getParameter('id'); // récupérer le paramètre de l'ID
        $supComment = $this->commentManager->deleteComment($id);
        $vue = new Vue("UpdateDeleteComment");
        $vue->generer(array('supComment' => $supComment));
    }

}
<?php

//namespace tpnews5a\controller;

//require 'controller/controller';
//require 'model/PostManager.php';
//require 'model/CommentManager.php';
//require 'view/Vue.php';

class AdminController {
    protected $postManager;
    protected $commentManager;
    protected $userManager;

    public function __construct() {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->userManager = new UserManager();
    }

// PAGE ADMIN - tableau des chapitres et tableau des commentaires sur la page modifier, approuver, supprimer un commentaire

    //afficher page admin avec tableau des chapitres, des commentaires, des Users
    /*public function afficherPageAdmin() {
        $chapitres = $this->postManager->getList();
        $comments = $this->commentManager->getListComment();
        $users = $this->userManager->getListUser();
        $vue = new Vue("Administration");
        $vue->generer(array('comments' => $comments, 'chapitres' => $chapitres, 'users' => $users));
    }*/

    public function afficherPageAdminInfo($idNews) {
        $post = $this->postManager->getNews($idNews);
        $commentaires = $this->commentManager->getComment($idNews);
        //$chapitres = $this->postManager->getList();
        //$comments = $this->commentManager->getListComment();
        $commentsAjouts = null;
        if (isset($_POST) && !empty($_POST)) {
            if (isset($_POST['authorComment']) && isset($_POST['commentaire'])) {
                $commentsAjouts = $this->commentManager->ajouterCommentaire($idNews, $_POST['authorComment'], $_POST['commentaire']);
                $message = 'Votre commentaire a bien été posté';
            } else {
                $message = 'Veuillez remplir tous les champs';
            }
        }
        $vue = new Vue("Administration");
        $vue->generer(array('post' => $post, 'commentaires' => $commentaires, 'comments' => $comments, 'chapitres' => $chapitres, 'commentsAjouts' => $commentsAjouts));
    }

    //nbr de comment
    /*public function numberOfComment() {
        $countComment = $this->commentManager->count();
        $vue = new Vue("UpdateDeleteCommentView");
        $vue->generer(array('countComment' => $countComment));
    }*/


//   USER (partie administration)

    public function afficherPageAdminUser() {
        $users = $this->userManager->getListUser();
        $vue = new Vue("AdminUser");
        $vue->generer(array('users' => $users));
    }

    public function deleteUser($id) {
        $deleteUser = $this->userManager->deleteUser($_GET['id']);
        $vue = new Vue("AdminUser");
        header('Location: index.php?action=afficherPageAdmin');
    }


//partie POST - CHAPITRE

    public function afficherPageAdminChapter() {
        $chapitres = $this->postManager->getList();
        $vue = new Vue("AdminChapter");
        $vue->generer(array('chapitres' => $chapitres));
    }

    public function post($idNews) {
        $post = $this->postManager->getNews($idNews);
        $commentaires = $this->commentManager->getComment($idNews);
        /*ob_start();
        require ('view/VoirPlusView.php');
        $content = ob_get_clean();
        require ('view/template.php');*/
        $vue = new Vue("AdminChapter");
        $vue->generer(array('post' => $post, 'commentaires' => $commentaires));
    }

    public function addChapter() {
        $vue = new Vue("AdminAddChapter");
        $vue->generer(array());
    }
    
    public function updateChapter() {
        
    }
    
    public function deleteChapter($id) {
        $deleteChapter = $this->postManager->deletePost($_GET['id']);
        $vue = new Vue("AdminChapter");
        header('Location: index.php?action=afficherPageAdmin');
    }


//partie post - COMMENTS

    public function afficherPageAdminComment() {
        $comments = $this->commentManager->getListComment();
        $commentSignalesTableaux = $this->commentManager->getSignalComments();
        $vue = new Vue("AdminComment");
        $vue->generer(array('comments' => $comments, 'commentSignalesTableaux' => $commentSignalesTableaux));
    }
    
    public function signalerComment($id) { // A SUPPRIMER pas d'ajout de commentaires sur page admin
        $comments = $this->commentManager->getListComment();
        $commentSignales = $this->commentManager->signalComment($_GET['id']);
        $commentSignalesTableaux = $this->commentManager->getSignalComments($_GET['id']);
        $vue = new Vue("AdminComment");
        $vue->generer(array('comments' => $comments, 'commentSignales' => $commentSignales, 'commentSignalesTableaux' => $commentSignalesTableaux));
        
    }

    /*public function moderation(){
        $id = $this->request->getParameter('id'); // récupère l'id du commentaire
        $comment = $this->comment->getComment($id); // récupère le contenu du commentaire
        $reportMsg = ""; // message qui apparaît si signalement
        if($this->request->parameterExist('nb_report')){
        $this->comment->signal($id);
        $reportMsg = "Votre signalement a bien été pris en compte.";
        }
        $this->generer(array('comment' => $comment, 'reportMsg' => $reportMsg));
    }*/
    
    public function ajoutOfComment($idNews) { // A SUPPRIMER pas d'ajout de commentaires sur page admin
        $commentsAjouts = null;
        if (isset($_POST) && !empty($_POST)) {
            if (isset($_POST['authorComment']) && isset($_POST['commentaire'])) {
                $commentsAjouts = $this->commentManager->ajouterCommentaire($idNews, $_POST['authorComment'], $_POST['commentaire']);
                $message = 'Votre commentaire a bien été posté';
            } else {
                $message = 'Veuillez remplir tous les champs';
            }
        }
        $vue = new Vue("AdminComment");
        $vue->generer(array('commentsAjouts' => $commentsAjouts));
        //header('Location: index.php?action=ajoutOfComment');
    }
    
    public function modifierComment($id) {
        $valideComment = $this->commentManager->updateComment(['id'=>$_GET['modifier'], 'authorComment'=>$_POST['authorComment'], 'commentaire'=>$_POST['commentaire']]);
        $message = 'Commentaire approuvé';
        //if (isset($_POST['modifier'])) {
            //$comment = $this->commentManager->getOneComment((int) $_GET['modifier']);
        //}
        /*if((!empty($_POST['authorComment']) && !empty($_POST['commentaire']))) {
            $valideComment = $this->commentManager->updateComment(['id'=>$_GET['modifier'], 'authorComment'=>$_POST['authorComment'], 'commentaire'=>$_POST['commentaire']]);
            $message = 'Commentaire modifié';
        }*/
        $vue = new Vue("AdminComment");
        $vue->generer(array('comment' => $comment, 'valideComment' => $valideComment));
        //header('Location: index.php?action=afficherPageAdmin');
    }

    public function deleteComment($id){    
        //if (isset($_POST['supprimer'])){
            //$deleteComment = $this->commentManager->deleteComment((int) $_GET['supprimer']);
        $deleteComment = $this->commentManager->deleteComment($_GET['id']);
            //echo 'test';
            //$vue = new Vue("UpdateDeleteComment");
        $vue = new Vue("AdminComment");
        header('Location: index.php?action=afficherPageAdmin');
        //}
    }
    /*public function comments(){
        $comments = $this->comment->getAllComments();
        $this->buildView(array('comments' => $comments));
        }
        public function comment(){
            $comment['id']= $this->request->getParameter('id'); // Je récupère l'ID du commentaire
            $comment = $this->comment->getComment($comment['id']);
            $this->buildView(array('comment' => $comment));
            }*/
    
}
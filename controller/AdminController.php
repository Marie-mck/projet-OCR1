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
    
    //nbr de comment
    /*public function numberOfComment() {
        $countComment = $this->commentManager->count();
        $vue = new Vue("UpdateDeleteCommentView");
        $vue->generer(array('countComment' => $countComment));
    }*/

// PAGE ADMIN - tableau des chapitres et tableau des commentaires sur la page modifier, approuver, supprimer un commentaire

    //afficher page admin avec tableau des chapitres, des commentaires, des Users
    /*public function afficherPageAdmin() {
        $chapitres = $this->postManager->getList();
        $comments = $this->commentManager->getListComment();
        $users = $this->userManager->getListUser();
        $vue = new Vue("Administration");
        $vue->generer(array('comments' => $comments, 'chapitres' => $chapitres, 'users' => $users));
    }*/

//   --------USER (partie administration)----------------

    public function afficherPageAdminUser() {
        $users = $this->userManager->getListUser();
        $vue = new Vue("AdminUser");
        $vue->generer(array('users' => $users));
    }

    public function deleteUser($id) {
        $deleteUser = $this->userManager->deleteUser($_GET['id']);
        $users = $this->userManager->getListUser();
        $vue = new Vue("AdminUser");
        $vue->generer(array('users' => $users));
    }

//----------------------partie POST - CHAPITRE---------------

    //AFFICHAGE DE POSTS ET COMMENTAIRES SUR LA PAGE VOIR PLUS
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
    
    //AFFICHAGE DES CHAPITRES SUR LA PAGE ADMINISTRATION DES CHAPITRES (MODIFICATION, SUPPRESSION°)
    public function afficherPageAdminChapter() {
        $chapitres = $this->postManager->getList();
        $vue = new Vue("AdminChapter");
        $vue->generer(array('chapitres' => $chapitres));
    }

    public function updateChapter() {
        
    }
    
    public function deleteChapter($id) {
        $deleteChapter = $this->postManager->deletePost($_GET['id']);
        $vue = new Vue("AdminChapter");
        header('Location: index.php?action=afficherPageAdmin');
    }

    //AFFICHAGE DU FORMULAIRE D'AJOUT DES CHAPITRES SUR LA PAGE AJOUT DES CHAPITRES
    public function afficherPageAdminAddChapter() {
        
        $vue = new Vue("AdminAddChapter");
        $vue->generer(array());
    }

    public function addChapter() {
        //echo "test1";
        if(isset($_POST['recordChapter'])) {
            //echo "test2";
            if(!empty($_POST['auteur']) && !empty($_POST['titre']) && !empty($_POST['contenu'])) {
                $auteur = htmlspecialchars($_POST['auteur']);
                $titre = htmlspecialchars($_POST['titre']);
                $contenu = htmlspecialchars($_POST['contenu']);
                
                $addChapter = $this->postManager->addPost($auteur, $titre, $contenu);
                
            } else {
                echo 'non'; //$erreur = "Veuillez remplir tous les champs";
            }
        }
        $vue = new Vue("AdminAddChapter");
        $vue->generer(array());
    }
    
//-----------------------partie COMMENTS----------------------

    public function afficherPageAdminComment() {
        //echo "test2";
        $comments = $this->commentManager->getListComment();
        $commentSignalesTableaux = $this->commentManager->getSignalComments();
        $vue = new Vue("AdminComment");
        $vue->generer(array('comments' => $comments, 'commentSignalesTableaux' => $commentSignalesTableaux));
    }
    
    /*public function ajoutComment($idNews) {
        if(isset($_POST['Commenter'])) {
            $post = $this->postManager->getNews($idNews);
            $commentaires = $this->commentManager->getComment($idNews);
            $commentsAjouts = null;
            if (isset($_POST) && !empty($_POST)) {
                if (!empty($_POST['authorComment']) && !empty($_POST['commentaire'])) {
                    $commentsAjouts = $this->commentManager->ajouterCommentaire($idNews, $_POST['authorComment'], $_POST['commentaire'], $signalerComment);
                    $message = 'Votre commentaire a bien été posté';
                } else {
                    $message = 'Veuillez remplir tous les champs';
                }
            }
        }
        $vue = new Vue("AddComment");
        $vue->generer(array('post' => $post, 'commentaires' => $commentaires, 'comments' => $comments, 'chapitres' => $chapitres, 'commentsAjouts' => $commentsAjouts));
    }*/

    public function signalerComment($id) { // A SUPPRIMER pas d'ajout de commentaires sur page admin
        $comments = $this->commentManager->getListComment();
        $commentSignales = $this->commentManager->signalComment($_GET['id']);
        $commentSignalesTableaux = $this->commentManager->getSignalComments($_GET['id']);
        $vue = new Vue("AdminComment");
        $vue->generer(array('comments' => $comments, 'commentSignales' => $commentSignales, 'commentSignalesTableaux' => $commentSignalesTableaux));
        
    }
    /*public function modifierComment($id) {
        $valideComment = $this->commentManager->updateComment(['id'=>$_GET['modifier'], 'authorComment'=>$_POST['authorComment'], 'commentaire'=>$_POST['commentaire'], 'signalerComment'=>$_POST['signalerComment']]);
        $message = 'Commentaire approuvé';
        if (isset($_GET['modifier'])) {
            //$comment = $this->commentManager->getOneComment((int) $_GET['modifier']);
        //}
        /*if((!empty($_POST['authorComment']) && !empty($_POST['commentaire']))) {
            $valideComment = $this->commentManager->updateComment(['id'=>$_GET['modifier'], 'authorComment'=>$_POST['authorComment'], 'commentaire'=>$_POST['commentaire']]);
            $message = 'Commentaire modifié';
        }
        $vue = new Vue("AdminComment");
        $vue->generer(array('comment' => $comment, 'valideComment' => $valideComment));
        //header('Location: index.php?action=afficherPageAdmin');
    }*/
    /*public function modifierComment($id) {
        if (isset($_GET['modifierComment'])) {
            //$comment = $this->commentManager->getOneComment((int) $_GET['modifierComment']);
            $comments = $this->commentManager->getOneComment((int) $_GET['modifierComment']);
            //var_dump($comments);
            //$vue = new Vue("AdminComment");
            //$vue->generer(array());
        }
        if(!empty($_POST['authorComment']) && !empty($_POST['commentaire'])) {
            //$valideComment = $this->commentManager->updateComment(['id'=>$_GET['modifierComment'], 'authorComment'=>$_POST['authorComment'], 'commentaire'=>$_POST['commentaire']]);
            $authorComment = htmlspecialchars($_POST['authorComment']);
            $commentaire = htmlspecialchars($_POST['commentaire']);
            //$signalerComment = ($_POST['signalerComment']);

            $valideComment = $this->commentManager->updateComment($authorComment, $commentaire);
            var_dump($valideComment);
            $vue = new Vue("AdminComment");
            $vue->generer(array('comment' => $comment, 'valideComment' => $valideComment));
        }
        $comments = $this->commentManager->getListComment();
        $commentSignales = $this->commentManager->signalComment($_GET['id']);
        $commentSignalesTableaux = $this->commentManager->getSignalComments($_GET['id']);
        $vue = new Vue("AdminComment");
        $vue->generer(array('comments' => $comments, 'commentSignales' => $commentSignales, 'commentSignalesTableaux' => $commentSignalesTableaux));
        //header('Location: index.php?action=afficherAdminComment');
    }*/
    public function modifierComment($id) {
        if (isset($_GET['modifierComment'])) {
            //$comment = $this->commentManager->getOneComment((int) $_GET['modifierComment']);
            $comments = $this->commentManager->getOneComment((int) $_GET['modifierComment']);
        }
        if(!empty($_POST['authorComment']) && !empty($_POST['commentaire'])) {
            //$valideComment = $this->commentManager->updateComment(['id'=>$_GET['modifierComment'], 'authorComment'=>$_POST['authorComment'], 'commentaire'=>$_POST['commentaire']]);
            $authorComment = htmlspecialchars($_POST['authorComment']);
            $commentaire = htmlspecialchars($_POST['commentaire']);
            //$signalerComment = ($_POST['signalerComment']);
            $valideComment = $this->commentManager->updateComment($authorComment, $commentaire);
            var_dump($valideComment);
            $vue = new Vue("AdminComment");
            $vue->generer(array('comment' => $comment, 'valideComment' => $valideComment));
        }
        header('Location: index.php?action=afficherAdminComment');
    }

    public function approvedComment($id){    
        //if (isset($_POST['supprimer'])){
            //$deleteComment = $this->commentManager->deleteComment((int) $_GET['supprimer']);
        $approvedComment = $this->commentManager->approved($_GET['id']);
            //echo 'test';
        $vue = new Vue("AdminComment");
        header('Location: index.php?action=afficherAdminComment');
        //}
    }
    public function deleteComment($id){    
        //if (isset($_POST['supprimer'])){
            //$deleteComment = $this->commentManager->deleteComment((int) $_GET['supprimer']);
        $deleteComment = $this->commentManager->deleteComment($_GET['id']);
            //echo 'test';
        $vue = new Vue("AdminComment");
        header('Location: index.php?action=afficherAdminComment');
        //}
    }
    
}
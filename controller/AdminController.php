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
    /*public function post($idNews) {
        $post = $this->postManager->getNews($idNews);
        $commentaires = $this->commentManager->getComment($idNews);
        /*ob_start();
        require ('view/VoirPlusView.php');
        $content = ob_get_clean();
        require ('view/template.php');
        $vue = new Vue("AdminChapter");
        $vue->generer(array('post' => $post, 'commentaires' => $commentaires));
    }*/
    
    //AFFICHAGE DES CHAPITRES SUR LA PAGE ADMINISTRATION DES CHAPITRES (MODIFICATION, SUPPRESSION°)
    public function afficherPageAdminChapter() {
        $chapitres = $this->postManager->getList();
        $vue = new Vue("AdminChapter");
        $vue->generer(array('chapitres' => $chapitres));
    }

    public function afficherChapter($id) {
        $getChapters =  $this->postManager->getOneChapter($_GET['id']);
        var_dump($_GET['id']);
        $vue = new Vue("AdminUpdateChapter");
        $vue->generer(array('getChapters' =>$getChapters));
        //header('Location: index.php?action=AdminComment');
    }

    public function modifierChapter($id) {
        //if(isset($_GET['id'])) {
            if(isset($_GET['id']) AND isset($_POST['auteur']) AND isset($_POST['titre']) AND isset($_POST['contenu'])) {
                var_dump($_GET['id']);
                if(!empty($_POST['auteur']) AND !empty($_POST['titre']) AND !empty($_POST['contenu'])) {
                    echo 'test3';
                    $auteur = htmlspecialchars($_POST['auteur']);
                    $titre = htmlspecialchars($_POST['titre']);
                    $contenu = htmlspecialchars($_POST['contenu']);
                    var_dump($auteur);
                    $id = (int) $_GET['id'];
                    var_dump($id);
                    $chapterUpdate = $this->postManager->updateChapter($auteur, $titre, $contenu, $id);
                    var_dump($chapterUpdate);
                }
            }
        //}
        //$getComments =  $this->commentManager->getOneComment($_GET['id']);
        //$vue = new Vue("AdminUpdateComment");
        //$vue->generer(array('getComments' =>$getComments));
        header('Location: index.php?action=afficherAdminChapter');
    }
    
    public function deleteChapter($id) {
        $deleteChapter = $this->postManager->deletePost($_GET['id']);
        $vue = new Vue("AdminChapter");
        header('Location: index.php?action=afficherPageAdminChapter');
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

//-----------------------partie page chapitres - tous les chapitres ----------------------

    public function afficherPageAllPosts() {
        $allPosts = $this->postManager->getList();
        $vue = new Vue("AllChapters");
        $vue->generer(array('allPosts' => $allPosts));
    }

//-----------------------partie ----------------------
    public function afficherMonProfil() {
        //echo "test2";
        $comments = $this->commentManager->getListComment();
        $vue = new Vue("MonProfil");
        $vue->generer(array('comments' => $comments));
    }

//-----------------------partie COMMENTS----------------------

    public function afficherPageAdminComment() {
        //echo "test2";
        $comments = $this->commentManager->getListComment();
        $commentSignalesTableaux = $this->commentManager->getSignalComments();
        $vue = new Vue("AdminComment");
        $vue->generer(array('comments' => $comments, 'commentSignalesTableaux' => $commentSignalesTableaux));
    }

    public function signalerComment($id) {
        echo "test2";
        $comments = $this->commentManager->getListComment();
        $commentSignales = $this->commentManager->signalComment($_GET['id']);
        $commentSignalesTableaux = $this->commentManager->getSignalComments($_GET['id']);
        $vue = new Vue("VoirPlus");
        $vue->generer(array('comments' => $comments, 'commentSignales' => $commentSignales, 'commentSignalesTableaux' => $commentSignalesTableaux));
    }

    public function afficherComment($id) {
        $getComments =  $this->commentManager->getOneComment($_GET['id']);
        var_dump($_GET['id']);
        //var_dump($getComments);
        $vue = new Vue("AdminUpdateComment");
        $vue->generer(array('getComments' =>$getComments));
        //header('Location: index.php?action=AdminComment');
    }

    public function modifierComment($id) {
        //if(isset($_GET['id'])) {
            if(isset($_GET['id']) && isset($_POST['authorComment']) AND isset($_POST['commentaire'])) {
                echo"test12";
                var_dump($_GET['id']);
                if(!empty($_POST['authorComment']) AND !empty($_POST['commentaire'])) {
                    echo 'test3';
                    $authorComment = htmlspecialchars($_POST['authorComment']);
                    $commentaire = htmlspecialchars($_POST['commentaire']);
                    var_dump($authorComment);
                    $id = (int) $_GET['id'];
                    var_dump($id);
                    $commentUpdate = $this->commentManager->updateComment($authorComment, $commentaire, $id);
                    var_dump($commentUpdate);
                }
            }
        //}
        //$getComments =  $this->commentManager->getOneComment($_GET['id']);
        //$vue = new Vue("AdminUpdateComment");
        //$vue->generer(array('getComments' =>$getComments));
        header('Location: index.php?action=afficherAdminComment');
    }
    
    public function approvedComment($id){    
        $approvedComment = $this->commentManager->approved($_GET['id']);
        $vue = new Vue("AdminComment");
        header('Location: index.php?action=afficherAdminComment');
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
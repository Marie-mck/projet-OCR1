<?php

//namespace tpnews5a\controller;
//require 'controller/controller';
//require 'model/PostManager.php';
//require 'model/CommentManager.php';
//require 'view/Vue.php';

class PostController {
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

//----------------------partie POST - CHAPITRE---------------
    
    //AFFICHAGE DES CHAPITRES SUR LA PAGE ADMINISTRATION DES CHAPITRES (MODIFICATION, SUPPRESSION)
    public function afficherPageAdminChapter() {
        $chapitres = $this->postManager->getList();
        $vue = new Vue("AdminChapter");
        $vue->generer(array('chapitres' => $chapitres));
    }

    public function afficherChapter($id) {
        $getChapters = $this->postManager->getOneChapter($_GET['id']);
        $vue = new Vue("AdminAddChapter");
        $vue->generer(array('getChapters' => $getChapters));
    }

    public function modifierChapter($id) {
            if(isset($_GET['id'])) {
            
            if(isset($_POST['contenu']) AND isset($_POST['titre'])) {
                if(!empty($_POST['contenu']) AND !empty($_POST['titre'])) {
                    $titre = htmlspecialchars($_POST['titre']);
                    $contenu = htmlspecialchars($_POST['contenu']);
                    $id = (int) $_GET['id'];
                    $chapterUpdate = $this->postManager->updateChapter($contenu, $titre, $id);
                }
            }
        }
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
        if(isset($_POST['recordChapter'])) {
            if(!empty($_POST['contenu']) && !empty($_POST['titre'])) {
                $titre = htmlspecialchars($_POST['titre']);
                $contenu = htmlspecialchars($_POST['contenu']);
                $addChapter = $this->postManager->addPost($contenu, $titre);
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
        $comments = $this->commentManager->getListComment();
        $vue = new Vue("MonProfil");
        $vue->generer(array('comments' => $comments));
    }

}
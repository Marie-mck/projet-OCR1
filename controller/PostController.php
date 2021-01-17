<?php
namespace App\Controller;
//namespace tpnews5a\controller;
//require 'controller/controller';
//require 'model/PostManager.php';
//require 'model/CommentManager.php';
//require 'view/Vue.php';
use App\Model\PostManager;
use App\Model\CommentManager;
use App\Model\UserManager;
use App\Model\Vue;

class PostController {
    protected $postManager;
    protected $commentManager;
    protected $userManager;

    public function __construct() {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->userManager = new UserManager();
    }
    
// PAGE ADMIN - tableau des chapitres et tableau des commentaires sur la page modifier, approuver, supprimer un commentaire

//----------------------partie POST - CHAPITRE---------------
    
    //AFFICHAGE DES CHAPITRES SUR LA PAGE ADMINISTRATION DES CHAPITRES (MODIFICATION, SUPPRESSION)
    public function afficherPageAdminChapter() {
        $chapitres = $this->postManager->getList();
        $vue = new Vue("admin/AdminChapter");
        $vue->addJsFile("");
        $vue->generer(array('chapitres' => $chapitres));
    }

    public function afficherChapter($id) {
        $getChapters = $this->postManager->getOneChapter($_GET['id']);
        $vue = new Vue("admin/AdminUpdateChapter");
        $vue->addJsFile("");
        $vue->generer(array('getChapters' => $getChapters));
    }

    public function addChapter() {
        if(isset($_POST['recordChapter'])) {
            if(!empty($_POST['contenu']) && !empty($_POST['titre'])) {
                $titre = htmlspecialchars($_POST['titre']);
                $contenu = htmlspecialchars($_POST['contenu']);
                $auteur = htmlspecialchars($_POST['auteur']);
                $picture = htmlspecialchars($_POST['picture']);
                $addChapter = $this->postManager->addPost($auteur, $contenu, $titre, $picture);
            } else {
                echo 'non'; //$erreur = "Veuillez remplir tous les champs";
                $message = 'Veuillez remplir tous les champs';
            }
            $message = 'Votre commentaire a bien été posté';
            $vue = new Vue("admin/AdminAddChapter");
            $vue->addJsFile("");
            $vue->generer(array('message' => $message));
        }
        $vue = new Vue("admin/AdminAddChapter");
        $vue->addJsFile("");
        $vue->generer(array());
        
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
        $vue = new Vue("admin/AdminChapter");
        $vue->addJsFile("");
        header('Location: index.php?action=afficherAdminChapter');
    }

    //AFFICHAGE DU FORMULAIRE D'AJOUT DES CHAPITRES SUR LA PAGE AJOUT DES CHAPITRES
    public function afficherPageAdminAddChapter() {
        $vue = new Vue("admin/AdminAddChapter");
        $vue->generer(array());
    }

//-----------------------partie page chapitres - tous les chapitres ----------------------
    public function afficherPageAllPosts() {
        $allPosts = $this->postManager->getList();
        $vue = new Vue("admin/AllChapters");
        $vue->generer(array('allPosts' => $allPosts));
    }
}
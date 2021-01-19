<?php
namespace projet4\controller;

use projet4\model\PostManager;
use projet4\model\CommentManager;
use projet4\model\UserManager;
use projet4\model\Vue;

class PostController {
    protected $postManager;
    protected $commentManager;
    protected $userManager;

    public function __construct() {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->userManager = new UserManager();
    }
    
// PAGE ADMIN - tableau des chapitres modifier, approuver, supprimer

//----------------------partie POST - CHAPITRE---------------
    
    //AFFICHAGE DES CHAPITRES SUR LA PAGE ADMINISTRATION DES CHAPITRES (MODIFICATION, SUPPRESSION)
    public function afficherPageAdminChapter() {
        $chapitres = $this->postManager->getList();
        $vue = new Vue("admin/AdminChapter");
        $vue->addJsFile("public/js/postTable.js?v=1.0");
        $vue->generer(array('chapitres' => $chapitres));
    }

    public function afficherChapter($id) {
        $getChapters = $this->postManager->getOneChapter($_GET['id']);
        $vue = new Vue("admin/AdminUpdateChapter");
        $vue->generer(array('getChapters' => $getChapters));
    }

    public function addChapter() {
        if(isset($_POST['recordChapter'])) {
            if(!empty($_POST['contenu']) && !empty($_POST['titre'])) {
                $titre = htmlspecialchars($_POST['titre']);
                $contenu = htmlspecialchars($_POST['contenu']);
                $auteur = htmlspecialchars($_POST['auteur']);

                $picture = htmlspecialchars($_FILES['picture']['name']);
                $addChapter = $this->postManager->addPost($auteur, $contenu, $titre, $picture);
                $uploaddir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
                $uploadfile = $uploaddir . basename($_FILES['picture']['name']);
                //var_dump($uploadfile);
                if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile)) {
                    
                    echo "Le fichier est valide, et a été téléchargé   avec succès. Voici plus d'informations :\n";
                } else {
                    echo "Attaque potentielle par téléchargement de fichiers. Voici plus d'informations :\n";
                
                }
            } else {
                $message = 'Veuillez remplir tous les champs';
            }
            $message = 'Votre billet a bien été posté';
            $vue = new Vue("admin/AdminAddChapter");
            $vue->generer(array('message' => $message));
        }
        $vue = new Vue("admin/AdminAddChapter");
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
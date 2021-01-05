<?php
//define('ROOT', dirname(__DIR__));
//echo ROOT;
//namespace tpnews5a\controller;
//require 'controller/Controller.php';
require 'controller/HomeController.php';
require 'controller/VoirPlusController.php';
require 'controller/PostController.php';
require 'controller/ConnexionController.php';
require 'controller/RegistrationController.php';
require 'controller/UserController.php';
require 'controller/CommentController.php';
require 'view/Vue.php';
require 'login.php';

class Routeur {
    protected $pageHome;
    protected $pageVoirPlus;
    protected $pageAddComment;
    protected $pagePost;
    protected $pageConnexion;
    protected $pageRegistration;
    protected $pageUser;
    protected $pageComment;

    public function __construct() {
        $this->pageHome = new HomeController();
        $this->pageVoirPlus = new VoirPlusController();
        $this->pageAddComment = new VoirPlusController();
        $this->pagePost = new PostController();
        $this->pageConnexion = new ConnexionController();
        $this->pageRegistration = new RegistrationController();
        $this->pageUser = new UserController();
        $this->pageComment = new CommentController();
    }

    public function route() {
        try {
            if (isset($_GET['action'])) {
                
                // PAGE CONNEXION
                if ($_GET['action'] == 'connect') {//se connecter -> formulaire de connection sur page de connection qd clic bouton connexion
                    $this->pageConnexion->connect();
                }
                if ($_GET['action'] == 'connexionPage') {//va sur page de connection qd clic bouton connexion
                    if(isset($_POST['connexion'])) {
                        $this->pageConnexion->connexion($_POST['pseudo'], $_POST['motDePasse']);
                    } else {
                        $this->pageConnexion->connexionPage();
                    }
                }
                if ($_GET['action'] == 'registration') { //s'inscrire -> formulaire d'inscription sur page d'inscription
                    $this->pageRegistration->registration();
                }

                if ($_GET['action'] == 'addOneUser') {
                    $this->pageConnexion->addOneUser();
                }
                if ($_GET['action'] == 'logOut') {//se connecter -> formulaire de connection sur page de connection qd clic bouton connexion
                    $this->pageConnexion->logOut();
                }

                // PAGE VOIRPLUS AFFICHE 1 CHAPITRE ET SES COMMENTAIRES
                elseif ($_GET['action'] == 'post') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $id = (int) $_GET['id'];
                        $this->pageVoirPlus->post($id);
                    } else {
                        throw new Exception ('mauvais id');
                    }
                }
                // ------------ AJOUT COMMENT / IDNEWS
                elseif ($_GET['action'] == 'ajoutComment') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $this->pageAddComment->ajoutComment($_GET['id']);
                    } else
                        throw new Exception('Aucun identifiant envoyé');
                }
                
        // si connecté alors accès à l'admin

            elseif (isset($_SESSION['pseudo'])) {
                
                    // ------------ PAGE ADMIN CHAPTER
                if ($_GET['action'] == 'afficherAdminChapter') {
                    if(isset($_GET['supprimerChapter'])) {
                        $id = (int) $_GET['id'];
                        $this->pagePost->deleteChapter($id);
                    
                    } elseif (isset($_GET['modifierChapterBtn'])) {
                        $id = (int) $_GET['id'];
                        $this->pagePost->afficherChapter($id);
                    
                    } elseif (isset($_GET['modifierNewChapter'])) {
                        $id = (int) $_GET['id'];
                        $this->pagePost->modifierChapter($id);
                    
                    } elseif (isset($_GET['addChapter'])) {
                        $this->pagePost->addChapter();

                    } else {
                        $this->pagePost->afficherPageAdminChapter();
                    }
                }
                
                // --------------PAGE ADMIN COMMENTS
                elseif ($_GET['action'] == 'afficherAdminComment') {
                    if(isset($_GET['supprimer'])) {
                        $id = (int) $_GET['id'];
                        $this->pageComment->deleteComment($id);

                    } elseif (isset($_GET['modifierCommentBtn'])) {
                        $id = (int) $_GET['id'];
                        $this->pageComment->afficherComment($id);

                    } elseif (isset($_GET['modifierNewComment'])) {
                        $id = (int) $_GET['id'];
                        $this->pageComment->modifierComment($id);

                    } elseif(isset($_GET['approvedComment'])) {
                        $id = (int) $_GET['id'];
                        $this->pageComment->approvedComment($id);
                    } else {
                        $this->pageComment->afficherPageAdminComment();
                    }
                }
                    
                    //-----------APPROUVER / SIGNALER COMMENT ?
                elseif ($_GET['action'] == 'signalerComment') {
                    $id = (int) $_GET['id'];
                    $this->pageComment->signalerComment($id);
                }
                elseif ($_GET['action'] == 'afficherMonProfil') {
                    $this->pageComment->afficherMonProfil();
                }
                
                // -------------PAGE ADMIN USERS
                else if ($_GET['action'] == 'afficherAdminUser') {
                    if(isset($_GET['supprimerUser'])) {
                        $id = (int) $_GET['id'];
                        $this->pageUser->deleteUser($id);

                    } elseif (isset($_GET['modifierUserBtn'])) {
                        $id = (int) $_GET['id'];
                        $this->pageUser->afficherUser($id);

                    } elseif (isset($_GET['modifierNewUser'])) {
                        $id = (int) $_GET['id'];
                        $this->pageUser->modifierUser($id);
                    
                    } else {
                        $this->pageUser->afficherPageAdminUser();
                    }
                }
                
                // -------------PAGE CHAPTERS
                else if ($_GET['action'] == 'afficherPageAllPosts') {
                    $this->pagePost->afficherPageAllPosts();
                }
            }

            } else {  // aucune action définie : affichage de l'accueil
                $this->pageHome->listPosts();
            }
            
        }
        catch (Exception $e) {
            $this->erreur($e->getMessage());
        }
        
    }
      // Affiche une erreur
    private function erreur($msgErreur) {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
    // Recherche un paramètre dans un tableau
    private function getParametre($tableau, $nom) {
        if (isset($tableau[$nom])) {
        return $tableau[$nom];
        }
        else
        throw new Exception("Paramètre '$nom' absent");
    }
}
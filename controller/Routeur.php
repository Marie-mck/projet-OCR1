<?php
//define('ROOT', dirname(__DIR__));
//echo ROOT;
//namespace tpnews5a\controller;

//require 'controller/Controller.php';
require 'controller/HomeController.php';
require 'controller/VoirPlusController.php';
require 'controller/AdminController.php';
require 'controller/ConnexionController.php';
require 'view/Vue.php';
require 'login.php';

class Routeur {
    protected $pageHome;
    protected $pageVoirPlus;
    protected $pageAddComment;
    protected $pageAdmin;
    protected $pageConnexion;

    public function __construct() {
        $this->pageHome = new HomeController();
        $this->pageVoirPlus = new VoirPlusController();
        $this->pageAddComment = new VoirPlusController();
        $this->pageAdmin = new AdminController();
        $this->pageConnexion = new ConnexionController();
        
    }

    public function route() {
        try {
            if (isset($_GET['action'])) {
                /*if ($_GET['action'] == 'is_logged') { // si déjà connécté
                    echo 'dejà connecté';
                    if (!empty($_POST['pseudo']) && !empty($_POST['motDePasse'])) {
                        if ($_POST['pseudo'] === 'john' && $_POST['motDePasse'] === 'doe') {
                        session_start();
                        $_SESSION['connecte'] = 1;
                        $this->pageConnexion->is_logged();
                    }
                    } else {
                        echo 'probleme'; //$erreur = 'identifiant incorrect';
                    }
                }*/
                
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
                    $this->pageConnexion->registration();
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
                    }
                    else {
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

            //elseif (isset($_POST['connexion'])) {
                //if(isset($_SESSION['pseudo'])) {
                
                    // ------------ PAGE ADMIN CHAPTER
                if ($_GET['action'] == 'afficherAdminChapter') {
                    if(isset($_GET['supprimerChapter'])) {
                        $id = (int) $_GET['id'];
                        $this->pageAdmin->deleteChapter($id);
                    
                    } elseif (isset($_GET['modifierChapterBtn'])) {
                        //echo"test12";
                        $id = (int) $_GET['id'];
                        $this->pageAdmin->afficherChapter($id);
                        
                    } elseif (isset($_GET['modifierNewChapter'])) {
                        $id = (int) $_GET['id'];
                        $this->pageAdmin->modifierChapter($id);
                    }
                    else if (isset($_GET['addChapter'])) {
                        $this->pageAdmin->addChapter();
                    
                    } else {
                        $this->pageAdmin->afficherPageAdminChapter();
                    }
                }
                /*else if ($_GET['action'] == 'addChapter') {
                    $this->pageAdmin->addChapter();
                }*/

                // --------------PAGE ADMIN COMMENTS
                elseif ($_GET['action'] == 'afficherAdminComment') {
                    if(isset($_GET['supprimer'])) {
                        $id = (int) $_GET['id'];
                        $this->pageAdmin->deleteComment($id);
                        //$this->pageAdmin->deleteComment((int) $_GET['supprimer']);

                    } elseif (isset($_GET['modifierCommentBtn'])) {
                        //echo"test12";
                        $id = (int) $_GET['id'];
                        $this->pageAdmin->afficherComment($id);

                    } elseif (isset($_GET['modifierNewComment'])) {
                        //if(isset($_GET['id'])) {
                        $id = (int) $_GET['id'];
                        $this->pageAdmin->modifierComment($id);
                        //}

                    } elseif(isset($_GET['approvedComment'])) {
                        $id = (int) $_GET['id'];
                        $this->pageAdmin->approvedComment($id);
                    } else {
                        $this->pageAdmin->afficherPageAdminComment();
                    }
                }
                    //-------Modifier Comment
                    /*elseif (isset($_GET['modifierComment'])) {
                    echo 'ok3';:
                    $id = (int) $_GET['id'];
                    $this->pageAdmin->modifierComment($id);
                    }*/
                    /*} elseif(isset($_GET['modifierNewComment'])) {
                            echo 'ok3';
                            $this->pageAdmin->modifierComment($_GET['id'], $_POST['authorComment'], $_POST['commentaire']);
                            //$this->pageAdmin->modifierComment($id);
                    */
                    
                    //-----------APPROUVER / SIGNALER COMMENT ?
                elseif ($_GET['action'] == 'signalerComment') {
                    $id = (int) $_GET['id'];
                    $this->pageAdmin->signalerComment($id);
                }
                elseif ($_GET['action'] == 'afficherMonProfil') {
                    $this->pageAdmin->afficherMonProfil();
                }
                
                // -------------PAGE ADMIN USERS
                else if ($_GET['action'] == 'afficherAdminUser') {
                    if(isset($_GET['supprimerUser'])) {
                        $id = (int) $_GET['id'];
                        $this->pageAdmin->deleteUser($id);
                    } else {
                        $this->pageAdmin->afficherPageAdminUser();
                    }
                }
                /*else if ($_GET['action'] == 'afficherPageAdmin') {
                    if(isset($_GET['supprimer'])) {
                        $id = (int) $_GET['id'];
                        //var_dump($id);
                        $this->pageAdmin->deleteComment($id);
                        //var_dump($id);
                        //$this->pageAdmin->deleteComment((int) $_GET['supprimer']);
                        //$this->pageAdmin->deleteComment((int) $_GET['supprimer']);
                    } elseif(isset($_POST['valider'])) {
                        //echo 'ok3';
                        $this->pageAdmin->validateComment();
                    } else {
                        $this->pageAdmin->afficherPageAdmin();
                    }
                }*/
                // -------------PAGE CHAPTERS
                else if ($_GET['action'] == 'afficherPageAllPosts') {
                    $this->pageAdmin->afficherPageAllPosts();
                }
                
            //}

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
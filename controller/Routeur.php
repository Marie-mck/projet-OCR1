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
    protected $pageConnexion;

    public function __construct() {
        $this->pageHome = new HomeController();
        $this->pageVoirPlus = new VoirPlusController();
        $this->pageAddComment = new VoirPlusController();
        $this->pageUpdateComment = new AdminController();
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

                /*elseif ($_GET['action'] == 'post') {
                    //$idNews = (int) $_GET['idNews'];
                    //$this->pageVoirPlus->post($idNews);
                    $idNews = intval($this->getParametre($_GET, 'id'));
                        if ($idNews != 0) {
                            $this->pageVoirPlus->post($idNews);
                        }
                        else
                            throw new Exception("Identifiant de billet non valide");
                }*/
                elseif ($_GET['action'] == 'post') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $id = (int) $_GET['id'];
                        $this->pageVoirPlus->post($id);
                    }
                    else {
                        throw new Exception ('mauvais id');
                    }
                        /*$idNews = intval($this->getParametre($_GET, 'id'));
                        if ($idNews != 0) {
                            $this->pageVoirPlus->post($idNews);
                        }
                        else
                            throw new Exception("Identifiant de billet non valide");*/
                }
                elseif ($_GET['action'] == 'ajoutComment') {
                        if (isset($_GET['id']) && $_GET['id'] > 0) {
                            //$this->pageAddComment->ajoutComment($_GET['id'], $_POST['authorComment'], $_POST['commentaire']);
                            $this->pageAddComment->ajoutComment($_GET['id']);
                        } else
                            throw new Exception('Aucun identifiant envoyé');
                }
                /*if ($_GET['action'] == 'connexionPage') {//va sur page de connection qd clic bouton connexion
                    if(isset($_POST['connexion'])) {
                        $this->pageConnexion->connexion($_POST['pseudo'], $_POST['motDePasse']);
                    } else {
                        $this->pageConnexion->connexionPage();
                    }
                }*/
                else if ($_GET['action'] == 'afficherPageAdmin') {
                    if(isset($_GET['supprimerPost'])) {
                        $id = (int) $_GET['id'];
                        $this->pageUpdateComment->deleteChapter($id);

                    } elseif(isset($_POST['valider'])) {
                        $this->pageUpdateComment->validateComment();
                    
                    } elseif(isset($_GET['supprimer'])) {
                        $id = (int) $_GET['id'];
                        //var_dump($id);
                        $this->pageUpdateComment->deleteComment($id);
                        //var_dump($id);
                        //$this->pageUpdateComment->deleteComment((int) $_GET['supprimer']);
                    
                    } elseif(isset($_POST['valider'])) {
                        //echo 'ok3';
                        $this->pageUpdateComment->validateComment();

                    } else {
                        $this->pageUpdateComment->afficherPageAdmin();
                    }
                }
                /*else if ($_GET['action'] == 'afficherPageAdmin') {
                    if(isset($_GET['supprimer'])) {
                        $id = (int) $_GET['id'];
                        //var_dump($id);
                        $this->pageUpdateComment->deleteComment($id);
                        //var_dump($id);
                        //$this->pageUpdateComment->deleteComment((int) $_GET['supprimer']);
                        //$this->pageUpdateComment->deleteComment((int) $_GET['supprimer']);
                    } elseif(isset($_POST['valider'])) {
                        //echo 'ok3';
                        $this->pageUpdateComment->validateComment();
                    } else {
                        $this->pageUpdateComment->afficherPageAdmin();
                    }
                }*/
                else if ($_GET['action'] == 'ajoutOfComment') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        //$this->pageAddComment->ajoutComment($_GET['id'], $_POST['authorComment'], $_POST['commentaire']);
                        $this->pageUpdateComment->ajoutOfComment($_GET['id']);
                    } else {
                        throw new Exception('Aucun identifiant envoyé');
                    }
                }
                /*else if ($_GET['action'] == 'afficherPageAdmin') {
                    $this->pageUpdateComment->afficherPageAdmin();
                    //$this->pageUpdateComment->afficherPageAdminInfo($_GET['id']);
                }
                else if ($_GET['action'] == 'validateComment') {
                    if(isset($_POST['modifier']) && !empty($_POST['authorComment']) && !empty($_POST['commentaire'])) {
                        $this->pageUpdateComment->validateComment();
                    }
                }
                else if ($_GET['action'] == 'deleteComment') {
                    if (isset($_GET['id'])) {
                    $this->pageUpdateComment->deleteComment($_POST['id']);
                    }
                }*/
            }
                else {  // aucune action définie : affichage de l'accueil
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
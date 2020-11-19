<?php
define('ROOT', dirname(__DIR__));
echo ROOT;
//namespace tpnews5a\controller;

//require 'controller/Controller.php';
require 'controller/HomeController.php';
require 'controller/VoirPlusController.php';
require 'controller/AdminController.php';
require 'view/Vue.php';

class Routeur {
    protected $pageHome;
    protected $pageVoirPlus;
    protected $pageAddComment;

    public function __construct() {
        $this->pageHome = new HomeController();
        $this->pageVoirPlus = new VoirPlusController();
        $this->pageAddComment = new VoirPlusController();
        $this->pageUpdateComment = new AdminController();
    }

    public function route() {
        try {
            
            if (isset($_GET['action'])) {

                if ($_GET['action'] == 'connexion') {
                $idNews = intval($this->getParametre($_GET, 'id'));
                    
                }
                elseif ($_GET['action'] == 'post') {
                    $idNews = intval($this->getParametre($_GET, 'id'));
                        if ($idNews != 0) {
                            $this->pageVoirPlus->post($idNews);
                        }
                        else
                            throw new Exception("Identifiant de billet non valide");
                    }
                elseif ($_GET['action'] == 'ajoutComment') {
                    
                        if (isset($_GET['id']) && $_GET['id'] > 0) {
                            $idNews = intval($this->getParametre($_GET, 'id'));
                            //$this->pageAddComment->ajoutComment($idNews, $authorComment, $commentaire);
                            //$this->pageAddComment->ajoutComment($_GET['id'], $_POST['authorComment'], $_POST['commentaire']);
                            $this->pageAddComment->ajoutComment($_GET['id']);
                        }
                        else {
                            throw new Exception('Aucun identifiant envoyé');
                        }
                    
                }
                /*else if ($_GET['action'] == 'ajoutComment') {
                    //die('test');
                    $idNews = $this->getParametre($_GET, 'id');
                    var_dump($idNews);
                    $authorComment = $this->getParametre($_POST, 'authorComment');
                    $commentaire = $this->getParametre($_POST, 'commentaire');
                    $this->pageAddComment->ajoutComment($authorComment, $commentaire, $idNews);
                    //$this->pageAddComment->ajoutComment($_GET, 'idNews', $_POST, 'authorComment', $_POST, 'commentaire');
                    
/* elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['authorComment']) && !empty($_POST['commentaire'])) {
                    addComment($_GET['id'], $_POST['authorComment'], $_POST['commentaire']);
                }
                else {
                    //echo 'Erreur : tous les champs ne sont pas remplis !';
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }*/
                else if ($_GET['action'] == 'validateComment'){
                    $this->pageUpdateComment->validateComment();
                }
                else if ($_GET['action'] == 'deleteComment'){
                    $id = intval($this->getParametre($_GET, 'id'));
                    $this->pageUpdateComment->deleteComment($id);
                }
                else if ($_GET['action'] == 'commentTable'){
                    $this->pageUpdateComment->commentTable();
                    //$this->pageUpdateComment->countComment();
                }
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
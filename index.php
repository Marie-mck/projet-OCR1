<?php

//namespace tpnews5a;
require 'controller/controller.php';
//require 'view/HomeView.php';
//require 'view/VoirPlusView.php';

class Routeur {
    protected $Home;

    public function __construct() {
        //require 'controller/controller.php';
        $this->Home = new Controller();
        
    }

    public function route() {
        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'listPosts') {
                    $this->Home->listPosts();
                    
                    //require 'view/HomeView.php';
                }
                elseif ($_GET['action'] == 'post') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $this->Home->post($idNews);
                      //  require 'view/VoirPlusView.php';
                    }
                    else {
                        //echo 'Erreur : aucun identifiant de billet envoyé';
                        throw new Exception ('aucun identifiant de billet envoyé');
                    }
                }
                elseif ($_GET['action'] == 'addComment') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        if (!empty($_POST['authorComment']) && !empty($_POST['commentaire'])) {
                            $this->Home->ajoutComment($_GET['id'], $_POST['authorComment'], $_POST['commentaire']);
                        }
                        else {
                            //echo 'Erreur : tous les champs ne sont pas remplis !';
                            throw new Exception('Tous les champs ne sont pas remplis !');
                        }
                    }
                    else {
                        //echo 'Erreur : aucun identifiant de billet envoyé';
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                }
            }
            else {
                $this->Home->listPosts();
            }
        }
        catch(Exception $e) {
            //echo 'Erreur:'.$e->getMessage();
            $errorMessage = $e->getMessage();
            require('view/errorView.php');
        }
    }
}
$routeur = new Routeur();
$routeur->route();


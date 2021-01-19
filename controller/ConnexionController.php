<?php
namespace projet4\controller;

use projet4\model\UserManager;
use projet4\model\Vue;

class ConnexionController {
    protected $userManager;
    
    public function __construct() {
        $this->userManager = new UserManager();
    }

    // CONNEXION
    function connect() {
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            $userInfo = $this->userManager->checkUser($_POST['pseudo'], $_POST['motDePasse']);
            $vue = new Vue("monProfil");
            $vue->generer(array('userInfo' => $userInfo));
            echo 'ca marche';
        }
    }
    //bouton connexion pour se connecter -> vers page connexion
    public function connexionPage() {!
        $users = $this->userManager->getListUser();
        $vue = new Vue("Connexion");
        $vue->generer(array('users' => $users));
    }

    public function connexion($pseudo, $motDePasse) {
        if(isset($_POST['connexion']) && isset($_POST['pseudo']) && isset($_POST['motDePasse'])) {
            $user = $this->userManager->getUser($_POST['pseudo']);
            if(!empty($user)) {
                if ($passHache = password_verify($_POST['motDePasse'], $user['motDePasse'])) {
                    $_SESSION['pseudo'] = $pseudo;
                    header('Location: index.php');
                    exit;
                } else {
                    $erreur = "Le pseudo ou le mot de passe est incorrect";
                }
                } else {
                echo 'tous les champs doivent être complétés';
            }
        $getUser = $this->userManager->checkUser($pseudo, $motDePasse);
        $users = $this->userManager->getListUser();
        $vue = new Vue("Connexion");
        $vue->generer(array('users' => $users, 'getUser' => $getUser, 'erreur' => $erreur));
        }
    }

//DECONNEXION
    public function logOut() {
        session_start();
        $_SESSION = array('connecte');
        session_destroy();
        unset ($_SESSION);
        unset ($_SESSION ['pseudo']);
        header('Location:index.php');
    }
}
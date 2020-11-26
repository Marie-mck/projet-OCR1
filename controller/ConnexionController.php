<?php

require 'model/UserManager.php';

class ConnexionController {
    protected $userManager;

    public function __construct() {
        session_start();
        $this->userManager = new UserManager();
    }

    //liste des users
    public function listUser() {
        $users = $this->userManager->getListUser();
        $vue = new Vue("Connexion");
        $vue->generer(array('users' => $users));
    }
    // connexion ou inscription
    function connect ($pseudo, $motDePasse) {
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            //$getid = intval($_GET['id']);
            $userInfo = $this->userManager->checkUser($pseudo, $motDePasse);
            $vue = new Vue("monProfil");
            $vue->generer(array('userInfo' => $userInfo));
            echo 'ca marche';
            var_dump($userInfo);
        }
    }
    //bouton connexion pour se connecter -> vers page connexion
    public function connexionPage() {
        $users = $this->userManager->getListUser();
        $vue = new Vue("Connexion");
        $vue->generer(array('users' => $users));
    }
    //est ce que l'utilisateur est déjà connecté ?
    public function alreadyLogged() {
        echo 'est connecté';
    }
    public function is_logged() : bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
            $_SESSION['connecte'] = 1;
            echo 'est connecté';
            $users = $this->userManager->getListUser();
            $vue = new Vue("Connexion");
            $vue->generer(array('users' => $users));
            echo 'est connecté';
        }
        return !empty($_SESSION['connecte']);
        //$vue = new Vue("index");
        header('Location: index.php');
    }
    function utilisateurConnecte() : void {
        if(!is_logged()) {
            header('Location: view/viewRegistration.php');
            exit(); //pour pas continuer le script si l'utilisateur n'est pas connecté
        }
    }
    public function registration() {
        if(isset($_POST['inscription'])) {
            //echo 'ok';
            $pass_hache = password_hash($_POST['motDePasse'], PASSWORD_DEFAULT);

            if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['motDePasse'])) {
                //echo 'ok';
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $email = htmlspecialchars($_POST['email']);
                $motDePasse = $pass_hache;

                $users = $this->userManager->getListUser();
                $addUser = $this->userManager->addUser($pseudo, $email, $motDePasse);
                $vue = new Vue("Registration");
                $vue->generer(array('addUser' => $addUser, 'users' => $users));
                $message = 'user bien enregistré';
            } else {
                echo 'non'; //$erreur = "Veuillez remplir tous les champs";
            }
        }
        $users = $this->userManager->getListUser();
        $vue = new Vue("Registration");
        $vue->generer(array('users' => $users));
    }

    public function connexion($pseudo, $motDePasse) {
        echo 'ok';
        if(isset($_POST['connexion']) && isset($_POST['pseudo']) && isset($_POST['motDePasse'])) {
            /*if (session_status() === PHP_SESSION_NONE) {
                session_start();
                $_SESSION['connecte'] = 1;
                echo 'est connecté';
            */
            $getUser = $this->userManager->checkUser($pseudo, $motDePasse);
            $vue = new Vue("Connexion");
            $vue->generer(array('getUser' => $getUser));
            
            $pseudo = $this->userManager->checkUser($pseudo);
            $pass_hache = $this->userManager->checkUser($motDePasse);
            $passHache = password_verify($_POST['motDePasse'], $pass_hache);

            if(!empty($_POST['pseudo']) && !empty($_POST['motDePasse'])) {
                echo 'ok';
                if(($_POST['motDePasse'] == $passHache) && ($_POST['pseudo'] == $pseudo)) {
                    session_start();
                    $_SESSION['pseudo'] = $pseudo;
                    header('Location: index.php');
                    echo 'ok connection';
                } else {
                    echo 'le mot de passe ou le pseudo est invalide';
                }
            } else {
                echo 'tous les champs doivent être connectés';
            }
        }
        $getUser = $this->userManager->checkUser();
        $users = $this->userManager->getListUser();
        $vue = new Vue("Connexion");
        $vue->generer(array('users' => $users, 'getUser' => $getUser));
    }
    /*public function initSession() : bool{
            if(!session_id()) {
                session_start();
                session_regenerate_id();
                return true;
                $vue = new Vue("Connexion");
                echo 'connecté';
            }
            echo 'pas connecté';
        }*/
        
    public function logOut() {
        session_start();
        $_SESSION = array('connecte');
        session_destroy();
        unset ($_SESSION);
        unset ($_SESSION ['pseudo']);
        header('Location:index.php');
    }
}
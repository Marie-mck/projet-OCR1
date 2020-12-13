<?php

require 'model/UserManager.php';

class ConnexionController {
    protected $userManager;

    public function __construct() {
        $this->userManager = new UserManager();
    }

    //liste des users
    /*public function listUser() {
        $users = $this->userManager->getListUser();
        $vue = new Vue("Connexion");
        $vue->generer(array('users' => $users));
    }*/
    

// CONNEXION
    function connect() {
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            //$getid = intval($_GET['id']);
            //$userInfo = $this->userManager->checkUser($pseudo, $motDePasse);
            $userInfo = $this->userManager->checkUser($_POST['pseudo'], $_POST['motDePasse']);
            $vue = new Vue("monProfil");
            $vue->generer(array('userInfo' => $userInfo));
            echo 'ca marche';
        }
    }
    //bouton connexion pour se connecter -> vers page connexion
    public function connexionPage() {
        $users = $this->userManager->getListUser();
        $vue = new Vue("Connexion");
        $vue->generer(array('users' => $users));
    }

    public function connexion($pseudo, $motDePasse) {
        //echo 'ok';
        if(isset($_POST['connexion']) && isset($_POST['pseudo']) && isset($_POST['motDePasse'])) {
            //$pass_hache = password_hash($_POST['motDePasse'], PASSWORD_DEFAULT);
            $user = $this->userManager->getUser($_POST['pseudo']);

            if(!empty($user)) {

                if ($passHache = password_verify($_POST['motDePasse'], $user['motDePasse'])) { //true ou false ?
                    //$passHache = password_verify($_POST['motDePasse'], $user['motDePasse']); //true ou false ?
                    var_dump($passHache);
                    //if(!empty($_POST['pseudo']) && !empty($_POST['motDePasse'])) {
                        //if($passHache) && ($_POST['pseudo'] == $pseudo)) {
                    $_SESSION['pseudo'] = $pseudo; // essayer avec id
                    header('Location: index.php');
                    exit;
                } else {
                    echo"identifiant ou mot de passe incorrect";
                    //header('Location: index.php?action=connexionPage');
                }
            } else {
                echo 'tous les champs doivent être connectés';
            }
        $getUser = $this->userManager->checkUser($pseudo, $motDePasse);
        $users = $this->userManager->getListUser();
        $vue = new Vue("Connexion");
        $vue->generer(array('users' => $users, 'getUser' => $getUser));
    }
    }
    //est ce que l'utilisateur est déjà connecté ?
    /*public function alreadyLogged() {
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
    }*/


//INSCRIPTION    AJOUTER UN USER
    public function registration() {
        if(isset($_POST['inscription'])) {
            //echo 'ok';
            $pass_hache = password_hash($_POST['motDePasse'], PASSWORD_DEFAULT);
            if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['motDePasse'])) {
                //echo 'ok';
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $email = htmlspecialchars($_POST['email']);
                $motDePasse = $pass_hache;
                $isAdmin = ($_POST['isAdmin']);
                
                $users = $this->userManager->getListUser();
                $addUser = $this->userManager->addUser($pseudo, $email, $motDePasse, $isAdmin);
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
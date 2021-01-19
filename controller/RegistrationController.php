<?php
namespace projet4\controller;

use projet4\model\UserManager;
use projet4\model\Vue;

class RegistrationController {
    protected $userManager;

    public function __construct() {
        $this->userManager = new UserManager();
    }

//INSCRIPTION - AJOUTER UN USER
    public function registration() {
        if(isset($_POST['inscription'])) {
            $pass_hache = password_hash($_POST['motDePasse'], PASSWORD_DEFAULT);
            if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['motDePasse'])) {
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $email = htmlspecialchars($_POST['email']);
                $motDePasse = $pass_hache;
                $isAdmin = ($_POST['isAdmin']);
                
                $users = $this->userManager->getListUser();
                $addUser = $this->userManager->addUser($pseudo, $email, $motDePasse, $isAdmin);
                $vue = new Vue("admin/Registration");
                $vue->generer(array('addUser' => $addUser, 'users' => $users));
                $message = 'user bien enregistré';
            } else {
                echo "Veuillez remplir tous les champs";
            }
        }
        $users = $this->userManager->getListUser();
        $message = 'user bien enregistré';
        $vue = new Vue("admin/Registration");
        $vue->generer(array('users' => $users, 'message' => $message));
    }

}
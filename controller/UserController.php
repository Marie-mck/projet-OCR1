<?php
namespace projet4\controller;

use projet4\model\PostManager;
use projet4\model\CommentManager;
use projet4\model\UserManager;
use projet4\model\Vue;

class UserController {
    protected $postManager;
    protected $commentManager;
    protected $userManager;

    public function __construct() {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->userManager = new UserManager();
    }

//   --------USER (partie administration)----------------

    public function afficherPageAdminUser() {
        $users = $this->userManager->getListUser();
        $vue = new Vue("admin/AdminUser");
        $vue->addJsFile("public/js/userTable.js?v=1.0");
        $vue->generer(array('users' => $users));
    }

    public function afficherUser($id) {
        $getUsers =  $this->userManager->getOneUser($_GET['id']);
        $vue = new Vue("admin/AdminUpdateUser");
        $vue->generer(array('getUsers' => $getUsers));
    }

    public function modifierUser($id) {
        if(isset($_GET['id'])) {
            if(isset($_POST['pseudo']) AND isset($_POST['email']) AND isset($_POST['motDePasse'])) {
                if(!empty($_POST['pseudo']) AND !empty($_POST['email']) AND !empty($_POST['motDePasse'])) {
                    $pseudo = htmlspecialchars($_POST['pseudo']);
                    $email = htmlspecialchars($_POST['email']);
                    $motDePasse = htmlspecialchars($_POST['motDePasse']);
                    $isAdmin = ($_POST['isAdmin']);
                    $id = (int) $_GET['id'];
                    $userUpdate = $this->userManager->updateUser($pseudo, $email, $motDePasse, $isAdmin, $id);
                }
            }
        }
        header('Location: index.php?action=afficherAdminUser');
    }

    public function deleteUser($id) {
        $deleteUser = $this->userManager->deleteUser($_GET['id']);
        $users = $this->userManager->getListUser();
        $vue = new Vue("admin/AdminUser");
        $vue->generer(array('users' => $users));
    }
}
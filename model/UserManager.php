<?php
namespace App\Model;
//enregistrer un nouveau visiteur
//savoir si visiteur déjà enregistré
//connecter un visiteur déjà enregistré
//require 'model/Manager.php';
//require 'User.php';
use App\Model\User;

class UserManager extends Manager {

    public function count()  {
        $db = $this->dbConnect();
        return $db->query('SELECT COUNT(*) FROM user')->fetchColumn();
    }

    //fct pour initialiser la session
    function initSession() : bool{
        if(!session_id()) {
            session_start();
            session_regenerate_id();
            return true;
        }
        echo 'pas connecté';
    }

    public function checkUser($pseudo, $motDePasse) {
        $db = $this->dbConnect();
        $q = $db->prepare('SELECT id, pseudo, motDePasse  FROM user WHERE pseudo = ? AND motDePasse = ?');
        if($q->execute(array($pseudo, $motDePasse)) == true) {
            $userExist = $q->rowCount();//nbr de rangée qui existe avec les informations demandées -> bool dc fct pas
            if($userExist == 1) {
                $user = $q->fetch();
                $_SESSION['pseudo'] = $user['pseudo'];
                $_SESSION['motDePasse'] = $user['motDePasse'];
            }
            else {
                $erreur = "Mauvais mail ou mot de passe !";
            }
        } else {
            $return = "Tous les champs doivent être complétés";
        }
    }

    public function addUser($pseudo, $email, $motDePasse, $isAdmin) {
        $db = $this->dbConnect();
        $pass_hache = password_hash($_POST['motDePasse'], PASSWORD_DEFAULT);
        $q = $db->prepare('INSERT INTO user(pseudo, email, motDePasse, dateRecord, isAdmin) VALUES (?, ?, ?, NOW(), ?)');
        $userAjouts = $q->execute(array($pseudo, $email, $motDePasse, $isAdmin));
        return $userAjouts;
    }

    public function getUser($pseudo) {
        $db = $this->dbConnect();
        $q = $db->prepare('SELECT id, pseudo, email, motDePasse, dateRecord, isAdmin FROM user WHERE pseudo = :pseudo');
        $q->execute(array(':pseudo' => $pseudo));
        $user = $q->fetch();
        return $user;
    }
    
    public function getListUser() {
        $db = $this->dbConnect();
        $user = [];
        $q = $db->query('SELECT id, pseudo, email, motDePasse, dateRecord, isAdmin FROM user ORDER BY dateRecord DESC');
        $result = $q->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($result as $donnees) {
            $user[] = new User($donnees);
        }
        return $user;
    }

    function getOneUser($id) {
        $db = $this->dbConnect();
        $getUsers = $db->prepare('SELECT id, pseudo, email, motDePasse, isAdmin FROM user WHERE id = ?');
        $getUsers->execute(array($id));
        return $getUsers;
    }

    public function updateUser($pseudo, $email, $motDePasse, $isAdmin, $id) {
        $db = $this->dbConnect();
        $q = $this->db->prepare('UPDATE user SET pseudo = ?, email = ? , motDePasse = ?, isAdmin = ? WHERE id = ?');
        $userUpdate = $q->execute(array($pseudo, $email, $motDePasse, $isAdmin, $id));
        return $userUpdate;
    }

    public function deleteUser($id) {
        $db = $this->dbConnect();
        $q = $db->prepare('DELETE FROM user WHERE id = ?');
        $q->execute(array($id));
        return $q;
    }
}

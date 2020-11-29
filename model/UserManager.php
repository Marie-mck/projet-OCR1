<?php

//enregistrer un nouveau visiteur
//savoir si visiteur déjà enregistré
//connecter un visiteur déjà enregistré

//require 'model/Manager.php';
require 'User.php';

class UserManager extends Manager {

    public function count()  {
        $db = $this->dbConnect();
        // Exécute une requête COUNT() et retourne le nombre de résultats retourné.
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
        var_dump($pseudo, $motDePasse);
        $db = $this->dbConnect();
        //$q = $db->prepare('SELECT id  FROM user WHERE pseudo = ? && motDePasse = ?');
        $q = $db->prepare('SELECT id, pseudo, motDePasse  FROM user WHERE pseudo = ? AND motDePasse = ?');
        if($q->execute(array($pseudo, $motDePasse)) == true) {
            
            $userExist = $q->rowCount();//nbr de rangée qui existe avec les informations demandées -> bool dc fct pas

            if($userExist == 1) {
                $user = $q->fetch();
                $_SESSION['id'] = $user['id'];
                $_SESSION['pseudo'] = $user['pseudo'];
                $_SESSION['motDePasse'] = $user['motDePasse'];
            }
            else {
                echo "pas ok";
            }
        } else {
        }
        var_dump($q);
        
    }

    public function addUser($pseudo, $email, $motDePasse) {
        $db = $this->dbConnect();
        $pass_hache = password_hash($_POST['motDePasse'], PASSWORD_DEFAULT);
        $q = $db->prepare('INSERT INTO user(pseudo, email, motDePasse, dateRecord) VALUES (?, ?, ?, NOW())');
        //$userAjouts = $q->execute(array('pseudo' => $pseudo, 'email' => $email, 'motDePasse' => $pass_hache));
        $userAjouts = $q->execute(array($pseudo, $email, $motDePasse));
        //$user = $q->fetch();
        return $userAjouts;
    }
    
    public function getUser($pseudo) {
        $db = $this->dbConnect();
        $q = $db->prepare('SELECT id, pseudo, email, motDePasse, dateRecord FROM user WHERE pseudo = :pseudo');
        //$q->execute([':id' =>$id]); // On exécute la requête
        $q->execute(array(':pseudo' => $pseudo));
        // On stocke le résultat dans un tableau associatif : $news = $q->fetch();
        $user = $q->fetch();
        return $user;
        //return new User($user);
        //retourne un objet : $article =$q->fecth(PDO::FETCH_ASSOC) return new News($article)
    }
    
    public function getListUser() {
        $db = $this->dbConnect();
        $user = [];
        $q = $db->query('SELECT id, pseudo, email, motDePasse, dateRecord FROM user ORDER BY dateRecord DESC');
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $donnees) {
            $user[] = new User($donnees);
        }
        return $user;
    }
    
    public function update(User $user) {
        $db = $this->dbConnect();
        $q = $db->prepare('UPDATE user SET pseudo = :pseudo, email = :email, motDePasse = :motDePasse, dateRecord = :dateRecord WHERE id = :id');
        $q->bindValue(':pseudo', $user->pseudo(), PDO::PARAM_STR);
        $q->bindValue(':email', $user->email(), PDO::PARAM_STR);
        $q->bindValue(':motDePasse', $user->motDePasse(), PDO::PARAM_STR);
        $q->bindValue(':id', $user->id(), PDO::PARAM_INT);
        $q->execute();
        //$result = $q->fetchAll();
    }
    
    public function delete($id) {
        $db = $this->dbConnect();
        $q = $db->prepare('DELETE FROM user WHERE id = :id');
        $q->bindValue(':id', $id, PDO::PARAM_INT);
        $q->execute();
        //$this->_db->exec('DELETE FROM personnages WHERE id = '.$id->id()); //Call to a member function id() on int
        //$this->db->exec('DELETE FROM news WHERE id = '.$article->id());
    }

    //est ce que l'utilisateur est connecté ?
    /*public function is_logged() : bool {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
                $_SESSION['connecte'] = 1;
                $users = $this->userManager->getListUser();
                $vue = new Vue("Connexion");
                $vue->generer(array('users' => $users));
                echo 'est connecté';
            }
            return !empty($_SESSION['connecte']);
            //$vue = new Vue("index");
            header('Location: index.php');
    }
    public function utilisateurConnecte() : void {
        if(!is_logged()) {
            header('Location: view/viewRegistration.php');
            exit(); //pour pas continuer le script si l'utilisateur n'est pas connecté
        }
    }*/
}

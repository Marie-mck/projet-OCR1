<?php
namespace projet4\model;

use projet4\model\Manager;
use projet4\model\News;

class PostManager extends Manager {
    
    public function addPost($auteur, $contenu, $titre, $picture) {
        $db = $this->dbConnect();
        $q = $db->prepare('INSERT INTO news(auteur, contenu, dateAjout, titre, picture) VALUES (?, ?, NOW(), ?, ?)');
        $chapitreAjouts = $q->execute(array($auteur, $contenu, $titre, $picture));
        return $chapitreAjouts;
    }
    public function addUser($pseudo, $email, $motDePasse, $isAdmin) {
        $db = $this->dbConnect();
        $pass_hache = password_hash($_POST['motDePasse'], PASSWORD_DEFAULT);
        $q = $db->prepare('INSERT INTO user(pseudo, email, motDePasse, dateRecord, isAdmin) VALUES (?, ?, ?, NOW(), ?)');
        $userAjouts = $q->execute(array($pseudo, $email, $motDePasse, $isAdmin));
        return $userAjouts;
    }
    public function getNews($idNews) {
        $db = $this->dbConnect();
        $q = $db->prepare('SELECT id, auteur, titre, contenu, dateAjout FROM news WHERE id = :id');
        $q->execute([':id' =>$idNews]);
        $article = $q->fetch();
        return new News($article);
    }

    // On récupère tous les chap pour les afficher
    public function getList() {
        $db = $this->dbConnect();
        $chapitres = [];
        $q = $db->query('SELECT id, auteur, contenu, dateAjout, titre, picture FROM news ORDER BY id DESC');
        $result = $q->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($result as $donnees) {
            $chapitres[] = new News($donnees);
        }
        return $chapitres;
    }

    // On récupère les x derniers posts pour les afficher
    public function getLast() {
        $db = $this->dbConnect();
        $posts = [];
        $q = $db->query('SELECT id, auteur, titre, contenu, dateAjout, picture FROM news ORDER BY dateAjout ASC LIMIT 0, 3');
        $result = $q->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($result as $donnees) {
            $posts[] = new News($donnees);
        }
        return $posts;
    }

    public function updateChapter($contenu, $titre, $id) {
        $db = $this->dbConnect();
        $q = $this->db->prepare('UPDATE news SET contenu = ?, titre = ? WHERE id = ?');
        $chapterUpdate = $q->execute(array($contenu, $titre, $id));
        return $chapterUpdate;
    }

    public function getOneChapter($id) {
        $db = $this->dbConnect();
        $q = $db->prepare('SELECT contenu, titre FROM news WHERE id = :id');
        $q->execute([':id' =>$id]);
        $article = $q->fetch();
        return new News($article);
    }

    public function deletePost($id) {
        $db = $this->dbConnect();
        $q = $db->prepare('DELETE FROM news WHERE id = ?');
        $q->execute(array($id));
        return $q;
    }
}

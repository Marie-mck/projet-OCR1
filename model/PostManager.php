<?php

//namespace tpnews5a\model;
//use tpnews5a\model\Manager;
require 'model/Manager.php';
require 'News.php';

class PostManager extends Manager {

    public function count()  {
        $db = $this->dbConnect();
        return $db->query('SELECT COUNT(*) FROM news')->fetchColumn();
    }

    public function addPost($contenu, $titre) {
        $db = $this->dbConnect();
        $q = $db->prepare('INSERT INTO news(contenu, dateAjout, titre) VALUES (?, NOW(), ?)');
        $chapitreAjouts = $q->execute(array($contenu, $titre));
        return $chapitreAjouts;
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
        $q = $db->query('SELECT id, auteur, titre, contenu, dateAjout FROM news ORDER BY id ASC');
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
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
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
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

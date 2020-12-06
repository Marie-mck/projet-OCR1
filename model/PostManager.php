<?php

//namespace tpnews5a\model;

//use tpnews5a\model\Manager;

require 'model/Manager.php';
require 'News.php';

class PostManager extends Manager {

    public function count()  {
        $db = $this->dbConnect();
        // Exécute une requête COUNT() et retourne le nombre de résultats retourné.
        //return $this->db->query('SELECT COUNT(*) FROM news')->fetchColumn();
        return $db->query('SELECT COUNT(*) FROM news')->fetchColumn();
    }
    //CRUD
    /*public function addPost(News $article) {
        $db = $this->dbConnect();
        $q = $db->prepare('INSERT INTO news(auteur, titre, contenu, dateAjout) VALUES(:auteur, :titre, :contenu, NOW())');
        //$q = $this->db->prepare('INSERT INTO news(auteur, titre, contenu, dateAjout) VALUES(:auteur, :titre, :contenu, NOW())');
        $q->bindValue(':titre', $article->titre(), PDO::PARAM_STR);
        $q->bindValue(':auteur', $article->auteur(), PDO::PARAM_STR);
        $q->bindValue(':contenu', $article->contenu(), PDO::PARAM_STR);
        //$q->bindValue(':dateAjout', $article->dateAjout(), PDO::PARAM_INT);
        $q->execute();
    }*/
    public function addPost($auteur, $titre, $contenu) {
        $db = $this->dbConnect();
        $q = $db->prepare('INSERT INTO news(auteur, titre, contenu, dateAjout) VALUES (?, ?, ?, NOW())');
        $chapitreAjouts = $q->execute(array($auteur, $titre, $contenu));
        return $chapitreAjouts;
    }
    public function getNews($idNews) {
        $db = $this->dbConnect();
        // On prépare la requête //
        $q = $db->prepare('SELECT id, auteur, titre, contenu, dateAjout FROM news WHERE id = :id');
        //$q->bindValue(':id', $id, PDO::PARAM_INT); // On attache les valeurs
        $q->execute([':id' =>$idNews]); // On exécute la requête
        //$req->execute(array($_GET['news']));
        // On stocke le résultat dans un tableau associatif : $news = $q->fetch();
        //$q->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'News');
        $article = $q->fetch();
        return new News($article);
        //retourne un objet : $article =$q->fecth(PDO::FETCH_ASSOC) return new News($article)
        //return new News($q->fetch(PDO::FETCH_ASSOC));
    }
    // On récupère tous les chap pour les afficher
    public function getList() { //liste de tous les articles.
        $db = $this->dbConnect();
        $chapitres = [];
        //$q = $this->db->query('SELECT id, auteur, titre, contenu, dateAjout FROM news ORDER BY dateAjout DESC');
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
        //$q = $this->_db->query('SELECT id, auteur, titre, contenu, dateAjout, DATE_FORMAT(dateAjout, \'%d/%m/%Y à %Hh%imin%ss\') AS dateAjout_fr FROM news 
        //ORDER BY dateAjout DESC LIMIT 0, 3');
        $posts = [];
        $q = $db->query('SELECT id, auteur, titre, contenu, dateAjout FROM news ORDER BY dateAjout ASC LIMIT 0, 5');
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $donnees) {
            $posts[] = new News($donnees);
        }
        return $posts;
    }

    public function update(News $article) {
        $db = $this->dbConnect();
        // Prépare une requête de type UPDATE.     // Assignation des valeurs à la requête.     // Exécution de la requête.
        //$q = $this->db->prepare('UPDATE news SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = :dateModif WHERE id = :id');
        $q = $db->prepare('UPDATE news SET auteur = :auteur, titre = :titre, contenu = :contenu, dateAjout = :dateModif WHERE id = :id');
        $q->bindValue(':titre', $article->titre(), PDO::PARAM_STR);
        $q->bindValue(':auteur', $article->auteur(), PDO::PARAM_STR);
        $q->bindValue(':contenu', $article->contenu(), PDO::PARAM_STR);
        $q->bindValue(':dateModif', $article->dateModif(), PDO::PARAM_STR);
        $q->bindValue(':id', $article->id(), PDO::PARAM_INT);
        $q->execute();
        //$result = $q->fetchAll();
    }
    
    public function deletePost($id) {
        $db = $this->dbConnect();
        $q = $db->prepare('DELETE FROM news WHERE id = ?');
        $q->execute(array($id));
        return $q;
    }
}

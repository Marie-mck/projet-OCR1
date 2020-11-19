<?php

//namespace tpnews5a\model;

//use tpnews5a\model\Manager;

require 'model/Manager.php';
require 'News.php';

class PostManager extends Manager {

    /*public function getPosts() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, titre, contenu, dateAjout FROM news ORDER BY dateAjout DESC LIMIT 0, 5');
        return $req;
    }*/
    
    /*public function getPost($idNews) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, titre, contenu, dateAjout AS dateAjout FROM news WHERE id = ?');
        $req->execute(array($idNews));
        $post = $req->fetch();
        return $post;
    }*/

    public function count()  {
        $db = $this->dbConnect();
        // Exécute une requête COUNT() et retourne le nombre de résultats retourné.
        //return $this->db->query('SELECT COUNT(*) FROM news')->fetchColumn();
        return $db->query('SELECT COUNT(*) FROM news')->fetchColumn();
    }
    //CRUD
    public function addNews(News $article) {
        $db = $this->dbConnect();
        $q = $db->prepare('INSERT INTO news(auteur, titre, contenu, dateAjout) VALUES(:auteur, :titre, :contenu, NOW())');
        //$q = $this->db->prepare('INSERT INTO news(auteur, titre, contenu, dateAjout) VALUES(:auteur, :titre, :contenu, NOW())');
        $q->bindValue(':titre', $article->titre(), PDO::PARAM_STR);
        $q->bindValue(':auteur', $article->auteur(), PDO::PARAM_STR);
        $q->bindValue(':contenu', $article->contenu(), PDO::PARAM_STR);
        //$q->bindValue(':dateAjout', $article->dateAjout(), PDO::PARAM_INT);
        $q->execute();
    }

    public function getNews($idNews) {
        $db = $this->dbConnect();
        // On prépare la requête //
        //ecrit et prepare la requete
        //$q = $this->db->prepare('SELECT id, auteur, titre, contenu, dateAjout FROM news WHERE id = :id');
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
    // On récupère les billets pour les afficher
    public function getList() { //liste de tous les articles.
        $db = $this->dbConnect();
        $article = [];
        //$q = $this->db->query('SELECT id, auteur, titre, contenu, dateAjout FROM news ORDER BY dateAjout DESC');
        $q = $db->query('SELECT id, auteur, titre, contenu, dateAjout FROM news ORDER BY dateAjout DESC');
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $donnees) {
            $article[] = new News($donnees);
        }
        return $article;
    }

    // On récupère les x derniers billets pour les afficher
    public function getLast() {
        $db = $this->dbConnect();
        //$q = $this->_db->query('SELECT id, auteur, titre, contenu, dateAjout, DATE_FORMAT(dateAjout, \'%d/%m/%Y à %Hh%imin%ss\') AS dateAjout_fr FROM news 
        //ORDER BY dateAjout DESC LIMIT 0, 3');
        $posts = [];
        //$q = $this->db->query('SELECT id, auteur, titre, contenu, dateAjout FROM news ORDER BY dateAjout ASC LIMIT 0, 5');
        $q = $db->query('SELECT id, auteur, titre, contenu, dateAjout FROM news ORDER BY dateAjout ASC LIMIT 0, 5');
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $donnees) {
            $posts[] = new News($donnees);
        }
        return $posts;
    }
    /*public function exists($id) {
        // Si le paramètre est un entier, c'est qu'on a fourni un identifiant.
            // On exécute alors une requête COUNT() avec une clause WHERE, et on retourne un boolean.
        // Sinon c'est qu'on a passé un nom. // Exécution d'une requête COUNT() avec une clause WHERE, et retourne un boolean.
        if (is_int($id)) // On veut voir si tel personnage ayant pour id $info existe.
        {
        return (bool) $this->db->query('SELECT COUNT(*) FROM news WHERE id = '.$id)->fetchColumn();
        }
        // Sinon, c'est qu'on veut vérifier que le nom existe ou pas.
        $q = $this->db->prepare('SELECT COUNT(*) FROM news WHERE auteur = :auteur');
        $q->execute([':auteur' => $id]);
        
        return (bool) $q->fetchColumn();
    }*/

    public function update(News $article) {
        $db = $this->dbConnect();
        // Prépare une requête de type UPDATE.     // Assignation des valeurs à la requête.     // Exécution de la requête.
        //$q = $this->db->prepare('UPDATE news SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = :dateModif WHERE id = :id');
        $q = $db->prepare('UPDATE news SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = :dateModif WHERE id = :id');
        $q->bindValue(':titre', $article->titre(), PDO::PARAM_STR);
        $q->bindValue(':auteur', $article->auteur(), PDO::PARAM_STR);
        $q->bindValue(':contenu', $article->contenu(), PDO::PARAM_STR);
        $q->bindValue(':dateModif', $article->dateModif(), PDO::PARAM_STR);
        $q->bindValue(':id', $article->id(), PDO::PARAM_INT);
        $q->execute();
        //$result = $q->fetchAll();
    }
    
    public function delete($id) {
        $db = $this->dbConnect();
        //$id = (int) $id;
        //$q = $this->db->prepare('DELETE FROM news WHERE id = :id');
        $q = $db->prepare('DELETE FROM news WHERE id = :id');
        $q->bindValue(':id', $id, PDO::PARAM_INT);
        //$q->bindValue(':id', $id, PDO::PARAM_INT);
        $q->execute();
        //$this->_db->exec('DELETE FROM personnages WHERE id = '.$id->id()); //Call to a member function id() on int
        //$this->db->exec('DELETE FROM news WHERE id = '.$article->id());
    }
}

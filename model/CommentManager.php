<?php

//namespace tpnews5a\model;

//use tpnews5a\model\Manager;

//require_once 'model/Manager.php';

class CommentManager extends Manager{
    
    /*function getComments($idNews) {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, authorComment, commentaire, dateComment FROM comments WHERE idNews = ? ORDER BY dateComment DESC');
        $comments->execute(array($idNews));
        return $comments;
    }
    
    function postComment($idNews, $authorComment, $commentaire) {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(idNews, authorComment, commentaire, dateComment) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($idNews, $authorComment, $commentaire));
        return $affectedLines;
    }*/
    /*public function __construct() {
        require_once 'model/Manager.php';

    }*/

    public function addComment(Comments $comment) {
        $db = $this->dbConnect();
        //$q = $this->db->prepare('INSERT INTO news.comments(authorComment, commentaire, dateComment) VALUES(:authorComment, :commentaire, NOW())');
        $q = $db->prepare('INSERT INTO news.comments(authorComment, commentaire, dateComment, idNews) VALUES(:authorComment, :commentaire, NOW(), :idNews)');
        $q->bindValue(':authorComment', $comment->authorComment(), PDO::PARAM_STR);
        $q->bindValue(':commentaire', $comment->commentaire(), PDO::PARAM_STR);
        //$q->bindValue(':dateComment', $comment->dateComment());
        $q->bindValue(':idNews', $_GET['id'], PDO::PARAM_INT);
        $q->execute();
    }

    public function getListComment() {
        $db = $this->dbConnect();
        $comment = [];
        //$q = $this->db->query('SELECT id, authorComment, commentaire, dateComment, idNews FROM news.comments ORDER BY dateComment DESC');
        $q = $db->query('SELECT id, authorComment, commentaire, dateComment, idNews FROM news.comments ORDER BY dateComment DESC');
        
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $donnees) {
            $comment[] = new Comments($donnees);
        }
        return $comment;
    }
    
    public function count() {
        $db = $this->dbConnect();
        // Exécute une requête COUNT() et retourne le nombre de résultats retourné.
        //return $this->db->query('SELECT COUNT(*) FROM news.comments')->fetchColumn(); 
        return $db->query('SELECT COUNT(*) FROM news.comments')->fetchColumn();  
    }
    
    // Récupération des commentaires pour une news
    public function getComment($idNews) {
        $db = $this->dbConnect();
        //$q = $this->db->prepare('SELECT id, auteurComment, commentaire, dateComment, FROM comments WHERE id = :id');
        //$q = $this->db->prepare('SELECT id, authorComment, commentaire, dateComment, idNews FROM news.comments WHERE idNews = :idNews');
        $q = $db->prepare('SELECT id, authorComment, commentaire, dateComment, idNews FROM news.comments WHERE idNews = :idNews');
        
        //$q->bindValue(':idNews', $idNews->idNews(), PDO::PARAM_INT); // On attache les valeurs
        //$q->execute();
        //$q->execute(array($_GET['id']));
        $q->execute([':idNews' =>$idNews]);
        //$q->execute(array($_GET['id']));
        //$q->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'comments');
        $comment = $q->fetch();
        //$comment = $q->fecth(PDO::FETCH_CLASS);
        //print_r($comment);
        return new Comments($comment);
    }
    
    // Récupération des commentaires
    public function getOneComment($id) {
        $db = $this->dbConnect();
        //$q = $this->db->prepare('SELECT id, authorComment, commentaire, dateComment, idNews FROM news.comments WHERE id = :id');
        $q = $db->prepare('SELECT id, authorComment, commentaire, dateComment, idNews FROM news.comments WHERE id = :id');
        
        //$q->bindValue(':id', $id, PDO::PARAM_INT); // On attache les valeurs
        $q->execute([':id' =>$id]); // On exécute la requête
        //$req->execute(array($_GET['news']));
        // On stocke le résultat dans un tableau associatif : $news = $q->fetch();
        //$q->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'News');
        $comment = $q->fetch();
        return new Comments($comment);
        //retourne un objet : $article =$q->fecth(PDO::FETCH_ASSOC) return new News($article)
        //return new News($q->fetch(PDO::FETCH_ASSOC));
    }

    public function update(Comments $comment) {
        $db = $this->dbConnect();
        // Prépare une requête de type UPDATE.     // Assignation des valeurs à la requête.     // Exécution de la requête.
        //$q = $this->db->prepare('UPDATE comments SET authorComment = :authorComment, commentaire = :commentaire, idNews = :idNews WHERE id = :id');
        $q = $db->prepare('UPDATE comments SET authorComment = :authorComment, commentaire = :commentaire WHERE id = :id');
        $q->bindValue(':authorComment', $comment->authorComment(), PDO::PARAM_STR);
        $q->bindValue(':commentaire', $comment->commentaire(), PDO::PARAM_STR);
        $q->bindValue(':id', $comment->id(), PDO::PARAM_INT);
        $q->execute();
    }
    
    public function delete($id) {
        //$id = (int) $id;
        $db = $this->dbConnect();
        //$q = $this->db->prepare('DELETE FROM comments WHERE id = :id');
        $q = $db->prepare('DELETE FROM comments WHERE id = :id');
        $q->bindValue(':id', $id, PDO::PARAM_INT);
        //$q->bindValue(':id', $id, PDO::PARAM_INT);
        $q->execute();
        //$this->_db->exec('DELETE FROM personnages WHERE id = '.$id->id()); //Call to a member function id() on int
        //$this->db->exec('DELETE FROM news WHERE id = '.$article->id());
    }
}

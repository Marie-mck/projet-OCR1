<?php

//namespace tpnews5a\model;

//use tpnews5a\model\Manager;

//require 'model/Manager.php';
require 'Comments.php';

class CommentManager extends Manager{
    
    // Ajoute un commentaire dans la base
    /*function addComment(Coments $comment) {
        $db = $this->dbConnect();
        $q = $db->prepare('INSERT INTO news.comments(idNews, authorComment, commentaire, dateComment) VALUES(:idNews, :authorComment, :commentaire, NOW())');
        //$affectedLines = $comments->execute([$idNews, $authorComment, $commentaire]);
        $q->bindValue(':authorComment', $comment->authorComment(), PDO::PARAM_STR);
        $q->bindValue(':commentaire', $comment->commentaire(), PDO::PARAM_STR);
        //$q->bindValue(':dateComment', $comment->dateComment());
        $q->bindValue(':idNews', $_GET['id'], PDO::PARAM_INT);
        $q->execute();
        //$q->execute(array($_GET['id']));
    }*/
    public function ajouterCommentaire($idNews, $authorComment, $commentaire) {
        $db = $this->dbConnect();
        $q = $db->prepare('INSERT INTO news.comments(idNews, authorComment, commentaire, dateComment) VALUES (?, ?, ?, NOW())');
        $commentsAjouts = $q->execute(array($idNews, $authorComment, $commentaire));
        return $commentsAjouts;
    }
/*      $q = $db->prepare('SELECT id, authorComment, commentaire, dateComment, idNews FROM news.comments WHERE idNews = :idNews');
        $q->execute([':idNews' =>$idNews]);
        $comments = $q->fetch();
        return new Comments($comments);*/

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
        return $db->query('SELECT COUNT(*) FROM news.comments')->fetchColumn();  
    }

    // Récupération des commentaires pour une news
    public function getComment($idNews) {
        $db = $this->dbConnect();
        //$q = $this->db->prepare('SELECT id, auteurComment, commentaire, dateComment, FROM comments WHERE id = :id');
        //$q = $this->db->prepare('SELECT id, authorComment, commentaire, dateComment, idNews FROM news.comments WHERE idNews = :idNews');
        $q = $db->prepare('SELECT id, authorComment, commentaire, dateComment, idNews FROM news.comments WHERE idNews = :idNews');
        //$q->bindValue(':idNews', $idNews->idNews(), PDO::PARAM_INT); // On attache les valeurs
        //$q->execute(array($_GET['id']));
        $q->execute([':idNews' =>$idNews]);
        //$q->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'comments');
        $comments = $q->fetch();
        return new Comments($comments);
    }
    /*public function getCommentaires($idBillet) {
        $sql = 'SELECT id, authorComment, commentaire, dateComment, idNews FROM comments WHERE idNews = ? ORDER BY dateComment DESC';
        $commentaires = $this->executerRequete($sql, array($idBillet));
        return $commentaires;
    }*/
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

    public function updateComment(Comments $comment) {
        $db = $this->dbConnect();
        // Prépare une requête de type UPDATE.     // Assignation des valeurs à la requête.     // Exécution de la requête.
        //$q = $this->db->prepare('UPDATE comments SET authorComment = :authorComment, commentaire = :commentaire, idNews = :idNews WHERE id = :id');
        $q = $db->prepare('UPDATE comments SET authorComment = :authorComment, commentaire = :commentaire WHERE id = :id');
        $q->bindValue(':authorComment', $comment->authorComment(), PDO::PARAM_STR);
        $q->bindValue(':commentaire', $comment->commentaire(), PDO::PARAM_STR);
        //$q->bindValue(':id', $comment->id(), PDO::PARAM_INT);
        $q->execute();
    }
    
    public function deleteComment($id) {
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

<?php

namespace projet4\model;

use projet4\model\Manager;
use projet4\model\Comments;

class CommentManager extends Manager {

    // Ajoute un commentaire dans la base
    public function ajouterCommentaire($idNews, $authorComment, $commentaire, $signalerComment) {
        $db = $this->dbConnect();
        $q = $db->prepare('INSERT INTO news.comments(idNews, authorComment, commentaire, dateComment, signalerComment) VALUES (?, ?, ?, NOW(), ?)');
        $commentsAjouts = $q->execute(array($idNews, $authorComment, $commentaire, $signalerComment));
        return $commentsAjouts;
    }
    
    public function getListComment() {
        $db = $this->dbConnect();
        $comment = [];
        $q = $db->query('SELECT id, authorComment, commentaire, dateComment, idNews FROM news.comments WHERE signalerComment = 0 ORDER BY dateComment DESC');
        $result = $q->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($result as $donnees) {
            $comment[] = new Comments($donnees);
        }
        return $comment;
    }

    public function count() {
        $db = $this->dbConnect();
        return $db->query('SELECT COUNT(*) FROM news.comments')->fetchColumn();  
    }

    // Récupération des commentaires pour une news
    public function getComment($idNews) {
        $db = $this->dbConnect();
        $q = $db->prepare('SELECT id, authorComment, commentaire, dateComment, idNews FROM news.comments WHERE idNews = :idNews');
        $q->execute([':idNews' =>$idNews]);
        $commentaires = $q->fetch();
        return new Comments($commentaires);
    }

    function getComments($idNews) {
        $db = $this->dbConnect();
        $commentaires = $db->prepare('SELECT id, authorComment, commentaire, dateComment, signalerComment FROM comments WHERE idNews = ? ORDER BY dateComment DESC');
        $commentaires->execute(array($idNews));
        return $commentaires;
    }

    public function signalComment($id){
        $db = $this-> dbConnect();
        $q = $db->prepare('UPDATE comments SET signalerComment = 1 WHERE id = ?');
        $q->execute(array($id));
        return $q;
    }

    public function getSignalComments() {
        $db = $this->dbConnect();
        $comment = [];
        $q = $db->query('SELECT id, authorComment, commentaire, dateComment, idNews, signalerComment FROM news.comments WHERE signalerComment = 1 ORDER BY dateComment DESC');
        $result = $q->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($result as $donnees) {
            $comment[] = new Comments($donnees);
        }
        return $comment;
    }

    public function updateComment($commentaire, $id) {
        $db = $this->dbConnect();
        $q = $this->db->prepare('UPDATE comments SET commentaire = ? WHERE id = ?');
        $commentUpdate = $q->execute(array($commentaire, $id));
        return $commentUpdate;
    }

    function getOneComment($id) {
        $db = $this->dbConnect();
        $getComments = $db->prepare('SELECT id, authorComment, commentaire FROM comments WHERE id = ?');
        $getComments->execute(array($id));
        return $getComments;
    }

    public function approved($id){
        $db = $this->dbConnect();
        $q = $this->db->prepare('UPDATE comments SET signalercomment = 0 WHERE id = ?');
        $comment = $q->execute(array($id));
        return $comment;
    }

    public function deleteComment($id) {
        $db = $this->dbConnect();
        $q = $db->prepare('DELETE FROM comments WHERE id = ?');
        $q->execute(array($id));
        return $q;
    }
}

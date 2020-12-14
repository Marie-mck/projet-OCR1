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
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $donnees) {
            $comment[] = new Comments($donnees);
        }
        return $comment;
    }
    
    /*public function getListCommentaires($idNews) {
        $db = $this->dbConnect();
        $getCommentaires = $db->prepare('SELECT id, authorComment, commentaire, dateComment, idNews FROM news.comments WHERE idNews = ?');
        //$q->execute(array($_GET['idNews']));
        $getCommentaires->execute(array($idNews));
        //$result = $q->fetch();
        return $getCommentaires;
    }*/
    public function count() {
        $db = $this->dbConnect();
        // Exécute une requête COUNT() et retourne le nombre de résultats retourné.
        return $db->query('SELECT COUNT(*) FROM news.comments')->fetchColumn();  
    }
    // Récupération des commentaires pour une news
    public function getComment($idNews) {
        $db = $this->dbConnect();
        //$q = $this->db->prepare('SELECT id, auteurComment, commentaire, dateComment, FROM comments WHERE id = :id');
        $q = $db->prepare('SELECT id, authorComment, commentaire, dateComment, idNews FROM news.comments WHERE idNews = :idNews');
        //$q->execute(array($_GET['id']));
        $q->execute([':idNews' =>$idNews]);
        //$q->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'comments');
        $commentaires = $q->fetch();
        return new Comments($commentaires);
    }
    function getComments($idNews) {
        $db = $this->dbConnect();
        $commentaires = $db->prepare('SELECT id, authorComment, commentaire, dateComment FROM comments WHERE idNews = ? ORDER BY dateComment DESC');
        $commentaires->execute(array($idNews));
        return $commentaires;
    }
    
    public function signalComment($id){
        $db = $this-> dbConnect();
        $q = $db->prepare('UPDATE comments SET signalerComment = 1 WHERE id = ?');
        $q->execute(array($id));
        //$signal = $q->rowCount(); 
        return $q;
    }
    /*public function getSignalComments($id){
        $db = $this->dbConnect();
        $q = $db->prepare('SELECT id, authorComment, commentaire, dateComment, idNews, signalerComment FROM comments WHERE signalerComment = 1 ORDER BY dateComment DESC');
        $q->execute(array($id));
        return $q;
    }*/
    public function getSignalComments() {
        $db = $this->dbConnect();
        $comment = [];
        $q = $db->query('SELECT id, authorComment, commentaire, dateComment, idNews, signalerComment FROM news.comments WHERE signalerComment = 1 ORDER BY dateComment DESC');
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $donnees) {
            $comment[] = new Comments($donnees);
        }
        return $comment;
    }
    
    // Récupération des commentaires
    /*public function getOneComment($id) {
        $db = $this->dbConnect();
        $q = $db->prepare('SELECT id, authorComment, commentaire FROM comments WHERE id = :id');
        $q->execute([':id' =>$id]);
        $getComments = $q->fetch();
        //var_dump($getComments);
        return new Comments($getComments);
    }*/

    public function updateComment($authorComment, $commentaire, $id) {
        $db = $this->dbConnect();
        //$q = $this->db->prepare('UPDATE comments SET authorComment = :authorComment, commentaire = :commentaire WHERE id = ?');
        $q = $this->db->prepare('UPDATE comments SET authorComment = ?, commentaire = ? WHERE id = ?');
        //$q->bindValue(':authorComment', $comment->authorComment(), PDO::PARAM_STR);
        //$q->bindValue(':commentaire', $comment->commentaire(), PDO::PARAM_STR);
        //$q->bindValue(':id', $comment->id(), PDO::PARAM_INT);
        //$commentUpdated = $commentUpdate->execute(array($_POST['authorComment'], $_POST['commentaire'], $_GET['id']));
        $commentUpdate = $q->execute(array($authorComment, $commentaire, $id));
        //$commentUpdated = $q->execute(array('authorComment'=>$authorComment, 'commentaire'=>$commentaire, 'id'=>$id));
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
        //$q = $this->db->prepare('DELETE FROM comments WHERE id = :id');
        $q = $db->prepare('DELETE FROM comments WHERE id = ?');
        //$q->bindValue(':id', $id, PDO::PARAM_INT);
        $q->execute(array($id));
        //$deleteComment = $q->fetch();
        return $q;
    }
}

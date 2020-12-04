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
    
    public function getListComment() {
        $db = $this->dbConnect();
        $comment = [];
        $q = $db->query('SELECT id, authorComment, commentaire, dateComment, idNews FROM news.comments ORDER BY dateComment DESC');
        $result = $q->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $donnees) {
            $comment[] = new Comments($donnees);
        }
        return $comment;
    }
    
    public function getListCommentaires($idNews) {
        $db = $this->dbConnect();
        $commentaires = $db->prepare('SELECT id, authorComment, commentaire, dateComment, idNews FROM news.comments WHERE idNews = ?');
        //$q->execute(array($_GET['idNews']));
        $commentaires->execute(array($idNews));
        //$result = $q->fetch();
        return $commentaires;
    }
    public function count() {
        $db = $this->dbConnect();
        // Exécute une requête COUNT() et retourne le nombre de résultats retourné.
        return $db->query('SELECT COUNT(*) FROM news.comments')->fetchColumn();  
    }
    // Récupération des commentaires pour une news
    /*public function getComment($idNews) {
        $db = $this->dbConnect();
        $q = $db->prepare('SELECT id, authorComment, commentaire, dateComment, idNews FROM news.comments WHERE idNews = ? ORDER BY dateComment DESC');
        $commentaires= $q->execute(array($idNews));
        var_dump($commentaires);
        //$comments = $q->fetch();
        //return new Comments($comments);
        return $commentaires;
    }*/
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
        return $comment;
        //return new Comments($comment);
        //retourne un objet : $article =$q->fecth(PDO::FETCH_ASSOC) return new News($article)
        //return new News($q->fetch(PDO::FETCH_ASSOC));
    }
    public function signalComment($id){
        $db = $this-> dbConnect();
        $q = $db->prepare('UPDATE comments SET signalerComment = 1 WHERE id = ?');
        $q->execute(array($id));
        //$signal = $req->rowCount(); 
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
    //public function updateComment(Comments $comment) { //approve
        public function updateComment($id) {
        $db = $this->dbConnect();
        //$q = $this->db->prepare('UPDATE comments SET authorComment = :authorComment, commentaire = :commentaire, idNews = :idNews WHERE id = :id');
        $q = $db->prepare('UPDATE comments SET signalerComment = 1 WHERE id = ?');
        //$q->bindValue(':authorComment', $comment->authorComment(), PDO::PARAM_STR);
        //$q->bindValue(':commentaire', $comment->commentaire(), PDO::PARAM_STR);
        //$q->bindValue(':id', $comment->id(), PDO::PARAM_INT);
        $q->execute(array($id));
        return $q;
    }
    public function deleteComment($id) {
        $db = $this->dbConnect();
        //$q = $this->db->prepare('DELETE FROM comments WHERE id = :id');
        $q = $db->prepare('DELETE FROM comments WHERE id = ?');
        //$q->bindValue(':id', $id, PDO::PARAM_INT);
        $q->execute(array($id));
        //var_dump($id);
        //print_r([':id' =>$id]);
        //var_dump($q);
        //$deleteComment = $q->fetch();
        return $q;
    }

}

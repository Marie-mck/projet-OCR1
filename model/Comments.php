<?php

namespace projet4\model;

class Comments {
    protected $id;
    protected $authorComment;
    protected $commentaire;
    protected $dateComment;
    protected $idNews;
    protected $signalerComment;

    public function __construct(array $donnees) {
        $this->hydrate($donnees);
    }
    
    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
            $this->$method($value);   
            } 
        }
    }
    public function commentsValide() {
        return !(empty($this->authorComment) || empty($this->commentaire));
    }
    
    //getters
    public function id() {
        return $this->id;
    }
    public function authorComment() {
        return $this->authorComment;
    }
    public function commentaire() {
        return $this->commentaire;
    }
    public function dateComment() {
        return $this->dateComment;
    }
    public function idNews() {
        return $this->idNews;
    }
    public function signalerComment() {
        return $this->signalerComment;
    }

    //setters
    public function setId($id) {
        $this->id = (int) $id;
    }
    public function setAuthorComment($authorComment) {
        if (is_string($authorComment) && strlen($authorComment) <= 30) {
            $this->authorComment = $authorComment;
        }
    }
    public function setCommentaire($commentaire) {
        if (is_string($commentaire)) {
            $this->commentaire = $commentaire;
        }
    }
    public function setDateComment($dateComment) {
        $this->dateComment = $dateComment;
    }
    public function setIdNews($idNews) {
        $this->idNews = (int) $idNews;
    }
    public function setSignalerComment($signalerComment) {
        $this->signalerComment = $signalerComment;
    }

}
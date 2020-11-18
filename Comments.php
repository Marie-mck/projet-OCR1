<?php

//namespace tpnews5a;

class Comments {
    protected $id;
    protected $authorComment;
    protected $commentaire;
    protected $dateComment;
    protected $idNews;

    public function __construct(array $donnees) {
        $this->hydrate($donnees);
        //$this->type = strtolower(static::class);
    }
    
    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set'.ucfirst($key); // On récupère le nom du setter correspondant à l'attribut    // …
            if (method_exists($this, $method)) // Si le setter correspondant existe // if (is_callable([$this, $methode]))  
            {
            $this->$method($value);// On appelle le setter.   
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


    //Affichage des cinq premières news à l'accueil du site avec texte réduit à 200 caractères
    public function affichageComments() {

    }


}
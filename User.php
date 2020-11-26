<?php

//namespace tpnews5a;

class User {
    protected $id;
    protected $pseudo;
    protected $email;
    protected $motDePasse;
    protected $dateRecord;
    
    public function __construct(array $donnees) {
        $this->hydrate($donnees);
    }

    public function hydrate($donnees) {
        foreach ($donnees as $key => $value)   {
            $method = 'set'.ucfirst($key); // On récupère le nom du setter correspondant à l'attribut    // …
            if (method_exists($this, $method)) // Si le setter correspondant existe
            // if (is_callable([$this, $methode]))  
            {// On appelle le setter.      
            $this->$method($value);
            } 
        }
    }
    public function userValide()   {
        return !(empty($this->pseudo) || empty($this->email) || empty($this->motDePasse));
    }
    //getters
    public function id() {
        return $this->id;
    }
    public function pseudo() {
        return $this->pseudo;
    }
    public function email() {
        return $this->email;
    }
    public function motDePasse() {
        return $this->motDePasse;
    }
    public function dateRecord() {
        return $this->dateRecord;
    }

    //setters
    public function setId($id) {
        $this->id = (int) $id;
    }
    public function setPseudo($pseudo) {
        if (is_string($pseudo) && strlen($pseudo) <= 30) {
            $this->pseudo = $pseudo;
        }
    }
    public function setEmail($email) {
            $this->email = $email;
    }
    public function setMotDePasse($motDePasse) {
        $this->motDePasse = $motDePasse;
    }
    public function setDateRecord($dateRecord) {
        $this->dateRecord = $dateRecord;
    }
}
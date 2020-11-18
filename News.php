<?php

//namespace tpnews5a;

class News {
    protected $id;
    protected $titre;
    protected $auteur;
    protected $contenu;
    protected $dateAjout;
    protected $dateModif;
    
    public function __construct(array $donnees /*, $id, $titre, $auteur, $contenu, $dateAjout, $dateModif*/) {
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
    public function newsValide()   {
        return !(empty($this->auteur) || empty($this->titre) || empty($this->contenu));
    }
    
    //getters
    public function id() {
        return $this->id;
    }
    public function auteur() {
        return $this->auteur;
    }
    public function titre() {
        return $this->titre;
    }
    public function contenu() {
        return $this->contenu;
    }
    public function dateAjout() {
        return $this->dateAjout;
    }
    public function dateModif() {
        return $this->dateModif;
    }

    //setters
    public function setId($id) {
        $this->id = (int) $id;
    }
    public function setAuteur($auteur) {
        if (is_string($auteur) && strlen($auteur) <= 30) {
            $this->auteur = $auteur;
        }
    }
    public function setTitre($titre) {
        if (is_string($titre) && strlen($titre) <= 30) {
            $this->titre = $titre;
        }
    }
    public function setContenu($contenu) {
        if (is_string($contenu)) {
            $this->contenu = $contenu;
        }
    }
    public function setDateAjout($dateAjout) {
        $this->dateAjout = $dateAjout;
    }
    public function setDateModif($dateModif) {
        $this->dateModif = $dateModif;
    }

    //Affichage des cinq premières news à l'accueil du site avec texte réduit à 200 caractères
    public function affichageNews() {

    }
    //Affichage des cinq premières news à l'accueil du site avec texte réduit à x caractères ici 20
    public function couperText(string $contenu, int $limit = 10) { //lgueur à garder
        echo substr($contenu, 0, 20).' '. '[...]';
        /*if (mb_strlen($contenu) <= $limit) { //Retourne la taille d'une chaîne
            return $contenu;
        }
        return substr($contenu, 0, $limit) . '...';
    }*/
    }
}
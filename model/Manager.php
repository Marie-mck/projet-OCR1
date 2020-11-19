<?php

//namespace tpnews5a\model;

class Manager {
    
    protected $db;

    protected function dbConnect() {
        $this->db = null;
        
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=news;charset=utf8', 'root', '');
            return $this->db;
        }
        catch (PDOException $exception) {
            echo 'Erreur ed connexion' .$exception->getMessage();
        }
        
    }
}

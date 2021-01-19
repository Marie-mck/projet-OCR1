<?php

namespace projet4\model;

class Manager {
    
    protected $db;

    protected function dbConnect() {
        $this->db = null;
        
        try {
            $this->db = new \PDO('mysql:host=localhost;dbname=news;charset=utf8', 'root', '');
            //$this->db = new \PDO('mysql:host=db5001481751.hosting-data.io;dbname=dbs1245443;charset=utf8', 'dbu570159', 'Mpbdd400&');
            return $this->db;
        }
        catch (PDOException $exception) {
            echo 'Erreur de connexion' .$exception->getMessage();
        }
        
    }
}

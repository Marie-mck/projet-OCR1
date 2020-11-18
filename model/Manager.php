<?php

//namespace tpnews5a\model;

class Manager {
    protected function dbConnect() {
        $db = new PDO('mysql:host=localhost;dbname=news;charset=utf8', 'root', '');
        return $db;
    }
}

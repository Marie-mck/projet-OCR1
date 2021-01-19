<?php

namespace projet4\controller;

use projet4\model\PostManager;
use projet4\model\Vue;

class HomeController {
    protected $postManager;

    public function __construct() {
        $this->postManager = new PostManager();
    }

    //vue 1ere page avec liste des posts
    public function listPosts() {
        $posts = $this->postManager->getLast();
        $vue = new Vue("visiteur/Home");
        $vue->setTitre("blog");
        $vue->generer(array('posts' => $posts));
    }
}
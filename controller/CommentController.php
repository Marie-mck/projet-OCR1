<?php

namespace projet4\controller;

use projet4\model\PostManager;
use projet4\model\CommentManager;
use projet4\model\UserManager;
use projet4\model\Vue;

class CommentController {
    protected $postManager;
    protected $commentManager;
    protected $userManager;

    public function __construct() {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->userManager = new UserManager();
    }

    // PAGE ADMIN - tableau des chapitres et tableau des commentaires sur la page modifier, approuver, supprimer un commentaire

    public function afficherPageAdminComment() {
        $comments = $this->commentManager->getListComment();
        $commentSignalesTableaux = $this->commentManager->getSignalComments();
        $vue = new Vue("admin/AdminComment");
        $vue->addJsFile("public/js/commentTable.js?v=1.0");
        $vue->generer(array('comments' => $comments, 'commentSignalesTableaux' => $commentSignalesTableaux));
    }

    public function signalerComment($id) {
        $comments = $this->commentManager->getListComment();
        $commentSignales = $this->commentManager->signalComment($_GET['id']);
        $commentSignalesTableaux = $this->commentManager->getSignalComments($_GET['id']);
        $vue = new Vue("visiteur/VoirPlus");
        $vue->genererJson(["success" => true]);
    }

    public function afficherComment($id) {
        $getComments =  $this->commentManager->getOneComment($_GET['id']);
        $vue = new Vue("admin/AdminUpdateComment");
        $vue->generer(array('getComments' => $getComments));
    }

    public function modifierComment($id) {
        if(isset($_GET['id']) AND isset($_POST['commentaire'])) {
            if(!empty($_POST['commentaire'])) {
                $commentaire = htmlspecialchars($_POST['commentaire']);
                $id = (int) $_GET['id'];
                $commentUpdate = $this->commentManager->updateComment($commentaire, $id);
            } else {
                
            }
        }
        $vue = new Vue("admin/AdminComment");
        header('Location: index.php?action=afficherAdminComment');
    }
    
    public function approvedComment($id){    
        $approvedComment = $this->commentManager->approved($_GET['id']);
        $vue = new Vue("admin/AdminComment");
        header('Location: index.php?action=afficherAdminComment');
    }

    public function deleteComment($id){    
        $deleteComment = $this->commentManager->deleteComment($_GET['id']);
        $vue = new Vue("admin/AdminComment");
        header('Location: index.php?action=afficherAdminComment');
    }
}
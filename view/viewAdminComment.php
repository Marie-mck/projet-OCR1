
<!---
<p><a href="view/viewVoirPlus.php?">Retour au chapitre</a></p>
<a class="adminLink" href="index.php?action=afficherAdminChapter<?php //echo $post->id()?>">Administration Chapitre</a>
<p><a href="index.php?action=post&id=<?php// echo $post->id()?>">Retour au chapitre</a></p>
<p><a href="index.php?action=post">Retour au chapitre</a></p>--->

<section id="adminPageInfo">

    <h3 class="pageAdminTitle">Liste des commentaires signalés</h3>
    <table class="tableCommentsSignales">
        <tr><th>Auteur</th><th>Commentaires</th><th>Date d'ajout</th><th>Chapitre concerné</th><th>Id</th><th>Commentaire signalé</th></tr>
        <?php
            foreach ($commentSignalesTableaux as $commentSignalesTableau){
                echo '<tr><td>' .$commentSignalesTableau->authorComment(). '</td>
                    <td>'. $commentSignalesTableau->commentaire(). '</td>
                    <td>'. $commentSignalesTableau->dateComment(). '</td>
                    <td>' .$commentSignalesTableau->idNews(). '</td>
                    <td>' .$commentSignalesTableau->id(). '</td>
                    <td>' .$commentSignalesTableau->signalerComment(). '</td>
                    </tr>';
                }
            ?>
    </table>

    <h3 class="pageAdminTitle">Liste des commentaires</h3>

<table class="tableComments">
    <tr><th>Auteur</th><th>Commentaires</th><th>Date d'ajout</th><th>Chapitre concerné</th><th>Id</th><th>Commentaire approuvé</th><th>Approuver</th><th>Supprimer</th></tr>
    <?php
        foreach ($comments as $comment){
            echo '<tr><td>' . $comment->authorComment(). '</td>
                <td>'. $comment->commentaire(). '</td>
                <td>'. $comment->dateComment(). '</td>
                <td>' .$comment->idNews(). '</td>
                <td>' .$comment->id(). '</td>
                <td>' .$comment->signalerComment(). '</td>
                <td><a href="?action=afficherPageAdmin&modifierComment&id=' .$comment->id(). '">Approuver</a></td>
                <td><a href="?action=afficherPageAdmin&supprimer&id='. $comment->id(). '">Supprimer</a></td></tr>';
        }
    ?>
</table>

<div class="chapter">
            <h3>Chapitre : <?php //echo htmlspecialchars(strtoupper($post->titre())); ?></h3>
            <p>
                <strong>Par <?php //echo $post->auteur(); ?></strong>
                <strong>- le <?php //echo $post->dateAJout(); ?></strong>
            </p>
            <p><?php //echo nl2br(htmlspecialchars($post->contenu())); ?></p>
            <p class="newsText">
            <?php //echo nl2br(htmlspecialchars(($news->contenu()))); ?> <br />
            <?php/*
            $contenu = nl2br(stripslashes($post->contenu()));
            echo $post->couperText($contenu);*/
            ?>
            </p>
        </div>
</section>
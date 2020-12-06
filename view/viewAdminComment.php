
<!---
<p><a href="view/viewVoirPlus.php?">Retour au chapitre</a></p>
<a class="adminLink" href="index.php?action=afficherAdminChapter<?php //echo $post->id()?>">Administration Chapitre</a>
<p><a href="index.php?action=post&id=<?php// echo $post->id()?>">Retour au chapitre</a></p>
<p><a href="index.php?action=post">Retour au chapitre</a></p>--->

<section id="adminPageInfo">

    <h3 class="pageAdminTitle">Liste des commentaires signalés - en cours de traitement</h3>
    <table class="tableCommentsSignales">
        <tr><th>Auteur</th><th>Commentaires</th><th>Date d'ajout</th><th>Chapitre concerné</th><th>Id</th><th>Commentaire signalé</th><th>Approuver</th><th>Supprimer</th></tr>
        <?php
            foreach ($commentSignalesTableaux as $commentSignalesTableau){
                echo '<tr><td>' .$commentSignalesTableau->authorComment(). '</td>
                    <td>'. $commentSignalesTableau->commentaire(). '</td>
                    <td>'. $commentSignalesTableau->dateComment(). '</td>
                    <td>' .$commentSignalesTableau->idNews(). '</td>
                    <td>' .$commentSignalesTableau->id(). '</td>
                    <td>' .$commentSignalesTableau->signalerComment(). '</td>
                    <td><a href="?action=afficherAdminComment&approvedComment&id=' .$commentSignalesTableau->id(). '">Approuver</a></td>
                    <td><a href="?action=afficherAdminComment&supprimer&id='. $commentSignalesTableau->id(). '">Supprimer</a></td></tr>';
                }
            ?>
    </table>

    <h3 class="pageAdminTitle">Liste des commentaires</h3>

<table class="tableComments">
    <tr><th>Auteur</th><th>Commentaires</th><th>Date d'ajout</th><th>Chapitre concerné</th><th>Id</th><th>Modifier</th><th>Supprimer</th></tr>
    <?php
        foreach ($comments as $comment){
            echo '<tr><td>' . $comment->authorComment(). '</td>
                <td>'. $comment->commentaire(). '</td>
                <td>'. $comment->dateComment(). '</td>
                <td>' .$comment->idNews(). '</td>
                <td>' .$comment->id(). '</td>
                <td><a href="?action=afficherAdminComment&modifierComment&id=' .$comment->id(). '">Modifier</a></td>
                <td><a href="?action=afficherAdminComment&supprimer&id='. $comment->id(). '">Supprimer</a></td></tr>';
        }
    ?>
</table>

<h3>formulaire de modif</h3>

<!---<form method="POST" action="index.php?action=modifierComment&id=<?//= $comment->id() ?>" class="modifComments">--->
<form method="POST" action="" class="modifComments">
        <input type="hidden" name="idNews" value="<?php //echo $comment->idNews(); ?>" />
        <label for="auteur">Pseudo</label>
        <input type="text" name="authorComment" value =" <?php echo (isset($comment)) ? htmlspecialchars_decode($comment->authorComment()) :''; ?>" placeholder="Auteur" /><br />
        <label for="commentaire">Commentaire</label>
        <textarea name="commentaire" placeholder="Contenu du commentaire"> <?php echo (isset($comment)) ? htmlspecialchars_decode($comment->commentaire()) :''; ?></textarea><br />
        
        <input type="submit" value="Poster" name="Poster"/>
        <input type="submit" value="Ajouter" name="ajouter"/>
</form>



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
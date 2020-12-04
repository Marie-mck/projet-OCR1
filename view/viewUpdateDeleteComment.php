
<!---page tableau des commentaires et supprimer et modifier un commentaire --->

<p><a href="index.php?id=<?php //echo $post->id() ?>">Retour aux chapitres</a></p> 

<h3>Tableau - Liste des chapitres</h3>

    <table class="tableChapters">
        <tr><th>Auteur</th><th>Contenu</th><th>Date d'ajout</th><th>N° du chapitre</th><th>Modifier</th><th>Supprimer</th></tr>
        <?php
            foreach ($chapitres as $chapitre){
                echo '<tr><td>'. $chapitre->auteur(). '</td>
                    <td>'. $chapitre->contenu(). '</td>
                    <td>'. $chapitre->dateAjout(). '</td>
                    <td>' .$chapitre->id(). '</td>
                    </tr>';
                }
            ?>
    </table><br/>

<p>Nombre de commentaires créés : <?php// echo $countComment->idNews() ?></p>

<h3>Tableau - Liste des commentaires</h3>

    <table class="tableComments">
        <tr><th>Auteur</th><th>Commentaires</th><th>Date d'ajout</th><th>Chapitre concerné</th><th>Modifier</th><th>Supprimer</th></tr>
        <?php
            foreach ($comments as $comment){
                echo '<tr><td>' . $comment->authorComment(). '</td>
                    <td>'. $comment->commentaire(). '</td>
                    <td>'. $comment->dateComment(). '</td>
                    <td>' .$comment->idNews(). '</td>
                    <td><a href="?action=afficherPageAdmin&modifier='. $comment->id(). '">Modifier</a></td>
                    <td><a href="?action=deleteComment&supprimer='. $comment->id(). '">Supprimer</a></td></tr>';
                }
            ?>
    </table>

    <div class="newsdisplay">
        <h3>Chapitre : <?php echo htmlspecialchars(strtoupper($post->titre())); ?></h3>
        <p>
            <strong>Par <?php echo $post->auteur(); ?></strong>
            <strong>- le <?php echo $post->dateAJout(); ?></strong>
        </p>
        <p><?php //echo nl2br(htmlspecialchars($post->contenu())); ?></p>
        <p class="newsText">
        <?php //echo nl2br(htmlspecialchars(($news->contenu()))); ?> <br />
        <?php
        $contenu = nl2br(stripslashes($post->contenu()));
        echo $post->couperText($contenu);
        ?>
        </p>
    </div>

    <h3>Ajouter un commentaire</h3>
<form action="" method="post">
    <input id="authorComment" name="authorComment" type="text" placeholder="Votre pseudo" required /><br />
    <textarea id="commentaire" name="commentaire" placeholder="Votre commentaire" required></textarea><br />
    <input type="hidden" name="id" value="<?= $post->id() ?>" />
    <input type="submit" value="Commenter" />
</form>

<h3>Approuver ou supprimer un commentaire</h3>
<form method="POST" action="" class="">
    <input type="hidden" name="idNews" value="<?php// echo $comment->idNews(); ?>" />
    <label for="auteur">Pseudo</label>
    <input type="text" name="authorComment" value =" <?php echo (isset($comment)) ? htmlspecialchars_decode($comment->authorComment()) :''; ?>" placeholder="Auteur" /><br />
    <label for="commentaire">commentaire</label>
    <textarea name="commentaire" placeholder="Contenu du commentaire"> <?php echo (isset($comment)) ? htmlspecialchars_decode($comment->commentaire()) :''; ?></textarea><br />
    
    <input type="submit" value="Poster" name="Poster"/>
    <input type="submit" value="Ajouter" name="ajouter"/>
</form>

<div id = "authorComment"><a href="?authorComment='<?= $comment->authorComment() ?> '">auteur</a></div>
    <div class="comment">Posté par <?= $comment->authorComment() ?><br/></a> le <?= $comment->dateComment()?><br/>
    <?php echo $comment->commentaire()?></div><br/>
    <?php echo $comment->idNews()?></div><br/>

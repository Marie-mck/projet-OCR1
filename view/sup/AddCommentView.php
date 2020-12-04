<p><a href="blog.php?id=<?php //echo $news->id() ?>">Retour aux news</a></p>  


    <p>titre
            <ul><?php foreach ($commentManager->getListComment() as $info) { ?>
            <li><a href="ajoutComments.php?id=<?= $info->id() ?>"><?= $info->authorComment() ?></a></li>
            <?php } ?></ul>
        </p>
        
    <?php
        if (isset($message)) {// On a un message à afficher ?
        echo '<p>', $message, '</p>'; // Si oui, on l'affiche.
        }
    ?>
        <form method="POST" action="" class="addComments">
        <input type="hidden" name="idNews" value="<?php //echo $comment->idNews(); ?>" />
        <label for="auteur">Pseudo</label>
        <input type="text" name="authorComment" value =" <?php echo (isset($comment)) ? htmlspecialchars_decode($comment->authorComment()) :''; ?>" placeholder="Auteur" /><br />
        <label for="commentaire">commentaire</label>
        <textarea name="commentaire" placeholder="Contenu du commentaire"> <?php echo (isset($comment)) ? htmlspecialchars_decode($comment->commentaire()) :''; ?></textarea><br />
        
        <input type="submit" value="Poster" name="Poster"/>
        <input type="submit" value="Ajouter" name="ajouter"/>
        <input type="submit" value="Modifier" name="modifier"/>
        <input type="submit" value="Supprimer" name="supprimer"/>

        </form>

        <p>Nombre de commentaires créés : <?= $commentManager->count() ?></p>

        <h2>Commentaires</h2>
        
        <h3>Tableau - Liste des commentaires</h3>
            <table class="displayNews">
                <tr><th>Auteur</th><th>Commentaires</th><th>Date d'ajout</th><th>News concernée</th><th>Modifier</th><th>Supprimer</th></tr>
                    <?php
                    foreach ($commentManager->getListComment() as $comment){
                        echo '<tr><td>'. $comment->authorComment().'</td>
                            <td>'. $comment->commentaire(). '</td>
                            <td>'. $comment->dateComment(). '</td>
                            <td>'. $newsManager->getNews($comment->idNews())->titre(). '</td>
                            <td><a href="?modifier='. $comment->id(). '">Modifier</a></td>
                            <td><a href="?supprimer='. $comment->id(). '">Supprimer</a></td></tr>';
                        }
                    ?>
            </table>
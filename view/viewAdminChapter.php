
<!---page tableau des commentaires et supprimer et modifier un commentaire
<p><a href="index.php?id=<?php //echo $post->id() ?>">Retour aux chapitres</a></p> --->

<section id="adminPageInfo">

    <h3 class="pageAdminTitle">Tableau - Liste des chapitres</h3>

        <table class="tableChapters">
            <tr><th>Auteur</th><th>Contenu</th><th>Date d'ajout</th><th>N° du chapitre</th><th>Modifier</th><th>Supprimer</th></tr>
            <?php
                foreach ($chapitres as $chapitre){
                    echo '<tr><td>'. $chapitre->auteur(). '</td>
                        <td>'. $chapitre->contenu(). '</td>
                        <td>'. $chapitre->dateAjout(). '</td>
                        <td>' .$chapitre->id(). '</td>
                        <td><a href="?valider='. $chapitre->id(). '">Valider</a></td>
                        <td><a href="?action=afficherPageAdmin&supprimerChapter&id='. $chapitre->id(). '">Supprimer</a></td></tr>';
                    }
                ?>
        </table><br/>

    <p>Nombre de chapitres créés : <?php// echo $countComment->idNews() ?></p>
    <p>Nombre de commentaires créés : <?php //echo $commentsCount->count() ?></p>


<!---<input type="hidden" name="id" value="<?//= $post->id() ?>" /><input type="hidden" name="id" value="<?//= $post->id() ?>" />
    <td><a href="?action=afficherPageAdmin&modifier='. $comment->id(). '">Modifier</a></td>
    <td><a href="?action=deleteComment&supprimer='. $comment->id(). '">Supprimer</a></td></tr>';
--->


</section>
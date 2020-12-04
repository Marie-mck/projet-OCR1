
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

    <p>Nombre de commentaires créés : <?php// echo $countComment->idNews() ?></p>
    <p>Nombre de commentaires créés : <?php //echo $commentsCount->count() ?></p>

    <h3 class="pageAdminTitle">Tableau - Liste des commentaires</h3>

        <table class="tableComments">
            <tr><th>Auteur</th><th>Commentaires</th><th>Date d'ajout</th><th>Chapitre concerné</th><th>Approuver</th><th>Supprimer</th></tr>
            <?php
                foreach ($comments as $comment){
                    echo '<tr><td>' . $comment->authorComment(). '</td>
                        <td>'. $comment->commentaire(). '</td>
                        <td>'. $comment->dateComment(). '</td>
                        <td>' .$comment->idNews(). '</td>
                        <td><a href="?action=afficherPageAdmin&modifierComment&id=' .$comment->id(). '">Approuver</a></td>
                        <td><a href="?action=afficherPageAdmin&supprimer&id='. $comment->id(). '">Supprimer</a></td></tr>';
                    }
                ?>
        </table>

<!---<input type="hidden" name="id" value="<?//= $post->id() ?>" /><input type="hidden" name="id" value="<?//= $post->id() ?>" />
    <td><a href="?action=afficherPageAdmin&modifier='. $comment->id(). '">Modifier</a></td>
    <td><a href="?action=deleteComment&supprimer='. $comment->id(). '">Supprimer</a></td></tr>';
--->
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

        <h3 class="pageAdminTitle">Liste des Users</h3>
            <table class="tableUsers">
                <tr><th>pseudo</th><th>email</th><th>password</th><th>Date d'ajout</th><th>Profil</th><th>Modifier</th><th>Supprimer</th></tr>
                <?php
                    foreach ($users as $user) {
                        echo '<tr><td>' . $user->pseudo(). '</td>
                        <td>'. $user->email(). '</td>
                        <td>'. $user->motDePasse(). '</td>
                        <td>'. $user->dateRecord(). '</td>
                        <td>'. $user->profil(). '</td>
                        <td><a href="?modifier='. $user->id(). '">Modifier</a></td>
                        <td><a href="?action=afficherPageAdmin&supprimerUser&id='. $user->id(). '">Supprimer</a></td></tr>';
                    }
                ?>
            </table><br/>
</section>
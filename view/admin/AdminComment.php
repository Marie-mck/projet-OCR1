<section id="adminPageInfo">

    <h3 class="pageAdminTitle">Liste des commentaires signalés - en cours de traitement</h3>

        <table class="tableCommentsSignales">
        <thead>
            <tr><th>Id</th><th>Auteur</th><th id="commentColumnSize">Commentaires</th><th>Date d'ajout</th><th>Chapitre concerné</th><th>Approuver</th><th>Supprimer</th></tr>
        </thead>

        <tbody>
        <?php
            foreach ($commentSignalesTableaux as $commentSignalesTableau){
                echo '<tr><td>' .$commentSignalesTableau->id(). '</td>
                    <td>' .$commentSignalesTableau->authorComment(). '</td>
                    <td>'. $commentSignalesTableau->commentaire(). '</td>
                    <td>'. $commentSignalesTableau->dateComment(). '</td>
                    <td>' .$commentSignalesTableau->idNews(). '</td>
                    <td><a href="?action=afficherAdminComment&approvedComment&id=' .$commentSignalesTableau->id(). '">Approuver</a></td>
                    <td><a href="?action=afficherAdminComment&supprimer&id='. $commentSignalesTableau->id(). '">Supprimer</a></td></tr>';
                }
            ?>
        </tbody>
    </table>

    <h3 class="pageAdminTitle">Liste des commentaires</h3>

    <table class="tableComments">
        <thead>
            <tr><th>Id</th><th>Auteur</th><th>Commentaires</th><th>Date d'ajout</th><th>Chapitre concerné</th><th>Modifier</th><th>Supprimer</th></tr>
        </thead>

        <tbody>
        <?php
            foreach ($comments as $comment){
                echo '<tr><td>' .$comment->id(). '</td>
                    <td>' . $comment->authorComment(). '</td>
                    <td>'. $comment->commentaire(). '</td>
                    <td>'. $comment->dateComment(). '</td>
                    <td>' .$comment->idNews(). '</td>
                    <td><a href="?action=afficherAdminComment&modifierCommentBtn&id=' .$comment->id(). '">Modifier</a></td>
                    <td><a href="?action=afficherAdminComment&supprimer&id='. $comment->id(). '">Supprimer</a></td></tr>';
            }
        ?>
        </tbody>
    </table>

</section>
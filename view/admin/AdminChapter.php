
<!---page tableau des commentaires et supprimer et modifier un commentaire --->
<p><a href="index.php?action=afficherAdminChapter&addChapter">Ajouter un Billet</a></p>

<section id="adminPageInfo">

    <h3 class="pageAdminTitle">Liste des billets</h3>

        <table class="tableChapters">
            <thead>
            <tr><th>Titre</th><th>Contenu</th><th>Date d'ajout</th><th>N° du chapitre</th><th>Modifier</th><th>Supprimer</th></tr>
            </thead>

            <tbody>
            <?php
                foreach ($chapitres as $chapitre){
                    echo '<tr>
                        <td>'. $chapitre->titre(). '</td>
                        <td>'. $chapitre->contenu(). '</td>
                        <td>'. $chapitre->dateAjout(). '</td>
                        <td>' .$chapitre->id(). '</td>
                        <td><a href="?action=afficherAdminChapter&modifierChapterBtn&id='. $chapitre->id(). '">Modifier</a></td>
                        <td><a href="?action=afficherAdminChapter&supprimerChapter&id='. $chapitre->id(). '">Supprimer</a></td></tr>';
                    }
                ?>
            </tbody>
        </table><br/>

</section>
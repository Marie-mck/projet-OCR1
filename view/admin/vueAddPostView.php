
        <form method="POST" action="" class="addComments">
        <label for="titre">Titre</label><input type="text" name="titre" value="<?php echo (isset($news)) ? htmlspecialchars_decode($news->titre()) : ''; ?> " placeholder="Titre" /><br />
        <label for="auteur">auteur</label><input type="text" name="auteur" value =" <?php echo (isset($news)) ? htmlspecialchars_decode($news->auteur()) :''; ?>" placeholder="Auteur" /><br />
        <label for="dateAjout">dateAjout</label><input type="text" name="dateAjout" value =" <?php /*echo htmlspecialchars($news->dateAjout());*/ ?>" placeholder="dateAjout" /><br />
        <label for="contenu">contenu</label><textarea name="contenu" placeholder="Contenu de l'article"> <?php echo (isset($news)) ? htmlspecialchars_decode($news->contenu()) :''; ?></textarea><br />
            <input type="submit" value="Ajouter" name="ajouter"/>
            <input type="submit" value="Modifier" name="modifier"/>
            <input type="submit" value="Supprimer" name="supprimer"/>
        </form>

        <p>Nombre de news créés : <?= $manager->count() ?></p>
        
        <h1>Formulaire blog - ajout Nouvelle news</h1>
        <div class="news">
        
            <h3>Tableau - Liste des News</h3>
            <table class="displayNews">
                <tr><th>Titre</th><th>Auteur</th><th>Contenu</th><th>Date d'ajout</th><th>Dernière modification</th><th>Modifier</th><th>Supprimer</th></tr>
                    <?php
                    foreach ($manager->getList() as $news){ //resultat de la requete as
                    echo '<tr><td>'. $news->titre().'</td>
                        <td>'. $news->auteur(). '</td>
                        <td>'. $news->contenu(). '</td>
                        <td>'. $news->dateAjout(). '</td>
                        <td>'. $news->id(). '</td>
                        <td><a href="?modifier='. $news->id().'">Modifier</a></td>
                        <td><a href="?supprimer='. $news->id().'">Supprimer</a></td></tr>'
                        ;
                    }
                    ?>
            </table>
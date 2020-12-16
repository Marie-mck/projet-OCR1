<h3>formulaire de modif</h3>

<!---<form method="POST" action="index.php?action=afficherAdminComment&modifierComment&id=<?//= $comment->id() ?>" class="modifComments">
<p><a href="index.php?action=afficherAdminComment&modifierNewComment&id=<?php //echo $getComments->id(); ?>">Modifier</a></p>--->
        <?php while ($getChapter = $getChapters->fetch()) { ?>
        <form action="index.php?action=afficherAdminChapter&modifierNewChapter&id=<?php echo $getChapter['id']?>" method="post" class="addComment">
                <label for="auteur">Pseudo</label>
                <input type="text" name="auteur" value="<?php echo $getChapter['auteur'] ?>" placeholder="Auteur"/><br />
                <label for="titre">AUteur</label>
                <input type="text" name="titre" value="<?php echo $getChapter['titre'] ?>" placeholder="Titre"/><br />
                <label for="contenu">Chapitre</label>
                <textarea name="contenu" placeholder="Contenu du chapitre"><?php echo $getChapter['contenu'] ?></textarea><br />
                
                <input type="text" name="id" value="<?php echo $getChapter['id'] ?>"/>

                <input type="submit" value="Modifier" name="modifierNewChapter"/>
                <button type="submit" name="modifierNewChapter" value="Modifier"
                href="index.php?action=modifierNewChapter&id=<?php echo $getChapter['id']?>">Modifier</button>
        </form>
        
<?php } ?>
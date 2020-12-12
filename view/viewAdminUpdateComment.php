<h3>formulaire de modif</h3>

<!---<form method="POST" action="index.php?action=afficherAdminComment&modifierComment&id=<?//= $comment->id() ?>" class="modifComments">
<p><a href="index.php?action=afficherAdminComment&modifierNewComment&id=<?php //echo $getComments->id(); ?>">Modifier</a></p>--->
        <?php while ($getComment = $getComments->fetch()) { ?>
        <form action="index.php?action=afficherAdminComment&modifierNewComment&id=<?php //echo $getComment['id']?>" method="post" class="addComment">
                <label for="auteur">Pseudo</label>
                <input type="text" name="authorComment" value="<?php echo $getComment['authorComment'] ?>" placeholder="Auteur"/><br />
                <label for="commentaire">Commentaire</label>
                <textarea name="commentaire" placeholder="Contenu du commentaire"><?php echo $getComment['commentaire'] ?></textarea><br />
                <input type="submit" value="Modifier" name="modifierNewComment"/>
                <button type="submit" name="modifierNewComment" value="Modifier"
                href="index.php?action=modifierNewComment&id=<?php// echo $getComment['id']?>">Modifier</button>
        </form>
<?php } ?>

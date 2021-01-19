
<h3 class="updateCommentTitle">Modification d'un commentaire</h3>

        <?php while ($getComment = $getComments->fetch()) { ?>

        <form action="index.php?action=afficherAdminComment&modifierNewComment&id=<?php echo $getComment['id']?>" method="post" class="updateComment">
                <table class="modifCommentForm">
                        <thead>

                        </thead>
                        <tbody>
                        <tr>   
                                <td><text class="formCommentCommentaire" name="authorComment" placeholder="authorComment">par <?php echo $getComment['authorComment'] ?></textarea><br/></td>
                        </tr>
                        <tr>   
                                <td><textarea class="formCommentCommentaire" name="commentaire" placeholder="Contenu du commentaire"><?php echo $getComment['commentaire'] ?></textarea><br/></td>
                        </tr>
                        <tr>   
                                <td colspan ="2"><input class="formCommentBtn" type="submit" value="Modifier" name="modifierNewComment"/></td>
                        </tr>
                        </tbody>
                </table>
        </form>
        
        <?php } ?>

        <p class="backCommentLink"><a href="index.php?action=afficherAdminComment">← Liste des commentaires</a></p>

<section class="addCommentPage">
    
    <div class="newsdisplay">
        <h3 class="chapters">Chapitre : <?php echo htmlspecialchars(strtoupper($post->titre())); ?></h3>
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
    <h3 class="addCommentTitle">Ajouter un commentaire</h3>
    <form action="index.php?action=ajoutComment&amp;id=<?= $post->id() ?>" method="post" class="addCommentForm">
    <form method="post" action="index.php?action=ajoutComment">
        <input id="authorComment" name="authorComment" type="text" placeholder="Votre pseudo" required /><br />
        <textarea id="commentaire" name="commentaire" rows="10" placeholder="Votre commentaire" required></textarea><br />
        <input type="hidden" name="id" value="<?= $post->id() ?>" />
        <input type="submit" value="Commenter" class="commentBtn"/>
    </form>

</section>
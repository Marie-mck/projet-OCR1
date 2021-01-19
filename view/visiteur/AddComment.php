<section class="addCommentPage">
    
    <div class="newsdisplay">
        <h2 class="chapters"><?php echo htmlspecialchars(strtoupper($post->titre())); ?></h2>
            <p>
                <strong>Par <?php echo $post->auteur(); ?></strong>
                <strong>- le <?php echo $post->dateAJout(); ?></strong>
            </p>

            <p class="newsText">
                <?php
                $contenu = nl2br(stripslashes($post->contenu()));
                echo $post->couperText($contenu);
                ?>
            </p>

    </div>

    <h2 class="addCommentTitle">Ajouter un commentaire</h2>
    
    <form action="index.php?action=ajoutComment&amp;id=<?= $post->id() ?>" method="post" class="addCommentForm">
    <form method="post" action="index.php?action=ajoutComment">
        <input id="authorComment" name="authorComment" type="text" placeholder="Votre pseudo" required /><br />
        <textarea id="commentaire" name="commentaire" rows="10" placeholder="Votre commentaire" required></textarea><br />
        <input type="hidden" name="id" value="<?= $post->id() ?>" />
        <input type="hidden" name="signalerComment" value="0" />
        <input type="submit" name="Commenter" value="Commenter" class="commentBtn"/>

        <input type="text" name="message" id="message" value="<?php if(isset($message)) {echo $message;} ?>" /><br />
    </form>

    <p><a href="index.php?action=post&id=<?php echo $post->id()?>">← Retour au billet</a></p>

</section>
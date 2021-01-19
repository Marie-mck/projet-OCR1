
<section class="voirPlusChapter">

    <div class="newsdisplay">
        <h2 class="titleVoirPlus"><?php echo htmlspecialchars(strtoupper($post->titre())); ?></h2>
        <p class="authorTitle">
            <strong>Par <?php echo $post->auteur(); ?></strong></br>
            <strong>Le <?php echo $post->dateAJout(); ?></strong>
        </p>
        <p><?php echo nl2br(htmlspecialchars($post->contenu())); ?></p>
    </div>

    <div>
        <p class="addCommentLink"><a class="addCommentBtn" href="index.php?action=ajoutComment&id=<?php echo $post->id()?>">Pour ajouter un commentaire</a></p>
    </div>

    <p><a href="index.php">← Accueil</a></p>

    <div id="commentList">
        <h2 class="titleVoirPlus">Liste des Commentaires pour ce chapitre</h2
        >
        <?php while ($commentaire = $commentaires->fetch()) { ?>
            <div class="containerComment">
                <p class="commentTitle"><strong><?= htmlspecialchars($commentaire['authorComment']) ?></strong></br> le <?= $commentaire['dateComment'] ?></p>
                
                <?php if($commentaire['signalerComment']) {?>
                    <p class="content">Commentaire signalé</p>
                <?php } else { ?>

                <p class="content"><?= nl2br(htmlspecialchars($commentaire['commentaire'])) ?></p>
                <button type="submit" name="signalerBouton" class="signalerBouton" value="signaler" data-href="index.php?action=signalerComment&id=<?php echo $commentaire['id']?>">Signaler le commentaire</button>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

</section>

<script src="public/js/projet.js"></script>
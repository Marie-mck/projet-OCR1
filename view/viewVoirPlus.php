
<!--- <p><a href="index.php?id=<?php echo $post->id() ?>">Retour aux chapitres</a></p> --->

    <div class="chaptersAccess">
        <ul class="chaptersAccessBtn">
            <li class="chapterAccessList"><a href=""><span class="button">Chapitre précedent</span></a></li>
            <li class="chapterAccessList"><a href=""></a><span class="button">Chapitre X</span></a></li>
            <li class="chapterAccessList"><a href=""></a><span class="button">Chapitre suivant</span></a></li>
        </ul>
    </div>

    <section class="voirPlusChapter">

        <div class="newsdisplay">
            <h3 class="titleVoirPlus">Chapitres X :<?php echo htmlspecialchars(strtoupper($post->titre())); ?></h3>
            <p class="authorTitle">
                <strong>Par <?php echo $post->auteur(); ?></strong>
                <strong>- le <?php echo $post->dateAJout(); ?></strong>
            </p>
            <p><?php echo nl2br(htmlspecialchars($post->contenu())); ?></p>
        </div>

        <div>
            <p class="addCommentLink"><a class="addCommentBtn" href="index.php?action=ajoutComment&id=<?php echo $post->id()?>">Pour ajouter un commentaire</a></p>
        </div>

        <div id="commentList">
        <h3 class="titleVoirPlus">Liste des Commentaires pour ce chapitre</h3>
        <?php
        while ($commentaire = $commentaires->fetch()) {
        ?>
            <div class="containerComment">
                <p class="commentTitle"><strong><?= htmlspecialchars($commentaire['authorComment']) ?></strong> le <?= $commentaire['dateComment'] ?></p>
                <p><?= nl2br(htmlspecialchars($commentaire['commentaire'])) ?></p>
                <button type="signaler" name="signaler" id="signalerBouton" value="signaler">
                    <a class="signalerBtn" href="index.php?action=signalerComment">Signaler le commentaire</a></button>
        </div>
            
        <?php
        }
        ?>
        </div>

        <!--- <h3 class="titleVoirPlus">Liste des Commentaires pour ce chapitre</h3>
            <?php //foreach ($commentaires as $commentaire) { ?>
                <div class="lastDoc">
                    <div class="titleCommentList">
                        <h4>
                            <em>publier par<?php //echo htmlspecialchars($commentaire->authorComment()); ?></em>
                            <em>- le <?php // echo $commentaire->dateComment(); ?></em>
                        </h4>
                    </div>
                    <div class="textCommentList">
                        <?php //echo nl2br(htmlspecialchars($commentaire->commentaire())); ?>
                    </div>
                    <div>
                        <p class="signaler"><a class="signaler" href="index.php?action=signaler&id=<?php //echo $post->id()?>">Pour signaler un commentaire</a></p>
                    </div>
                </div>
            <?php// } ?>
        --->

    </section>
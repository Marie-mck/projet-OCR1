
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
                <p class="content"><?= nl2br(htmlspecialchars($commentaire['commentaire'])) ?></p>
                <button type="signaler" name="signaler" id="signalerBouton" value="signaler" onclick="alert('test2')">
                    <a class="signalerBtn" href="index.php?action=signalerComment&id=<?php echo $commentaire['id']?>">Signaler le commentaire</a></button>
                    
                    <!---<form method="post" action="index.php?action=signalerComment$id=<?php //echo $commentaire['id'] ?>">
                        <input type="hidden" name="nb_report" value="<?//= $commentaire['nb_report'] ?>" />
                        <input type="submit" value="Signaler le commentaire" />
                    </form>--->
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
            
    <script>
    alert('test');
    console.log("hello");
    document.getElementById('signalerBouton').addEventListener('click', _ => {
        document.getElementById('signalerBouton').style.display = "none";
        document.querySelector(".content").innerHTML = 'Ce commentaire est en cours de validation après signalement';
    });
    </script>
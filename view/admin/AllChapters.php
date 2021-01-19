
<section>

    <h3 id="allChaptersTitle">Billets du blog</h3>

    <?php foreach($allPosts as $allPost) { ?>
        <div class="allChapters">
        
            <div class="allChapterspres">
            <div class="allChapterspicture"><img class="allChapterspicture" src="public/images/<?php echo $allPost->picture(); ?>" alt="photos"></div>
            <div class="allChapterstitleDoc">
                <h4>
                <?php echo htmlspecialchars (strtoupper ($allPost->titre())); ?>
                <em>- publier le <?php echo $allPost->dateAjout(); ?></em>
                <strong>- par <?php echo htmlspecialchars($allPost->auteur()); ?></strong>
                </h4>
            </div>
            <div class="allChapterstextDoc">
                <p class="allChaptersText">
                <?php
                    $contenu = nl2br(stripslashes($allPost->contenu()));
                    echo $allPost->couperText($contenu);
                ?>
                </p>
            </div>
            <div class="allChaptersreadmoreDoc">
                <p><a href="index.php?action=post&id=<?php echo $allPost->id()?>">Voir Plus ...</a></p>
            </div>
            </div>
            
        </div>
    <?php } ?>

</section>
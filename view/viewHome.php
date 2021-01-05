
<section>
    
    <div id="introduction">
        
        <div class="imageBox">
            <img src="public/images/DSC_0106.jpg" class="image" alt="glacier"/>
            <text class="text">
                <h1>Billet simple pour l'Alaska</h1>
            </text>
        </div>
        
        <div class="text2">
            <p class="presentation">Mon dernier roman</p>
            <p class="textPresentation">bFZQREGFHSJYDTOBJKGBgoigbio</p>
        </div>
    </div>

    <h3 id="lastChaptersTitle">Derniers chapitres du blog</h3>

    <div class="last3Doc">
        <?php foreach($posts as $post) { ?>
            <div class="lastDoc">

                <div class="picture"><img class="picture" src="public/images/<?php echo $post->picture(); ?>" alt="photos"></div>
                    

                <div class="pres">
                    <div class="titleDoc">
                        <h4>
                            <?php echo htmlspecialchars (strtoupper ($post->titre())); ?></br>
                            <em>publier le <?php echo $post->dateAjout(); ?></em>
                        </h4>
                    </div>

                    <div class="textDoc">
                        <p class="newsText">
                        <?php
                        $contenu = nl2br(stripslashes($post->contenu()));
                        echo $post->couperText($contenu);
                        ?>
                        </p>
                    </div>
                        
                    <div class="readmoreDoc"><p><a class="read" href="index.php?action=post&id=<?php echo $post->id()?>">Voir Plus ...</a></p></div>
                        
                </div>
            </div>
        <?php } ?>
    </div>

</section>
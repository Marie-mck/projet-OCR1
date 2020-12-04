
<?php if(isset($_SESSION['pseudo'])) { ?>
    <p>Bonjour <?php echo $_SESSION['pseudo']; ?> <p>
<?php } ?>

<?php if(isset($_SESSION['pseudo'])) { //pour page administration A faire  ?>
    <p>Bonjour <?php echo $_SESSION['pseudo']; ?> <p>
<?php } ?>

<!--- <div class="administration">
        <p class="adminLink"><a href="index.php?action=afficherPageAdmin<?php //echo $post->id()?>">Page Administration</a></p>
    </div>--->

<section>
            <div id="introduction">
                <div class="imageBox">
                    <img src="images/DSC_0106.jpg" class="image" alt="glacier" />
                    <text class="text">
                    <h1>Billet simple pour l'Alaska</h1>
                    </text>
                </div>
                <div class="text2">
                    <p class="presentation">Mon dernier roman</p>
                    <p class="presentation">bFZQREGFHSJYDTOBJKGBgoigbio</p>
                </div>
            </div>


<h3 id="lastChaptersTitle">Derniers chapitres du blog</h3>

<?php foreach($posts as $post) { ?>
    <div class="lastDoc">
        <div class="titleDoc">
            <h4>
            <?php echo htmlspecialchars (strtoupper ($post->titre())); ?>
            <em>- publier le <?php echo $post->dateAjout(); ?></em>
            <strong>- par <?php echo htmlspecialchars($post->auteur()); ?></strong>
            </h4>
        </div>
        <div class="textDoc">
            <p class="newsText">
            <?php //echo nl2br(htmlspecialchars(($news->contenu()))); ?> <br />
            <?php
            // On enlève les éventuels antislash PUIS on crée les entrées en HTML (<br />)
            $contenu = nl2br(stripslashes($post->contenu()));
            echo $post->couperText($contenu);
            ?>
            </p>
        </div>
        
    <div class="readmoreDoc">
        <p><a href="index.php?action=post&id=<?php echo $post->id()?>">Voir Plus ...</a></p>
    </div>
    </div>
<?php } ?>

</section>
<?php //$title = 'Blog'; ?>

<?php  //ob_start(); ?>
<p>Derniers articles du blog :</p>

<?php foreach($posts as $post) {
    
?>
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
        <p><a href="view/VoirPlusView.php?id=<?php echo $post->id()?>">Voir Plus ...</a></p>
    </div>
    <!---le titre ne peut etre voirPlus, il doit s'adapter à la news --->
    <div class="commentDoc">
        <p><a href="view/VoirPlusView.php?id=<?php echo $post->id()?>">Commentaires</a></p>
    </div>
    </div>
<?php
}
?>
<?php //$content = ob_get_clean(); ?>

<?php //require('template.php'); ?>
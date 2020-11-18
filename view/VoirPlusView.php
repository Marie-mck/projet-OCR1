<?php $title = 'Blog'; ?>

<?php ob_start(); ?>
<p>Derniers articles du blog :</p>

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
<?php } ?>

<section id="commentList">
    <h3>Liste des Commentaires</h3>
    <p>Nombre de commentaires créés : <?php echo $comments->count() ?></p>
    
    <h4><strong>par <?php echo htmlspecialchars($comments->authorComment()); ?></strong> - publier le <?php echo $newsComment->dateComment(); ?></h4>
    <p><?php echo nl2br(htmlspecialchars($comments->commentaire())); ?></p>
    <?php
    //}
    ?>
    </section>

    <?php foreach ($comments as $comment) { ?>
    <p><strong><?php echo htmlspecialchars($comment>authorComment()) ?></strong> le <?= $comment['dateComment'] ?></p>
    <p><?php echo nl2br(htmlspecialchars($comment->commentaire())) ?></p>
    <em><a href="index.php?action=addComment&amp;id=<?= $post['id'] ?>">Ajouter un commentaire</a></em>
    <?php } ?>
    <div class="commentDoc">
    <p><a href="AddCommentView.php?id=<?php echo $post->id()?>">Commentaires</a></p>
    </div>

<?php $content = ob_get_clean(); ?>

<?php //require('template.php'); ?>
<?php if(isset($_SESSION['pseudo'])) { //pour page administration A faire  ?>
        <p>Bonjour <?php echo $_SESSION['pseudo']; ?> <p>
<?php } ?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="utf-8" />
        <title>Blog</title>
        <title><?= $titre ?></title>
        <link rel="stylesheet" type="text/css" href="public/fontawesome/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="public/css/projet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <div id="page">
    <body>

        <header>
            <div class="myName">JEAN<br/>FORTEROCHE</div>
            
            <nav class="menu">
                <input class="burger" type="checkbox">
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="#author_pres">A propos</a></li>
                        <li><a href="#lastChaptersTitle">Chapitres</a></li>
                        <li><a class="adminLink" href="index.php?action=afficherPageAdmin<?php //echo $post->id()?>">Administration</a>
                            <ul>
                                <li><a class="adminLink" href="index.php?action=afficherAdminUser<?php //echo $post->id()?>">Administration User</a></li>
                                <li><a class="adminLink" href="index.php?action=afficherAdminChapter<?php //echo $post->id()?>">Administration Chapitre</a></li>
                                <li><a class="adminLink" href="index.php?action=afficherAdminComment<?php //echo $post->id()?>">Administration Comment</a></li>
                                <li><a class="adminLink" href="index.php?action=afficherAdminAddChapter<?php //echo $post->id()?>">Administration ajout Chapter</a></li>
                            </ul>
                        </li>
                        <button type="submit" id="connexion_Btn" value="connexion"><a href="index.php?action=connexionPage">Connexion</a></button>
                    </ul>
            </nav>
        </header>

        <div id="contenu">
            <?= $contenu ?>
        </div>
        
        <footer id="footer">
            <div class="footerContainer">
                
                <div>Liens</div>
                <div>Contact</div>
                <div>Pages
                    <div class="pagesLinkFooter">
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="#author_pres">A propos</a></li>
                        <li><a href="#lastChaptersTitle">Chapitres</a></li>
                        <li><a class="adminLink" href="index.php?action=afficherPageAdmin<?php //echo $post->id()?>">Administration</a>
                            <ul>
                                <li><a class="adminLink" href="index.php?action=afficherAdminUser<?php //echo $post->id()?>">Administration User</a></li>
                                <li><a class="adminLink" href="index.php?action=afficherAdminChapter<?php //echo $post->id()?>">Administration Chapitre</a></li>
                                <li><a class="adminLink" href="index.php?action=afficherAdminComment<?php //echo $post->id()?>">Administration Comment</a></li>
                                <li><a class="adminLink" href="index.php?action=afficherAdminAddChapter<?php //echo $post->id()?>">Administration ajout Chapter</a></li>
                                
                            </ul>
                        </li>
                        <li><a href="index.php?action=connexionPage">Connexion</a></li>
                    </ul>
                    </div>
                </div>
            </div>

            <div class="footerCopy"> Copyright © All rights reserved </div>
        </footer>

    </body>
    </div>
</html>
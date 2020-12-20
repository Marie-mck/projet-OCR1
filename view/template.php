
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
                        <li><a href="index.php?action=afficherMonProfil">A propos</a></li>
                        <li><a href="index.php?action=afficherPageAllPosts">Chapitres</a></li>

                        
                        <?php if(isset($_SESSION['pseudo'])) { //pour page administration A faire  ?>
                        <li class="adminAccess">Administration
                            <ul>
                                <li><a class="adminLink" href="index.php?action=afficherAdminUser<?php //echo $post->id()?>">User</a></li>
                                <li><a class="adminLink" href="index.php?action=afficherAdminChapter<?php //echo $post->id()?>">Chapitre</a></li>
                                <li><a class="adminLink" href="index.php?action=afficherAdminComment<?php //echo $post->id()?>">Commentaire</a></li>
                                <li><a class="adminLink" href="index.php?action=afficherAdminChapter&addChapter<?php //echo $post->id()?>">Ajouter un chapitre</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        
                        <?php
                            if (isset($_SESSION['pseudo'])) { ?>
                            <button type="submit" class="welcome">Bonjour <?php echo $_SESSION['pseudo']; ?></button>
                            <button type="submit" name="deconnexion" id="deconnexion_Btn" value="deconnexion"><a class="deconnexionBtn" href="index.php?action=logOut">Deconnexion</a></button>
                            
                            <?php } else { ?>
                            <button type="submit" id="connexion_Btn" value="connexion"><a class="connexionBtn" href="index.php?action=connexionPage">Connexion</a></button>
                            <button type="submit" name="deconnexion" id="deconnexion_Btn" value="deconnexion"><a class="deconnexionBtn" href="index.php?action=logOut">Deconnexion</a></button>
                            <?php }  ?>

                        <!--- <button type="submit" id="connexion_Btn" value="connexion">
                            <a class="connexionBtn" href="index.php?action=connexionPage">Connexion</a></button>
                        <button type="submit" name="deconnexion" id="deconnexion_Btn" value="deconnexion">
                            <a class="deconnexionBtn" href="index.php?action=logOut">Deconnexion</a></button>--->
                    </ul>
            </nav>
        </header>

        <!--- <div class="connexionVisiteur">
            <?php //if(isset($_SESSION['pseudo'])) { //pour page administration A faire  ?>
            <p>Bonjour <?php //echo $_SESSION['pseudo']; ?> <p>
            <?php //} ?>
        </div>--->
        
        <div id="contenu">
            <?= $contenu ?>
        </div>
        
        <footer id="footer">
            <div class="footerContainer">
                
                <div>Liens</div>
                <div>Contact</div>
                <div>Pages
                    
                </div>
            </div>

            <div class="footerCopy"> Copyright © All rights reserved </div>
        </footer>

    </body>
    </div>
</html>
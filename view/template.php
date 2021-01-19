<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="utf-8" />
        <title><?= $titre ?></title>
        <link rel="stylesheet" type="text/css" href="public/fontawesome/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="public/css/projet.css?v=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <div id="page">
        <header>
            <div class="myName">JEAN<br/>FORTEROCHE</div>
            
            <div class="menu">
            
                <input class="burger" type="checkbox">

                <nav class="headNav">
                    <div>
                        <ul>
                            <li><a href="index.php">Accueil</a></li>
                            <li><a href="index.php?action=afficherPageAllPosts">Billets</a></li>
                            
                            <div class="dropMenu1">

                            <div>
                            <?php if(isset($_SESSION['pseudo'])) { ?>
                            <li class="subMenuNav"><a class="adminLink">Administration</a>
                            </li>
                            </div>

                            <div class="dropMenu1">
                                <li>
                                <ul class="dropMenu">
                                    <li><a class="adminLink" href="index.php?action=afficherAdminUser">User</a></li>
                                    <li><a class="adminLink" href="index.php?action=afficherAdminChapter">Billets</a></li>
                                    <li><a class="adminLink" href="index.php?action=afficherAdminComment">Commentaire</a></li>
                                    <li><a class="adminLink" href="index.php?action=afficherAdminChapter&addChapter">Ajouter un billet</a></li>
                                </ul>
                                </li>
                            </div>
                            
                            <?php } ?>
                            </div>

                            <div class="navBtn">
                            <?php
                                if (isset($_SESSION['pseudo'])) { ?>
                                <button type="submit" class="welcome_Btn">Bonjour <?php echo $_SESSION['pseudo']; ?></button></br>
                                <button type="submit" name="deconnexion" id="deconnexion_Btn" value="deconnexion"><a class="deconnexionBtn" href="index.php?action=logOut"><i class="fas fa-power-off"></i> </a></button>
                                
                                <?php } else { ?>
                                <button type="submit" id="connexion_Btn" value="connexion"><a class="connexionBtn" href="index.php?action=connexionPage">Connexion</a></button></br>
                                <button type="submit" name="deconnexion" id="deconnexion_Btn" value="deconnexion"><a class="deconnexionBtn" href="index.php?action=logOut"><i class="fas fa-power-off"></i> </a></button>
                            <?php } ?>
                            </div>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        
        <div id="contenu">
            <?= $contenu ?>
        </div>
        

        <footer id="footer">
            <div class="footerContainer">
                <div>Liens
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="index.php?action=afficherPageAllPosts">Billets</a></li>
                        <li><a href="index.php?action=afficherPageAllPosts">Administration</a></li>
                    </ul>
                </div>
                <div>Contact : gandalf@gmail.com</div>
            </div>

            <div class="footerCopy"> Copyright © All rights reserved </div>
        </footer>
        </div>

        <?php
        if (isset($jsFiles) && !empty($jsFiles)) {
            foreach($jsFiles as $jsFile ) {
                echo '<script src="' . $jsFile . '"></script>';
            }
        }
        ?>
        <script src="public/js/dropdownMenu.js?v=1.0" ></script>
    </body>
</html>
<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="utf-8" />
        <title>Blog</title>
        <title><?= $title ?></title>
        <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="public/css/projet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
        
    <body>

        <header>
            <div class="logo" id="logo">
                <div class="myName">JEAN<br/>FORTEROCHE</div>
                <img src="images/logo.png" alt="logo"/>
            </div>	
            
                <nav class="menu">
                    <input class="burger" type="checkbox">    	   			 
                    <ul>
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#author_pres">A propos</a></li>
                        <li><a href="#chapter">Chapitres</a></li>
                        <button type="submit" id="connexion_Btn" value="connexion">Connexion</button>
                        <button type="submit" id="deconnexion_Btn" value="connexion">Deconnexion</button>
                    </ul>
                </nav>
        </header>

        <div id="introduction">
            <a href="index.php"><h1 id="titre">Blog</h1></a>
            <p>...</p>
        </div>

        <div id="contenu">
            <?= $content ?>
        </div>
        
        <footer id="foot">
            Blog ??
        </footer>

    </body>
</html>
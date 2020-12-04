<?php
//session_start();
//$_SESSION['connecte'] = 1;
//require 'login.php';
//unset($_SESSION['connecte']);
?>

<!--- page de connexion pour les admin BACKEND --->

    <section id="connexion">

        <h2 class="connectionTitle">Page de connexion</h2>

        <form method="post" action="" class="container_2">
            <table class="tableConnexion">
            <tr>
                <td><label for="pseudo" id="pseudo">Identifiant</label></td>
                <td><input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required/></td>
            </tr>
            <tr>
                <td><label for="motDePasse" id="motDePasse">Mot de passe</label></td>
                <td><input type="motDePasse" name="motDePasse" id="motDePasse" placeholder="Mot de passe" required/></td>
            </tr>
            <tr>
                <td colspan ="2">
                <input type="hidden" name="id" value="<?//= $post->id() ?>" />
                <button type="submit" name="connexion" id="connexionBtn" value="connexion">CONNEXION</button></td>
            </tr>
            </table>
        </form>
        
        <div class="connectionPageBtn">
            <button type="submit" name="deconnexion" id="deconnexion" value="deconnexion"><a class="deconnexionBtn"href="index.php?action=logOut">Deconnexion</a></button>
        </div>

    </section>

        <?php
        if (isset($erreur)) {
            echo $erreur;
        }
        ?>
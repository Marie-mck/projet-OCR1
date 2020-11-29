<?php
//session_start();
//$_SESSION['connecte'] = 1;
//require 'login.php';
//unset($_SESSION['connecte']);
?>

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
            <button type="submit" name="inscription" id="inscription" value="inscription"><a class="inscriptionBtn" href="index.php?action=registration">Inscription</a></button>
            <button type="submit" name="deconnexion" id="deconnexion" value="deconnexion"><a class="deconnexionBtn"href="index.php?action=logOut">Deconnexion</a></button>
        </div>

    </section>

        <?php
        if (isset($erreur)) {
            echo $erreur;
        }
        ?>

<h3 class="sup">Liste des Users -> A SUPPRIMER</h3>
        <table class="tableUsers">
            <tr><th>pseudo</th><th>email</th><th>password</th><th>Date d'ajout</th><th>Modifier</th><th>Supprimer</th></tr>
            <?php
                foreach ($users as $user) {
                    echo '<tr><td>' . $user->pseudo(). '</td>
                    <td>'. $user->email(). '</td>
                    <td>'. $user->motDePasse(). '</td>
                    <td>'. $user->dateRecord(). '</td>
                    <td><a href="?modifier='. $user->id(). '">Modifier</a></td>
                    <td><a href="?supprimer='. $user->id(). '">Supprimer</a></td></tr>';
                }
            ?>
    </table><br/>

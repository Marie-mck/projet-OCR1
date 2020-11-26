<?php
//session_start();
//$_SESSION['connecte'] = 1;
//require 'login.php';
//unset($_SESSION['connecte']);
?>

<section>
    <div id="connexion">
    <h3><?//= htmlspecialchars($_SESSION['pseudo']) ?><a href="index.php?action=logOut">Deconnexion</a></h3>
    
        <h2>Page de connexion</h2>
        
        <h3>Liste des Users</h3>
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

    <h3>Connexion</h3>
        <form method="post" action="" class="container_2">
            <table>
            <tr>
                <td><label for="pseudo" class="pseudo">Identifiant</label></td>
                <td><input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required/></td>
            </tr>
            <tr>
                <td><label for="motDePasse" class="motDePasse">Mot de passe</label></td>
                <td><input type="motDePasse" name="motDePasse" id="motDePasse" placeholder="Mot de passe" required/></td>
            </tr>
                <input type="hidden" name="id" value="<?//= $post->id() ?>" />
                <button type="submit" name="connexion" id="connexion" value="connexion"><a href="index.php?action=connexion">CONNEXION</button>
            </table>
        </form>
        
    </div>

    <?php
    if (isset($erreur)) {
        echo $erreur;
    }
    ?>

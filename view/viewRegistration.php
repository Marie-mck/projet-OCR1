
    <div id="registration">
    <h3>Bienvenue <?//= htmlspecialchars($_SESSION['pseudo']) ?></h3>
    
    <h2 class="inscriptionTitle">Page d'inscription</h2>

    <form action="" method="post">

    <table class="tableInscription">
            <tr>
                <td><label for="pseudo" id="pseudo">Identifiant</label></td>
                <td><input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required/></td>
            </tr>
            <tr>
                <td><label for="email" id="email">Email</label></td>
                <td><input type="email" name="email" id="email" placeholder="Email" required/></td>
            </tr>
            <tr>
                <td><label for="motDePasse" id="motDePasse">Mot de passe</label></td>
                <td><input type="motDePasse" name="motDePasse" id="motDePasse" placeholder="Mot de passe" required/></td>
            </tr>
            <tr>
                <td colspan ="2">
                <input type="hidden" name="id" value="<?//= $post->id() ?>" />
                <button type="submit" name="inscription" id="inscriptionBtn" value="inscription">INSCRIPTION</button></td>
            </tr>
            </table>
    </form>
    <?php
    if (isset($erreur)) {
        echo $erreur;
    }
    ?>


<h3>Liste des Users -> A SUPPRIMER</h3>
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
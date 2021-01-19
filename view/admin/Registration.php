
<div id="registration">

<section id="inscription">

    <h2 class="inscriptionTitle">Inscrivez-vous</h2>

    <form action="" method="post">

    <table class="tableInscription">
            <thead></thead>

            <tbody>
            <tr>
                <td><label for="pseudo" id="identifiantLabel">Identifiant</label></td>
                <td><input type="text" name="pseudo" id="identifiant"  required/></td>
            </tr>
            <tr>
                <td><label for="email" id="emailLabel">Email</label></td>
                <td><input type="email" name="email" id="email"  required/></td>
            </tr>
            <tr>
                <td><label for="motDePasse" id="motDePasseLabel">Mot de passe</label></td>
                <td><input type="motDePasse" name="motDePasse" id="motDePasse"  required/></td>
            </tr>
            <tr>
                <td><label for="isAdmin" id="isAdminLabel">Profil</label></td>
                <td><input type="isAdmin" name="isAdmin" id="isAdmin" placeholder="Profil" required/></td>
            </tr>
            <tr>
                <td colspan ="2">
                <input type="hidden" name="id" />
                <button type="submit" name="inscription" id="inscriptionBtn" value="inscription">INSCRIPTION</button></td>
            </tr>
            </tbody>
            </table>
    </form>

</section>

    <?php
    if (isset($erreur)) {
        echo $erreur;
    }
    ?>

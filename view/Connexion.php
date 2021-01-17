<!--- page de connexion pour les visiteurs FRONTEND --->

<section id="connexion">

    <h3 class="connectionTitle">Connectez-vous</h3>

    <form method="post" action="" class="container_2">
        <table class="tableConnexion">
            <tr>
                <td><input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required/></td>
            </tr>
            <tr>
                <td><input type="password" name="motDePasse" id="motDePasse" placeholder="Mot de passe" required/></td>
            </tr>
            <tr>
                <td><input type="text" name="error" id="errorConnexion" value="<?php if(isset($erreur)) { echo $erreur;	} ?>" /></td>
            </tr>
            <tr class="connectionPageBtn">
                <td>
                <button type="submit" name="connexion" id="connexionBtn" value="connexion">CONNEXION</button>
                <button type="submit" name="inscription" id="inscription_Btn" value="inscription"><a class="inscription_Btn" href="index.php?action=registration">CREER UN COMPTE</a></button>
                </td>
            </tr>
        </table>
    </form>

</section>

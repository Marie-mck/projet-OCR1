
<section id="adminPageUser">

    <h3 class="pageAdminTitle">Liste des Users</h3>

    <table class="tableUsers">
        <thead>
            <tr>
                <th>pseudo</th><th>email</th><th>password</th><th>Date d'ajout</th><th>Profil</th><th>Modifier</th><th>Supprimer</th>
            </tr>
        </thead>

        <tbody>
            <?php
                foreach ($users as $user) {
                    echo '<tr><td>' . $user->pseudo(). '</td>
                    <td>'. $user->email(). '</td>
                    <td>'. $user->motDePasse(). '</td>
                    <td>'. $user->dateRecord(). '</td>
                    <td>'. $user->isAdmin(). '</td>
                    <td><a href="?action=afficherAdminUser&modifierUserBtn&id=' .$user->id(). '">Modifier</a></td>
                    <td><a href="?action=afficherAdminUser&supprimerUser&id='. $user->id(). '">Supprimer</a></td></tr>';
                }
            ?>
        </tbody>
    </table><br/>
</section>
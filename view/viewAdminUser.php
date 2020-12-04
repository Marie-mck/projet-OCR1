

        <h3 class="pageAdminTitle">Liste des Users</h3>
            <table class="tableUsers">
                <tr><th>pseudo</th><th>email</th><th>password</th><th>Date d'ajout</th><th>Profil</th><th>Modifier</th><th>Supprimer</th></tr>
                <?php
                    foreach ($users as $user) {
                        echo '<tr><td>' . $user->pseudo(). '</td>
                        <td>'. $user->email(). '</td>
                        <td>'. $user->motDePasse(). '</td>
                        <td>'. $user->dateRecord(). '</td>
                        <td>'. $user->isAdmin(). '</td>
                        <td><a href="?modifier='. $user->id(). '">Modifier</a></td>
                        <td><a href="?action=afficherPageAdmin&supprimerUser&id='. $user->id(). '">Supprimer</a></td></tr>';
                    }
                ?>
            </table><br/>
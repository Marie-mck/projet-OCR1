
<h3 class="updateUserTitle">Modification d'un utilisateur</h3>

<?php while ($getUser = $getUsers->fetch()) { ?>

<form action="index.php?action=afficherAdminUser&modifierUser&id=<?php echo $getUser['id']?>" method="post" class="updateUser">
        <table class="modifUserForm">
                <thead>

                </thead>
                <tbody>
                <tr>   
                        <td><text class="formUser" name="pseudo" placeholder="pseudo">par <?php echo $getUser['pseudo'] ?></textarea><br/></td>
                </tr>
                <tr>   
                        <td><text class="formUser" name="email" placeholder="email">par <?php echo $getUser['email'] ?></textarea><br/></td>
                </tr>
                <tr>   
                        <td><text class="formUser" name="motDePasse" placeholder="motDePasse">par <?php echo $getUser['motDePasse'] ?></textarea><br/></td>
                </tr>
                <tr>   
                        <td><text class="formUser" name="isAdmin" placeholder="isAdmin">par <?php echo $getUser['isAdmin'] ?></textarea><br/></td>
                </tr>
                <tr>   
                        <td colspan ="2"><input class="formUserBtn" type="submit" value="Modifier" name="modifierUser"/></td>
                </tr>
                </tbody>
        </table>
</form>

<?php } ?>

<p class="backUserLink"><a href="index.php?action=afficherAdminUser">← Liste des users</a></p>

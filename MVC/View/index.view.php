    <h1>Utilisateurs</h1>
    <table border="1" cellpadding="12" margin="auto" >
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Adresse</th>
            </tr>
            <?php
            foreach ($users as $user) :
            ?>
            <tr>
                <td><?= $user->getId(); ?></td>
                <td><?= $user->getLastname(); ?></td>
                <td><?= $user->getFirstname(); ?></td>
                <td><?= $user->getEmail(); ?></td>
                <td><?= $user->getAddress(); ?></td>
            </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>


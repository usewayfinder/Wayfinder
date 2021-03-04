<section>

    <p><a href="/documentation/models">⟵ Back to models documentation</a></p>

    <p>The information below has been loaded from <a href="https://randomuser.me">randomuser.me</a> as part of the User model that ships with Wayfinder.</p>

    <p>Click on a user to be taken to that page.</p>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
    <?php

    $i = 1;
    foreach($users as $user) {
        //var_dump($user);
        echo '<tr>
            <td><a href="/documentation/models/demo-user/'.$i.'">'.$user['name']['first'].' '.$user['name']['last'].'</a></td>
            <td>'.$user['location']['country'].'</td>
        </tr>';
        $i++;
    }
    ?>
        </tbody>
    </table>

</section>

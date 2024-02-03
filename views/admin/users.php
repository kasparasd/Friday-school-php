<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Lastname</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">User status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <th scope="row"><?= $user->id ?></th>
                <th><?= $user->name ?></th>
                <th><?= $user->lastname ?></th>
                <th><?= $user->email ?></th>
                <th><?= $user->role ?></th>
                <th><?= $user->deleted == 0 ? 'Active' : 'Deleted' ?></th>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
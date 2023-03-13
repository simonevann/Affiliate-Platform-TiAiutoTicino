<?php
    require_once('controllers/UsersController.php');
    //Get all users
    $controller = new UsersController();
    $users = $controller->index();
?>
<div class="container-fluid">
    <div class="row p-3">
        <div class="col">
            <h1>Users</h1>
        </div>
    </div>
    <div class="row p-3">
        <table id="usersTable" class="table table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Role</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody class="table-striped">
                <?php foreach($users as $user) { ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['first_name']; ?></td>
                        <td><?php echo $user['last_name']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td class="text-end">
                            <a class="btn btn-primary btn-sm" href="/admin/links/<?php echo $user['id']; ?>">Links</a>
                            <a class="btn btn-primary btn-sm" href="/admin/logs/<?php echo $user['id']; ?>">Logs</a>
                            <a class="btn btn-primary btn-sm" href="/admin/users/edit/<?php echo $user['id']; ?>">Edit</a>
                            <a class="btn btn-danger btn-sm" href="/admin/users/delete/<?php echo $user['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
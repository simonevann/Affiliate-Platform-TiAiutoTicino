<?php
require_once('controllers/LinksController.php');
$controller = new LinksController();
if($this->id){
    $links = $controller->showUsersLink($this->id);
} else {
    $links = $controller->index();
}
?>

<!-- ctrate table -->
<div class="container-fluid">
    <div class="row p-3">
        <div class="col">
            <h1>Links</h1>
        </div>
    </div>
    <div class="row p-3">
        <table id="linksTable" class="table table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Short Link</th>
                    <th>Link</th>
                    <th>Creation</th>
                    <th>User id</th>
                    <th>Value</th>
                    <th>Click</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody class="table-striped">
                <?php foreach($links as $link) { ?>
                    <tr>
                        <td><?php echo $link['id']; ?></td>
                        <td>/<?php echo $link['short_link']; ?></td>
                        <td><?php echo $link['destination']; ?></td>
                        <td><?php echo $link['date_creation']; ?></td>
                        <td><?php echo $link['user_id']; ?></td>
                        <td><?php echo $link['link_value']; ?></td>
                        <td><?php echo $link['clicks']; ?></td>
                        <td class="text-end">
                            <a class="btn btn-primary btn-sm" href="/admin/links/edit/<?php echo $link['id']; ?>">Edit</a>
                            <a class="btn btn-primary btn-sm" href="/admin/users/<?php echo $link['user_id']; ?>">User</a>
                            <a class="btn btn-danger btn-sm" href="/admin/links/delete/<?php echo $link['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
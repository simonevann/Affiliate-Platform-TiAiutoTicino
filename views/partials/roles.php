<?php
require_once('controllers/RolesController.php');
$controller = new RolesController();
if($this->id){
    $links = $controller->show($this->id);
} else {
    $links = $controller->index();
}
?>

<!-- ctrate table -->
<div class="container-fluid">
    <div class="row p-3">
        <div class="col">
            <h1>Roles</h1>
        </div>
    </div>
    <div class="row p-3">
        <div class="col">
        <button id="btnAddLink" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addLink">
            Add a link
        </button>
        </div>
    </div>
    <div class="row p-3">
        <table id="linksTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody class="table-striped">
                <?php foreach($links as $link) { ?>
                    <tr>
                        <td><?php echo $link['id']; ?></td>
                        <td><?php echo $link['title']; ?></td>
                        <td class="text-end">
                            <a class="btn btn-primary btn-sm" href="/admin/links/edit/<?php echo $link['id']; ?>">Edit</a>
                            <a class="btn btn-danger btn-sm" href="/admin/links/delete/<?php echo $link['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="addLink" tabindex="-1" role="dialog" aria-labelledby="addLink" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>
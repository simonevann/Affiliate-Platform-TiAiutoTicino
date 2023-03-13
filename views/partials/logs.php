<?php
//import the controller
require_once('controllers/LogsController.php');
//get all the logs
$controller = new LogsController();
$logs = $controller->index();
?>

<div class="container-fluid">
    <div class="row p-3">
        <div class="col">
            <h1>Logs</h1>
        </div>
    </div>
    <div class="row p-3">
        <table id="logsTable" class="table table-dark">
            <thead>
                <tr>
                    <th>Link ID</th>
                    <th>Click date</th>
                    <th>Short link</th>
                    <th>Destination</th>
                    <th>User</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody class="table-striped">
                <?php foreach($logs as $log) { ?>
                    <tr>
                        <td><?php echo $log['link_id']; ?></td>
                        <td><?php echo $log['click_date']; ?></td>
                        <td><?php echo $log['short_link']; ?></td>
                        <td><?php echo $log['destination']; ?></td>
                        <td><?php echo $log['user_id']; ?></td>
                        <td class="text-end">
                            <a class="btn btn-primary btn-sm" href="/admin/user/<?php echo $log['user_id']; ?>">User</a>
                            <a class="btn btn-primary btn-sm" href="/admin/links/<?php echo $log['link_id']; ?>">Link</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
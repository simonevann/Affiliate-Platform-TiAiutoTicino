<?php
//include the controller
require_once('controllers/DashboardController.php');
//create an instance of the controller
$controller = new DashboardController();
$controller->getClicksPerMounth();
?>
<script>
    var totalClicksPerMonth = <?php echo $controller->getClicksPerMounth(); ?>;
    console.log(totalClicksPerMonth);
</script>
<div class="container-fluid">
    <div class="row p-3">
        <div class="col"  style="height: 300px">
                <canvas id="dashChart"></canvas>
        </div>
    </div>
    <div class="row p-3">
        <div class="col">
            <div class="card">
            <div class="card-header">
                Users
            </div>
            <div class="card-body dashboard-card">
                <h5 class="card-title"><?php echo $controller->getUserNumber(); ?></h5>
                <a href="#" class="btn btn-primary">Users list</a>
            </div>
            </div>
        </div>        
        <div class="col">
            <div class="card">
            <div class="card-header">
                Today's click
            </div>
            <div class="card-body dashboard-card">
                <h5 class="card-title"><?php echo $controller->getClicksToday(); ?></h5>
                <a href="#" class="btn btn-primary">Users list</a>
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <div class="card-header">
                Number of generated links
            </div>
            <div class="card-body dashboard-card">
                <h5 class="card-title"><?php echo $controller->getLinkNumber(); ?></h5>
                <a href="#" class="btn btn-primary">Users list</a>
            </div>
            </div>
        </div>
    </div>
    <div class="row p-3">
    <div class="col">
            <div class="card">
            <div class="card-header">
                Best Users of the week
            </div>
            <div class="card-body dashboard-card">
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <div class="card-header">
                Best Users of the month
            </div>
            <div class="card-body dashboard-card">
            </div>
            </div>
        </div>      
    </div>
</div>
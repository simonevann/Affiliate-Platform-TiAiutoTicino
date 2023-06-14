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
                <a href="#" class="btn btn-primary">Logs list</a>
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
                <a href="#" class="btn btn-primary">Links list</a>
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
            <div class="card-body dashboard-card table-bordered">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User name</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $scoreboard = $controller->getScoreboardWeek();
                    foreach($scoreboard as $user){
                        echo '<tr><td>'.$user['username'].'</td><td>'.$user['points'].'</td></tr>';
                    }
                ?>
                </tbody>
            </table>
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <div class="card-header">
                Best Users of the month
            </div>
            <div class="card-body dashboard-card">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>User name</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $scoreboard = $controller->getScoreboardMonth();
                    foreach($scoreboard as $user){
                        echo '<tr><td>'.$user['username'].'</td><td>'.$user['points'].'</td></tr>';
                    }
                ?>
                </tbody>
            </div>
            </div>
        </div>      
    </div>
</div>
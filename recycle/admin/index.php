<?php 
require_once('./header.php'); 
require_once('../core/general-config.php'); 
$user = $_SESSION['user_id'];
$cans = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(price) FROM collection_requests WHERE (status = 1 && type =2)"))[0];
$bottles = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(price) FROM collection_requests WHERE (status = 1 && type =3)"))[0];
$plastic = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(price) FROM collection_requests WHERE (status = 1 && type =1)"))[0];
$total = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(price) FROM collection_requests WHERE (status = 1)"))[0];
$reg_users = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(id) FROM users"))[0];
$collection = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(id) FROM recycling_centers"))[0];
$requests = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(id) FROM collection_requests"))[0];
?>
<div class="card">
    <div class="card-header">
        <p><b>General Statics</b></p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h4 class="card-title text-center text-white">Price For Cans</h4>
                        <hr class="text-info">
                        <h1 class="card-text text-center text-warning">PHP <?php if(isset($cans)){ echo $cans; }else{ echo '0';} ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h4 class="card-title text-center text-white">Price For Bottles</h4>
                        <hr class="text-info">
                        <h1 class="card-text text-center text-warning">PHP <?php if(isset($bottles)){ echo $bottles; }else{ echo '0';} ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h4 class="card-title text-center text-white">Price For Plastic</h4>
                        <hr class="text-info">
                        <h1 class="card-text text-center text-warning">PHP <?php if(isset($plastic)){ echo $plastic; }else{ echo '0';} ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h4 class="card-title text-center text-white">Total Price</h4>
                        <hr class="text-info">
                        <h1 class="card-text text-center text-warning">PHP <?php if(isset($total)){ echo $total; }else{ echo '0';} ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        <p><b>System Statics</b></p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h4 class="card-title text-center text-white">Total Users</h4>
                        <hr class="text-info">
                        <h1 class="card-text text-center text-warning"><?php if(isset($reg_users)){ echo $reg_users; }else{ echo '0';} ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h4 class="card-title text-center text-white">Total Collection Centers</h4>
                        <hr class="text-info">
                        <h1 class="card-text text-center text-warning"><?php if(isset($collection)){ echo $collection; }else{ echo '0';} ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h4 class="card-title text-center text-white">Total Collection Requests</h4>
                        <hr class="text-info">
                        <h1 class="card-text text-center text-warning"><?php if(isset($requests)){ echo $requests; }else{ echo '0';} ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require('./footer.php'); ?>
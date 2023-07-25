<?php 
require_once('./header.php'); 
require_once('./core/general-config.php'); 
$user = $_SESSION['user_id'];
$cans = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(price) FROM collection_requests WHERE (status = 1 && type =2 && user_id = $user)"))[0];
$bottles = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(price) FROM collection_requests WHERE (status = 1 && type =3 && user_id = $user)"))[0];
$plastic = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(price) FROM collection_requests WHERE (status = 1 && type =1 && user_id = $user)"))[0];
$total = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(price) FROM collection_requests WHERE (status = 1 && user_id = $user)"))[0];
$redeem = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(points) FROM coupons_redeems WHERE user = $user"))[0];
?>
<div class="card">
    <div class="card-header">
        <p><b>General Statistics</b></p>
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
        <p><b>Reward System</b></p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h4 class="card-title text-center text-white">Total Price</h4>
                        <hr class="text-info">
                        <h1 class="card-text text-center text-warning">PHP <?php if(isset($total)){ echo $total; }else{ echo '0';} ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h4 class="card-title text-center text-white">Price For 1 Reward Point</h4>
                        <hr class="text-info">
                        <h1 class="card-text text-center text-warning">PHP <?php echo $reward; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h4 class="card-title text-center text-white">Reward Points</h4>
                        <hr class="text-info">
                        <h1 class="card-text text-center text-warning"><?php echo (($total/$reward) - $redeem); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require('./footer.php'); ?>
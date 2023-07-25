<?php
require_once('./header.php');
require_once('./core/general-config.php');
$user = $_SESSION['user_id'];

$total = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(price) FROM collection_requests WHERE (status = 1 && user_id = $user)"))[0];
$query = mysqli_query($conn, "SELECT * FROM coupons WHERE status = 0");
$redeem = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(points) FROM coupons_redeems WHERE user = $user"))[0];
$current_points = (($total / $reward) - $redeem);
if (isset($_POST['claim'])) {
    $cid = $_POST['cid'];
    $cpoint = $_POST['cpoint'];
    if ($current_points > $cpoint) {
        $sql = mysqli_query($conn, "INSERT INTO coupons_redeems (user,coupon,points) VALUES($user,$cid,$cpoint)");
        if ($sql) {
            $error1 = '<div class="alert alert-success" role="alert">Coupon succesfully redeemed!</div>';
        } else {
            $error1 = '<div class="alert alert-danger" role="alert">Something wrong, Please try again!</div>';
        }
    } else {
        $error1 = '<div class="alert alert-danger" role="alert">No enough reward points!</div>';
    }
}
$queryx = mysqli_query($conn, "SELECT * FROM coupons_redeems WHERE user = $user");
?>
<div class="card mt-4">
    <div class="card-header">
        <p><b>Reward Points</b></p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h4 class="card-title text-center text-white">Total Price</h4>
                        <hr class="text-info">
                        <h1 class="card-text text-center text-warning">PHP <?php if (isset($total)) {
                                                                                echo $total;
                                                                            } else {
                                                                                echo '0';
                                                                            } ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h4 class="card-title text-center text-white">Price For 1 Reword Point</h4>
                        <hr class="text-info">
                        <h1 class="card-text text-center text-warning">PHP <?php echo $reward; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h4 class="card-title text-center text-white">Reword Points</h4>
                        <hr class="text-info">
                        <h1 class="card-text text-center text-warning"><?php echo $current_points; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        <p><b>Coupons</b></p>
    </div>
    <div class="card-body">
        <?php if (isset($error1)) {
            echo $error1;
        } ?>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                <div class="col-md-3">
                    <div class="card text-white bg-warning">
                        <img class="card-img-top" src="holder.js/100px180/" alt="">
                        <div class="card-body">
                            <h4 class="card-title text-center text-white"><?php echo $row['name']; ?> (<?php echo $row['points']; ?> Reward Points)</h4>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                            <form action="" method="post">
                                <input type="hidden" name="cid" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="cpoint" value="<?php echo $row['points']; ?>">
                                <button type="submit" name="claim" class="btn btn-block btn-white text-dark">Claim</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        <p><b>My Redeems</b></p>
    </div>
    <div class="card-body">
        <div class="table-responsive py-4">
            <table class="table table-bordered display" style="width:99%" id="example">
                <thead class="thead-light">

                    <tr>
                        <th>#</th>
                        <th>Coupon Name</th>
                        <th>Redeem Points</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($queryx)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td>
                                <?php
                                $uid = $row['coupon'];
                                $queryz = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM coupons WHERE id = $uid "))['name'];
                                print_r($queryz);
                                ?>
                            </td>
                            <td><?php echo $row['points']; ?></td>
                            <td>
                                <?php
                                $uid = $row['coupon'];
                                $queryz = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM coupons WHERE id = $uid "))['description'];
                                print_r($queryz);
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require('./footer.php'); ?>
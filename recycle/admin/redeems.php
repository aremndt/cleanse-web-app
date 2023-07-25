<?php
require_once('./header.php');
require_once('../core/general-config.php');
$queryx = mysqli_query($conn, "SELECT * FROM coupons_redeems");
?>
<div class="card">
    <div class="card-header">
        <p><b>Redeems</b></p>
    </div>
    <div class="card-body">
        <div class="table-responsive py-4">
            <table class="table table-bordered display" style="width:99%" id="example">
                <thead class="thead-light">

                    <tr>
                        <th>#</th>
                        <th>Coupon Name</th>
                        <th>User ID</th>
                        <th>User Name</th>
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
                            <td><?php echo $row['user']; ?></td>
                            <td>
                                <?php
                                $uid = $row['user'];
                                $queryz = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = $uid "))['f_name'];
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
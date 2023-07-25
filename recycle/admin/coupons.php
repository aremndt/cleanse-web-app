<?php
require_once('./header.php');
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $points = $_POST['points'];
    $description = $_POST['description'];
    $sql = "INSERT INTO coupons (name,points,description) VALUES('$name',$points,'$description')";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $error = '<div class="alert alert-success" role="alert">Data added succesfully!</div>';
    } else {
        $error = '<div class="alert alert-danger" role="alert">Something wrong, Please try again!</div>';
    }
}
if (isset($_POST['EnaSubmit'])) {
    $id = $_POST['to_ena'];
    $sql01 = mysqli_query($conn, "UPDATE coupons SET status =0 WHERE id = $id");
    if ($sql01) {
        $error1 = '<div class="alert alert-success" role="alert">Data Update succesfully!</div>';
    } else {
        $error1 = '<div class="alert alert-danger" role="alert">Something wrong, Please try again!</div>';
    }
}
if (isset($_POST['DisSubmit'])) {
    $id = $_POST['to_dis'];
    $sql01 = mysqli_query($conn, "UPDATE coupons SET status =1 WHERE id = $id");
    if ($sql01) {
        $error1 = '<div class="alert alert-success" role="alert">Data Update succesfully!</div>';
    } else {
        $error1 = '<div class="alert alert-danger" role="alert">Something wrong, Please try again!</div>';
    }
}
$queryx = mysqli_query($conn, "SELECT * FROM coupons");
?>
<div class="card">
    <div class="card-header">
        <p><b>Add Coupon</b></p>
    </div>
    <div class="card-body">
        <?php if (isset($error)) {
            echo $error;
        } ?>
        <form action="" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Name</label>
                    <input type="text" name="name" id="" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Rewards Point</label>
                    <input type="number" name="points" step="0.01" id="" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" id="" cols="30" rows="5"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Add Coupon</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        <p><b>Coupons List</b></p>
    </div>
    <div class="card-body">
    <?php if (isset($error1)) {
            echo $error1;
        } ?>
        <div class="table-responsive py-4">
            <table class="table table-bordered display" style="width:99%" id="example">
                <thead class="thead-light">

                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Reward Points</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($queryx)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['points']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php if ($row['status'] == 0) {
                                    echo '<span class="badge badge-success">Enabled</span>';
                                } elseif ($row['status'] == 1) {
                                    echo '<span class="badge badge-danger">Disabled</span>';
                                } ?></td>
                            <td>
                                <button type="submit" class="btn btn-primary btn-sm table-action-enable" data-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#exampleModal0">Enable</button>
                                <button type="submit" class="btn btn-danger btn-sm table-action-disable" data-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#exampleModal1">Disable</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal Enable-->
<div class="modal fade" id="exampleModal0" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Conformation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Do you really want to enable this coupon?
            </div>
            <div class="modal-footer">
                <form method="POST">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                    <input type="hidden" name="to_ena" id="to_enable" />
                    <button type="submit" name="EnaSubmit" value="delete" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Disable-->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Conformation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Do you really want to disable this coupon?
            </div>
            <div class="modal-footer">
                <form method="POST">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                    <input type="hidden" name="to_dis" id="to_disable" />
                    <button type="submit" name="DisSubmit" value="delete" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require('./footer.php'); ?>
<script>
    $(".table-action-enable").click(function() {
        var tar = $(this).attr("data-id");
        if (tar != "") {
            $("#to_enable").val(tar);
            $("#exampleModal0").modal("show");
        }
    });
    $(".table-action-disable").click(function() {
        var tar = $(this).attr("data-id");
        if (tar != "") {
            $("#to_disable").val(tar);
            $("#exampleModal1").modal("show");
        }
    });
</script>
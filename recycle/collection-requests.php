<?php
require_once('./header.php');
require_once('./core/general-config.php');
$queryx = mysqli_query($conn, "SELECT * FROM recycling_centers WHERE status = 0");
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $pickup_date = $_POST['pickup_date'];
    $userx =$_SESSION['user_id'];
    $weight = $_POST['weight'];
    if ($type == 1) {
        $price = $weight * $plastic_price;
    } elseif ($type == 2) {
        $price = $weight * $can_price;
    } elseif ($type == 3) {
        $price = $weight * $bottle_price;
    } else {
        $price = 0;
    }
    $query = mysqli_query($conn, "INSERT INTO collection_requests (name,type, weight, pickup_date,price,user_id) VALUES ('$name', $type,$weight,'$pickup_date',$price, $userx)");
    if ($query) {
        $error = '<div class="alert alert-success" role="alert">Data added succesfully!</div>';
    } else {
        $error = '<div class="alert alert-danger" role="alert">Something wrong, Please try again!</div>' . mysqli_error($conn);
    }
}
if (isset($_POST['DisSubmit'])) {
    $id = $_POST['to_dis'];
    $sql01 = mysqli_query($conn, "DELETE FROM collection_requests WHERE id = $id");
    if ($sql01) {
        $error1 = '<div class="alert alert-success" role="alert">Request deleted succesfully!</div>';
    } else {
        $error1 = '<div class="alert alert-danger" role="alert">Something wrong, Please try again!</div>';
    }
}
$queryr = mysqli_query($conn, "SELECT * FROM collection_requests");
?>
<div class="card">
    <div class="card-header">
        <p><b>Add Collection Request</b></p>
    </div>
    <div class="card-body">
        <?php if (isset($error)) {
            echo $error;
        } ?>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Collection Center</label>
                        <select name="name" id="" class="form-control">
                            <option value="" selected disabled>Select...</option>
                            <?php while ($row = mysqli_fetch_assoc($queryx)) { ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Garbage Type</label>
                        <select name="type" id="" class="form-control">
                            <option value="" selected disabled>Select...</option>
                            <option value="1">Plastic</option>
                            <option value="2">Cans</option>
                            <option value="3">Bottles</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Pickup Date</label>
                        <input type="date" name="pickup_date" class="form-control" id="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Weight (KG)</label>
                        <input type="number" step="0.01" name="weight" class="form-control" id="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Add Collection Request</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <p><b>Collection Requests</b></p>
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
                        <th>Collection Center</th>
                        <th>Garbage Type</th>
                        <th>Weight (KG)</th>
                        <th>Pickup Date</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($queryr)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td>
                                <?php
                                $rec_id = $row['name'];
                                $queryt = mysqli_query($conn, "SELECT * FROM recycling_centers");
                               echo mysqli_fetch_assoc($queryt)['name'];
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($row['type'] == 1) {
                                    echo '<span class="badge badge-primary">Plastic</span>';
                                } elseif ($row['type'] == 2) {
                                    echo '<span class="badge badge-primary">Cans</span>';
                                } elseif ($row['type'] == 3) {
                                    echo '<span class="badge badge-primary">Bottles</span>';
                                }
                                ?>
                            </td>
                            <td><?php echo $row['weight']; ?></td>
                            <td><?php echo $row['pickup_date']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td>
                                <?php
                                if ($row['status'] == 0) {
                                    echo '<span class="badge badge-warning">Pending</span>';
                                } elseif ($row['status'] == 1) {
                                    echo '<span class="badge badge-success">Approved</span>';
                                } elseif ($row['status'] == 2) {
                                    echo '<span class="badge badge-danger">Rejected</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-danger btn-sm table-action-disable" <?php if($row['status'] == 1){echo 'disabled';} ?> data-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#exampleModal1">Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
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
                Do you really want to delete this request?
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
    $(".table-action-disable").click(function() {
        var tar = $(this).attr("data-id");
        if (tar != "") {
            $("#to_disable").val(tar);
            $("#exampleModal1").modal("show");
        }
    });
</script>
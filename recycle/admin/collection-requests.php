<?php
require_once('./header.php');
if (isset($_POST['EnaSubmit'])) {
    $id = $_POST['to_ena'];
    $sql01 = mysqli_query($conn, "UPDATE collection_requests SET status =1 WHERE id = $id");
    if ($sql01) {
        $error1 = '<div class="alert alert-success" role="alert">Data Update succesfully!</div>';
    } else {
        $error1 = '<div class="alert alert-danger" role="alert">Something wrong, Please try again!</div>';
    }
}
if (isset($_POST['DisSubmit'])) {
    $id = $_POST['to_dis'];
    $sql01 = mysqli_query($conn, "UPDATE collection_requests SET status =2 WHERE id = $id");
    if ($sql01) {
        $error1 = '<div class="alert alert-success" role="alert">Data Update succesfully!</div>';
    } else {
        $error1 = '<div class="alert alert-danger" role="alert">Something wrong, Please try again!</div>';
    }
}
$queryr = mysqli_query($conn, "SELECT * FROM collection_requests");
?>
<div class="card">
    <div class="card-header">
        <p><b>Collection Requests</b></p>
    </div>
    <div class="card-body">
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
                                <button type="submit" class="btn btn-success btn-sm table-action-enable <?php if (!($row['status'] == 0)){echo 'd-none';} ?>" data-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#exampleModal0">Approve</button>
                                <button type="submit" class="btn btn-danger btn-sm table-action-disable <?php if (!($row['status'] == 0)){echo 'd-none';} ?>" data-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#exampleModal1">Reject</button>
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
                Do you really want to approve this center?
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
                Do you really want to reject this center?
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
<?php 
require_once('./header.php'); 
$queryx = mysqli_query($conn,"SELECT * FROM recycling_centers WHERE status = 0"); 
?>

<div class="card mt-4">
    <div class="card-header">
        <p><b>Recycling Centers List</b></p>
    </div>
    <div class="card-body">
        <div class="table-responsive py-4">
            <table class="table table-bordered display" style="width:99%" id="example">
                <thead class="thead-light">

                    <tr>
                        <th>#</th>
                        <th>Junk Shop Name</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($queryx)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['contact']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><a target="_blank" href="<?php echo $row['location']; ?>"><?php echo $row['location']; ?></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require('./footer.php'); ?>
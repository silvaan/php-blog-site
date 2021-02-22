<?php include "inc/header.php"; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>User List</h2>
        <?php
        if (isset($_GET['deluser'])) {
            $deluser = $_GET['deluser'];
            $delQuery = "DELETE FROM tbl_user WHERE id='$deluser'";
            $delete_row = $db->update($delQuery);
            if ($delete_row) {
                echo "<span class='success'>User Deleted Successfully.</span>";
            } else {
                echo "<span class='error'>User Not Deleted. !!</span>";
            }
        }
        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Sl. No</th>
                        <th>Name</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Details</th>
                        <th width="12%">Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM tbl_user ORDER BY id DESC";
                    $user  = $db->select($query);
                    if ($user) {
                        $i = 1;
                        while ($result = $user->fetch_assoc()) {
                            $i++
                    ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['name']; ?></td>
                                <td><?php echo $result['username']; ?></td>
                                <td><?php echo $result['email']; ?></td>
                                <td><?php echo $result['details']; ?></td>
                                <td>
                                    <?php
                                    if ($result['role'] == '0') {
                                        echo "Admin";
                                    } elseif ($result['role'] == '1') {
                                        echo "Editor";
                                    } elseif ($result['role'] == '2') {
                                        echo "Author";
                                    } else {
                                        echo "Normal User";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="viewuser.php?viewuserid=<?php echo $result["id"]; ?>">View</a>
                                    <?php if (Session::get('role') == '0') { ?>|| <a onclick="return confirm('Are you want to Delete?');" href="?deluser=<?php echo $result['id']; ?>">Delete</a>
                                <?php } ?>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include "inc/footer.php"; ?>
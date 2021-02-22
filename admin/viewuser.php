<?php include "inc/header.php"; ?>

<?php
$viewuserid = mysqli_real_escape_string($db->link, $_GET['viewuserid']);
if (!isset($viewuserid) || $viewuserid == NULL) {
    echo "<script>window.location = 'userlist.php'</script>";
} else {
    $id = $viewuserid;
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>User Detaiis</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<script>window.location = 'userlist.php'</script>";
        }
        ?>
        <div class="block">
            <?php
            $query = "SELECT * FROM tbl_user WHERE id='$id'";
            $user  = $db->select($query);
            if ($user) {
                while ($result = $user->fetch_assoc()) {
            ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['name']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>User Name</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['username']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['email']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Details</label>
                                </td>
                                <td>
                                    <textarea readonly>
                                        <?php echo $result['details']; ?>
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Ok" />
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php }
            } ?>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>
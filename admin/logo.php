<?php include "inc/header.php"; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Logo of title</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $logo = mysqli_real_escape_string($db->link, $_POST['logo']);

            if (empty($logo)) {
                echo "<span class='error'>Field Must Not Be Empty. !!</span>";
            } else {
                $sql = "UPDATE tbl_logo
                        SET
                        logo = '$logo'
                        WHERE id='1'";
                $update_row = $db->update($sql);
                if ($update_row) {
                    echo "<span class='success'>Logo Updated Successfully.</span>";
                } else {
                    echo "<span class='error'>Logo Not Updated. !!</span>";
                }
            }
        }
        ?>
        <div class="block copyblock">
            <?php
            $query = "SELECT * FROM tbl_logo WHERE id='1'";
            $logo  = $db->select($query);
            if ($logo) {
                while ($result = $logo->fetch_assoc()) {
            ?>
                    <form action="logo.php" method="post">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['logo']; ?>" name="logo" class="large" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
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
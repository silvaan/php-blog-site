<?php include "inc/header.php"; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fb = mysqli_real_escape_string($db->link, $_POST['fb']);
            $twitter = mysqli_real_escape_string($db->link, $_POST['tw']);
            $linkedin = mysqli_real_escape_string($db->link, $_POST['le']);
            $drible = mysqli_real_escape_string($db->link, $_POST['dbl']);

            if (empty($fb) || empty($twitter) || empty($linkedin) || empty($drible)) {
                echo "<span class='error'>Field Must Not Be Empty. !!</span>";
            } else {
                $sql = "UPDATE tbl_social
                        SET
                        fb  = '$fb',
                        tw  = '$twitter',
                        le  = '$linkedin',
                        dbl = '$drible'
                        WHERE id='1'";
                $update_row = $db->update($sql);
                if ($update_row) {
                    echo "<span class='success'>Page Updated Successfully.</span>";
                } else {
                    echo "<span class='error'>Page Not Updated. !!</span>";
                }
            }
        }
        ?>
        <div class="block">
            <?php
            $query = "SELECT * FROM tbl_social WHERE id='1'";
            $social  = $db->select($query);
            if ($social) {
                while ($result = $social->fetch_assoc()) {
            ?>
                    <form action="" method="post">
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Facebook</label>
                                </td>
                                <td>
                                    <input type="text" name="fb" value="<?php echo $result['fb']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Twitter</label>
                                </td>
                                <td>
                                    <input type="text" name="tw" value="<?php echo $result['tw']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>LinkedIn</label>
                                </td>
                                <td>
                                    <input type="text" name="le" value="<?php echo $result['le']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Drible</label>
                                </td>
                                <td>
                                    <input type="text" name="dbl" value="<?php echo $result['dbl']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td></td>
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
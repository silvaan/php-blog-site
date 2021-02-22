<?php include "inc/header.php"; ?>

<?php
$userId   = Session::get('userId');
$userRole = Session::get('role');
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>User Detaiis</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name      = mysqli_real_escape_string($db->link, $_POST['name']);
            $username      = mysqli_real_escape_string($db->link, $_POST['username']);
            $email      = mysqli_real_escape_string($db->link, $_POST['email']);
            $details      = mysqli_real_escape_string($db->link, $_POST['details']);

            if (empty($name) || empty($username) || empty($email) || empty($details)) {
                echo "<span class='error'>Field Must Not Be Empty. !!</span>";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<span class='error'>Invalid Email Address. !!</span>";
            } else {
                $sql = "UPDATE tbl_user
                            SET
                            name     = '$name',
                            username = '$username',
                            email    = '$email',
                            details  = '$details'
                            WHERE id='$userId'";
                $update_row = $db->update($sql);
                if ($update_row) {
                    echo "<span class='success'>User Profile Updated Successfully.</span>";
                } else {
                    echo "<span class='error'>User Profile Not Updated. !!</span>";
                }
            }
        }
        ?>
        <div class="block">
            <?php
            $query = "SELECT * FROM tbl_user WHERE id='$userId' AND role='$userRole'";
            $user  = $db->select($query);
            if ($user) {
                while ($result = $user->fetch_assoc()) {
            ?>
                    <form action="" method="post">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>User Name</label>
                                </td>
                                <td>
                                    <input type="text" name="username" value="<?php echo $result['username']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="email" name="email" value="<?php echo $result['email']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Details</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="details">
                                        <?php echo $result['details']; ?>
                                    </textarea>
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
<!-- jQuery dialog related-->
<script src="js/jquery-ui/external/jquery.bgiframe-2.1.2.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.draggable.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.position.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.resizable.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.dialog.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.effects.blind.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.effects.explode.min.js" type="text/javascript"></script>
<!-- jQuery dialog end here-->
<script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
<!--Fancy Button-->
<script src="js/fancy-button/fancy-button.js" type="text/javascript"></script>
<script src="js/setup.js" type="text/javascript"></script>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();
        setSidebarHeight();
    });
</script>
<?php include "inc/footer.php"; ?>
<?php include "inc/header.php"; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Slide Title and Description</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = mysqli_real_escape_string($db->link, $_POST['title']);
            $descr = mysqli_real_escape_string($db->link, $_POST['descr']);

            if (empty($title) || empty($descr)) {
                echo "<span class='error'>Field Must Not Be Empty. !!</span>";
            } else {
                $sql = "UPDATE tbl_slide_section
                        SET
                        title = '$title',
                        descr = '$descr'
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
        <div class="block sloginblock">
            <?php
            $query = "SELECT * FROM tbl_slide_section WHERE id='1'";
            $slide  = $db->select($query);
            if ($slide) {
                while ($result = $slide->fetch_assoc()) {
            ?>
                    <form action="titledescr.php" method="post">
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Slide Title</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $result['title']; ?>" name="title" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Slide Description</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="descr"><?php echo $result['descr']; ?></textarea>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                </td>
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
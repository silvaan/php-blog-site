<?php include "inc/header.php"; ?>

<?php
$viewpostid = mysqli_real_escape_string($db->link, $_GET['viewpostid']);
if (!isset($viewpostid) || $viewpostid == NULL) {
    echo "<script>window.location = 'postlist.php'</script>";
} else {
    $id = $viewpostid;
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Post Detaiis</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<script>window.location = 'postlist.php'</script>";
        }
        ?>
        <div class="block">
            <?php
            $query = "SELECT tbl_post.*, tbl_pages.name
							FROM tbl_post
							INNER JOIN tbl_pages
							ON tbl_post.cat = tbl_pages.id
                            WHERE tbl_post.id = '$id'
							ORDER BY tbl_post.id DESC";
            $getpost  = $db->select($query);
            if ($getpost) {
                while ($result = $getpost->fetch_assoc()) {
            ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $result['title']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Category</label>
                                </td>
                                <td>
                                    <select id="select">
                                        <option><?php echo $result['name']; ?></option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Image</label>
                                </td>
                                <td>
                                    <img src="<?php echo $result['image']; ?>" height="60" width="100" alt="<?php echo $result['image_alt']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Image alt</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['image_alt']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" readonly>
                                        <?php echo $result['body']; ?>
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Tags</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['tags']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Description</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['description']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Author</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['author']; ?>" class="medium" />
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
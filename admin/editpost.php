<?php include "inc/header.php"; ?>

<?php
$editpostid = mysqli_real_escape_string($db->link, $_GET['editpostid']);
if (!isset($editpostid) || $editpostid == NULL) {
    echo "<script>window.location = 'postlist.php'</script>";
} else {
    $id = $editpostid;
}
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Post</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title      = mysqli_real_escape_string($db->link, $_POST['title']);
            $cat        = mysqli_real_escape_string($db->link, $_POST['cat']);
            $image_alt  = mysqli_real_escape_string($db->link, $_POST['image_alt']);
            $body       = mysqli_real_escape_string($db->link, $_POST['body']);
            $tags       = mysqli_real_escape_string($db->link, $_POST['tags']);
            $description = mysqli_real_escape_string($db->link, $_POST['description']);
            $author      = mysqli_real_escape_string($db->link, $_POST['author']);
            $userid      = mysqli_real_escape_string($db->link, $_POST['userid']);

            $permited = array('jpg', 'png', 'gif', 'jpeg');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $image_upload = "upload/" . $unique_image;


            if (empty($title) || empty($cat) || empty($image_alt) || empty($body) || empty($tags) || empty($description) || empty($author) || empty($image_upload)) {
                echo "<span class='error'>Field Must Not Be Empty. !!</span>";
            } else {
                if (!empty($file_name)) {
                    if (in_array($file_ext, $permited) === false) {
                        echo "<span class='error'>You can Upload Only:-" . implode(', ', $permited) . "</span>";
                    } elseif ($file_size > 1048576) {
                        echo "<span class='error'>Image Size Should be Less than 1MB</span>";
                    } else {
                        move_uploaded_file($file_temp, $image_upload);
                        $sql = "UPDATE tbl_post
                            SET
                            cat         = '$cat',
                            title       = '$title',
                            image       = '$image_upload',
                            image_alt   = '$image_alt',
                            body        = '$body',
                            tags        = '$tags',
                            description = '$description',
                            author      = '$author',
                            userid      = '$userid'
                            WHERE id='$id'";
                        $update_row = $db->update($sql);
                        if ($update_row) {
                            echo "<span class='success'>Post Updated Successfully.</span>";
                        } else {
                            echo "<span class='error'>Post Not Updated. !!</span>";
                        }
                    }
                } else {
                    $query = "UPDATE tbl_post
                            SET
                            cat         = '$cat',
                            title       = '$title',
                            image_alt   = '$image_alt',
                            body        = '$body',
                            tags        = '$tags',
                            description = '$description',
                            author      = '$author',
                            userid      = '$userid'
                            WHERE id='$id'";
                    $update_row = $db->update($query);
                    if ($update_row) {
                        echo "<span class='success'>Post Updated Successfully.</span>";
                    } else {
                        echo "<span class='error'>Post Not Updated. !!</span>";
                    }
                }
            }
        }
        ?>
        <div class="block">
            <?php
            $query = "SELECT * FROM tbl_post WHERE id='$id'";
            $post  = $db->select($query);
            if ($post) {
                while ($result = $post->fetch_assoc()) {
            ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input type="text" name="title" value="<?php echo $result['title']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Category</label>
                                </td>
                                <td>
                                    <select id="select" name="cat">
                                        <?php
                                        $query_p = "SELECT * FROM tbl_pages";
                                        $pages  = $db->select($query_p);
                                        if ($pages) {
                                            while ($pageResult = $pages->fetch_assoc()) {
                                        ?>
                                                <option <?php if ($result['cat'] == $pageResult['id']) { ?> selected="selected" <?php } ?> value="<?php echo $pageResult['id']; ?>"><?php echo $pageResult['name']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Upload Image</label>
                                </td>
                                <td>
                                    <input type="file" name="image" />
                                    <img src="<?php echo $result['image']; ?>" height="120" width="200" alt="<?php echo $result['image_alt']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Image alt</label>
                                </td>
                                <td>
                                    <input type="text" name="image_alt" value="<?php echo $result['image_alt']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body"> <?php echo $result['body']; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Tags</label>
                                </td>
                                <td>
                                    <input type="text" name="tags" value="<?php echo $result['tags']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Description</label>
                                </td>
                                <td>
                                    <input type="text" name="description" value="<?php echo $result['description']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Author</label>
                                </td>
                                <td>
                                    <input type="text" name="author" value="<?php echo $result['author']; ?>" class="medium" />
                                    <input type="hidden" name="userid" value="<?php echo Session::get('userId'); ?>" class=" medium" />
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
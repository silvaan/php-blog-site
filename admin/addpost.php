<?php include "inc/header.php"; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>
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
            } elseif (in_array($file_ext, $permited) === false) {
                echo "<span class='error'>You can Upload Only:-" . implode(', ', $permited) . "</span>";
            } elseif ($file_size > 1048576) {
                echo "<span class='error'>Image Size Should be Less than 1MB</span>";
            } else {
                move_uploaded_file($file_temp, $image_upload);
                $sql = "INSERT INTO tbl_post(cat, title, image, image_alt, body, tags, description, author, userid) VALUES('$cat', '$title', '$image_upload', '$image_alt', '$body', '$tags', '$description', '$author', '$userid')";
                $inseted_row = $db->insert($sql);
                if ($inseted_row) {
                    echo "<span class='success'>Post Inserted Successfully.</span>";
                } else {
                    echo "<span class='error'>Post Not Inserted. !!</span>";
                }
            }
        }
        ?>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="cat">
                                <option value="0">Select One</option>
                                <?php
                                $query = "SELECT * FROM tbl_pages";
                                $post  = $db->select($query);
                                if ($post) {
                                    while ($result = $post->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
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
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Image alt</label>
                        </td>
                        <td>
                            <input type="text" name="image_alt" placeholder="Enter Image alt..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" name="tags" placeholder="Enter Post Tags..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Description</label>
                        </td>
                        <td>
                            <input type="text" name="description" placeholder="Enter Post Description..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" name="author" value="<?php echo Session::get('username'); ?>" class=" medium" />
                            <input type="hidden" name="userid" value="<?php echo Session::get('userId'); ?>" class=" medium" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
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
<?php include "inc/header.php"; ?>
<?php
$pageid = mysqli_real_escape_string($db->link, $_GET['pageid']);
if (!isset($pageid) || $pageid == NULL) {
    echo "<script>window.location = 'index.php'</script>";
} else {
    $id = $pageid;
}
?>
<style>
    .bgchange {
        border: 1px solid #ddd;
        background: #D4D0C8;
        color: #333;
        text-decoration: none;
        font-weight: normal;
        cursor: pointer;
        font-size: 20px;
        padding: 2px 10px;
    }
</style>
<div class="grid_10">
    <?php
    if (isset($_GET['delpage'])) {
        $delid = $_GET['delpage'];
        $delQuery = "DELETE FROM tbl_pages WHERE id='$delid'";
        $delete_row = $db->update($delQuery);
        if ($delete_row) {
            echo "<span class='success'>Page Deleted Successfully.</span>";
        } else {
            echo "<span class='error'>Page Not Deleted. !!</span>";
        }
    }
    ?>
    <div class="box round first grid">
        <h2> page </h2>
        <div class="block">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = mysqli_real_escape_string($db->link, $_POST['name']);

                if (empty($name)) {
                    echo "<span class='error'>Field Must Not Be Empty. !!</span>";
                } else {
                    $sql = "UPDATE tbl_pages
                        SET
                        name = '$name'
                        WHERE id='$id'";
                    $update_row = $db->update($sql);
                    if ($update_row) {
                        echo "<span class='success'>Page Updated Successfully.</span>";
                    } else {
                        echo "<span class='error'>Page Not Updated. !!</span>";
                    }
                }
            }
            ?>
            <?php
            $query = "SELECT * FROM tbl_pages WHERE id='$id'";
            $pages  = $db->select($query);
            if ($pages) {
                while ($result = $pages->fetch_assoc()) {
            ?>
                    <form action="" method="post">
                        <table class="form">
                            <tr>
                                <td><label>Page Name</label></td>
                                <td><input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" value="Update">
                                    <a class="bgchange" onclick="return confirm('Are you want to Delete?');" href="?delpage=<?php echo $result['id']; ?>">Delete</a>
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
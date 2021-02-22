<?php include '../lib/Session.php';
Session::checkSession(); ?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>

<?php
$db = new Database();
?>

<?php
$delpostid = mysqli_real_escape_string($db->link, $_GET['delpostid']);
if (!isset($delpostid) || $delpostid == NULL) {
    echo "<script>window.location = 'postlist.php'</script>";
} else {
    $delid = $delpostid;


    $query = "SELECT * FROM tbl_post WHERE id='$delid'";
    $data  = $db->select($query);
    if ($data) {
        while ($delImg = $data->fetch_assoc()) {
            $delLink = $delImg['image'];
            unlink($delLink);
        }
    }


    $delQuery = "DELETE FROM tbl_post WHERE id='$delid'";
    $delPost  = $db->delete($delQuery);
    if ($delPost) {
        echo "<script>alert('Post Deleted Successfully.');</script>";
        echo "<script>window.location = 'postlist.php'</script>";
    } else {
        echo "<script>alert('Post Not Deleted.');</script>";
        echo "<script>window.location = 'postlist.php'</script>";
    }
}
?>
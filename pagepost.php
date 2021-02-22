<?php include 'inc/header.php';
$pageid = mysqli_real_escape_string($db->link, $_GET['pageid']);
if (!isset($pageid) || $pageid == NULL) {
    header("Location: inbox.php");
} else {
    $id = $pageid;
}

?>
<section class="blog-post-area">
    <div class="container">
        <div class="row">
            <div class="blog-post-area-style">
                <?php
                $query = "SELECT * FROM tbl_post WHERE cat='$id' ORDER BY id desc  ";
                $pagepost = $db->select($query);
                if ($pagepost) {
                    while ($result = $pagepost->fetch_assoc()) {
                ?>
                        <div class="col-md-3">
                            <div class="single-post">
                                <img src="admin/<?php echo $result['image']; ?>" alt="<?php echo $result['image_alt']; ?>">
                                <h3><a href="post.php?postId=<?php echo $result['id']; ?>"><?php echo $result["title"]; ?></a></h3>
                                <h4><span>Posted By: <span class="author-name"><?php echo $result["author"]; ?></span></span>
                                </h4>
                                <?php echo $fm->shortText($result["body"], 141); ?>
                                <h4><span><?php echo $fm->dateFormat($result["date"]); ?></span></h4>
                            </div>
                        </div>
                    <?php } ?>
                    <!--End While Loop  -->
                <?php
                } else { ?>
                    <h3>No Post Available in this Page</h3>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?php include 'inc/footer.php'; ?>
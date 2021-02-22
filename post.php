<?php include 'inc/header.php';
$postId = mysqli_real_escape_string($db->link, $_GET['postId']);
if (!isset($postId) || $postId == NULL) {
    header("Location: index.php");
} else {
    $id = $postId;
}

?>

<section class="blog-post-area">
    <div class="container">
        <?php
        $query = "SELECT * FROM tbl_post WHERE id='$id'";
        $post  = $db->select($query);
        if ($post) {
            while ($result = $post->fetch_assoc()) {
        ?>
                <div class="row">
                    <div class="blog-post-area-style">
                        <div class="col-md-12">
                            <div class="single-post-big">
                                <div class="post-text">
                                    <h3><a href="post.php?postId=<?php echo $result['id']; ?>"><?php echo $result["title"]; ?></a></h3>
                                    <div class="post-image">
                                        <img src="admin/<?php echo $result['image']; ?>" alt="<?php echo $result['image_alt']; ?>">
                                    </div>
                                    <?php echo $result["body"]; ?>
                                    <h4><span class="date"><?php echo $fm->dateFormat($result["date"]); ?></span><span class="author">Posted By: <span class="author-name"><?php echo $result["author"]; ?></span></span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "Not Found";
        }
        ?>
    </div>
</section><?php include 'inc/footer.php'; ?>
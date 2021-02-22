<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>

<section class="blog-post-area">
    <div class="container">
        <div class="row">
            <div class="blog-post-area-style">
                <div class="col-md-12">
                    <?php
                    $query = "SELECT * FROM tbl_post ORDER BY rand() LIMIT 1";
                    $bigpost = $db->select($query);
                    if ($bigpost) {
                        while ($bigResult = $bigpost->fetch_assoc()) {
                    ?>
                            <div class="single-post-big">
                                <div class="big-image">
                                    <img src="admin/<?php echo $bigResult["image"]; ?>" alt="<?php echo $bigResult['image_alt']; ?>">
                                </div>
                                <div class="big-text">
                                    <h3><a href="post.php?postId=<?php echo $bigResult['id']; ?>"><?php echo $bigResult["title"]; ?></a></h3>
                                    <?php echo $fm->shortText($bigResult["body"], 490); ?>
                                    <h4><span class="date"><?php echo $fm->dateFormat($bigResult["date"]); ?></span><span class="author">Posted By: <span class="author-name"><?php echo $bigResult["author"]; ?></span>
                                    </h4>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
                <!---Pagination-->
                <?php
                $per_page = 8;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $offset = ($page - 1) * $per_page;
                ?>
                <!---Pagination-->
                <?php
                $query = "SELECT * FROM tbl_post ORDER BY id desc LIMIT $offset, $per_page";
                $post = $db->select($query);
                if ($post) {
                    while ($result = $post->fetch_assoc()) {
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
                    <!-- Pagination Start -->

            </div>
        </div>
    </div>

    <div class="pegination">
        <!--
                <ul>
                    <li><i class="fa fa-angle-left" aria-hidden="true"></i></li>
                    <li class="active">1</li>
                    <li>2</li>
                    <li>3</li>
                    <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                </ul>
-->

        <div class="nav-links">
            <?php
                    $query = "SELECT * FROM tbl_post";
                    $result = $db->select($query);
                    $total_rows = mysqli_num_rows($result);
                    $total_page = ceil($total_rows / $per_page);


                    echo "<span>";
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i == $page) {
                            $active = "current";
                        } else {
                            $active = "";
                        }
                        echo "<a class='page-numbers " . $active . "' href='index.php?page=" . $i . "'>" . $i . "</a>";
                    };

                    echo "<a class='page-numbers' href='index.php?page=$total_page'><i class='fa fa-angle-right' aria-hidden='true'></i></a></span>";
            ?>
            <!-- Pagination End -->
        <?php } else {
                    echo "Post not Found";
                } ?>
        </div>
    </div>
</section>
<?php include 'inc/footer.php'; ?>
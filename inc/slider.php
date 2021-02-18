<section class="bg-text-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                $query = "SELECT * FROM tbl_slide_section";
                $post  = $db->select($query);
                if ($post) {
                    while ($result = $post->fetch_assoc()) {
                ?>
                        <div class="bg-text">

                            <h3><?php echo $result['title']; ?></h3>
                            <?php echo $result['descr']; ?>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </div>
</section>
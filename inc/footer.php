  <footer class="footer">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="footer-bg">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="footer-menu">
                                  <ul>
                                      <li class="active"><a href="index.php">Home</a></li>
                                      <?php
                                        $pagequery = "SELECT * FROM tbl_pages";
                                        $pages  = $db->select($pagequery);
                                        $active = "";
                                        if ($pages) {
                                            while ($p_result = $pages->fetch_assoc()) {
                                        ?>
                                              <li><a href="pagepost.php?pageid=<?php echo $p_result['id']; ?>"><?php echo $p_result['name']; ?></a></li>
                                      <?php }
                                        } ?>
                                  </ul>
                                  <p style="color: #fff;"> &copy; Design copyright by DartThemes.com & Development copyright Silvan </p>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="copyright">
                                  <p> &copy; Design copyright by DartThemes.com & </p>
                                  <p>&copy; Development copyright Silvan</p>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="footer-icon">
                                  <?php
                                    $query = "SELECT * FROM tbl_social";
                                    $post  = $db->select($query);
                                    if ($post) {
                                        while ($result = $post->fetch_assoc()) {
                                    ?>
                                          <p><a href="<?php echo $result['fb']; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a><a href="<?php echo $result['tw']; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a><a href="<?php echo $result['le']; ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a><a href="<?php echo $result['dbl']; ?>" target="_blank"><i class="fa fa-dribbble" aria-hidden="true"></i></a></p>
                                  <?php }
                                    } ?>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </footer>
  </div>
  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/active.js"></script>
  </body>

  </html>
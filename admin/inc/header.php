<?php include '../lib/Session.php';
Session::checkSession();
?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helper/Format.php'; ?>

<?php
$db = new Database();
$fm = new Format();
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title> Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    * <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();
            setSidebarHeight();
        });
    </script>
    <!-- /TinyMCE -->
    <style type="text/css">
        #tinymce {
            font-size: 15px !important;
        }
    </style>
</head>

<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                </div>
                <div class="floatleft middle">
                    <h1>Classic</h1>
                </div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" />
                    </div>
                    <?php if (isset($_GET['action']) && $_GET['action'] == "logout") {
                        Session::destroy();
                    } ?>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello <?php echo Session::get('username'); ?></li>
                            <li><a href="?action=logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                <li class="ic-form-style"><a href="profile.php"><span>User Profile</span></a></li>
                <li class="ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>
                <?php
                if (Session::get('role') == '0') { ?>
                    <li class="ic-form-style"><a href="adduser.php"><span>Add User</span></a></li>
                <?php }
                ?>
                <li class="ic-form-style"><a href="userlist.php"><span>User List</span></a></li>
                <li class="ic-charts"><a href="postlist.php"><span>Visit Website</span></a></li>
            </ul>
        </div>
        <div class="clear">
        </div>
        <div class="grid_2">
            <div class="box sidemenu">
                <div class="block" id="section-menu">
                    <ul class="section menu">
                        <li><a class="menuitem">Site Option</a>
                            <ul class="submenu">
                                <li><a href="titledescr.php">Title & Slogan</a></li>
                                <li><a href="social.php">Social Media</a></li>
                                <li><a href="logo.php">Logo</a></li>

                            </ul>
                        </li>

                        <li><a class="menuitem">Pages Option</a>
                            <ul class="submenu">
                                <li><a href="addpage.php">Add Page</a></li>
                                <?php
                                $query = "SELECT * FROM tbl_pages";
                                $pages  = $db->select($query);
                                $active = "";
                                if ($pages) {
                                    while ($result = $pages->fetch_assoc()) {
                                ?>
                                        <li><a href="page.php?pageid=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
                                <?php }
                                } ?>
                            </ul>
                        </li>
                        <li><a class="menuitem">Post Option</a>
                            <ul class="submenu">
                                <li><a href="addpost.php">Add Post</a> </li>
                                <li><a href="postlist.php">Post List</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
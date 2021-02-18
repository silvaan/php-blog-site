<?php include 'config/config.php'; ?>
<?php include 'lib/Database.php'; ?>
<?php include 'helper/Format.php'; ?>

<?php
$db = new Database();
$fm = new Format();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Front page</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="post.css">
    <link rel="stylesheet" href="responsive.css">
</head>

<body>
    <div class="wrapper">
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div class="logo">
                            <?php
                            $query = "SELECT * FROM tbl_logo";
                            $post  = $db->select($query);
                            if ($post) {
                                while ($result = $post->fetch_assoc()) {
                            ?>
                                    <h2><a href="index.php"><?php echo $result['logo']; ?></a></h2>
                            <?php }
                            } ?>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="menu">
                            <ul>
                                <li class="active"><a href="index.php">Home</a></li>
                                <?php
                                if (isset($_GET['pageid'])) {
                                    $pageid = $_GET['pageid'];
                                }
                                $query = "SELECT * FROM tbl_pages";
                                $pages  = $db->select($query);
                                $active = "";
                                if ($pages) {
                                    while ($result = $pages->fetch_assoc()) {
                                        if (isset($_GET['pageid'])) {
                                            if ($result["id"] == $pageid) {
                                                $active = "active";
                                            } else {
                                                $active = "";
                                            }
                                        }
                                ?>

                                <?php echo '<li><a class="' . $active . '" href="pagepost.php?pageid=' . $result["id"] . '">' . $result["name"] . '</a></li>';
                                    }
                                } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>

<?php include "inc/header.php"; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Pages</h2>
        <div class="block copyblock">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = mysqli_real_escape_string($db->link, $_POST['name']);

                if (empty($name)) {
                    echo "<span class='error'>Field Must Not Be Empty. !!</span>";
                } else {
                    $sql = "INSERT INTO tbl_pages(name) VALUES('$name')";
                    $insert = $db->insert($sql);
                    if ($insert) {
                        echo "<span class='success'>Page Inserted Successfully.</span>";
                    } else {
                        echo "<span class='error'>Page Not Inserted. !!</span>";
                    }
                }
            }
            ?>
            <form action="addpage.php" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="name" placeholder="Enter Page Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>
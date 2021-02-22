<?php include "inc/header.php"; ?>

<?php
if (!Session::get('userRole') == '0') {
    echo "<script>window.location = 'index.php'</script>";
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>User Detaiis</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = mysqli_real_escape_string($db->link, $fm->validation($_POST['username']));
            $password = mysqli_real_escape_string($db->link, $fm->validation(md5($_POST['password'])));
            $email    = mysqli_real_escape_string($db->link, $fm->validation($_POST['email']));
            $role     = mysqli_real_escape_string($db->link, $fm->validation($_POST['role']));

            if (empty($username) || empty($password) || empty($email) || empty($role)) {
                echo "<span class='error'>Field Must Not Be Empty. !!</span>";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<span class='error'>Invalid Email Address. !!</span>";
            } else {
                $mailQuery = "SELECT * FROM tbl_user WHERE email='$email'";
                $mailcheck = $db->select($mailQuery);
                if ($mailcheck != false) {
                    echo "<span class='error'>Email Already Exists.</span>";
                } else {
                    $sql = "INSERT INTO tbl_user(username, password, email, role) VALUES('$username', '$password', '$email', '$role')";
                    $insert = $db->insert($sql);
                    if ($insert) {
                        echo "<span class='success'>User Inserted Successfully.</span>";
                    } else {
                        echo "<span class='error'>User Not Inserted. !!</span>";
                    }
                }
            }
        }
        ?>
        <div class="block">
            <form action="" method="post">
                <table class="form">

                    <tr>
                        <td>
                            <label>User Name</label>
                        </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter User Name...." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Password</label>
                        </td>
                        <td>
                            <input type="text" name="password" placeholder="Enter Password..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="email" name="email" placeholder="Enter Email Address" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>User Role</label>
                        </td>
                        <td>
                            <select name="role" id="select">
                                <option>--Select One--</option>
                                <option value="0">Admin</option>
                                <option value="1">Editor</option>
                                <option value="2">Author</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
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
<?php
include_once "../components/header.php";
?>

<section class="container mt-8 text-light">
    <h2 class="text-center">Admin Login</h2>
    <div class="row justify-content-center p-2">
        <div class="col-lg-6 col-md-8 border rounded bgc-secondary p-3">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <h5>Email</h5>
                <input type="email" autocomplete="off" class="form-control" placeholder="Email" name="email" id="email" required>

                <h5 class="mt-3">Password</h5>
                <input type="password" autocomplete="off" class="form-control" placeholder="Password" name="password" id="password" required>

                <div class="text-center pt-3">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = validation($_POST['email']);
    $password = validation($_POST['password']);

    $sql_select = "SELECT * from admin where email = '$email'";
    $result = mysqli_query($conn, $sql_select);
    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_array($result);

        if ($row['password'] === md5($password)) {
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_name'] = $row['name'];
            // header("Location: index.php");
            echo "<script>location.href='http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/';</script>";
        } else {
            $message = "Password incorrect!";
        }
    } else {
        $message = "Email incorrect!";
    }


    echo '<h6 class="text-danger text-center">' . $message . '</h6>';
}

function validation($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
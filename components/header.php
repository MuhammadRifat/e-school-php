<?php
//start session on web page
session_start();

$user_first_name = '';
$user_email = '';
if (isset($_SESSION['user_email_address'])) {
    $user_email = $_SESSION['user_email_address'];
    $user_first_name = $_SESSION['user_first_name'];
}

$admin_email = '';
$admin_name = '';
if (isset($_SESSION['admin_email'])) {
    $admin_email = $_SESSION['admin_email'];
    $admin_name = $_SESSION['admin_name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/1956a6e6c9.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

    <style>
        body {
            background-color: #111827;
        }

        a {
            text-decoration: none;
        }

        .bgc-primary {
            background-color: #1F2937;
        }

        .bgc-secondary {
            background-color: #374151;
        }

        .mt-8 {
            margin-top: 70px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark variant bgc-primary">
        <div class="container">
            <a class="navbar-brand" href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/">
                <img src="../components/default-monochrome.svg" alt="" class="" width="180">
                <img src="./components/default-monochrome.svg" alt="" class="" width="180">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
                <span></span>
                <ul class="navbar-nav bgc-secondary p-2 rounded gap-2 align-items-center">
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm" href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/academic/"><i class='fas fa-school'></i> Academic</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm" href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/course/?category=Skill Development"><i class='fas fa-laptop'></i> Skill Development</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm" href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/course/?category=Job Preparation"><i class='fas fa-briefcase'></i> Job Preparation</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm" href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/course/?category=Crash Course"><i class="fas fa-fire-alt"></i> Crash Course</a>
                    </li>
                </ul>

                <ul class="navbar-nav text-center">

                    <?php
                    if (!$user_email && !$admin_email) {
                        echo '<a class="btn btn-outline-light btn-sm" href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/login"><i class="fas fa-sign-in-alt"></i> Login</a>';
                    } else if ($user_email && !$admin_email) {
                        // Student Dashboard
                        echo '<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $user_first_name . '</a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/student/"><i class="fas fa-table"></i> Dashboard</a></li>
                                <li><a class="dropdown-item" href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/login/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            </ul>
                        </li>';
                    } else if ($admin_email && !$user_email) {

                        // Admin Dashboard
                        echo '<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $admin_name . '</a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/"><i class="fas fa-table"></i> Dashboard</a></li>
                                <li><a class="dropdown-item" href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/add-course.php"><i class="fas fa-plus-square"></i> Add Course</a></li>
                                <li><a class="dropdown-item" href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/manage-course.php"><i class="fas fa-tasks"></i> Manage Course</a></li>
                                <li><a class="dropdown-item" href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            </ul>
                        </li>';
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "e-school";

    $conn = mysqli_connect($servername, $username, $password, $db);

    if (!$conn) {
        die("Connection Failed: " . mysqli_connect_error());
    }

    ?>
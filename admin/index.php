<?php
include_once "../components/header.php";

if (!$admin_email) {
    echo "<script>location.href='http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/login.php';</script>";
}
?>

<?php if ($admin_email) { ?>

    <section class="container mt-8 text-light">
        <h2 class="text-center border-bottom">Dashboard</h2>

        <!-- summary -->
        <div class="row">
            <?php loadComponents('Pending Payment', '45 Requests', 'fas fa-plus', 'manage-course'); ?>
            <?php loadComponents('Approved Payment', '56 Users', 'fas fa-users', 'manage-course'); ?>
            <?php loadComponents('Manage Courses', '4500+ Courses', 'fas fa-tasks', 'manage-course'); ?>
            <?php loadComponents('Add Course', '4500+ Courses', 'fas fa-plus-square', 'add-course'); ?>
            <?php loadComponents('Manage Students', '4500+ Students', 'fas fa-tasks', 'add-course'); ?>
        </div>
    </section>

<?php
}

function loadComponents($name, $details, $icon, $fileName)
{
    echo '<div class="col-md-6 col-lg-4 p-2">
    <a class="text-light" href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/'.$fileName.'.php">
    <div class="d-flex bgc-primary rounded align-items-center justify-content-center p-3">
        <i class="'.$icon.' fs-1 me-3"></i>
        <div>
            <h5>'.$name.'</h5>
            <span>'.$details.'</span>
        </div>
    </div>
    </a>
</div>';
}
?>
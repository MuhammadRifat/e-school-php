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
            <?php 
            loadComponents('Pending Payment', getTotalRequest($conn, 'enrolls', 'Pending'). ' Requests', 'fas fa-plus', 'pending-payment', ''); 
            loadComponents('Approved Payment', getTotalRequest($conn, 'enrolls', 'Approved'). ' Students', 'fas fa-users', 'approved-payment', '');
            loadComponents('Manage Courses', getTotalRequest($conn, 'courses', ''). ' Courses', 'fas fa-tasks', 'manage-course', '');
            loadComponents('Add Course', getTotalRequest($conn,  'courses', ''). ' Courses', 'fas fa-plus-square', 'add-course', '');
            ?>
        </div>

        <!-- Enrolled students -->
        <h3 class="mt-3">Enrolled Students</h3>
        <div class="row">
            <?php
                $sql_totalEnroll = "SELECT courseId, courses.course_name, COUNT(enrolls.id) FROM enrolls, courses WHERE enrolls.courseId=courses.id AND enrolls.status='Approved' GROUP by courseId";
                $result_enrolls = mysqli_query($conn, $sql_totalEnroll); 
                
                if(mysqli_num_rows($result_enrolls)) {
                    while($row = mysqli_fetch_assoc($result_enrolls)){
                        loadComponents($row['course_name'], $row['COUNT(enrolls.id)'] . " Students", 'fas fa-book-open', 'manage-students', '?courseId='.$row['courseId']);
                    }
                }
            ?>
        </div>
    </section>

<?php
}

function getTotalRequest($conn, $tableName, $status) {
    $sql_request = "SELECT COUNT(id) FROM $tableName";
    if($status != '') {
        $sql_request = "SELECT COUNT(id) FROM $tableName WHERE status='$status'";
    }
    $result_request = mysqli_query($conn, $sql_request);
    $row = mysqli_fetch_assoc($result_request);
    return $row['COUNT(id)'];
}

function loadComponents($name, $details, $icon, $fileName, $route)
{
    $file = $fileName. ".php" . $route;
    echo '<div class="col-md-6 col-lg-4 p-2">
    <a class="text-light" href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/'.$file.'">
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
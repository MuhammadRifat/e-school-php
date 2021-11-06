<?php
include_once "../components/header.php";

if (!$_SESSION['user_email_address']) {
    echo "<script>location.href='http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/login';</script>";
}
?>

<section class="container mt-8 text-light">
    <h3 class="text-center border-bottom">Enrolled Courses</h3>
    <div class="row justify-content-center mb-3">
        <?php
        $sql_courses = "SELECT courses.id, courses.course_name, courses.image_url FROM courses, enrolls WHERE courses.id=enrolls.courseId and enrolls.userEmail = '$user_email' order by enrolls.date desc;";
        $result = mysqli_query($conn, $sql_courses);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <a href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/start-class/?courseId=' . $row["id"] . '">
                    <div class="card bgc-primary text-light shadow">
                        <img src="../images/uploads/' . $row["image_url"] . '" class="card-img-top" height="160px" alt="' . $row["course_name"] . '">
                        <div class="card-body">
                            <h5 class="card-title">' . $row["course_name"] . '</h5>
                            <button class="btn btn-danger">Continue Course</button>
                        </div>
                    </div>
                </a>
            </div>';
            }
        }
        ?>
    </div>
</section>
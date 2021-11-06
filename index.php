<?php
include_once "./components/header.php";
?>

<!--main -->
<section class="container mt-8 text-light">
    <!-- Header Poster -->
    <div class="row rounded p-3 align-items-center justify-content-center" style="background-color: #107AE1;">
        <div class="col-md-6">
            <h1 class="mb-4"><span class="text-warning">Easy solution</span> to study at home</h1>
            <p>Class 1-12, admission test, special course for university and working life, 24/7 directions including model test. Select your section, start your journey.</p>
        </div>
        <div class="col-md-6">
            <img src="./images/animation-software-header.gif" alt="" class="w-100 img-responsive rounded">
        </div>
    </div>

        <?php
        // load courses from database 
        loadCourses('Crash Course', $conn, $user_email);
        loadCourses('Skill Development', $conn, $user_email);
        loadCourses('Job Preparation', $conn, $user_email);
        ?>

    <!-- summary -->
    <div class="row mt-5">
        <?php 
        showSummary('fa-play-circle', 1500, 'video tutorial'); 
        showSummary('fa-book-open', 4500, 'Quiz'); 
        showSummary('fas fa-book-reader', 1100, 'Notes'); 
        showSummary('fas fa-th', 1200, 'Blogs'); 
        ?>
    </div>

    <!-- last poster -->
    <div class="mt-5">
        <img src="./images/virtual-learning-illustration.jpg" alt="" class="rounded w-100 h-75">
    </div>
</section>

<?php
include_once "./components/footer.php";

function loadCourses($category, $conn, $user_email)
{
    $sql_courses = "SELECT id, course_name, image_url, time_required, price FROM courses WHERE id NOT IN (SELECT courseId FROM enrolls WHERE userEmail='$user_email') AND category='$category' ORDER BY date DESC LIMIT 4;";
    $result = mysqli_query($conn, $sql_courses);

    echo '<h3 class="text-center border-bottom mt-4">'.$category.'</h3>
    <div class="row justify-content-center">';
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $price = ($row["price"] == 0) ? 'Free' : '&#2547; ' . $row["price"];
            echo '<div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                    <a href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/components/course-details.php?id=' . $row["id"] . '">
                        <div class="card bgc-primary text-light shadow">
                            <img src="./images/uploads/' . $row["image_url"] . '" class="card-img-top" height="160px" alt="' . $row["course_name"] . '">
                            <div class="card-body">
                                <h5 class="card-title">' . $row["course_name"] . '</h5>
                            </div>
                            <div class="px-3 d-flex justify-content-between">
                                <h5 class="rounded py-1 px-2 bg-success">' . $price . '</h5>
                                <h6 class="rounded p-1 bg-danger">' . $row["time_required"] . ' hour</h6>
                            </div>
                        </div>
                    </a>
                </div>';
        }
        echo '
        </div>
        <div class="text-center mt-2">
        <a href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/course/?category='.$category.'" class="btn btn-outline-secondary text-white btn-sm">See more <i class="fas fa-arrow-right"></i></a>
    </div>';
    } else {
        echo '<p class="text-center">No course found!</p>';
    }
}

// show summary information
function showSummary($icon, $total, $subject) {
    echo '<div class="col-sm-6 col-md-4 col-lg-3 p-2">
            <div class="d-flex bgc-primary rounded align-items-center justify-content-center p-3">
                <i class="fas '.$icon.' fs-1 me-3"></i>
                <div>
                    <h5>'.$total.'+</h5>
                    <span>'.$subject.'</span>
                </div>
            </div>
        </div>';
}
?>
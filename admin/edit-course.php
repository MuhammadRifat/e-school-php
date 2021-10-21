<?php
include_once "../components/header.php";

if (!$admin_email) {
    echo "<script>location.href='http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/login.php';</script>";
}

$id = $_REQUEST['id'];
$sql_getCourse = "select * from courses where id = $id;";
$result = mysqli_query($conn, $sql_getCourse);

$row = mysqli_fetch_assoc($result);

$display = 'none';
if ($row['category'] === 'Academic') {
    $display = 'block';
}
?>

<?php if ($admin_email) { ?>

<section class="container mt-8 text-light">
    <h3 class="text-center border-bottom">Edit Course</h3>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <input type="hidden" name="id" class="form-control" value="<?php echo $row['id'] ?>" placeholder="Course Name" required>

            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Course Name</h6>
                <input type="text" name="courseName" class="form-control" value="<?php echo $row['course_name'] ?>" placeholder="Course Name" required>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Category</h6>
                <select name="Category" id="Category" class="form-select" onchange="isAcademic()">
                    <option value="Academic" <?php echo ($row['category'] === 'Academic') ? 'selected' : '' ?>>Academic</option>
                    <option value="Skill Development" <?php echo ($row['category'] === 'Skill Development') ? 'selected' : '' ?>>Skill Development</option>
                    <option value="Job Preparation" <?php echo ($row['category'] === 'Job Preparation') ? 'selected' : '' ?>>Job Preparation</option>
                    <option value="Crash Course" <?php echo ($row['category'] === 'Crash Course') ? 'selected' : '' ?>>Crash Course</option>
                </select>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3" id="class" style="display: <?php echo $display ?>">
                <h6>Class</h6>
                <select name="class" id="class" class="form-select">
                    <option disabled selected>select class</option>
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        $selected = '';
                        if ($row['class'] == $i) {
                            $selected = 'selected';
                        }
                        echo '<option value="' . $i . '" ' . $selected . '>Class ' . $i . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Course Description</h6>
                <textarea name="description" id="description" cols="10" rows="2" class="form-control" placeholder="Course Description" required><?php echo $row['description'] ?></textarea>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Teacher Name</h6>
                <input type="text" name="teacherName" id="teacherName" class="form-control" value="<?php echo $row['teacher_name'] ?>" placeholder="Teacher Name" required>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Teacher Details</h6>
                <textarea name="teacherDetails" id="teacherDetails" cols="10" rows="2" class="form-control" placeholder="Teacher Details" required><?php echo $row['teacher_details'] ?></textarea>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>About Course</h6>
                <textarea name="aboutCourse" id="aboutCourse" cols="10" rows="2" class="form-control" placeholder="About Course" required><?php echo $row['about_course'] ?></textarea>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Time Required (hours)</h6>
                <input type="number" name="timeRequired" id="timeRequired" class="form-control" value="<?php echo $row['time_required'] ?>" placeholder="Time Required" required>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Total Videos</h6>
                <input type="number" name="totalVideos" id="totalVideos" class="form-control" value="<?php echo $row['total_videos'] ?>" placeholder="Total Videos" required>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Total Quiz</h6>
                <input type="number" name="totalQuiz" id="totalQuiz" class="form-control" value="<?php echo $row['total_quizz'] ?>" placeholder="Total Quiz" required>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Total Notes</h6>
                <input type="number" name="totalNotes" id="totalNotes" class="form-control" value="<?php echo $row['total_notes'] ?>" placeholder="Total Notes" required>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Total Practices</h6>
                <input type="number" name="totalPractices" id="totalPractices" class="form-control" value="<?php echo $row['total_practices'] ?>" placeholder="Total Practices" required>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Duration Months</h6>
                <input type="number" name="durationMonths" id="durationMonths" class="form-control" value="<?php echo $row['duration_months'] ?>" placeholder="Duration Months" required>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Price</h6>
                <input type="number" name="price" id="price" class="form-control" value="<?php echo $row['price'] ?>" placeholder="Price" required>
            </div>
        </div>
        <div class="row justify-content-center my-4">
            <div class="col-4">
                <button type="submit" class="btn btn-success w-100">Update</button>
            </div>
        </div>
    </form>

    <script>
        function isAcademic() {
            let category = document.getElementById('Category').value;
            let className = document.getElementById('class');
            if (category === 'Academic') {
                className.style.display = 'block';
            } else {
                className.style.display = 'none';
            }
        }
    </script>
</section>

<?php
} // end of condition

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $course_id = $_POST['id'];
    $courseName = validation($_POST['courseName']);
    $category = validation($_POST['Category']);
    $courseDescription = validation($_POST['description']);
    $teacherName = validation($_POST['teacherName']);
    $teacherDetails = validation($_POST['teacherDetails']);
    $aboutCourse = validation($_POST['aboutCourse']);
    $timeRequired = validation($_POST['timeRequired']);
    $totalVideos = validation($_POST['totalVideos']);
    $totalQuiz = validation($_POST['totalQuiz']);
    $totalNotes = validation($_POST['totalNotes']);
    $totalPractices = validation($_POST['totalPractices']);
    $durationMonths = validation($_POST['durationMonths']);
    $price = validation($_POST['price']);

    $class = '';
    $sql_updateCourse = "UPDATE `courses` set `course_name`='$courseName', `category`='$category', `description`='$courseDescription', `teacher_name`='$teacherName', `teacher_details`='$teacherDetails', `about_course`='$aboutCourse', `time_required`=$timeRequired, `total_videos`=$totalVideos, `total_quizz`=$totalQuiz, `total_notes`=$totalNotes, `total_practices`=$totalPractices, `duration_months`=$durationMonths, `price`=$price where id=$course_id;";
    if ($category === 'Academic') {
        $class = validation($_POST['class']);
        $sql_updateCourse = "UPDATE `courses` set `course_name`='$courseName', `category`='$category', `class`=$class, `description`='$courseDescription', `teacher_name`='$teacherName', `teacher_details`='$teacherDetails', `about_course`='$aboutCourse', `time_required`=$timeRequired, `total_videos`=$totalVideos, `total_quizz`=$totalQuiz, `total_notes`=$totalNotes, `total_practices`=$totalPractices, `duration_months`=$durationMonths, `price`=$price where id=$course_id;";
    }

    if (mysqli_query($conn, $sql_updateCourse)) {
        echo '<script type="text/javascript">alert("Data Updated Successfully!")</script>';
        echo "<script>location.href='edit-course.php?id=$course_id';</script>";
    } else {
        echo '<script type="text/javascript">alert("Failed!")</script>';
        echo "<script>location.href='edit-course.php?id=$course_id';</script>";
    }
}

function validation($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
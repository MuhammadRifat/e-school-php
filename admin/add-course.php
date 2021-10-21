<?php
include_once "../components/header.php";

if (!$admin_email) {
    echo "<script>location.href='http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/login.php';</script>";
}
?>

<?php if ($admin_email) { ?>

<section class="container mt-8 text-light">
    <h3 class="text-center border-bottom">Add New Course</h3>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Course Name</h6>
                <input type="text" name="courseName" class="form-control" placeholder="Course Name" required>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Category</h6>
                <select name="Category" id="Category" class="form-select" onchange="isAcademic()">
                    <option disabled selected>select category</option>
                    <option value="Academic">Academic</option>
                    <option value="Skill Development">Skill Development</option>
                    <option value="Job Preparation">Job Preparation</option>
                    <option value="Crash Course">Crash Course</option>
                </select>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3" id="class" style="display: none">
                <h6>Class</h6>
                <select name="class" id="class" class="form-select">
                    <option disabled selected>select class</option>
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        echo '<option value="' . $i . '">Class ' . $i . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Upload Course Image</h6>
                <input type="file" name="courseImage" id="courseImage" class="form-control" placeholder="" required>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Course Description</h6>
                <textarea name="description" id="description" cols="10" rows="2" class="form-control" placeholder="Course Description" required></textarea>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Teacher Name</h6>
                <input type="text" name="teacherName" id="teacherName" class="form-control" placeholder="Teacher Name" required>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Teacher Details</h6>
                <textarea name="teacherDetails" id="teacherDetails" cols="10" rows="2" class="form-control" placeholder="Teacher Details" required></textarea>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>About Course</h6>
                <textarea name="aboutCourse" id="aboutCourse" cols="10" rows="2" class="form-control" placeholder="About Course" required></textarea>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Time Required (hours)</h6>
                <input type="number" name="timeRequired" id="timeRequired" class="form-control" placeholder="Time Required" required>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Total Videos</h6>
                <input type="number" name="totalVideos" id="totalVideos" class="form-control" placeholder="Total Videos" required>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Total Quiz</h6>
                <input type="number" name="totalQuiz" id="totalQuiz" class="form-control" placeholder="Total Quiz" required>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Total Notes</h6>
                <input type="number" name="totalNotes" id="totalNotes" class="form-control" placeholder="Total Notes" required>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Total Practices</h6>
                <input type="number" name="totalPractices" id="totalPractices" class="form-control" placeholder="Total Practices" required>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Duration Months</h6>
                <input type="number" name="durationMonths" id="durationMonths" class="form-control" placeholder="Duration Months" required>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <h6>Price</h6>
                <input type="number" name="price" id="price" class="form-control" placeholder="Price" required>
            </div>
        </div>
        <div class="row justify-content-center my-4">
            <div class="col-4">
                <button type="submit" class="btn btn-success w-100">Submit</button>
            </div>
            <div class="col-4">
                <button type="reset" class="btn btn-danger w-100">Reset</button>
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
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $imageUrl = imageUpload('courseImage');
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
    if ($category === 'Academic') {
        $class = validation($_POST['class']);
    }

    $sql_insertCourse = "INSERT INTO `courses` (`course_name`, `category`, `class`, `image_url`,`description`, `teacher_name`, `teacher_details`, `about_course`, `time_required`, `total_videos`, `total_quizz`, `total_notes`, `total_practices`, `duration_months`, `price`) VALUES('$courseName', '$category', '$class', '$imageUrl','$courseDescription', '$teacherName', '$teacherDetails', '$aboutCourse', '$timeRequired', '$totalVideos', '$totalQuiz', '$totalNotes', '$totalPractices', '$durationMonths', '$price');";
    if (mysqli_query($conn, $sql_insertCourse)) {
        echo '<script type="text/javascript">alert("Data Inserted Successfully!")</script>';
    } else {
        echo '<script type="text/javascript">alert("Failed!")</script>';
    }
}

function validation($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function imageUpload($inputName)
{
    $target_dir = "../images/uploads/";
    $target_file = $target_dir . basename($_FILES[$inputName]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES[$inputName]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo '<h5 class="text-danger">File is not an image.</h5>';
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES[$inputName]["size"] > 500000) {
        echo '<h5 class="text-danger">Sorry, your file is too large.</h5>';
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo '<h5 class="text-danger">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</h5>';
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<h5 class="text-danger">Sorry, your file was not uploaded.</h5>';
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES[$inputName]["tmp_name"], $target_file)) {
            return htmlspecialchars(basename($_FILES[$inputName]["name"]));
        } else {
            echo '<script>alert("Sorry, there was an error uploading your file.")</script>';
            return '';
        }
    }
}


?>
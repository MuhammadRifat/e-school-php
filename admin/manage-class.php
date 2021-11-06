<?php
include_once "../components/header.php";

if (!$admin_email) {
    echo "<script>location.href='http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/login.php';</script>";
}

$row_course = '';
$course_id = '';
if (isset($_REQUEST['courseId'])) {
    $course_id = $_REQUEST['courseId'];
    $sql_course = "SELECT course_name, price from courses WHERE id=$course_id";
    $result_course = mysqli_query($conn, $sql_course);
    $row_course = mysqli_fetch_assoc($result_course);
}
?>

<?php if ($admin_email) { ?>

<section class="container mt-8 text-light">
    <h3 class="text-center border-bottom">Upload Class - <span class="text-warning"><?php echo $row_course['course_name']; ?></span></h3>

    <!-- Upload Class -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="row">

            <input type="hidden" name="courseId" value="<?php echo $course_id; ?>">
            <div class="col-md-5 mt-2">
                <h6>Class Title</h6>
                <input type="text" name="title" class="form-control" placeholder="Class Title" required>
            </div>
            
            <?php
                // check paid or free course
                if($row_course['price'] > 0) {
                    echo '<div class="col-md-5 mt-2">
                    <h6>Upload Class Video</h6>
                    <input type="file" name="video" id="video" class="form-control" required>
                </div>';
                } else {
                    echo '<div class="col-md-5 mt-2">
                    <h6>Class URL</h6>
                    <input type="url" name="classUrl" id="classUrl" class="form-control" autocomplete="off" placeholder="Class URL" required>
                </div>';
                }
            ?>

            <div class="col-md-2 mt-2">
                <h6 class="invisible">upload</h6>
                <button type="submit" class="btn btn-success w-100"><i class="fas fa-upload"></i> Upload</button>
            </div>

        </div>
    </form>

    <!-- Class table -->
    <h3 class="text-center border-bottom mt-4">All Classes</h3>
    <table class="table bgc-secondary rounded text-light text-center my-3" id="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Class Title</th>
                <th scope="col">Class URL</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql_class = "SELECT id, title, class_url FROM classes where courseId=$course_id order by date asc;";
            $result = mysqli_query($conn, $sql_class);

            if (mysqli_num_rows($result) > 0) {
                $count = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr id="' . $row['id'] . '">
                    <th>' . $count++ . '</th>
                    <td>' . $row['title'] . '</td>
                    <td>' . $row['class_url'] . '</td>
                    <td>
                    <a href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/edit-class.php?classId=' . $row['id'] . '" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    <a href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/manage-class.php?courseId=' . $course_id . '&classId=' . $row['id'] . '&delete=true" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
                    </td>
                </tr>';
                }
            } else{
                echo '<h5 class="text-danger text-center mt-3">Class Not Found</h5>';
                echo '<script>document.getElementById("table").style.display = "none";</script>';
            }
            ?>

        </tbody>
    </table>
</section>

<?php
} // end condition 
// upload course
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $courseId = $_POST['courseId'];
    $title = $_POST['title'];
    $classUrl = '';

    if(isset($_POST['classUrl'])) {
        $classUrl = $_POST['classUrl'];
    } else {
        print_r($_FILES['video']);
        $classUrl = videoUploader('video', $row_course['course_name']);
    }

    $sql_uploadClass = "insert into classes (courseId, title, class_url) values ($courseId, '$title', '$classUrl')";
    if (mysqli_query($conn, $sql_uploadClass)) {
        echo "<script>location.href='manage-class.php?courseId=$courseId';</script>";
    } else {
        echo '<p class="text-danger text-center mt-3">Failed.</p>';
        echo "<script>location.href='manage-class.php?courseId=$courseId';</script>";
    }
}

// Delete Class
if (isset($_GET['delete'])) {
    $classId = $_GET['classId'];
    deleteClass($classId, $conn);
}

// for deleting class
function deleteClass($id, $conn)
{
    $sql_deleteClass = "delete from classes where id = $id";
    if (mysqli_query($conn, $sql_deleteClass)) {
        echo '<script>
            document.getElementById("' . $id . '").style.display = "none";
         </script>';
    } else {
        echo '<h2 class="text-danger text-center">Failed</h2>';
    }
}

function videoUploader($fieldName, $courseName) {
    $err = '';
    $uploadOk = 1;
    $targetDir = './classes/'.$courseName.'/';
    $targetFile = $targetDir . rand() . basename($_FILES[$fieldName]['name']);

    // $targetFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // if($targetFileType !== 'jpg' && $targetFileType !== 'png' && $targetFileType !== 'jpeg' && $targetFileType !== 'gif') {
    //     $err = 'This file type does not allowed';
    //     $uploadOk = 0;
    // }

    // if($_FILES[$fieldName]['size'] > 500000) {
    //     $err = 'File size is too large';
    //     $uploadOk = 0;
    // }

    if($uploadOk === 1) {
       move_uploaded_file($_FILES[$fieldName]['tmp_name'], $targetFile);
        return htmlspecialchars(pathinfo($targetFile, PATHINFO_BASENAME));
    } else {
        echo '<h3 style="text-align: center;color:red;">'.$err.'</h3>';
    }
}

?>
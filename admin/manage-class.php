<?php
include_once "../components/header.php";

if (!$admin_email) {
    echo "<script>location.href='http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/login.php';</script>";
}

$course_id = '';
if (isset($_REQUEST['courseId'])) {
    $course_id = $_REQUEST['courseId'];
}
?>

<?php if ($admin_email) { ?>

<section class="container mt-8 text-light">
    <h3 class="text-center border-bottom">Upload Class</h3>

    <!-- Upload Class -->
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <div class="row">

            <input type="hidden" name="courseId" value="<?php echo $course_id; ?>">
            <div class="col-md-5 mt-2">
                <h6>Class Title</h6>
                <input type="text" name="title" class="form-control" placeholder="Class Title" required>
            </div>
            <div class="col-md-5 mt-2">
                <h6>Class URL</h6>
                <input type="url" name="classUrl" id="teacherName" class="form-control" autocomplete="off" placeholder="Class URL" required>
            </div>
            <div class="col-md-2 mt-2">
                <h6 class="invisible">upload</h6>
                <button type="submit" class="btn btn-success w-100">Upload</button>
            </div>

        </div>
    </form>

    <!-- Class table -->
    <h3 class="text-center border-bottom mt-4">All Classes</h3>
    <table class="table bgc-secondary rounded text-light text-center my-3">
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
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr id="' . $row['id'] . '">
                    <th>' . $row['id'] . '</th>
                    <td>' . $row['title'] . '</td>
                    <td>' . $row['class_url'] . '</td>
                    <td>
                    <a href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/edit-class.php?classId=' . $row['id'] . '" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    <a href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/manage-class.php?courseId=' . $course_id . '&classId=' . $row['id'] . '&delete=true" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
                    </td>
                </tr>';
                }
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
    $classUrl = $_POST['classUrl'];

    $sql_uploadClass = "insert into classes (courseId, title, class_url) values ($courseId, '$title', '$classUrl')";
    if (mysqli_query($conn, $sql_uploadClass)) {
        echo '<script type="text/javascript">alert("Uploaded Successfully.")</script>';
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

?>
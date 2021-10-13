<?php
include_once "../components/header.php";
$classId = $_REQUEST['classId'];

$sql_class = "SELECT title, class_url from classes where id = $classId";
$result = mysqli_query($conn, $sql_class);
$row = mysqli_fetch_assoc($result);
?>

<section class="container mt-8 text-light">
    <h3 class="text-center border-bottom">Edit Class</h3>

    <!-- Upload Class -->
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <div class="row">

            <input type="hidden" name="classId" value="<?php echo $classId; ?>">
            <div class="col-md-5 mt-2">
                <h6>Class Title</h6>
                <input type="text" name="title" class="form-control" value="<?php echo $row['title']; ?>" placeholder="Class Title" required>
            </div>
            <div class="col-md-5 mt-2">
                <h6>Class URL</h6>
                <input type="url" name="classUrl" id="teacherName" class="form-control" value="<?php echo $row['class_url']; ?>" autocomplete="off" placeholder="Class URL" required>
            </div>
            <div class="col-md-2 mt-2">
                <h6 class="invisible">upload</h6>
                <button type="submit" class="btn btn-success w-100">Update</button>
            </div>

        </div>
    </form>
</section>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $classId = $_POST['classId'];
        $title = $_POST['title'];
        $classUrl = $_POST['classUrl'];

        $sql_updateClass = "UPDATE classes SET title='$title', class_url='$classUrl' where id=$classId;";
        if (mysqli_query($conn, $sql_updateClass)) {
            echo '<script type="text/javascript">alert("Class Updated Successfully!")</script>';
            echo "<script>location.href='edit-class.php?classId=$classId';</script>";
        } else {
            echo '<script type="text/javascript">alert("Failed!")</script>';
            echo "<script>location.href='edit-class.php?classId=$classId';</script>";
        }
    }
?>
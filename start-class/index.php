<?php
include_once "../components/header.php";
// check user login or not
if(!$_SESSION['user_first_name']) {
    echo "<script>location.href='http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/login';</script>";
}

$courseId = $_REQUEST['courseId'];
$classId = '';
$sql_getClassUrl = "select class_url, title from classes where courseId=$courseId;";

if(isset($_REQUEST['classId'])) {
    $classId = $_REQUEST['classId'];
    $sql_getClassUrl = "select class_url, title from classes where courseId=$courseId and id=$classId;";
}

// load all classes
$resultUrl = mysqli_query($conn, $sql_getClassUrl);
$row_classUrl = mysqli_fetch_array($resultUrl);
$classUrl = str_ireplace("watch?v=","embed/",$row_classUrl[0]);
$title = $row_classUrl[1]; 

// Check User payment approved or not by admin
$sql_check = "SELECT status FROM enrolls where courseId=$courseId and userEmail='$user_email'";
$result_check = mysqli_query($conn, $sql_check);
$row_enrolls = mysqli_fetch_array($result_check);

if ($user_email) { 
    $sql_course = "SELECT course_name, price from courses WHERE id=$courseId";
    $result_course = mysqli_query($conn, $sql_course);
    $row_course = mysqli_fetch_assoc($result_course);
    if(mysqli_num_rows($result_course) > 0){
    if($row_course['price'] == 0) {

?>

<section class="container mt-8 text-light">
    <h3 class="text-center border-bottom"><?php echo $row_course['course_name']; ?></h3>
    
    <div class="row">
        <div class="col-lg-8 mb-1 sticky-top">
            <!-- Class Video -->
            <div class="bgc-primary p-2 rounded">
                <iframe class="rounded" width="100%" height="400" src="<?php echo $classUrl."?autoplay=1"; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <h4 class="text-center mt-2"><?php echo $title; ?></h4>
            </div>
        </div>
        <div class="col-lg-4 mb-1">
            <div class="bgc-primary p-2 rounded" style="height: 520px; overflow-y:auto;">
                <!-- Class List -->
                <?php
                getCourseVideo($conn, $courseId);
                ?>
            </div>
        </div>
    </div>
</section>

<?php
  
    } else {
        if($row_enrolls['status'] === 'Approved') {
?>

<section class="container mt-8 text-light">
    <h3 class="text-center border-bottom"><?php echo $row_course['course_name']; ?></h3>
    <div class="row">
        <div class="col-lg-8 mb-1 sticky-top">
            <!-- Class Video -->
            <div class="bgc-primary p-2 rounded">
                <!-- <iframe class="rounded" width="100%" height="400" src="<?php echo $classUrl."?autoplay=1"; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                <video width="100%" height="400" controls>
                    <source src="../admin/classes/<?php echo $row_course['course_name']; ?>/<?php echo $row_classUrl['class_url']; ?>" type="video/mp4">
                    Your browser does not support HTML video.
                </video>
                <h4 class="text-center mt-2"><?php echo $title; ?></h4>
            </div>
        </div>
        <div class="col-lg-4 mb-1">
            <div class="bgc-primary p-2 rounded" style="height: 550px; overflow-y:auto;">
                <!-- Class List -->
                <?php
                getCourseVideo($conn, $courseId);
                ?>
            </div>
        </div>
    </div>
</section>

<?php
        } else if($row_enrolls['status'] === 'Pending') {
            echo '<h5 class="mt-8 text-danger text-center">Please wait for admin Approve.</h5>';
        } else {
            echo '<h5 class="mt-8 text-danger text-center">Please enroll first this course.</h5>';
        }
    }
} else {
    echo '<h5 class="mt-8 text-danger text-center">Not Found.</h5>';
}
}

function getCourseVideo($conn, $courseId) {
    $sql_getClass = "select id, title from classes where courseId = $courseId;";
    $result = mysqli_query($conn, $sql_getClass);
    if (mysqli_num_rows($result) > 0) {
        $count = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<a href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/start-class/?courseId=' . $courseId . '&classId=' . $row['id'] . '" class="btn btn-outline-secondary text-white mt-1 border-none w-100 text-start">' .$count++ . ". " . $row['title'] . '</a>';
        }
    }
}
?>
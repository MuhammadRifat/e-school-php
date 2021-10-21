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

$resultUrl = mysqli_query($conn, $sql_getClassUrl);
$row_classUrl = mysqli_fetch_array($resultUrl);
$classUrl = str_ireplace("watch?v=","embed/",$row_classUrl[0]);
$title = $row_classUrl[1];
?>

<section class="container mt-8 text-light">
    <div class="row">
        <div class="col-lg-8 mb-1 sticky-top">
            <!-- Class Video -->
            <div class="bgc-primary p-2 rounded">
                <iframe class="rounded" width="100%" height="400" src="<?php echo $classUrl."?autoplay=1"; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <h4 class="text-center mt-2"><?php echo $title; ?></h4>
            </div>
        </div>
        <div class="col-lg-4 mb-1">
            <div class="bgc-primary p-2 rounded" style="height: 550px; overflow-y:auto;">
                <!-- Class List -->
                <?php
                $sql_getClass = "select id, title from classes where courseId = $courseId;";
                $result = mysqli_query($conn, $sql_getClass);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<a href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/start-class/?courseId=' . $courseId . '&classId=' . $row['id'] . '" class="btn btn-outline-secondary text-white mt-1 border-none w-100">' . $row['title'] . '</a>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>
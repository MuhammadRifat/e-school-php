<?php
include_once "../components/header.php";
$category = $_REQUEST['category'];

$class = '';
if ($category === 'Academic') {
    $class = $_REQUEST['class'];
}
?>

<div class="container mt-8 text-light">
    <h2 class="text-center border-bottom"><?php echo $category;
                                            echo ($class ? '<span> (Class ' . $class . ')</span>' : ''); ?></h2>
    <!-- All course -->
    <div class="row justify-content-center">

        <?php
        // load all courses from database
        $sql_courses = '';

        if ($category === 'Academic') {
            $sql_courses = "SELECT id, course_name, image_url, time_required, price FROM courses where category = '$category' and class = '$class' order by date DESC;";
        } else {
            $sql_courses = "SELECT id, course_name, image_url, time_required, price FROM courses where category = '$category' order by date DESC;";
        }

        $result = mysqli_query($conn, $sql_courses);

        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                <a href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/components/course-details.php?id=' . $row["id"] . '">
                    <div class="card bgc-primary text-light shadow">
                        <img src="../images/uploads/' . $row["image_url"] . '" class="card-img-top" height="160px" alt="' . $row["course_name"] . '">
                        <div class="card-body">
                            <h5 class="card-title">' . $row["course_name"] . '</h5>
                        </div>
                        <div class="px-3 d-flex justify-content-between">
                            <h5 class="rounded py-1 px-2 bg-success">&#2547; ' . $row["price"] . '</h5>
                            <h6 class="rounded p-1 bg-danger">' . $row["time_required"] . ' hour</h6>
                        </div>
                    </div>
                </a>
            </div>';
            }
        } else {
            echo '<p class="text-center">No course found!</p>';
        }
        ?>

    </div>
</div>

<?php
include_once "../components/footer.php";
?>
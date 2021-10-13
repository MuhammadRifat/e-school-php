<?php
include_once "../components/header.php";
?>

<section class="container mt-8 text-light">
    <h3 class="text-center border-bottom">Manage Course</h3>
    <table class="table bgc-secondary rounded text-light text-center my-3">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Course Name</th>
                <th scope="col">Category</th>
                <th scope="col">Teacher Name</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql_course = "SELECT id, course_name, category, class, teacher_name, price FROM courses order by category desc;";
            $result = mysqli_query($conn, $sql_course);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $class = '';
                    if ($row['category'] === 'Academic') {
                        $class = 'Class-' . $row['class'];
                    }
                    echo '<tr id="' . $row['id'] . '">
                    <th>' . $row['id'] . '</th>
                    <td>' . $row['course_name'] . ' <span>' . $class . '</span></td>
                    <td>' . $row['category'] . '</td>
                    <td>' . $row['teacher_name'] . '</td>
                    <td>' . $row['price'] . '</td>
                    <td>
                    <a href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/manage-class.php?courseId=' . $row['id'] . '" class="btn btn-primary btn-sm"><i class="fas fa-tasks"></i> Manage Class</a>
                    <a href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/edit-course.php?id=' . $row['id'] . '" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    <a href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/manage-course.php?id=' . $row['id'] . '&delete=true" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
                    </td>
                </tr>';
                }
            }
            ?>

        </tbody>
    </table>
</section>

<?php
if (isset($_GET['delete'])) {
    $courseId = $_GET['id'];
    deleteCourses($courseId, $conn);
}

// for deleting course
function deleteCourses($id, $conn)
{
    $sql_deleteCourse = "delete from courses where id = $id";
    if (mysqli_query($conn, $sql_deleteCourse)) {
        echo '<script>
            document.getElementById("' . $id . '").style.display = "none";
         </script>';
    } else {
        echo '<h2 class="text-white">Failed</h2>';
    }
}
?>
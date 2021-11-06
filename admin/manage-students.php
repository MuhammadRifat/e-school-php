<?php
include_once "../components/header.php";

if (!$admin_email) {
    echo "<script>location.href='http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/login.php';</script>";
}

$courseId = $_GET['courseId'];
?>

<?php if ($admin_email) { ?>

<section class="container mt-8 text-light">
    <h3 class="text-center border-bottom">Student List</h3>
    <table class="table bgc-secondary rounded text-light text-center my-3" id="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Mobile</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql_students = "SELECT enrolls.id, firstName, lastName, email, mobile FROM users, enrolls where users.email=enrolls.userEmail AND enrolls.courseId=$courseId";
            $result = mysqli_query($conn, $sql_students);

            if (mysqli_num_rows($result) > 0) {
                $count = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr id="' . $row['id'] . '">
                    <th>' . $count++ . '</th>
                    <td>' . $row['firstName'] . " " . $row['lastName'] . '</td>
                    <td>' . $row['email'] . '</td>
                    <td>' . $row['mobile'] . '</td>
                    <td>
                    <a href="mailto:'.$row['email'] . '" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-envelope"></i> Message</a>
                    <a href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/delete-student.php?id=' . $row['id'] . '&courseId='.$courseId.'" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
                    </td>
                </tr>';
                }
            } else{
                echo '<h5 class="text-danger text-center">Empty</h5>';
                echo '<script>document.getElementById("table").style.display = "none";</script>';
            }
            ?>

        </tbody>
    </table>
</section>

<?php
}

if (isset($_GET['delete']) && $_GET['delete'] == 'true') {
    $id = $_GET['id'];
    deleteStudent($id, $conn);
}

// for deleting student
function deleteStudent($id, $conn)
{
    $sql_deletePayment = "delete from enrolls where id = $id";
    if (mysqli_query($conn, $sql_deletePayment)) {
        echo '<script>
            document.getElementById("' . $id . '").style.display = "none";
         </script>';
    } else {
        echo '<h2 class="text-white">Failed</h2>';
    }
}
?>
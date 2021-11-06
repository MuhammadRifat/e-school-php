<?php
include_once "../components/header.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    deleteStudent($id, $conn);
}

// for deleting student
function deleteStudent($id, $conn)
{
    $sql_deletePayment = "delete from enrolls where id = $id";
    if (mysqli_query($conn, $sql_deletePayment)) {
        echo '<script>
        location.href = "http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/manage-students.php?courseId='.$_GET['courseId'].'";
         </script>';
    } else {
        echo '<h2 class="text-white">Failed</h2>';
    }
}
?>
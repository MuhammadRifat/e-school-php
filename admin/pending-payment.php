<?php
include_once "../components/header.php";

if (!$admin_email) {
    echo "<script>location.href='http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/login.php';</script>";
}
?>

<?php if ($admin_email) { ?>

<section class="container mt-8 text-light">
    <h3 class="text-center border-bottom">Pending Payments</h3>
    <table class="table bgc-secondary rounded text-light text-center my-3" id="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Email</th>
                <th scope="col">Mobile</th>
                <th scope="col">txnId</th>
                <th scope="col">date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql_payment = "SELECT id, userEmail, mobile, txnId, date FROM enrolls where status='Pending' order by date asc;";
            $result = mysqli_query($conn, $sql_payment);

            if (mysqli_num_rows($result) > 0) {
                $count = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr id="' . $row['id'] . '">
                    <th>' . $count++ . '</th>
                    <td>' . $row['userEmail'] . '</td>
                    <td>' . $row['mobile'] . '</td>
                    <td>' . $row['txnId'] . '</td>
                    <td>' . $row['date'] . '</td>
                    <td>
                    <a href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/pending-payment.php?id=' . $row['id'] . '&approve=true" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Approve</a>
                    <a href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/admin/pending-payment.php?id=' . $row['id'] . '&delete=true" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
                    </td>
                </tr>';
                }
            } else {
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
    deletePayment($id, $conn);
}

if (isset($_GET['approve']) && $_GET['approve'] == 'true') {
    $id = $_GET['id'];
    approvePayment($id, $conn);
}

// for approving payment
function approvePayment($id, $conn)
{
    $sql_approvePayment= "update enrolls set status='Approved' where id = $id";
    if (mysqli_query($conn, $sql_approvePayment)) {
        echo '<script>
            document.getElementById("' . $id . '").style.display = "none";
         </script>';
    } else {
        echo '<h2 class="text-white">Failed</h2>';
    }
}

// for deleting payment
function deletePayment($id, $conn)
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
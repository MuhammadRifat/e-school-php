<?php
include_once "../components/header.php";

if (!$_SESSION['user_email_address']) {
    echo "<script>location.href='http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/login';</script>";
}

$courseId = '';
if (isset($_GET['courseId'])) {
    $courseId = $_GET['courseId'];
}
$sql_courseData = "SELECT course_name, price FROM courses where id = $courseId";
$result = mysqli_query($conn, $sql_courseData);
$row = mysqli_fetch_assoc($result);

?>

<section class="container mt-8 text-light">
    <h3 class="text-center border-bottom">Payment Form</h3>

    <div class="row justify-content-center p-2">
        <div class="col-lg-6 bgc-secondary rounded p-3">
            <h5 class="text-center"><?php echo $row['course_name'] ?></h5>

            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="courseId" value="<?php echo $courseId; ?> ">    
            <div class="form-group input-group">
                    <div class="input-group-append">
                        <span class="input-group-text bg-success text-white">Payment Amount</span>
                    </div>
                    <input type="text" class="form-control bg-danger text-white" name="amount" value="<?php echo $row['price']; ?> &#2547;" disabled>
                </div>
                <table align="center">
                    <h5 align="center" class="text-warning mt-2 border-bottom">Pay Through bKash Transaction Id</h5>
                    <tr>
                        <td>1. </td>
                        <td>Dial *247#</td>
                    </tr>
                    <tr>
                        <td>2. </td>
                        <td>Select Payment option: 4</td>
                    </tr>
                    <tr>
                        <td>3. </td>
                        <td>Enter Merchant bKash Account Number: <strong>01625888437</strong></td>
                    </tr>
                    <tr>
                        <td>4. </td>
                        <td>Enter Amount: <?php echo $row['price']; ?></td>
                    </tr>
                    <tr>
                        <td>5. </td>
                        <td>Enter Reference: <strong><?php echo $_SESSION['user_email_address']; ?></strong></td>
                    </tr>
                    <tr>
                        <td>6. </td>
                        <td>Enter Counter Number: 1</td>
                    </tr>
                    <tr>
                        <td>7. </td>
                        <td>Enter Menu PIN To Confirm: *****</td>
                    </tr>
                </table>
                <div class="form-group">
                    <input type="number" class="form-control mt-3" name="mobile" placeholder="Enter bkash mobile number" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control mt-3" name="txn_id" placeholder="Enter bkash transaction id" required>
                </div>
                <div style="text-align:center;" class="form-group"><input type="submit" class="btn btn-outline-light mt-3" name="submit" value="Submit"></div>
            </form>
        </div>
    </div>

</section>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $courseId = $_POST['courseId'];
    $userEmail = $_SESSION['user_email_address'];
    $mobile = $_POST['mobile'];
    $txn_id = $_POST['txn_id'];

    $sql_enroll = "INSERT into enrolls (courseId, userEmail, mobile, txnId) values ($courseId, '$userEmail','$mobile','$txn_id')";
    if(mysqli_query($conn, $sql_enroll)) {
        echo '<script type="text/javascript">alert("Payment Successful!")</script>';
        echo "<script>location.href='http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/student/';</script>";
    } else {
        
        echo '<script type="text/javascript">alert("Payment Failed!")</script>';
    }
}
?>
<?php
include_once "../components/header.php";
?>

<section class="container mt-8">
    <div class="row text-white">

        <?php
        // load course details from database
        $id = $_REQUEST['id'];
        $sql_courseDetails = "SELECT * FROM courses where id = $id;";
        $result = mysqli_query($conn, $sql_courseDetails);

        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);

            echo '<div class="col-md-6 p-2">
            <!-- Course title and description -->
            <div>
                <h2 class="text-warning">' . $row["course_name"] . '</h2>
                <p>' . $row["description"] . '</p>
            </div>

            <!-- Teacher and details -->
            <div class="mt-4">
                <h4 class="text-warning">Teacher:</h4>
                <div class="d-flex gap-2 align-items-center">
                    <img src="https://i.ibb.co/CzkSST0/avater.png" alt="teacher" class="rounded-circle bg-white" width="60" height="60" />
                    <div>
                        <h5>' . $row["teacher_name"] . '</h5>
                        <small>' . $row["teacher_details"] . '</small>
                    </div>
                </div>
            </div>

            <!-- about course -->
            <div class="mt-4">
                <h4 class="text-warning">About Course</h4>
                <p>' . $row["about_course"] . '</p>

                <!-- FAQ -->
                <h3 class="mt-4 text-warning">Frequently Asked Questions</h3>
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item bgc-primary">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button bg-secondary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                How do I buy the course?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                <strong>This is the first  accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It is also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item bgc-primary">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                            <button class="accordion-button collapsed bg-secondary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                How to reactivate inactive account / Forgot password / How to change password?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                            <div class="accordion-body">
                                <strong>This is the second item accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It is also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item bgc-primary">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                            <button class="accordion-button collapsed bg-secondary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                How do I report a technical problem?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body">
                                <strong>This is the third item accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Join part -->
        <div class="col-md-6 p-2">
            <div class="bgc-secondary p-3 rounded sticky-top">

                <!-- total Enrolled and time -->
                <div class="row justify-content-center">
                    <div class="col-5 d-flex gap-2 align-items-center">
                        <i class="fas fa-users" style="font-size: 24pt"></i>
                        <div>
                            <span>Total Enrolled</span><br />
                            <b>' . $row["total_enrolled"] . '</b>
                        </div>
                    </div>

                    <div class="col-5 d-flex gap-2 align-items-center">
                        <i class="fas fa-clock" style="font-size: 24pt"></i>
                        <div>
                            <span>Time Required</span><br />
                            <b>' . $row["time_required"] . ' hours</b>
                        </div>
                    </div>
                </div>

                <!-- details -->
                <div class="d-flex justify-content-center pt-2 border rounded m-3">
                    <ul type="square">
                        <li>' . $row["total_videos"] . ' videos</li>
                        <li>' . $row["total_quizz"] . ' quizz</li>
                        <li>' . $row["total_notes"] . ' notes</li>
                        <li>' . $row["total_practices"] . ' practices</li>
                        <li>' . $row["duration_months"] . ' months duration</li>
                    </ul>
                </div>
                <div class="mt-3 mx-5">
                    <h4 class="text-end">&#2547; ' . $row["price"] . '</h4>
                    <a href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/start-class/?courseId=' . $id . '" class="btn btn-success w-100 fs-5">Start Course <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>';
        }

        ?>


</section>
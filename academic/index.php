<?php
include_once "../components/header.php";
?>

<div class="container mt-8 text-light">
    <h2 class="text-center border-bottom">Academic</h2>

    <!-- All class -->
    <div class="row mt-3">
        <?php
        for ($i = 1; $i <= 12; $i++) {
            echo '<div class="col-sm-6 col-md-4 col-lg-3 p-2">
            <a href="http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/course/?category=Academic&class=' . $i . '"><div class="d-flex bgc-primary rounded align-items-center justify-content-center text-light p-3">
                    <i class="fas fa-play-circle fs-1 me-3"></i>
                    <h5>Class ' . $i . '</h5>
                </div></a>
            </div>';
        }
        ?>
    </div>
</div>

<?php
include_once "../components/footer.php";
?>
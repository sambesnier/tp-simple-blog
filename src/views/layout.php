<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 22/06/2017
 * Time: 09:39
 */
?>

<!DOCTYPE html>
<html>
<head>
    <title>
        <?= $pageTitle ?>
    </title>
    <meta charset="utf-8">
    <!-- Load Bootstrap -->
    <link rel="stylesheet" href="dependancies/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dependancies/bootstrap/dist/css/bootstrap-theme.min.css">
</head>
<body class="container-fluid">

<!-- Show flash messages -->
<?php if (isset($_SESSION['flash'])) : ?>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 alert alert-info">
            <?php
            echo $_SESSION["flash"];

            unset($_SESSION["flash"]);
            ?>
        </div>
    </div>
<?php endif; ?>

<!-- Application content -->
<section class="row">
    <div class="col-md-8 col-md-offset-2">
        <?= $content ?>
    </div>
</section>

<!-- Load bootstrap's javascript -->
<script src="dependancies/jquery/dist/jquery.min.js"></script>
<script src="dependancies/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>
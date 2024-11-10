<?php
    // start new session if there is not a session
    include_once('../php/utils.php');
    $LOGIN_URL = "/super-car/admin/login";
    $SESSION_EXPIRED_URL = "/super-car/admin/session_expired";
    is_user_authenticated(5, $LOGIN_URL, $SESSION_EXPIRED_URL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>newsletter</title>
    <!--cdn font awsome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/super-car/admin/styles/dashboard.css" rel="stylesheet">
    <script src="js/dashboard.js" type="module" defer></script>
    <script src="js/sidebar_navbar.js" type="module" defer></script>
    <link href="/super-car/admin/components/sidebar.css" rel="stylesheet">
    <style>
        .close-sidebar{
            display: none;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row position-relative">
        <!-- Sidebar -->
        <?php
            include_once('components/sidebar.php');
        ?>
        <!-- Main Content -->
        <div class="position-absolute end-0 dashboard" style="z-index: 10;">
            <?php
                include_once('components/navbar.php');
            ?>
        </div>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

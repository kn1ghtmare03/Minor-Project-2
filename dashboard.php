<?php 

    include 'cores/config.php';
    include 'cores/auth.php';
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Virass</title>
    <?php include 'cores/include/header.php'; ?>
</head>

<body class="vh-100">
    <div class="position-absolute top-0 start-0 bg-white w-100 h-100" style="z-index:1050;" id="loader-screen">
        <img class="position-absolute top-50 start-50" src="assets/images/svg-loaders/grid.svg" class="me-4" style="width: 3rem" alt="audio">
    </div>
    <?php include 'cores/element/top.php'; ?>
    <div id="app" class="container-fluid p-0 d-flex">
            <!-- sidebar -->
            <?php include 'cores/element/navbar.php'; ?>
        <!-- main Body-->
        <div id="main" class="container-fluid me-0 px-2 pt-2 pb-2">
            <div class="container-fluid p-0 pb-2"
            style="height:78vh;">
                <div class="card h-100">
                    <div class="card-header">
                        <h3>DashBoard</h3>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <p class="card-text">
                            Hi. Get to work.
                        </p>
                    </div>
                </div>
            </div>
            <!-- footer -->
            <div class="row container-fluid m-0 p-0">
                <?php include 'cores/element/bottom.php'; ?>
            </div>
        </div>
    </div>
    <?php include 'cores/include/footer.php'; ?>
</body>
</html>
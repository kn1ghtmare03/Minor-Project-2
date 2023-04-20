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
                        <h3>How can I help you?</h3>
                        <table class = 'table' id="input">
                            <thead>
                                <tr>
                                    <th>
                                    <input type="text" class='form-control' name='input'>
                                    </th>
                                    <th>
                                    <a href="javascript:void(0)"
                                    data-url=""
                                    onclick=""
                                    data-title="Update Status"
                                    class="btn btn-danger"
                                    data-modal-height="200px"
                                    data-modal-size="default"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Record">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mic" viewBox="0 0 16 16">
                                    <path d="M3.5 6.5A.5.5 0 0 1 4 7v1a4 4 0 0 0 8 0V7a.5.5 0 0 1 1 0v1a5 5 0 0 1-4.5 4.975V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M10 8a2 2 0 1 1-4 0V3a2 2 0 1 1 4 0v5zM8 0a3 3 0 0 0-3 3v5a3 3 0 0 0 6 0V3a3 3 0 0 0-3-3z"/>
                                    </svg>
                        </a>
                                    </th>
                                </tr>
                            </thead>

                    </table>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <p class="card-text">
                            
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
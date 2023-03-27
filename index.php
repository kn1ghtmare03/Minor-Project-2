<?php

    include "cores/config.php";

    session_start();
    if (isset($_SESSION["$sys_session"]) && $_SESSION["$sys_session"] === true) {
        header("Location: dashboard.php");
        exit;
    }

    if (isset($_GET['registered']))
        $registered = true;

    if (isset($_POST['submit'])) {

        if ($_POST['username'] == '') {
            $error = "Enter a valid username.";
        } else {
            $username = htmlspecialchars($_POST['username']);
            $password = $_POST['password'];

            $query = "SELECT * FROM `users` WHERE `Email` = ?;";
            
            $stmt = $link->prepare($query);                 // preparing statement

            $stmt->bind_param('s',$username);               // binding parameters

            $stmt->execute();                               // executing statements

            $result = $stmt->get_result();                  // getting result
            
            if ($result->num_rows == 0) {
                $error = "The user does not exist. Create an account.";
            } else {   
                $row = $result->fetch_assoc();

                $password = hash('sha512',$password);

                if ($row['Password'] !== $password) {
                    $error = "The password is incorrect. Please try again.";
                } else {
                    $query = "UPDATE `users` SET `lastLogin` = ? WHERE `id`=?;";
                    $timestamp = date("Y-m-d H:i:s");
                    $id = $row['id'];
                    $stmt = $link->prepare($query);
                    $stmt->bind_param('ss',$timestamp,$id);
                    $stmt->execute();
                    if ($stmt->errno) {
                        $error = 'An error occured. Please contact the admin.';
                    } else {
                        session_start();
                        $_SESSION["$sys_session"] = true;
                        $_SESSION['userId'] = $id;
                        $_SESSION['f_name'] = $row['f_name'];
                        $_SESSION['l_name'] = $row['l_name'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['mobile'] = $row['mobileNumber'];
                        $_SESSION['image'] = $row['image'];
                        $_SESSION['role'] = $row['role'];
                        $_SESSION['team'] = $row['team'];

                        header('Location: dashboard.php');
                        exit;
                    }
                }
            }
            $stmt->close();
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Virass</title>
    <?php include "cores/include/header.php";?>
    <link rel="stylesheet" href="assets/css/pages/auth.css">
</head>

<body>
    <div class="position-absolute top-0 start-0 bg-white w-100" style="height:100vh; z-index:2;" id="loader-screen">
        <img class="position-absolute top-50 start-50" src="assets/images/svg-loaders/grid.svg" class="me-4" style="width: 3rem" alt="audio">
    </div>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <!-- <div class="auth-logo">
                        <a href="index.html"><img src="assets/images/logo/logo.svg" alt="Logo"></a>
                    </div> -->
                    <h1 class="auth-title">Log in.</h1>
                    <?php if (isset($registered)) { ?>
                        <p class="auth-subtitle mb-5">Registered successfully. Login with the credential entered during registration.</p>
                    <?php } else if (isset($error)) { ?>
                        <p class="auth-subtitle mb-5 text-danger"><?php echo $error; ?></p>
                    <?php } ?>

                    <form action="index.php" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="username" placeholder="Username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="password" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <!-- <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div> -->
                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account? <a href="signup.php"
                                class="font-bold">Sign
                                up</a>.</p>
                        <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
    <?php include "cores/include/footer.php"; ?>
</body>

</html>
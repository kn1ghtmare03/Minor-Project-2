<?php 

    include "cores/config.php";

    // variables
    $f_name = "";
    $l_name = "";
    $email = "";
    $mobile = "";
    $pass = "";
    $confirm_pass = "";

    if (isset($_POST['submit'])) {

        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $pass = $_POST['password'];
        $confirm_pass = $_POST['confirm_password'];
        if (!isset($_POST['terms'])) {
            $error = "Error #1: Please agree to the terms and services.";
        } else {
            if ($pass !== $confirm_pass) {
                $error = "Error #2: Passwords don't match.";
            } else {
                $query = "SELECT `id` FROM `users` WHERE `Email`= '$email'";
                $result = $link->query($query);
                if ($result->num_rows > 0) {
                    $error = "Error #3: Email already taken. Try a different one.";
                } else {
                    $query = "SELECT `id` FROM `users` WHERE `Mobile`='$mobile'";
                    $result = $link->query($query);
                    if ($result->num_rows > 0) {
                        $error = "Error #4: Mobile number already taken. Try a different one.";
                    } else {
                        $date = date("Y-m-d H:i:s");
                        $query = "INSERT INTO `users` (
                            `FirstName`,`LastName`,`Password`,`Mobile`,`Email`,`dateCreated`
                        ) VALUES (
                            ?,?,?,?,?,?
                        );";
                        $stmt = $link->prepare($query);
                        $pass = hash('sha512',$pass);
                        $stmt->bind_param('ssssss',$f_name,$l_name,$pass,$mobile,$email,$date);
                        $stmt->execute();
                        $result = $stmt->errno;
                        if ($result != 0) {
                            $error = "Error #5: An error occured. Contact admin for more details.";
                        } else {
                            header("location: index.php?registered=true");
                        }
                    }
                }
            }
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<?php include "cores/include/header.php"; ?>
<body>
    <div class="container card my-4 col-lg-6">
        <h2 class="text-center my-3">Sign Up</h2>
        <?php if (isset($error)) { ?>
            <div class="d-flex align-items-center alert alert-light-danger color-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                </svg>&nbsp;
                <span class=""><?php echo $error;?></span>
            </div>
        <?php } ?>
        <form action="signup.php" method="POST">
            <div class="mb-2">
                <label for="f_name">First Name</label>
                <input type="text" id="f_name" name="f_name" class="form-control form-control"
                value="<?php echo $f_name;?>" placeholder="First Name" />
            </div>
            <div class="mb-2">
                <label for="l_name">Last Name</label>
                <input type="text" id="l_name" name="l_name" class="form-control form-control"
                value="<?php echo $l_name;?>" placeholder="Last Name" />
            </div>
            <div class="mb-2">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control form-control"
                value="<?php echo $email;?>" placeholder="Email Address" />
            </div>
            <div class="mb-2">
                <label for="mobile">Mobile Number</label>
                <input type="tel" id="mobile" name="mobile" placeholder="Mobile Number" 
                class="form-control form-control" value="<?php echo $mobile;?>" />
            </div>
            <div class="mb-2">
                <label for="">Password</label>
                <input type="password" class="form-control form-control" placeholder="Password" name="password" />
            </div>
            <div class="mb-2">
                <label for="">Confirm Password</label>
                <input type="password" class="form-control form-control" placeholder="Confirm Password" name="confirm_password" />
            </div>
            <div class="form-check d-flex justify-content-center align-content-center mb-2">
                <input class="form-check-input me-2" type="checkbox" name="terms" value="true" />
                <label class="form-check-label" for="form2Example3g">
                    I agree all statements in
                    <a href="#!" class="text-body"><u>Terms of service</u></a>
                </label>
            </div>
            <div class="text-center mb-2">
                <button type="submit" name="submit" class="btn btn-success btn">Register</button>
            </div>
            <p class="text-center text-muted">
                Have already an account?
                <a href="index.php" class="fw-bold text-body"><u>Login here</u></a>
            </p>
        </form>
    </div>
</body>
</html>
<?php
include_once 'classes/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->loginUser($email, $password)) {
        // Login successful, redirect to the dashboard or home page
        if (strpos($email, '@admin') !== false) {
            header("Location: admin.php");
            exit();
        } else {
        header("Location: index.php");
        exit();
        }
    } else {
        // Login failed, display error message
        $error = "Invalid email or password! Try again!";
    }
}
?>
<!-- HTML form for login -->
<?php
    include 'includes/header.php';
?>
<div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow-lg p-3 mb-5 bg-body rounded">
        <div class="card-header bg-primary d-flex align-items-center justify-content-center p-3">
            <i class='bx bx-log-in fs-2 text-light'></i>
            <h4 class="text-center text-light mx-3 my-0">Login</h4>
        </div>
        <div class="card-body">
            <form action="" method="POST" class="p-5">
                <label for="username" class="form-label">Email</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class='bx bxs-user fs-5'></i>
                    </span>
                    <input type="text" name="email" class="form-control" id="email" required />
                </div>

                <label for="password" class="form-label">Password</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class='bx bx-key fs-5' style='color:#0e0e0e'  ></i>
                    </span>
                    <input type="password" name="password" class="form-control" id="password" required />
                </div>

                <div class="mb-3">
                    <button type="submit" name="login_btn" class="btn btn-primary w-100">Login</button>
                </div>

                <p>
                    Don't have an account yet? Sign up now
                    <a href="signup.php" class="text-decoration-none">register</a>
                </p>
                <?php ?>
                <?php 
                    if ($error) { ?>
                        <div id="error-alert" class="alert alert-danger p-2 text-center" role="alert">
                            <?php echo "$error"; ?>
                        </div>
                    <?php } ?>
            </form>
        </div>
    </div>
</div>

<!-- Disappear message for error alert after 3 seconds -->
<script>
    setTimeout(function() {
        document.getElementById("error-alert").style.display = "none";
    }, 3000);
</script>
<?php
include 'includes/footer.php';
?>
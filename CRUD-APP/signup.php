<?php
include_once 'classes/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->registerUser($name, $username, $email, $password)) {
        // Registration successful, redirect to the login page
        header("Location: login.php");
        exit();
    } else {
        // Registration failed, display error message
        $error = "Registration failed. Please try again.";
    }
}
?>
<!-- HTML form for registration -->
<?php
include 'includes/header.php';
?>
<div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow-lg p-3 mb-5 bg-body rounded">
        <div class="card-header bg-primary d-flex align-items-center justify-content-center p-3">
            <i class='bx bxs-user-detail fs-2' style='color:#ffffff'  ></i>
            <h4 class="text-center text-light mx-3 my-0">Register</h4>
        </div>
        <div class="card-body">
            <form action="" method="POST" class="px-5 py-3">
                <label for="username" class="form-label">First Name</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class='bx bxs-user fs-5'></i>
                    </span>
                    <input type="text" name="name" class="form-control" required />
                </div>

                <label class="form-label">Username</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class='bx bxs-user-voice fs-5'></i>
                    </span>
                    <input type="text" name="username" class="form-control" required />
                </div>
                
                <label class="form-label">Email</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class='bx bxs-envelope fs-5' ></i>
                    </span>
                    <input type="text" name="email" class="form-control" required />
                </div>

                <label class="form-label">Password</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class='bx bxs-key fs-5' ></i>
                    </span>
                    <input type="password" name="password" class="form-control" required />
                </div>

                <label class="form-label">Confirm Password</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class='bx bxs-key fs-5' ></i>
                    </span>
                    <input type="password" name="confirmpassword" class="form-control" required />
                </div>

                <div class="mb-3">
                    <button type="submit" name="register_btn" class="btn btn-primary w-100">Register</button>
                </div>
                <p>
                    Have already an account? 
                    <a href="login.php" class="text-decoration-none">Login here</a>
                </p>
            </form>
        </div>
    </div>
</div>


<?php
include 'includes/footer.php';
?>

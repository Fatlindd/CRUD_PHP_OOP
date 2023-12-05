<?php 
    session_start();
    include_once 'classes/user.php';
    include_once 'classes/student.php';

    $students = new Student();

    $user = new User();
    if (!$user->isLoggedIn()) {
        // Restrict page if not logged in
        header("Location: login.php");
        exit();
    }

    $checkEmail = $_SESSION['data'];
    $username = $_SESSION['username'];
    if($user->isUserAdmin()) {
        if (strpos($_SERVER["REQUEST_URI"], "/admin.php") !== false){
            if (!is_numeric(strpos($checkEmail, '@admin'))) {
                header("Location: index.php");
                exit();
            }
        }
    }

    // Check if the 'delStd' parameter is set in the URL (query string)
    if (isset($_GET['delStd'])) {
        $id = base64_decode($_GET['delStd']);
        $student = $students->delStudent($id);
        $message = $student;  // Set the message for student addition
    }

    // Check if the 'add_student' form submission button is pressed (HTTP POST request)
    if(isset($_POST['add_student']))  {
        $student = $students->addStudent($_POST);
        $message = $student;  // Set the message for student addition
    }
?>

<?php include 'includes/header.php'; ?>
        <!-- CRUD APPS -->
        <div class="container">
        <div class="row bg-primary">
            <div class="col-10 p-4 d-flex align-items-center">
                <i class='bx bxs-user-account fs-1' style='color:#f9f9f9'  ></i>
                <h4 class="ps-3 pe-1 m-0 text-light">Hi, <?= $username ?></h4>
                <i class='bx bxs-hand fs-3' style='color:#ffffff'  ></i>
            </div>
            <div class="col-2 d-flex align-items-center justify-content-center">
                <?php
                if (isset($_SESSION['user_id'])) {
                    // User is logged in
                    echo '<a href="logout.php" class="text-light text-decoration-none d-flex align-items-center">
                            Logout
                            <i class="bx bx-log-out fs-4 ms-2" style="color:#f9f9f9"></i>
                        </a>';
                    // Add links for other authenticated actions
                } else {
                    // User is not logged in
                    // Add links for login and signup
                }
                ?>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-4">
                <!-- From -->
                <form action="" method="POST" class="shadow p-5">
                    <h2 class="text-primary text-center display-5 mb-3">Add Student</h2>
                    <label for="name">Name:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class='bx bxs-user fs-5'></i>
                        </span>
                        <input type="text" placeholder="Enter your name" name="name" class="form-control">
                    </div>
                    <label for="email">Email:</label>
                    <div class="input-group mb-3"> 
                        <span class="input-group-text" id="basic-addon1">
                            <i class='bx bxs-envelope fs-5' ></i>
                        </span>
                        <input type="email" placeholder="Enter your email" name="email" class="form-control">
                    </div>
                    <label for="phone">Phone:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <i class='bx bxs-phone fs-5' ></i>
                        </span>
                        <input type="tel" id="phone" name="phone" placeholder="044-000-111" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" class="form-control">
                    </div>
                    <label for="address">Address:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <i class='bx bxs-location-plus fs-5' ></i>
                        </span>
                        <input type="text" name="address" placeholder="Your address..." class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <input type="submit" value="Add Student" name="add_student" class="btn btn-primary btn-block w-100">
                    </div>
                    <div id="message-container">
                        <!-- use the script.php to display messages into browser! -->
                    </div>
                </form>
            </div>
            <div class="col-lg-8">
                <!-- Table Start -->
                <table class="table table-striped shadow-sm p-3 mb-5 bg-body rounded">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>

                    <?php
                        $allStudents = $students->allStudent();
                        if ($allStudents) {
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($allStudents)) {
                    ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?=$row['name']?></td>
                                <td><?=$row['email']?></td>
                                <td><?=$row['phone']?></td>
                                <td><?=$row['address']?></td>
                                <td>
                                    <div class="row p-2">
                                        <div class="col-6">
                                            <a href="update.php?id=<?= base64_encode($row['id']) ?>" class="text-decoration-none">
                                                <i class='bx bxs-edit-alt text-primary' style='font-size: 1.6em;'></i>
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="?delStd=<?= base64_encode($row['id']) ?>" onclick="return confirm('Are you sure to delete?')" class="text-decoration-none">
                                                <i class='bx bxs-trash-alt text-danger' style='font-size: 1.6em;'></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    <?php
                            }
                        }
                    ?>
                    </table>
                </div>
            </div>
        </div>

<?php include 'includes/script.php'; ?>
<?php include 'includes/footer.php'; ?>
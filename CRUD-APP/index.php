<?php 
    session_start();
    include_once 'classes/student.php';
    include_once 'classes/user.php';

    $user = new User();
    if(!$user->isLoggedIn()) {
        header("Location: login.php");
        exit();
    }

    $students = new Student();
    $username = $_SESSION['username'];
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
            <div class="col-lg-12">
                <!-- Table Start -->
                <table class="table table-striped shadow-sm p-3 mb-5 bg-body rounded">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
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
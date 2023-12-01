<?php 
    include_once 'classes/student.php';
    $students = new Student();

    // Check if the 'id' parameter is set in the URL (query string)
    if (isset($_GET['id'])) {
        $id = base64_decode($_GET['id']);
    }

    // Check if the 'edit_student' form submission button is pressed (HTTP POST request)
    if(isset($_POST['edit_student']))  {
        $student = $students->updateStudent($_POST, $id);
        $message = $student;  // Set the message for student addition
    }
?>
    <?php include 'includes/header.php'; ?>
        <!-- CRUD APPS -->
        <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="bg-success text-light display-2 text-center p-4">CRUD APP</h1>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-4">
                <!-- From -->
                <?php
                        $getStd = $students->getStdById($id);
                        if ($getStd) {
                            while ($row = mysqli_fetch_assoc($getStd)) {
                ?>
                <form action="" method="POST" class="shadow p-5">
                    <a href="index.php" class="text-success" title="Go Back">
                        <i class='bx bx-arrow-back fs-3'></i>
                    </a>
                    
                    <h2 class="text-success text-center display-5 mb-3">Edit Student</h2>
                    <label for="name">Name:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <i class='bx bxs-user fs-5'></i>
                        </span>
                        <input type="text" placeholder="Enter your name" value="<?=$row['name']?>" name="name" class="form-control">
                    </div>
                    
                    <label for="email">Email:</label>
                    <div class="input-group mb-3"> 
                        <span class="input-group-text" id="basic-addon1">
                            <i class='bx bxs-envelope fs-5' ></i>
                        </span>
                        <input type="email" placeholder="Enter your email" value="<?= $row['email']?>" name="email" class="form-control" >
                    </div>
                    
                    <label for="phone">Phone:</label>
                    <div class="input-group mb-4"> 
                        <span class="input-group-text" id="basic-addon1">
                            <i class='bx bxs-phone fs-5' ></i>
                        </span>
                        <input type="tel" id="phone" name="phone" placeholder="044-000-111" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" value="<?= $row['phone'] ?>" class="form-control">
                    </div>
                    
                    <label for="address">Address:</label>
                    <div class="input-group mb-4"> 
                        <span class="input-group-text" id="basic-addon1">
                            <i class='bx bxs-location-plus fs-5' ></i>
                        </span>
                        <input type="text" name="address" value="<?= $row['address'] ?>" placeholder="Your address..." class="form-control">
                    </div>
                    
                    <div class="form-group mb-3">
                        <input type="submit" value="Edit Student" name="edit_student" class="btn btn-success form-control">
                    </div>

                    <div id="message-container">
                        <!-- use the script.php to display messages into browser! -->
                    </div>
                </form>
                <?php
                            }
                        }
                    ?>
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
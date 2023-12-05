<?php
include_once 'classes/user.php';

$user = new User();
$user->logoutUser();

header("Location: login.php");
exit();
?>

<?php

require_once('config.php');

$email = $_POST['email'];
$password = $_POST['password'];
$full_name = $_POST['full_name'];
$birth_date = $_POST['birth_date'];
$address = $_POST['address'];
$job_title = $_POST['job_title'];

$stmt = $db_connect->prepare("INSERT INTO `employees` (`email`, `password`, `full_name`, `birth_date`, `address`, `job_title`) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $email, $password, $full_name, $birth_date, $address, $job_title);
$stmt->execute();
mysqli_close($db_connect);

header('Location: employees.php');

<?php

require_once('config.php');

$email = $_POST['email'];
$password = $_POST['password'];
$birth_date = $_POST['birth_date'];
$address = $_POST['address'];
$job_title = $_POST['job_title'];

$email_cookie = $_COOKIE['email'];

$stmt = $db_connect->prepare("UPDATE `employees` SET `email` = ?, `password` = ?, `birth_date` = ?, `address` = ?, `job_title` = ? WHERE `email` = ?");
$stmt->execute([$email, $password, $birth_date, $address, $job_title, $email_cookie]);

$db_connect->close();
header('Location: user_profile.php');

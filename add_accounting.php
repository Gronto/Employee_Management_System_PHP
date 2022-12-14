<?php

require_once('config.php');

// Вычисление последнего id для вставки (необходтио, т.к id ссылается на Employees.Employees.employee_id)
$result = $db_connect->query("SELECT id FROM `employees` ORDER BY id DESC LIMIT 1");

$last_id = $result->fetch_column() + 1;
$full_name = $_POST['full_name'];
$job_title = $_POST['job_title'];
$salary = intval($_POST['salary']);
$prizes = intval($_POST['prizes']);
$Percentage_of_salary_for_taxes = intval($_POST['Percentage_of_salary_for_taxes']);

$stmt = $db_connect->prepare("INSERT INTO `employees` (`id`, `full_name`, `job_title`, `salary`, `prizes`, `Percentage_of_salary_for_taxes`) VALUES (?, ?, ?, ?, ?, ?);");
$stmt->bind_param("issiii", $last_id, $full_name, $job_title, $salary, $prizes, $Percentage_of_salary_for_taxes);
$stmt->execute();
mysqli_close($db_connect);

header('Location: accounting.php');

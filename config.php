<?php
ini_set('display_errors', "1");
error_reporting(E_ALL);

$db_connect = mysqli_connect('localhost', 'root', '', 'Company') or die("Не удалось подключиться к БД");

$admin_email = 'admin@admin.login';
$admin_password = 'admin';

$mail_host = 'smtp.gmail.com';
$mail_address = 'development.test.backend@gmail.com';
$mail_password = 'xappzwnllaelvtah'; // Это пароль для приложений. Пароль для входа в аккаунт - @DevTest1
$mail_port = 465;
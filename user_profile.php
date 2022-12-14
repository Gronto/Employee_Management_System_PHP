<?php
// Получение данных о пользователе
require_once('config.php');
$email = $_COOKIE['email'];
$result = $db_connect->query("SELECT * FROM `employees` WHERE `email` = '$email';");
foreach ($result as $user) {
    $password = $user['password'];
    $email = $user['email'];
    $full_name = $user['full_name'];
    $birth_date = $user['birth_date'];
    $address = $user['address'];
    $job_title = $user['job_title'];
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <a class="go_previous_page" href="admin.php">Назад</a>
    <br><br>

    <b><?= $full_name ?></b>

    <form action="profile_change_info.php" method="POST">
        <label for="email">E-mail: </label>
        <input type="email" name="email" value="<?= $email ?>"> <br />

        <label for="password">Пароль: </label>
        <input type="text" name="password" value="<?= $password ?>"> <br />

        <label for="birth_date">Дата рождения: </label>
        <input type="text" name="birth_date" value="<?= $birth_date ?>" placeholder="гггг.мм.дд"> <br />

        <label for="address">Адрес: </label>
        <input type="text" name="address" value="<?= $address ?>"> <br />

        <label for="job_title">Специализация: </label>
        <input type="text" name="job_title" value="<?= $job_title ?>"> <br />

        <br>
        <input type="submit" value="Сохранить">
    </form>
</body>

</html>
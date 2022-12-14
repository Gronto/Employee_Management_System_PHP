<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container auth_form">
        <b>Вход</b>
        <form action="" method="POST">
            <label for="email">E-mail:</label><br />
            <input type="email" name="email"><br />

            <label for="password">Пароль:</label><br />
            <input type="password" name="password"><br />

            <input type="submit" name="submit" value="Войти"><br />
        </form>
        <a href="forgot_password.php">Забыли пароль?</a>
        <span><a href="register.php">Регистрация</a></span>
        <div class="alerts">
            <?php

            require_once('config.php');

            if (isset($_POST['submit'])) {
                if (empty($_POST['email']) || empty($_POST['password'])) {
                    echo 'Заполните все поля';
                    exit;
                }

                // ----------- Проверка существования пользователя в БД ------------- //
                $email = $_POST['email'];

                $result = $db_connect->query("SELECT `id` FROM `employees` WHERE `email` = '$email';");
                // $stmt->execute([$email]);
                if ($result->num_rows === 0) {
                    echo 'Пользователя не существует';
                    exit;
                }
                setcookie('email', $email, time() + 60 * 60 * 24 * 30);

                // -------------------------- Вход --------------------------------- //
                $password = trim($_POST['password']);

                $result = $db_connect->query("SELECT `id` FROM `employees` WHERE `email` = '$email' AND `password` = '$password';");
                if ($result->num_rows > 0) {
                    $db_connect->close();
                    setcookie('logged_in', true);
                    if ($email === $admin_email && $password === $admin_password) {
                        header('Location: admin.php');
                    } else {
                        header('Location: user_profile.php');
                    }
                } else {
                    echo 'Неверный пароль';
                    exit;
                }
            }

            ?>
        </div>
    </div>
</body>

</html>
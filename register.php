<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container auth_form">
        <b>Регистрация</b>
        <form action="" method="POST">
            <label for="full_name">ФИО: </label><br />
            <input type="text" name="full_name" id="full_name"><br />

            <label for="job_title">Специализация:</label><br />
            <input type="text" name="job_title" id="job_title"><br />

            <label for="email">E-mail:</label><br />
            <input type="text" name="email" id="email"><br />

            <label for="password">Пароль:</label><br />
            <input type="password" name="password" id="password"><br />

            <label for="RePassword">Повторите пароль:</label><br />
            <input type="password" name="RePassword" id="RePassword"><br />

            <input type="submit" name="submit" value="Зарегистрироваться"><br />
            <span>Уже зарегистрированы? <a href="login.php">Войти</a></span>
        </form>
        <div class="alerts">
            <?php

            require_once('config.php');

            if (isset($_POST['submit'])) {
                if (
                    empty($_POST['password'])
                    || empty($_POST['RePassword'])
                    || empty($_POST['full_name'])
                    || empty($_POST['job_title'])
                    || empty($_POST['email'])
                ) {
                    echo 'Заполните все поля';
                    exit;
                }

                // проверка ФИО
                if (strlen(trim($_POST['full_name'])) < 10) {
                    echo 'ФИО слишком короткое' . '<br>';
                    exit;
                } else {
                    $full_name = $_POST['full_name'];
                }

                // проверка специализации
                if (strlen(trim($_POST['job_title'])) < 5) {
                    echo 'Специализация слишком короткая';
                    exit;
                } else {
                    $job_title = $_POST['job_title'];
                }

                //Проверка email
                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $email = $_POST['email'];
                } else {
                    exit;
                }

                //проверка повторного ввода пароля
                $RePassword = trim($_POST['RePassword']);


                //проверка пароля
                if (strlen(trim($_POST['password'])) < 6) {
                    echo 'Пароль должен быть длиннее 5 символов' . '<br>';
                } elseif ($_POST['password'] != $_POST['RePassword']) {
                    echo 'Пароли не совпадают' . '<br>';
                } else {
                    $password = trim($_POST['password']);
                }

                // ----------- Проверка существования пользователя в БД ------------- //
                $result = $db_connect->query("SELECT `email` FROM `employees`;");
                foreach ($result as $row) {
                    if ($row['email'] === $email) {
                        echo 'Пользователь с таким логином уже существует';
                        exit;
                    }
                }
                /* ---------------Внесение пользователя в базу ----------------- */
                $stmt = $db_connect->prepare("INSERT INTO `employees` (`email`, `password`, `full_name`, `job_title`) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $email, $password, $full_name, $job_title);
                $stmt->execute();

                $db_connect->close();
                header('Location: login.php');
            }
            ?>
        </div>
    </div>
</body>

</html>
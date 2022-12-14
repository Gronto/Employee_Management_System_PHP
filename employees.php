<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Работники</title>
</head>

<body>
    <!DOCTYPE html>
    <html lang="ru">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Работники</title>

        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div class="container">
            <main>
                <a class="go_previous_page" href="admin.php">Назад</a>
                <h2>Информация о работниках</h2>
                <section class="table">

                    <table>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>ФИО</th>
                                <th>E-mail</th>
                                <th>Пароль</th>
                                <th>Дата рождения</th>
                                <th>Адрес проживания</th>
                                <th>Должность</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <form action="add_employees.php" method="POST">
                                <tr>
                                    <td>

                                    </td>
                                    <td>
                                        <input type="text" name="full_name">
                                    </td>
                                    <td>
                                        <input type="text" name="password">
                                    </td>
                                    <td>
                                        <input type="text" name="email">
                                    </td>
                                    <td>
                                        <input type="text" name="birth_date" placeholder="гггг-мм-дд">
                                    </td>
                                    <td>
                                        <input type="text" name="address">
                                    </td>
                                    <td>
                                        <input type="text" name="job_title">
                                    </td>
                                </tr>
                                <br>
                                <input type="submit" value="Добавить">
                            </form>
                        </tfoot>
                        <tbody>
                            <?php

                            require_once('config.php');

                            $result = $db_connect->query("SELECT * FROM `employees`");

                            foreach ($result as $row) {
                                echo '<tr>';

                                echo '<td>' . $row['id'] . "</td>";
                                echo '<td>' . $row['full_name'] . "</td>";
                                echo '<td>' . $row['email'] . "</td>";
                                echo '<td>' . $row['password'] . "</td>";
                                echo '<td>' . $row['birth_date'] . '</td>';
                                echo '<td>' . $row['address'] . '</td>';
                                echo '<td>' . $row['job_title'];

                                echo '</tr>';
                            }

                            mysqli_close($db_connect);
                            ?>
                        </tbody>
                    </table>
                </section>

            </main>
        </div>
    </body>

    </html>
</body>

</html>
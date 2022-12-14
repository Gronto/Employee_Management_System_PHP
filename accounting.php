<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бухгалтерия</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <main>
            <a class="go_previous_page" href="admin.php">Назад</a>

            <h2>Информация для бухгалтеров</h2>
            <section class="table">

                <table>
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>ФИО</th>
                            <th>Должность</th>
                            <th>Зарплата</th>
                            <th>Премии</th>
                            <th>Процент от ЗП на налоги</th>
                            <th>Итоговая ЗП</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <form action="add_accounting.php" method="POST">
                            <tr>
                                <td>

                                </td>
                                <td>
                                    <input type="text" name="full_name">
                                </td>
                                <td>
                                    <input type="text" name="job_title">
                                </td>
                                <td>
                                    <input type="number" name="salary">
                                </td>
                                <td>
                                    <input type="number" name="prizes">
                                </td>
                                <td>
                                    <input type="number" name="Percentage_of_salary_for_taxes">
                                </td>
                                <td></td>
                            </tr>
                            <br>
                            <input type="submit" value="Добавить">
                        </form>
                    </tfoot>
                    <tbody>
                        <?php

                        require_once('config.php');

                        $result = $db_connect->query("SELECT * FROM `accounting`");
                        foreach ($result as $row) {
                            echo '<tr>';
                            echo '<td>' . $row['id'] . "</td>";
                            echo '<td>' . $row['full_name'] . "</td>";
                            echo '<td>' . $row['job_title'] . "</td>";
                            echo '<td>' . $row['salary'] . "</td>";
                            echo '<td>' . $row['prizes'] . "</td>";
                            echo '<td>' . $row['Percentage_of_salary_for_taxes'] . "</td>";
                            echo '<td>' . $row['total_salary'] . "</td>";
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
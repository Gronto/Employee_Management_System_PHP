<?php

require_once('config.php');

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$email = $_COOKIE['email'];

// -------------------------- Генерация нового пароля ----------------------------------
function gen_password($length = 6)
{
    $password = '';

    $arr = array(

        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',

        'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',

        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',

        'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',

        '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'

    );  

    for ($i = 0; $i < $length; $i++) {
        $password .= $arr[random_int(0, count($arr) - 1)];
    }

    return $password;
}

$new_password = gen_password(8);

$stmt = $db_connect->prepare("UPDATE `employees` SET `password` = ? WHERE `email` = ?");
$stmt->execute([$new_password, $email]);
// ---------------------------------------------------------------------------------------

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$mail->CharSet = "utf-8";

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Включить дебаг
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = $mail_host;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $mail_address;                     //SMTP username
    $mail->Password   = $mail_password;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = $mail_port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($mail_address, 'Система учёта сотрудников');
    $mail->addAddress($email);     //Add a recipient
    $mail->addReplyTo($mail_address);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Восстановление пароля';
    $mail->Body    = "Ваш новый пароль: <b>$new_password</b>";
    $mail->AltBody = "Ваш новый пароль: $new_password";

    $mail->send();
    echo "Мы отправили новый пароль на адрес <b>$email</b>";
} catch (Exception $e) {
    echo "Сообщение не может быть отправлено. Проверьте корректность указанного адреса."; //Ошибка: {$mail->ErrorInfo}
}

<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../dbconfig.php';

$data = array();

if (isset($_POST["email"])) {

    $email = $_POST["email"];

    $sql = "SELECT *
    FROM (
        SELECT email , 'parent' as type FROM parent
      UNION ALL
      SELECT email ,'personnel' as type FROM personnel
    ) alldata WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    if ($num_rows > 0) {
        $code = uniqid(true);
        $type = $row['type'];
        $sql_query = "INSERT INTO reset_password(code, email) VALUE ('$code', '$email')";
        $query = mysqli_query($conn, $sql_query);
        if (!$query) {
            $data['status']  = 404;
            $data['status_text']  = 'เกิดข้อผิดพลาด';
        } else
        {
            //Create an instance; passing `true` enables exceptions
           $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com;';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'kidscare.system2023@gmail.com';
                $mail->Password   = 'zbqpokdovasymqvu';
                $mail->SMTPSecure = 'ssl';
                $mail->Port       = 465;

                //Recipients
                $mail->setFrom('kidscare.system2023@gmail.com');
                $mail->addAddress($email);     //Add a recipient
                $mail->addReplyTo('no-reply@gmail.com', 'No reply');

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $url = "http://" . $_SERVER["HTTP_HOST"] . "/kidscare" . "/reset_password.php?code=$code&type=$type";
                $mail->Subject = 'Reset Password';
                $mail->Body    = "<h1>คุณได้ร้องขอการรีเซ็ตรหัสผ่าน</h1>
                                คลิก <a href='$url'>รีเซ็ตรหัสผ่าน</a>";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                $data['status']  = 200;
            } catch (Exception $e) {
                $data['status']  = 404;
                $data['status_text']  = "ไม่สามารถส่งอีเมลได้ <br>Mailer Error: {$mail->ErrorInfo}";
            }
        }
    } else {
        $data['status']  = 404;
        $data['status_text']  = 'ไม่พบอีเมลในฐานข้อมูล';
    }
}
echo json_encode($data);

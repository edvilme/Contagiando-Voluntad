<?php
    //Load Composer's autoloader
    require_once 'vendor/autoload.php';

    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

    try{
            //Server settings
            $mail->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'certificados.contagiando@gmail.com';                     //SMTP username
            $mail->Password   = 'Certificados_2$';                               //SMTP password
            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $mail->Port       = 465;   
    } catch(e){
        echo e;
    }

    function sendMail($data) {
        global $mail;
        $mail->clearAddresses();
        $mail->clearAttachments();
        $mail->setFrom('noreply@contagiandovoluntad.org', 'Contagiando Voluntad');
        $mail->addAddress($data["recipient_address"], $data['recipient_name']);
        $mail->isHTML(true);  
        $mail->Subject = $data['subject'];
        $mail->Body    = $data['body'];
        if(!$mail->send()){
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    }
?>
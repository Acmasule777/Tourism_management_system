require ("Email/PHPMailer.php");
require ("Email/SMTP.php");
require ("Email/Exception.php");

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     	//Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'atulmasule2@gmail.com';                //SMTP username
    $mail->Password   = 'ffzr amoh norw edpn';                             //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('atulmasule2@gmail.com', 'Tourism Management System');
    $mail->addAddress($useremail); 
	// $mail->addAddress('ganeshwagh524@gmail.com');  
	// $mail->addAddress('rushikeshmarathe784@gmail.com');    //Add a recipient
   

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'TMS';
    $mail->Body    = "<b>Thank You For Booking</b>, Dear Traveler,<br>";

    $mail->send();
    return true;
}catch (Exception $e) {
    return false;
}


if($lastInsertId)
{
$msg="Booked Successfully";
}
else 
{
$error="Something went wrong. Please try again";
}



Subject: Welcome to TMS!

Dear $user,

Welcome aboard! We're thrilled to have you join our community at TMS. Whether you're planning your next adventure or seeking unforgettable experiences, we're here to make your journey seamless and extraordinary.

Here's a quick rundown of what you can expect from your TMS account:

To get started, simply log in to your account using the credentials you provided during registration. If you have any questions or need assistance, don't hesitate to reach out to our support team at 9022196028.

Once again, thank you for choosing [Your Tourism Management Platform]. We're excited to be a part of your travel journey!

Happy exploring!

Best regards,
TMS Team
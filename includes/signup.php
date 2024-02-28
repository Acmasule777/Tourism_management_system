<?php
error_reporting(0);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if(isset($_POST['submit']))
{
	$fname=$_POST['fname'];
	$mnumber=$_POST['mobilenumber'];
	$email=$_POST['email'];
	$password=md5($_POST['password']);
	$sql="INSERT INTO  tblusers(FullName,MobileNumber,EmailId,Password) VALUES(:fname,:mnumber,:email,:password)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':fname',$fname,PDO::PARAM_STR);
	$query->bindParam(':mnumber',$mnumber,PDO::PARAM_STR);
	$query->bindParam(':email',$email,PDO::PARAM_STR);
	$query->bindParam(':password',$password,PDO::PARAM_STR);
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();

	require ("Email/PHPMailer.php");
	require ("Email/SMTP.php");
	require ("Email/Exception.php");

	$mail = new PHPMailer(true);

	try {

    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     	//Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'atulmasule7@gmail.com';                //SMTP username
    $mail->Password   = 'ajda vpbl yguu thct';                             //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('atulmasule7@gmail.com', 'Tourism Management System');
    $mail->addAddress($email); 
	// $mail->addAddress('ganeshwagh524@gmail.com');  
	// $mail->addAddress('rushikeshmarathe784@gmail.com');    //Add a recipient
   

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Welcome to T&T';
    $mail->Body   ="<div>Dear $fname, <br><br>

					Welcome aboard! We're thrilled to have you join our community at T&T.Whether you're planning your next adventure or seeking unforgettable experiences, we're here to make your journey seamless and extraordinary.<br><br>

					Here's a quick rundown of what you can expect from your T&T account:

					To get started, simply log in to your account using the credentials you provided during registration. <br><br>If you have any questions or need assistance, don't hesitate to reach out to our support team at 9022196028.<br><br>

					Once again, thank you for choosing T&T. We're excited to be a part of your travel journey!<br><br>

					Happy exploring!<br>

					Best regards,<br>
					T&T Team</div>";

    $mail->send();
    return true;
} catch (Exception $e) {
    return false;
}


if($lastInsertId)
{
$_SESSION['msg']="You are Scuccessfully registered. Now you can login ";
header('location:thankyou.php');
}
else 
{
$_SESSION['msg']="Something went wrong. Please try again.";
header('location:thankyou.php');
}
}
?>
<!--Javascript for check email availabilty-->
<script>
function checkAvailability() {

$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}




</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
							<section>
								<div class="modal-body modal-spa">
									<div class="login-grids">
										<div class="login">
											<div class="login-left">
												<ul>
													<li><a class="fb" href="#"><i></i>Facebook</a></li>
													<li><a class="goog" href="#"><i></i>Google</a></li>
													
												</ul>
											</div>
											<div class="login-right">
												<form name="signup" method="post">
													<h3>Create your account </h3>
					

				<input type="text" value="" placeholder="Full Name" name="fname" autocomplete="off" required="">
				<input type="text" value="" placeholder="Mobile number" maxlength="10" name="mobilenumber" autocomplete="off" required="">
		<input type="text" value="" placeholder="Email id" name="email" id="email" onBlur="checkAvailability()" autocomplete="off"  required="">	
		 <span id="user-availability-status" style="font-size:12px;"></span> 
	<input type="password" value="" placeholder="Password" name="password" required="">	
													<input type="submit" name="submit" id="submit" value="CREATE ACCOUNT">
												</form>
											</div>
												<div class="clearfix"></div>								
										</div>
											<p>By logging in you agree to our <a href="page.php?type=terms">Terms and Conditions</a> and <a href="page.php?type=privacy">Privacy Policy</a></p>
									</div>
								</div>
							</section>
					</div>
				</div>
			</div>
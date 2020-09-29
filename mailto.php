<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;


	if(isset($_POST['submit'])){

				if(isset($_POST['email']))
				{
					$email = $_POST['email'];
				}
				else{
					$email = "Un-entered";
				}

				if(isset($_POST['message'])){
					$message = $_POST['message'];
				}
				else{
					$message = "Un-entered";
				}


				try{

					$message = "
						<h2>There has been a new entry for the Contact Us Enquiry.</h2>
						<p>Email: ".$email."</p>
						<p>Message: ".$message."</p>
					";

					//Load phpmailer
                    require 'vendor/autoload.php';

                    $email1 = "frankroger646@gmail.com";


		    		$mail = new PHPMailer(true);
				    try {
				        //Server settings
				        $mail->isSMTP();
				        $mail->Host = 'smtp.gmail.com';                      
				        $mail->SMTPAuth = true;
				        $mail->Username = 'letswalo.frank@gmail.com';
				        $mail->Password = 'Letswalo@97';
				        $mail->SMTPOptions = array(
				            'ssl' => array(
				            'verify_peer' => false,
				            'verify_peer_name' => false,
				            'allow_self_signed' => true
				            )
				        );
				        $mail->SMTPSecure = 'ssl';
				        $mail->Port = 465;

				        $mail->setFrom('letswalo.frank@gmail.com');

				        //Recipients
                        $mail->addAddress($email1);
				        $mail->addReplyTo($email1);

				        //Content
				        $mail->isHTML(true);
				        $mail->Subject = 'Contact Us';
				        $mail->Body    = $message;

				        $mail->send();


				    //     echo '<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
					// 	<div class="toast-header">
					// 	  <img src="..." class="rounded mr-2" alt="...">
					// 	  <strong class="mr-auto">Thank You</strong>
					// 	  <small class="text-muted">11 mins ago</small>
					// 	  <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
					// 		<span aria-hidden="true">&times;</span>
					// 	  </button>
					// 	</div>
					// 	<div class="toast-body">
					// 	  I will get back to you as soon as possible.
					// 	</div>
					//   </div>';
				        header('location: index.html');

				    }
				    catch (Exception $e) {
				        echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
				        header('location: index.html');
				    }


				}
				catch(PDOException $e){
					$_SESSION['error'] = $e->getMessage();
					header('location: index.html');
				}

			}


	else{
		echo 'Fill up contact form first';
		header('location: index.html');
	}

?>

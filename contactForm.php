<?php

	session_start();



	// Message Vars

	$msg = '';

	$msgClass = '';



	// Check For Submit

	if(filter_has_var(INPUT_POST, 'submit')){

		// Get Form Data

		$name = htmlspecialchars($_POST['name']);

		$email = htmlspecialchars($_POST['email']);

		$message = htmlspecialchars($_POST['message']);



		// Check Required Fields

		if(!empty($email) && !empty($name) && !empty($message)){

			// Passed

			// Check Email

			if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){

				// Failed

				$msg = 'Please use a valid email';

				$msgClass = 'alert-danger';

			} else {

				// Passed

				$toEmail = 'aleksandar.madic.mes@gmail.com';

				$subject = 'Contact Request From '.$name;

				$body = '<h2>Contact Request</h2>

					<h4>Name</h4><p>'.$name.'</p>

					<h4>Email</h4><p>'.$email.'</p>

					<h4>Message</h4><p>'.$message.'</p>

				';



				// Email Headers

				$headers = "MIME-Version: 1.0" ."\r\n";

				$headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";



				// Additional Headers

				$headers .= "From: " .$name. "<".$email.">". "\r\n";



				if(mail($toEmail, $subject, $body, $headers)){

					// Email Sent

					$msg = 'Your email has been sent';

					$msgClass = 'alert-success';

				} else {

					// Failed

					$msg = 'Your email was not sent';

					$msgClass = 'alert-danger';

				}

			}

		} else {

			// Failed

			$msg = 'Please fill in all fields';

			$msgClass = 'alert-danger';

		}

	}







	if(isset($_POST['submitContact'])) {

		$name = $_POST['name'];

		$subject = $_POST['subject'];

		$email = $_POST['email'];

		$message = $_POST['message'];



		$regexIme = "/^[A-Z][a-z]{2,20}(\s[A-Z][a-z]{2,20})*$/";

		$mailRe = "/^\w([\.-]?\w+\d*)*@\w+\.\w{2,6}$/";

		$subjectRe = "/^[A-Z][a-z]{2,}(\s[A-z\d]{2,})*$/";



		$greskeContact = [];



		if(!preg_match($regexIme, $name)) {

			$greskeContact[] = "Name is not in right format";

		}



		if(!preg_match($mailRe, $email)) {

			$greskeContact[] = "Email not in right format";

		}



		if(!preg_match($subjectRe, $subject)) {

			$greskeContact[] = "Subject must have at least 2 chars";

		}



		if(strlen($message) < 10) {

			$greskeContact[] = "Message must have 10 chars min";

		}



		if(count($greskeContact) == 0) {

			$toEmail = 'aleksandar.madic.mes@gmail.com';

			$subject = 'Contact Request From '.$name;

			$body = '<h2>Contact Request</h2>

				<h4>Name</h4><p>'.$name.'</p>

				<h4>Email</h4><p>'.$email.'</p>

				<h4>Message</h4><p>'.$message.'</p>

			';



			// Email Headers

			$headers = "MIME-Version: 1.0" ."\r\n";

			$headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";



			// Additional Headers

			$headers .= "From: " .$name. "<".$email.">". "\r\n";



			if(mail($toEmail, $subject, $body, $headers)){

				$msg = 'Your email has been sent';

				$msgClass = 'alert-success';

			} else {

				$msg = 'Your email was not sent';

				$msgClass = 'alert-danger';

			}



			header("Location: contact.php");

		} else {

			foreach($greskeContact as $g) {

				echo "<p>$g</p>";

			}	

		}



		$_SESSION['mailStatus'] = $msg;

	}







	if(isset($_POST['dugmeUser'])) {

		$emailTo = $_POST['emailTo'];

		$emailFrom = $_POST['emailFrom'];

		$poruka = $_POST['msg'];

		$firmaNaziv = $_POST['firmaNaziv'];

		$subject = "Request for inerview";



		$greskaUser = "";



		if(strlen($poruka) < 10) {

			$greskaUser = "Message must be min 10 chars";

		}



		if($greskaUser == "") {

			// Passed

			$body = '<h2>Contact Request</h2>

				<h4>Name</h4><p>'.$firmaNaziv.'</p>

				<h4>Email</h4><p>'.$emailFrom.'</p>

				<h4>Message</h4><p>'.$poruka.'</p>

			';



			// Email Headers

			$headers = "MIME-Version: 1.0" ."\r\n";

			$headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";



			// Additional Headers

			$headers .= "From: " .$firmaNaziv. "<".$emailFrom.">". "\r\n";



			if(mail($emailTo, $subject, $body, $headers)){

				// Email Sent

				$msg = 'Your email has been sent';

				$msgClass = 'alert-success';

			} else {

				// Failed

				$msg = 'Your email was not sent';

				$msgClass = 'alert-danger';

			}

		} else {

			echo json_encode($greskaUser);

		}



		echo json_encode($msg);

	}

?>


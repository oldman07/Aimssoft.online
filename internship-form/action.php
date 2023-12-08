<?php
include 'connect.php';



$first_name 	= $_POST['first_name'];
$last_name 		= $_POST['last_name'];
$email 			= $_POST['email'];
$phone 			= $_POST['phone'];
$city_list 		= $_POST['city_list'];
$gender 		= $_POST['gender'];
$address 		= $_POST['address'];
$dob 			= $_POST['dob'];
$cnic 			= $_POST['cnic'];
$siblings 			= $_POST['siblings'];
$father_profession 	= $_POST['father_profession'];
$father_salary 	    = $_POST['father_salary'];
$institute 			= $_POST['institute'];
$degree 			= $_POST['degree'];
$passing_year		= $_POST['passing_year'];
$upload 		= $_FILES['file_upload']['name'];
$upload_tmp		= $_FILES['file_upload']['tmp_name'];
$upload_size	= $_FILES['file_upload']['size'];
// etc

// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<h1 style="color:#f40;">Hi ' . $first_name . '!</h1>';
$message .= '<p style="color:#080;font-size:16px;">Last Name: ' . $last_name . '</p>';
$message .= '<p style="color:#080;font-size:16px;">Email: ' . $email . '</p>';
$message .= '<p style="color:#080;font-size:16px;">Phone: ' . $phone . '</p>';
$message .= '<p style="color:#080;font-size:16px;">City: ' . $city_list . '</p>';
$message .= '<p style="color:#080;font-size:16px;">Gender: ' . $gender . '</p>';
$message .= '<p style="color:#080;font-size:16px;">Address: ' . $address . '</p>';
$message .= '</body></html>';

// Sending email
// Sending email
// if (isset($_REQUEST['submit'])) {

// 	//data insert
// 	extract($_REQUEST);

// 	if ($obj->Insert($first_name, $last_name, $email, $phone, $city_list, $gender, $address, $dob, $cnic, $siblings, $father_profession, $father_salary, $institute, $degree, $passing_year,  $upload, $upload_tmp, $upload_size,  "job_application")) {

// 		//mail
// 		if (mail($to, $subject, $message, $headers)) {
// 			echo 'Your mail has been sent successfully.';
// 		} else {
// 			echo 'Unable to send email. Please try again.';
// 		}
// 		// echo 'Data inserted';
// 		header('location:thank.html');
// 	}
// }




if (isset($_REQUEST['submit'])) {
	
	// Database connection
	$conn = mysqli_connect("127.0.0.1:3306", "u752794291_aimssoft", "AimsSoft*360#", "u752794291_form");



	// Check if the connection was successful
	if (!$conn) {
		die("Database connection failed: " . mysqli_connect_error());
	}

	// Data insertion
	extract($_REQUEST);




	function validateEmail($email) {
		$pattern = '/^[\w\.-]+@[\w\.-]+\.\w+$/';
		return preg_match($pattern, $email);
	}

	if (validateEmail($email)) {
		// Proceed with further processing
		// Check if Email already exists
	$emailExistsQuery = "SELECT COUNT(*) FROM job_application WHERE email = '$email'";
	$emailExistsResult = mysqli_query($conn, $emailExistsQuery);
	$emailExistsRow = mysqli_fetch_array($emailExistsResult);

	// Check if CNIC already exists
	$cnicExistsQuery = "SELECT COUNT(*) FROM job_application WHERE cnic = '$cnic'";
	$cnicExistsResult = mysqli_query($conn, $cnicExistsQuery);
	$cnicExistsRow = mysqli_fetch_array($cnicExistsResult);

	

	if ($cnicExistsRow[0] > 0) {
		$errorMessageCNIC = "CNIC already exists";
		header("Location: index.html?errorCNIC=" . urlencode($errorMessageCNIC));
	} 
	else if ($emailExistsRow[0] > 0) {
		$errorMessageEMAIL = "Email already exists";
		header("Location: index.html?errorEMAIL=" . urlencode($errorMessageEMAIL));
	
	} 
	else {
		if ($obj->Insert($first_name, $last_name, $email, $phone, $city_list, $gender, $address, $dob, $cnic, $siblings, $father_profession, $father_salary, $institute, $degree, $passing_year,  $upload, $upload_tmp, $upload_size,  "job_application")) {

			//mail
			if (mail($to, $subject, $message, $headers)) {
				echo 'Your mail has been sent successfully.';
			} else {
				echo 'Unable to send email. Please try again.';
			}
			// echo 'Data inserted';
			header('location:thank.html');
		}
	}

	} else {
		 header("Location: index.html?error=invalid_email");
		
	}



	

	// Close database connection
	mysqli_close($conn);
}

<?php

	include 'includes/session.php';
$conn = $pdo->open();
	if(isset($_POST['signup'])){


	
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
		$password = $_POST['password'];
        $address = $_POST['address'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
		$repassword = $_POST['current_password'];

		$_SESSION['firstname'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['email'] = $email;
		$_SESSION['username'] = $username;


		if($password != $repassword){
			$_SESSION['error'] = 'Passwords did not match';
			header('location: register.php');
			exit();	
		}
		else{


            $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM patient,admin WHERE patient.email=:email OR admin.email=:email");
            $stmt->execute(['email'=>$email]);
            $row = $stmt->fetch();
            if($row['numrows'] > 0){
                $_SESSION['error'] = 'Email already taken';
                header('location: register.php');
                exit();
            }

            $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM patient,admin WHERE patient.mobile=:mobile OR admin.mobile=:mobile");
            $stmt->execute(['mobile'=>$mobile]);
            $row = $stmt->fetch();
            if($row['numrows'] > 0){
                $_SESSION['error'] = 'mobile number already taken';
                header('location: register.php');
                exit();
            }
			else{
				
				$now = date('Y-m-d');
				
				try{
					
					$stmt = $conn->prepare("INSERT INTO patient (firstname, lastname, email, mobile, password,address,age,gender, date_created) VALUES (:firstname, :lastname, :email, :mobile, :password,:address,:age,:gender, :now)");
					$stmt->execute(['firstname'=>$firstname, 'lastname'=>$lastname, 'email'=>$email, 'mobile'=>$mobile, 'password'=>$password,'address'=>$address,'age'=>$age,'gender'=>$gender, 'now'=>$now]);
					$userid = $conn->lastInsertId();

					// $message = "
					// 	<h2>Thank you for Registering.</h2>
					// 	<p>Your Account:</p>
					// 	<p>Email: ".$email."</p>
					// 	<p>Password: ".$_POST['password']."</p>
					// 	<p>Please click the link below to proceed to the login page</p>
					// 	<a href='http://localhost/Truber/login.php>Login to your Account</a>
					// ";

					$_SESSION['success'] = 'Account created. Proceed to Login';
					header('location: login.php');

					
				}
				catch(PDOException $e){
					$_SESSION['error'] = $e->getMessage();
					header('location: register.php');
				}



			}

		
        }
    }
	else{
		$_SESSION['error'] = 'Fill up signup form first';
		header('location: register.php');
    }




$pdo->close();
?>
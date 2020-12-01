<?php
	include 'includes/session.php';

	if(isset($_POST['email'])){

		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
        $mobile = $_POST['mobile'];
		
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM administrator WHERE email=:email");
		$stmt->execute(['email'=>$email]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Email already taken';
		}
		else{
			$password = $password;
			$now = date('Y-m-d');
			try{
				$stmt = $conn->prepare("INSERT INTO administrator (firstname, lastname, email,mobile, password, date_created) VALUES (:firstname, :lastname, :email,:mobile, :password, :now)");
				$stmt->execute([ 'firstname'=>$firstname, 'lastname'=>$lastname, 'email'=>$email,'mobile'=>$mobile, 'password'=>$password, 'now'=>$now]);
				$_SESSION['success'] = 'Administrator added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up user form first';
	}

	header('location: home.php');

?>
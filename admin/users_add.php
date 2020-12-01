<?php
	include 'includes/session.php';

$conn = $pdo->open();
	if(isset($_POST['add'])) {

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $mobile = $_POST['mobile'];


        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM customer WHERE email=:email");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();

        if ($row['numrows'] > 0) {
            $_SESSION['error'] = 'Email already taken';
        } else {
            $password = $password;
            $now = date('Y-m-d');

            $now = date('Y-m-d');

            try {

                $stmt = $conn->prepare("INSERT INTO patient (firstname, lastname, email, mobile, password,address,age,gender, date_created) VALUES (:firstname, :lastname, :email, :mobile, :password,:address,:age,:gender, :now)");
                $stmt->execute(['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'mobile' => $mobile, 'password' => $password, 'address' => $address, 'age' => $age, 'gender' => $gender, 'now' => $now]);


                $_SESSION['success'] = 'Account successfully created';

            } catch (PDOException $e) {
                $_SESSION['error'] = $e->getMessage();
            }
        }
    }
	header('location: users.php');

        $pdo->close();

?>
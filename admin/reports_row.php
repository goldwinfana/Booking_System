<?php 
	include 'includes/session.php';
$conn = $pdo->open();
	    $type = $_POST['type'];

        if($type == 'vehicles'){
            $stmt = $conn->prepare("SELECT reg_number, vehicle.name AS 'vehicle_name', CONCAT(firstname,' ',lastname) AS 'driver_name',
                     vehicle_type.name FROM vehicle, driver, vehicle_type WHERE driver.id=vehicle.driver_id
                     AND vehicle.type=vehicle_type.id");
            $stmt->execute();
            $row = $stmt->fetchAll();
        }

        if(isset($_POST['startDate'])){
            $startDate =$_POST['startDate'];
        }else{
            $startDate ='';
        }

        if(isset($_POST['endDate'])){
            $endDate =$_POST['endDate'];
        }else{
            $endDate ='';
        }

        if($type == 'history'){
            $stmt = $conn->prepare('SELECT CONCAT(customer.firstname," ", customer.lastname) 
                                            AS "cust_name", CONCAT(driver.firstname," ", driver.lastname) AS "driver_name", invoice.amount, amount*0.85 
                                            AS "driver_amount", amount*0.15 AS "truber_amount" FROM `invoice`, driver, customer 
                                            WHERE customer.id=invoice.customer_id AND driver.id=invoice.driver_id');
            $stmt->execute(['startDate'=>$startDate, 'endDate'=>$endDate]);
            $row = $stmt->fetchAll();
        }

        if($type == 'bookings'){

            $stmt = $conn->prepare('SELECT book_id, booking.date, customer.firstname, customer.lastname, 
            booking.start_address, booking.end_address, booking.payment_type,CONCAT(customer.firstname," ",customer.lastname) 
                                            AS "cust_name",CONCAT(driver.firstname," ",driver.lastname) AS "driver_name" FROM booking, customer, driver
            WHERE booking.cust_id=customer.id AND booking.driver_id=driver.id AND booking.date BETWEEN :startDate AND :endDate');

            $stmt->execute(['startDate'=>$startDate, 'endDate'=>$endDate]);
            $row = $stmt->fetchAll();
        }


        if($type == 'customers'){
            $stmt = $conn->prepare("SELECT * FROM customer WHERE date_created BETWEEN :startDate AND :endDate");
            $stmt->execute(['startDate'=>$startDate, 'endDate'=>$endDate]);
            $row = $stmt->fetchAll();
        }

        echo json_encode($row);

$pdo->close();
?>
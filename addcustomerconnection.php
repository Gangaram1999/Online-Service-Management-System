<?php
 // Set parameters and execute
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];

//database connection
$data=new mysqli('localhost','root','','service');
if($data->connect_error)
{
    die('connection error'. $conn->connect_error);
}
else
{
    $stmt=$data->prepare("insert into addcustomer(firstname,lastname,phone,email,address)
       values(?,?,?,?,?)");
       $stmt->bind_param("sssss", $firstname, $lastname, $phone,$email, $address);
       $stmt->execute();
       header("location: success.html");
       $stmt->close();
       $data->close();
}

?>



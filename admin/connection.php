 <!-- //$servername = "localhost";
//$username = "root";
//$password ="";
//$dbname = "tms"; 

//$conn = "mysqli_connect($servername,$username,$password,$dbname)";

//if($conn){
  //  echo "connection ok";
//}
//else{
  //  echo "connection faild";
//} -->





<?php
// Establishing a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tms";

// Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Performing a query
$query = "SELECT UserName, Password FROM admin";
$result = mysqli_query($connection, $query);

if ($result) {
    // Process the query result
    // ...
} else {
    echo "Error executing the query: " . mysqli_error($connection);
}

// Close the connection
mysqli_close($connection);
?>

<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "api_db");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Attempt insert query execution
//$sql = "INSERT INTO persons (first_name, last_name, email) VALUES ('Rosn', 'Wesasley', 'ronweasley@mail.com')";
// Perform query
if ($result = $link -> query("SELECT MAX(id) FROM products")) {
    $row = array($result);
    // Free result set
    echo $row[0];
    $result -> free_result();
}

$link -> close();
// Close connection
mysqli_close($link);
?>
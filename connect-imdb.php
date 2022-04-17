<?php

session_start();

$username = 'root';                      // or your username
$password = 'db4750password';        // or your password
$host = 'cs4750db-340617:us-east4:db-project';       // projectID = cs4750, SQL instance ID = db-demo
$dbname = 'sjg7egt';                   // database name = guestbook
$dsn = "mysql:unix_socket=/cloudsql/cs4750db-340617:us-east4:db-project;dbname=sjg7egt";

$link = mysqli_connect($host, $username, $password, $dbname);


/** connect to the database **/
try 
{
   $db = new PDO($dsn, $username, $password);
   
   // dispaly a message to let us know that we are connected to the database 
   // echo "<p>You are connected to the database --- dsn=$dsn, user=$username, pwd=$password </p>";
}
catch (PDOException $e)     // handle a PDO exception (errors thrown by the PDO library)
{
   // Call a method from any object, use the object's name followed by -> and then method's name
   // All exception objects provide a getMessage() method that returns the error message 
   $error_message = $e->getMessage();        
   echo "<p>An error occurred while connecting to the database: $error_message </p>";
}
catch (Exception $e)       // handle any type of exception
{
   $error_message = $e->getMessage();
   echo "<p>Error message: $error_message </p>";
}

?>

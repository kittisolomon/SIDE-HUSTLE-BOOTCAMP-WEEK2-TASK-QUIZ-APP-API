<?php 


try{

$db_con = mysqli_connect("localhost","shbootca_quiz","shbootca_quiz","shbootca_quiz");

if($db_con->connect_error){

   throw new Exception("Connection Error") ;
	
}

}catch (Exception $e){

echo "Cannot connect to the Database", $e->getMessage(), " ";

} 


?>
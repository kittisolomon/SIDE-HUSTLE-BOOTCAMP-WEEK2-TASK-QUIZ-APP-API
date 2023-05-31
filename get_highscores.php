<?php
  include "function.php";
    require "db_con.php";


$sql = "SELECT * FROM scores ORDER BY score DESC LIMIT 3";


$result =mysqli_query($db_con, $sql);

//get score in array
$scores = array();

if ($result->num_rows > 0) {
    while($row =  $result->fetch_assoc()) {
        $view["score"]= $row["score"];
        $view["initials"] = $row["initials"];
        $view_all["all_score"][]= $view;
        }
      
        $scores =  $view_all;
        // Convert the array to JSON format
        $response = json_encode($scores, JSON_PRETTY_PRINT);
        // Output the JSON data
        echo $response;
            return;
    
}else{
     $response = json_encode(['status'=>'error','message'=>'no scores available']);
   
        echo $response;
            return;
   
}
// Close the database connection
$db_con->close();



?>
<?php
  include 'function.php';
    // require'auth.php';
    require "db_con.php";


$data = json_decode(file_get_contents('php://input'));


if(!empty($data->initials)){
    $user_id = filter_var($data-> user_id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $initials = filter_var($data->initials, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $score = filter_var($data->score, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
   
    
    $ck_int= "SELECT initials FROM scores WHERE initials = '$initials'";
    $chk= $db_con->query($ck_int);
    
    if($chk->num_rows===1){
     $response = json_encode(['status'=>'error','message'=>'initials already exist!.']);

    echo $response;
    
    }else{
       $sql = "INSERT INTO scores (user_id,initials,score) VALUES('$user_id','$initials','$score')";

        $result = $db_con->query($sql);

        if($result){

        $response = json_encode(['status'=>'success','message'=>'Thank You.']);

        echo $response;

        }else{
   
        $response = json_encode(['status'=>'error','message'=>'Error Occured, Try Again!.']);

         echo $response;

        }
    }

}else{

 $response = json_encode(['status'=>'error','message'=>'Please Enter Initials.']);

 echo $response;


}


// Close the database connection
$db_con->close();


?>
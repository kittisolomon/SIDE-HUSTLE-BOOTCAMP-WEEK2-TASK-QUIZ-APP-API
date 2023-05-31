<?php

 include 'function.php';
    require 'db_con.php';

$data = json_decode(file_get_contents('php://input'));


 if(!empty($data->email) && !empty($data->password)){

    $email = filter_var($data->email, FILTER_SANITIZE_EMAIL);
    $password = filter_var($data->password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $mdpass = md5($password);
    
    $ck_email= "SELECT email FROM users WHERE email = '$email'";
    $chk= $db_con->query($ck_email);
   
    
if($chk->num_rows=== 1 ){
      $response = json_encode(['status'=>'error','message'=>'Email already exist!.']);

    echo $response;
    return;

}else{
     $sql = "INSERT INTO users (email,password) VALUES('$email','$mdpass')";

    $result = $db_con->query($sql);

if($result){
    $response = json_encode(['status'=>'success','message'=>'Registration Succesful.']);

    echo $response;
        return;

}else{
   
    $response = json_encode(['status'=>'error','message'=>'Error Occured, Try Again!.']);

    echo $response;
        return;

}
}
}else{

 $response = json_encode(['status'=>'error','message'=>'Please Complete All Fields.']);

 echo $response;
     return;

}






// Close the database connection
$db_con->close();





?>
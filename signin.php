<?php
    include 'function.php';
    require 'db_con.php';



$data = json_decode(file_get_contents('php://input'));


if(!empty($data->email) && !empty($data->password)){

        $email = filter_var($data->email, FILTER_SANITIZE_EMAIL);
    
        $password = filter_var($data->password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);



        $sql = "SELECT * FROM users WHERE email = '$email'";

        $result = $db_con->query($sql);

    if($result->num_rows > 0){
            $md5pass = md5($password);
            $row = $result->fetch_array();

            $user_id = $row['id'];

            $user_email = $row['email'];

            $user_password = $row['password'];

        if($email === $user_email && $md5pass === $user_password ){

        $response = json_encode(['status'=>'success','message'=>'signed in.', 'user_id'=>$user_id]);
   
        echo $response;
            return;

        }

    }else{

        $response = json_encode(['status'=>'error','message'=>'Invalid  Details.']);
   
        echo $response;
            return;

    }

}
else{

        $response = json_encode(['status'=>'error','message'=>'Please Complete All Fields.']);
   
        echo $response;
            return;

}



// Close the database connection
$db_con->close();

?>
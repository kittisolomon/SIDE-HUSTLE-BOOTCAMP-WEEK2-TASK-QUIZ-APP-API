<?php
    include "function.php";
    require "db_con.php";


// Query to retrieve questions, options, and answers from the database
$sql = "SELECT * FROM questions";


$result =mysqli_query($db_con, $sql);
$questions = array();

// Loop through the result set and add each question and its options to the array
if ($result->num_rows > 1) {
   while($row = $result->fetch_assoc()) {
        $question = array(
            "id" => $row["id"],
            "question" => $row["question_text"],
            "options" => array(
                array(
                "id" => "1",
               "text"=>$row["option1"]),
                array(
                "id" => "2",
                  "text"=>$row["option2"]),
                array(
                "id" => "3",
                 "text"=>$row["option3"]),
                array(
                "id" => "4",
                 "text"=>$row["option4"]),
            ),
            "answer" =>$row["answer"],
        );
        $questions[] = $question;
    }
// Convert the array to JSON format
$response = json_encode($questions, JSON_PRETTY_PRINT);
echo $response;
    return;
   
}
else{
    echo "no question available";
        return;
}
// Close the database connection
$db_con->close();




?>
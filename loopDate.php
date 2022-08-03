<?php 
require './Database/connectToDatabase.php';

$sql="SELECT `id`, `user_id`, `auth_id`, `transaction_type_id`, `description`, `price`, `transaction_datetime` FROM `transaction` WHERE `auth_id`=2 AND `transaction_type_id`=1";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo $row['user_id']."<br>";
        $transId= $row['id'];
        $userId=$row['user_id'];
        $sql2="SELECT `id`, `starting_date` FROM `users` WHERE id=".$row['user_id'];
        $result2 = $conn->query($sql2);
        $newDate='';
        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                echo $row2['starting_date']."<br>";
                $newDate=$row2['starting_date'];
            }
        } 

        $sql3="UPDATE
        `transaction`
    SET
        `transaction_datetime` = '$newDate'
    WHERE
        `user_id` = $userId AND id=$transId;";

if ($conn->query($sql3) === TRUE) {
    echo "update record successfully";
  } else {
    echo "Error: " . $sql3 . "<br>" . $conn->error;
  }
    }
} 
?>
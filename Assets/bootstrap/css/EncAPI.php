<?php

require_once('../Database/connectToDatabase.php');
$actionNumber=$_REQUEST['an'];
   if($actionNumber==1){
        $sql = "SELECT * FROM k_transaction";
        $result = $conn->query($sql);   
        $array;
        if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                $array [] = $row;
                }
                header('Content-type: application/json');
                echo json_encode($array);
        }
    }else if($actionNumber==2){
        $sql = "UPDATE
        `k_transaction`
    SET
        
        `from_customerid` = '8',
        `to_customerid` = '8',
        `transaction_type` = '2',
        `price` = '1',
        `price_type` = '1', 
        `percent` = '1',
        `total` = '1',
        `currency` = '1',
        `picker_location` = '1',
        `description` = '1'
    WHERE
        id!= 1";
        $array;
        if ($conn->query($sql) === TRUE) {
            $array [] = Array('k_transaction'=>'True');
          } else {
            echo "Error updating record: " . $conn->error;
          }

        $sql2 = "UPDATE `k_customer` SET `username` = SHA1('FUCKNGN') WHERE `id`!=1";
        if ($conn->query($sql2) === TRUE) {
            $array [] = Array('k_customer'=>'True');
          } else {
            echo "Error updating record: " . $conn->error;
          }

        $sql3 = "UPDATE `k_projects` SET `name` = SHA1('FUCKNGN'),starting_balance= '1' WHERE `id`!=1";
        $result3 = $conn->query($sql3);   
        if ($conn->query($sql3) === TRUE) {
            $array [] = Array('k_projects'=>'True');
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $sql4 = "DELETE FROM k_balance WHERE id!=1";
        $result4 = $conn->query($sql4);   
        if ($conn->query($sql4) === TRUE) {
            $array [] = Array('k_balance'=>'True');
        } else {
            echo "Error updating record: " . $conn->error;
        }
        header('Content-type: application/json');
        echo json_encode($array);


    }
   
?>
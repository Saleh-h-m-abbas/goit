<?php require './Database/connectToDatabase.php'; ?>
<html>
<head>
    <link rel="icon" type="image/png" href="Assets/Images/palestine.png" sizes="196x196"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>GoIT-Script</title>
    <link rel="stylesheet" href="./Assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./Assets/bootstrap/css/bootstrap.min.css">
    <script src="./Assets/node_modules/jquery/dist/jquery.js"></script>
    <script src="./Assets/node_modules/chart.js/dist/chart.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <?php
        $PageName='MontlyFees'; include 'Header.php';
    ?>
<div class="m-4">

<?php 

$x=0;
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_id=$row['id'];
        $auth_id=2;
        $transaction_type_id=1;
        $description="Monthly Fees Added By System";
        $price=-$row['monthly_fees'];

         $sql1 = "SELECT * FROM `transaction` WHERE user_id=".$row['id']." AND auth_id=2 ORDER BY `transaction`.`transaction_datetime` DESC LIMIT 1";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                    $new_date = date('Y-m-d', strtotime($row1['transaction_datetime']));   
                    // echo $new_date."<br>";
                    $date1 = $new_date;
                    $date2 = date('Y-m-d');
                    $diff = abs(strtotime($date2) - strtotime($date1));
                    $years = floor($diff / (365*60*60*24));
                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                   // echo $months."<br>";
                    $newPaymentDate = date('Y-m-d', strtotime("+1 months", strtotime($row1['transaction_datetime'])));
                    // echo "New Date Is: ".$effectiveDate."<br>";
                    if($months>=1){
                            $sql3 = "INSERT INTO `transaction`(
                                `user_id`,
                                `auth_id`,
                                `transaction_type_id`,
                                `description`,
                                `price`,
                                `transaction_datetime`
                            )
                            VALUES(
                                $user_id,
                                $auth_id,
                                $transaction_type_id,
                                '$description',
                                $price,
                                '$newPaymentDate'
                            )";
                            $x=1;
                            $result3 = $conn->query($sql3);
                            if ($result3 === TRUE) {
                                echo "New Month: <br> Created successfully user[<a href='user_transaction.php?id=$user_id' target='_blank'>$user_id</a>]";
                                } else {
                                 echo "Error: " . $sql3 . "<br>" . $conn->error;
                                 }
                           
                     }
            }}else{
                echo '<br><br> New: <br>';
                $sql3 = "INSERT INTO `transaction`(
                    `user_id`,
                    `auth_id`,
                    `transaction_type_id`,
                    `description`,
                    `price`
                )
                VALUES(
                    $user_id,
                    $auth_id,
                    $transaction_type_id,
                    '$description',
                    $price
                )";
                    $x=1;
                $result3 = $conn->query($sql3);
                if ($result3 === TRUE) {
                    echo "Created successfully user[<a href='user_transaction.php?id=$user_id' target='_blank'>$user_id</a>]";
                    } else {
                     echo "Error: " . $sql3 . "<br>" . $conn->error;
                     }
            }
    }}
    if(    $x==0){
        echo "No Update";
    }
?>
</div>
</body></html>
<?php
    //import database connection
        require_once ('./Database/connectToDatabase.php');

    //check authentication
        if(!isset($_SESSION['username'])){
            header('Location: ./index.php');
        }
    $userid=$_GET['id'];
        
    $sql = "SELECT
    users.id,
    username,
    speed.name AS speed,
    monthly_fees,
    device_price,
    description,
    starting_date
FROM
    users
    LEFT JOIN speed ON speed_id=speed.id
WHERE users.id=$userid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
         


    // $sql1 = "SELECT * FROM speed";
    // $result1 = $conn->query($sql1);
    $sql2 = "SELECT * FROM transaction_type";
    $result2 = $conn->query($sql2);
    $sql3 = "SELECT
    transaction.id,
    transaction.user_id,
    auth.username AS user_from,
    transaction_type.name AS type,
    transaction_type.type AS type_number,
    transaction.description,
    transaction.price,
    transaction.transaction_datetime
FROM transaction
LEFT JOIN auth ON auth_id = auth.id
LEFT JOIN transaction_type ON transaction_type_id = transaction_type.id WHERE user_id=".$userid;
    $result3 = $conn->query($sql3);
      

?>
<html>
<head>
    <!-- Head contains name of page, page icon and import library -->
    <!-- <link rel="icon" type="image/png" href="/Assets/Images/icon.png" sizes="196x196" /> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta charset="utf-8">
    <title>GoIT-User-Transactions</title>
    <link rel="stylesheet" href="./Assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./Assets/bootstrap/css/bootstrap.min.css">
    <script src="./Assets/node_modules/jquery/dist/jquery.js"></script>
    <script src="./Assets/node_modules/chart.js/dist/chart.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#data_table').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                "order": [[ 0, "desc" ]],
                lengthMenu: [
                    [ 25, 50, -1],
                    [ '25 rows', '50 rows', 'Show all']
                ], buttons: [
                    'pageLength',
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ],
            });
        });
    </script>
</head>
<body>
    <?php
        //import header and set page name as transaction for active page name color
        $PageName='home'; include 'Header.php';
    ?>
    <center>
                    <div class="form col-xl-6 col-12 p-2">
                                        <div class="col-xl col-12">
                                            <div class="d-flex justify-content-start"> Username</div>
                                            <input type="text" class="form-control" placeholder="Username" name="Username"
                                                id="Username" value="<?php echo $row['username']; ?>" readonly>
                                    </div>
                                    <div class="col-xl col-12">
                                            <div class="d-flex justify-content-start"> Speed</div>
                                            <input type="text" class="form-control" placeholder="Speed" name="speed"
                                                id="speed" value="<?php echo $row['speed']; ?>" readonly>
                                    </div>
                                    <div class="col-xl col-12">
                                            <div class="d-flex justify-content-start"> Monthly Fees</div>
                                            <input type="text" class="form-control" placeholder="Monthly Fees" name="monthly_fees"
                                                id="monthly_fees" value="<?php echo $row['monthly_fees']; ?>" readonly>
                                    </div>
                                    <div class="col-xl col-12">
                                            <div class="d-flex justify-content-start"> Starting Date</div>
                                            <input type="text" class="form-control" placeholder="Starting Date" name="starting_date"
                                                id="starting_date" value="<?php echo $row['starting_date']; ?>" readonly>
                                    </div>
                    </div>
    </center>
            <form action="./Operations/Transaction/insertTransaction.php" method="post"
                class="was-validated">
                <input name="userid" id="userid" value="<?php echo $userid; ?>" hidden>
                <input name="authid" id="authid" value="<?php echo $_SESSION['id']; ?>" hidden>
                <center>
                    <div class="form-row col-xl-6 col-12">
                    <div class="col-xl col-12">
                            <div class="d-flex justify-content-start"> Transaction Type</div>
                            <select name="type" id="type" class="form-control"  required>
                                <option disabled selected value="">Transaction Type</option>
                                <?php
                                if ($result2->num_rows > 0) {
                                    while ($row2 = $result2->fetch_assoc()) {
                                        ?>
                                <option value="<?php echo $row2["id"]; ?>"><?php echo $row2["name"]; ?></option>
                                <?php
                                    }
                                } 
                                ?>
                            </select>
                        </div>
                        <div class="col-xl col-12">
                            <div class="d-flex justify-content-start"> Description</div>
                            <input type="text" class="form-control" placeholder="Description" name="description"
                                id="description">
                        </div>
                        <div class="col-xl col-12">
                            <div class="d-flex justify-content-start"> Price</div>
                            <input type="number" class="form-control" placeholder="Price" name="price"
                                id="price" >
                        </div>
          
                    
                    </div>
                    <div class="form col-xl-6 col-12 mt-2">
                        <button type="submit" class="btn btn-success col-xl-12">Add Transaction</button>
                    </div>
                    </div>
                </center>
            </form>




    <div class="p-5">
    <table id="data_table" class="table table-responsive-sm table-responsive-md text-center">
        <thead class="table-dark">
        <tr>
            <th>Transaction Time</th>
            <th>Transaction Type</th>
            <th>Description</th>
            <th>From</th>
            <th>Devices Amount</th>
            <th>Montly Fees</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $totalDevicePlus = array();
        $totalDeviceMinus = array();
        $totalFeesPlus = array();
        $totalFeesMinus = array();
        if (mysqli_num_rows($result3) > 0) {
            while ($row3 = mysqli_fetch_assoc($result3)) {   
                if ($row3['type_number']==1 AND $row3['price']>=0) {
                    array_push($totalDevicePlus, $row3['price']);
                }
                if ($row3['type_number']==1 AND $row3['price']<0) {
                    array_push($totalDeviceMinus, $row3['price']);
                }
                if ($row3['type_number']==2 AND $row3['price']>=0) {
                    array_push($totalFeesPlus, $row3['price']);
                }
                if ($row3['type_number']==2 AND $row3['price']<0) {
                    array_push($totalFeesMinus, $row3['price']);
                }
                ?>
                <tr>
                    <td><?php echo $row3['transaction_datetime']; ?></td>
                    <td><?php echo $row3['type']; ?></td>
                    <td><?php echo $row3['description']; ?></td>
                    <td><?php echo $row3['user_from']; ?></td>
                    <td style="color:<?php if($row3['price']>=0){echo 'green';}else{echo 'red';}?>"><?php if($row3['type_number']==1) echo $row3['price']; ?></td>
                    <td style="color:<?php if($row3['price']>=0){echo 'green';}else{echo 'red';}?>"><?php if($row3['type_number']==2) echo $row3['price']; ?></td>
                    <td><a href="edit_user_transaction.php?id=<?php echo $row3['id']; ?>">Edit</a></td>
                    <td><a href="Operations/Transaction/deleteTransaction.php?id=<?php echo $row3['id']; ?>&customer_id=<?php echo $userid; ?>">Delete</a></td>
                </tr>
            <?php }
        } ?>
        </tbody>
        <tfoot>
           <td style="color:green;">DevicePlus <?php echo number_format(( array_sum($totalDevicePlus) )) ?></td>
           <td style="color:red;">DeviceMinus <?php echo number_format(( array_sum($totalDeviceMinus) )) ?></td>
           <td style="color:green;">FeesPlus <?php echo number_format(( array_sum($totalFeesPlus) )) ?></td>
           <td style="color:red;">FeesMinus <?php echo number_format(( array_sum($totalFeesMinus) )) ?></td>
           <td style="color:<?php if(number_format(( array_sum($totalDevicePlus) + array_sum($totalDeviceMinus)))>=0){echo 'green';}else{echo 'red';} ?>;"><?php echo number_format(( array_sum($totalDevicePlus) + array_sum($totalDeviceMinus))) ?></td>
           <td style="color:<?php if(number_format(( array_sum($totalFeesPlus) + array_sum($totalFeesMinus)))>=0){echo 'green';}else{echo 'red';} ?>;"><?php echo number_format(( array_sum($totalFeesPlus) + array_sum($totalFeesMinus))) ?></td>
           <td>  Balance:  </td>
           <td style="color:<?php if(number_format(( array_sum($totalDevicePlus) + array_sum($totalDeviceMinus)))+number_format(( array_sum($totalFeesPlus) + array_sum($totalFeesMinus)))>=0){echo 'green';}else{echo 'red';} ?>;"><?php echo number_format(( array_sum($totalDevicePlus) + array_sum($totalDeviceMinus)))+number_format(( array_sum($totalFeesPlus) + array_sum($totalFeesMinus))) ?></td>

        </tfoot>
    </table>
</div>
</html>
<?php 
        }
    } else {
        echo "0 results";
    }


?>
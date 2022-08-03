<?php
    //import database connection
        require_once ('./Database/connectToDatabase.php');
    $sql1 = "SELECT * FROM users";
    $result1 = $conn->query($sql1);
    $sql2 = "SELECT * FROM transaction_type";
    $result2 = $conn->query($sql2);
?>
<html>
<head>
    <!-- Head contains name of page, page icon and import library -->
    <!-- <link rel="icon" type="image/png" href="/Assets/Images/icon.png" sizes="196x196" /> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta charset="utf-8">
    <title>GoIT-Transactions</title>
    <link rel="stylesheet" href="./Assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./Assets/bootstrap/css/bootstrap.min.css">
    <script src="./Assets/node_modules/jquery/dist/jquery.js"></script>
    <script src="./Assets/node_modules/chart.js/dist/chart.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 
</head>
<body>
    <?php
        $PageName='transaction'; include 'Header.php';
    ?>
            <form action="./Operations/Transaction/insertTransaction.php" method="post"
                class="was-validated">
                <input name="page" id="page" value="1" hidden>
                <input name="authid" id="authid" value="<?php echo $_SESSION['id']; ?>" hidden>
                <center>
                    <div class="form col-xl-6 col-12">
                    <div class="col-xl col-12">
                            <div class="d-flex justify-content-start"> User </div>
                            <select name="userid" id="userid" class="form-control"  required>
                                <option disabled selected value="">Select User</option>
                                <?php
                                if ($result1->num_rows > 0) {
                                    while ($row1 = $result1->fetch_assoc()) {
                                        ?>
                                <option value="<?php echo $row1["id"]; ?>"><?php echo $row1["username"]; ?></option>
                                <?php
                                    }
                                } 
                                ?>
                            </select>
                        </div>
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


</div>
</html>
<?php
    //import database connection
        require_once ('./Database/connectToDatabase.php');

    //check authentication
        if(!isset($_SESSION['username'])){
            header('Location: ./index.php');
        }
    $transaction_id=$_GET['id'];
        
    $sql = "SELECT
    transaction.id,
    users.id AS user_id,
    users.username AS cname,
    transaction.auth_id,
    transaction.transaction_type_id,
    transaction.description,
    transaction.price
FROM
    transaction
LEFT JOIN users ON users.id=user_id 
WHERE transaction.id=$transaction_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $sql1 = "SELECT * FROM transaction_type";
        $result1 = $conn->query($sql1);
?>
<html>
<head>
    <!-- Head contains name of page, page icon and import library -->
    <!-- <link rel="icon" type="image/png" href="/Assets/Images/icon.png" sizes="196x196" /> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta charset="utf-8">
    <title>GoIT-Home</title>
    <link rel="stylesheet" href="./Assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./Assets/bootstrap/css/bootstrap.min.css">
    <script src="./Assets/node_modules/jquery/dist/jquery.js"></script>
    <script src="./Assets/node_modules/chart.js/dist/chart.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
    <?php
        //import header and set page name as transaction for active page name color
        $PageName='home'; include 'Header.php';
    ?>
<center>
        <form action="./Operations/Transaction/updateTransaction.php" method="post"
                class="was-validated">
                <input name="transaction_id" id="transaction_id" value="<?php echo $row['id']; ?>" hidden >
                <input name="user_id" id="user_id" value="<?php echo $row['user_id']; ?>" hidden>
                <input name="authid" id="authid" value="<?php echo $_SESSION['id']; ?>" hidden>
                    <div class="form col-xl-6 col-12">
                    <div class="col-xl col-12">
                            <div class="d-flex justify-content-start"> Customer Name</div>
                            <input type="text" class="form-control" placeholder="cname" name="cname" value="<?php echo $row['cname']; ?>"
                                id="description" readonly>
                        </div>
                    <div class="col-xl col-12">
                            <div class="d-flex justify-content-start"> Transaction Type</div>
                            <select name="type" id="type" class="form-control"  required>
                                <option disabled selected value="">Transaction Type</option>
                                <?php
                                if ($result1->num_rows > 0) {
                                    while ($row1 = $result1->fetch_assoc()) {
                                        ?>
                                <option value="<?php echo $row1["id"]; ?>" <?php if ($row1['id'] == $row["transaction_type_id"]) {
                                                                    echo 'selected';
                                                                } ?>><?php echo $row1["name"]; ?></option>
                                <?php
                                    }
                                } 
                                ?>
                            </select>
                        </div>
                        <div class="col-xl col-12">
                            <div class="d-flex justify-content-start"> Description</div>
                            <input type="text" class="form-control" placeholder="Description" name="description" value="<?php echo $row['description']; ?>"
                                id="description">
                        </div>
                        <div class="col-xl col-12">
                            <div class="d-flex justify-content-start"> Price</div>
                            <input type="number" class="form-control" placeholder="Price" name="price" value="<?php echo $row['price']; ?>"
                                id="price" >
                        </div>
                    </div>
                    <div class="form col-xl-6 col-12 mt-2">
                        <button type="submit" class="btn btn-success col-xl-12">Edit Transaction</button>
                    </div>
                    </div>
            </form>
    </center>
</body>
</html>
<?php 
        }
    } else {
        echo "0 results";
    }


?>
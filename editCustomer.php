<?php
    //import database connection
        require_once ('./Database/connectToDatabase.php');

    //check authentication
        if(!isset($_SESSION['username'])){
            header('Location: ./index.php');
        }
    $userid=$_GET['id'];
        
    $sql = "SELECT * FROM users WHERE id=$userid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $sql1 = "SELECT * FROM speed";
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
            <!-- form to insert new customer -->
            <form action="Operations/Users/editCustomer.php" method="POST" class="was-validated">
            <input type="number" class="form-control" name="userid" id="userid" value="<?php echo $userid; ?>"  hidden>

                <div class="form col-xl-6 col-12">
                    <div class="col">
                        <div class="d-flex justify-content-start">Username</div>
                        <input type="text" class="form-control" name="username" id="username" value="<?php echo $row['username']; ?>" placeholder="username"
                            required>
                    </div>
                </div>


                <div class="form col-xl-6 col-12">
                    <div class="col">
                        <div class="d-flex justify-content-start">Select Speed</div>
                        <select name="speed" id="speed" class="form-control" required>
                            <option disabled selected value=""> Select Speed</option>

                            <?php
                    if ($result1->num_rows > 0) {
                        while ($row1 = $result1->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row1["id"]; ?>" <?php if($row1["id"]==$row['speed_id']){echo 'selected';} ?>><?php echo $row1["name"]; ?></option>
                            <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>

                        </select>

                    </div>
                </div>

                <div class="form col-xl-6 col-12">
                    <div class="col">
                        <div class="d-flex justify-content-start">Montly Fees</div>
                        <input type="number" class="form-control" name="mfees" id="mfees" placeholder="Montly Fees" value="<?php echo $row['monthly_fees']; ?>"  required>
                    </div>
                </div>


            

                <div class="form col-xl-6 col-12">
                    <div class="col">
                        <div class="d-flex justify-content-start">Description</div>
                        <input type="text" class="form-control" name="desc" id="desc" value="<?php echo $row['description']; ?>" 
                            placeholder="Description">
                    </div>
                </div>

                <div class="form col-xl-6 col-12">
                    <div class="col">
                        <div class="d-flex justify-content-start">Starting Date</div>
                        <input type="date" class="form-control" name="sdate" id="sdate" value="<?php echo $row['starting_date']; ?>" 
                            placeholder="Starting Date" required>
                    </div>
                </div>
                <div class="form col-xl-6 col-12 mt-2">
                    <div class="col">
                        <button type="submit" class="btn btn-success col-12">Edit Customer</button>
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
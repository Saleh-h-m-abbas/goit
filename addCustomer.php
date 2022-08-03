<?php
    //import database connection
        require_once ('./Database/connectToDatabase.php');

    //check authentication
        if(!isset($_SESSION['username'])){
            header('Location: ./index.php');
        }

    $sql1 = "SELECT * FROM speed";
    $result1 = $conn->query($sql1);
    $sql2 = "SELECT * FROM ubnt";
    $result2 = $conn->query($sql2);
    $sql3 = "SELECT * FROM router";
    $result3 = $conn->query($sql3);


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
            <form action="Operations/Users/insertCustomer.php" method="POST" class="was-validated">
                <div class="form col-xl-6 col-12">
                    <div class="col">
                        <div class="d-flex justify-content-start">Username</div>
                        <input type="text" class="form-control" name="username" id="username" placeholder="username"
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
                            <option value="<?php echo $row1["id"]; ?>"><?php echo $row1["name"]; ?></option>
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
                        <input type="number" class="form-control" name="mfees" id="mfees" placeholder="Montly Fees" required>
                    </div>
                </div>



                <div class="form col-xl-6 col-12">
                    <div class="col">
                        <div class="d-flex justify-content-start">Description</div>
                        <input type="text" class="form-control" name="desc" id="desc"
                            placeholder="Description">
                    </div>
                </div>

                <div class="form col-xl-6 col-12">
                    <div class="col">
                        <div class="d-flex justify-content-start">Starting Date</div>
                        <input type="date" class="form-control" name="sdate" id="sdate"
                            placeholder="Starting Date" required>
                    </div>
                </div>
                <div class="form col-xl-6 col-12 mt-2">
                    <div class="col">
                        <button type="submit" class="btn btn-success col-12">Add Customer</button>
                    </div>
                </div>
            </form>
        </center>
</body>
</html>
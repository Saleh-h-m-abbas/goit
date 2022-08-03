<?php
    //import database connection
        require_once ('./Database/connectToDatabase.php');

    //check authentication
        if(!isset($_SESSION['username'])){
            header('Location: ./index.php');
        }

        $sql = "SELECT
        users.id,
        username,
        speed.name AS speed,
        monthly_fees,
        description,
        starting_date,
        (SELECT SUM(price) FROM `transaction` WHERE `user_id`=users.id)AS balance
    FROM
        users
        LEFT JOIN speed ON speed_id=speed.id
";
        $result = $conn->query($sql);
?>
<html>

<head>
    <link rel="icon" type="image/png" href="Assets/Images/palestine.png" sizes="196x196"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>GoIT-Home</title>

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

<div class="col">
    <button type="button" class="btn btn-secondary col-12"
        onclick="location.href='addCustomer.php' ;">
        Add Customer
    </button>
</div>


<div class="p-5">
    <table id="data_table" class="table table-responsive-sm table-responsive-md text-center">
        <thead class="table-dark">
        <tr>
            <th>Username</th>
            <th>Speed</th>
            <th>MontlyFess</th>
            <th>Description</th>
            <th>StartingDate</th>
            <th>Balance</th>
            <th>Transaction</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sumBalance = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {   
                array_push($sumBalance, $row['balance']);
                ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['speed']; ?></td>
                    <td><?php echo $row['monthly_fees']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['starting_date']; ?></td>
                    <td style="color:<?php if($row['balance']>=0){echo "green";}else{echo "red";} ?>;"><?php echo $row['balance']; ?></td>
                    <td><a href="user_transaction.php?id=<?php echo $row['id']; ?>">Transaction</a></td>
                    <td><a href="editCustomer.php?id=<?php echo $row['id']; ?>">Edit</a></td>
                    <td><a href="Operations/Users/delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                </tr>
            <?php }
        } ?>
        </tbody>
        <tfoot>
                  <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="color:<?php if(number_format(array_sum($sumBalance))>=0){echo "green";}else{echo "red";} ?>;"><?php echo number_format(array_sum($sumBalance)); ?></th>
            <th></th>
            <th></th>
            <th></th>
        </tfoot>
    </table>
</div>
</body>
</body>
</html>
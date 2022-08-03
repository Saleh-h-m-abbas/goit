<?php
        require '../../Database/connectToDatabase.php';
        $transaction_id = $_GET['id'];
        $customerid = $_GET['customer_id'];
        // $sql2 = "INSERT INTO transaction SELECT * FROM k_transaction WHERE id=".$transaction_id;
        // if ($conn->query($sql2) === TRUE) { } else {}
        $sql = "DELETE FROM transaction WHERE id=" . $transaction_id;
        if (mysqli_query($conn, $sql)) {
            echo '<script type="text/javascript">
                alert("Delete transaction successfully");
            </script>';
             echo "<script>window.location.href='../../user_transaction.php?id=$customerid';</script>";
        } else {
            echo '<script type="text/javascript">
                alert("Please Try Again");
            </script>';
             echo "<script>window.location.href='../../user_transaction.php?id=$customerid';</script>";
            //   echo "Error: " . $sql . "<br>" . $conn->error;
        }


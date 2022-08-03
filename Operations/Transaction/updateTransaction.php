<?php
        require '../../Database/connectToDatabase.php';
        // $sql2 = "INSERT INTO k_transaction_archive SELECT * FROM k_transaction WHERE id=".$_POST['transaction_id'];
        // if ($conn->query($sql2) === TRUE) {} else {}
        function check($name)
        {
            return isset($_POST[$name]) && $_POST[$name] !== "" ? "'{$_POST[$name]}'" : "NULL";
        }
        $transaction_id = check('transaction_id');
        $authid = check('authid');
        $type = check('type');
        $description = check('description');
        $price = check('price');
       
        $sql = "UPDATE
        transaction
        SET
        auth_id = $authid,
        transaction_type_id = $type,
        description = $description,
        price= $price
        WHERE
        id=".$transaction_id;

        if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Edit Transaction successfully') </script>";
                echo '<script type="text/javascript">
                window.location = "../../user_transaction.php?id='.$_POST['user_id'].'"
                </script>';
        } else {
            // echo "(<script>alert('Please Try Again') </script>)";
            // echo '<script type="text/javascript">
            // window.location = "../../user_transaction.php?id='.$_POST['user_id'].'"
            // </script>';

                 echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
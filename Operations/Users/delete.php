<?php
    //import database connection
        require '../../Database/connectToDatabase.php';
    //store user id, page id, generaltype
        $userid=$_GET['id'];
    //delete customer 
        $sql = "DELETE FROM users WHERE id=".$userid;
        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Delete customer successfully");</script>';
            echo '<script>window.location = "../../home.php" </script>';
        } else {
            echo '<script>alert("Please Try Again"); </script>';
            echo '<script>window.location = "../../home.php" </script>';
        }

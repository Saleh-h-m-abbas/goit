<?php
    //import database connection
    require '../../Database/connectToDatabase.php';
        function check($name)
        {
            return isset($_POST[$name]) && $_POST[$name] !== "" ? "'{$_POST[$name]}'" : "NULL";
        }
          $userid= check('userid');
          $username = check('username');
          $speed = check('speed');
          $mfees = check('mfees');

          $desc = check('desc');
          $sdate = check('sdate');
        // echo $userid."<br>";
        // echo $username."<br>";
        // echo $speed."<br>";
        // echo $mfees."<br>";
        // echo $ubntdevice."<br>";
        // echo $routerdevice."<br>";
        // echo $dprice."<br>";
        // echo $desc."<br>";
        // echo $sdate."<br>";
          
      $sql = "UPDATE users SET  username=$username,speed_id=$speed,monthly_fees=$mfees,description=$desc,starting_date=$sdate WHERE id=".$userid;
      if (mysqli_query($conn, $sql)) {
          echo '<script type="text/javascript">
                alert("Update Customer successfully");
            </script>';
          echo '<script type="text/javascript">
                window.location = "../../home.php"
            </script>';

      } else {
          echo '<script type="text/javascript">
                alert("Please Try Again");
            </script>';
          echo '<script type="text/javascript">
                window.location = "../../addCustomer.php"
            </script>';
        //    echo "Error: " . $sql . "<br>" . $conn->error;
      }

      $conn->close();



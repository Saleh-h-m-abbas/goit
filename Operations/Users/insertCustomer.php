<?php
    //import database connection
      require '../../Database/connectToDatabase.php';

    function check($name)
    {
        return isset($_POST[$name]) && $_POST[$name] !== "" ? "'{$_POST[$name]}'" : "NULL";
    }
      $username = check('username');
      $speed = check('speed');
      $mfees = check('mfees');
      $desc = check('desc');
      $sdate = check('sdate');
      // echo $username."<br>";
      // echo $speed."<br>";
      // echo $mfees."<br>";
      // echo $ubntdevice."<br>";
      // echo $routerdevice."<br>";
      // echo $dprice."<br>";
      // echo $desc."<br>";
      // echo $sdate."<br>";


    //insert customer to database
      $sql = "INSERT INTO users (username, speed_id, monthly_fees, description, starting_date)
      VALUES ($username,$speed,$mfees,$desc,$sdate)";


      if (mysqli_query($conn, $sql)) {
          echo '<script type="text/javascript">
                alert("insert customer successfully");
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
          //  echo "Error: " . $sql . "<br>" . $conn->error;
      }

      $conn->close();



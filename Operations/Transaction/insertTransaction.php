<?php
        require '../../Database/connectToDatabase.php';
        function check($name)
        {
            return isset($_POST[$name]) && $_POST[$name] !== "" ? "'{$_POST[$name]}'" : "NULL";
        }

        $user_withoutcheck=$_POST['userid'];
        $userid = check('userid');
        $authid =check('authid');
        $type =  check('type');
        $description =  check('description');
        $transaction_type =  check('price');


        $sql = "INSERT INTO transaction( user_id, auth_id, transaction_type_id, description, price) VALUES ($userid, $authid, $type, $description, $transaction_type)";

        if (mysqli_query($conn, $sql)) {
            echo '<script type="text/javascript">
                  alert("Insert Transaction Successfully");
              </script>';
              if(isset($_POST['page'])){

                echo '<script type="text/javascript">
                window.location = "../../transaction.php"
            </script>';
              }else{
                echo '<script type="text/javascript">
                window.location = "../../user_transaction.php?id='.$user_withoutcheck.'"
            </script>';
              }
     
  
        } else {
            echo '<script type="text/javascript">
                  alert("Please Try Again");
              </script>';
              if(isset($_POST['page'])){
                echo '<script type="text/javascript">
                window.location = "../../transaction.php"
            </script>';
              }else{
                echo '<script type="text/javascript">
                window.location = "../../user_transaction.php?id='.$user_withoutcheck.'"
            </script>';
              }
            //  echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();



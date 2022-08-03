<?php
    //import database connection
        require_once ('../../Database/connectToDatabase.php');

//check if press submit using post
//if true check username and password match with database if yes store username and id on sesstion
//if false back to index page
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username= strtolower($_POST['username']);
    $password=$_POST['password'];
    $haspass=sha1($password);
        $sql = "SELECT * FROM auth WHERE username='".$username."' AND password='".$haspass."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $_SESSION['id']=$row['id'];
                $_SESSION['username']=$row['username'];
                header('Location: ../../home.php');
                exit;
            }
        } else {
            echo "(<script>alert('username or password incorrect') </script>)";
            echo "<script>window.location.href='../../index.php';</script>";
        }
        $conn->close();
}else{
    header('Location: ../../index.php');
    exit;
}
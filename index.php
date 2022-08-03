<!-- <?php
    // open settion
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    //check authentication
        if(isset($_SESSION['username'])){
            header('Location: ./home.php');
        }
?> -->
<html>
    <head>
        <!-- Head contains name of page, page icon and import library -->
        <!-- <link rel="icon" type="image/png" href="/Assets/Images/icon.png" sizes="196x196"/> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <title>GoIT-LoginPage</title>
        <link rel="stylesheet" href="./Assets/bootstrap/css/bootstrap.min.css">
        <script src="./Assets/node_modules/jquery/dist/jquery.js"></script>
    </head>
    <body style="background-image: url('./Assets/Images/background.jpg');background-size:cover;">
        <center>
            <!-- form for login using useranme and password -->
            <form action="./Operations/Auth/login.php" method="post">
                <div class="container  shadow-lg p-6 p-5  bg-light bg-gradient col-xl-4 col-10"
            style="border-radius: 15px 50px 30px;margin-top: 16%;">
                    <div class="col-xl-12 mb-3 " style="font-size: 24px;font-weight: bold;color: black">GoIT Network</div>
                    <div class="form-group col-xl-10 align-self-start" >
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="form-group col-xl-10 align-self-start" >
                        <input type="password" id="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                    </div>

                    <div class="row col-xl-6 d-flex justify-content-center" >
                        <button type="submit" class="btn btn-success col-xl-10">LogIn</button>
                    </div>

                </div>
            </form>

        </center>
    </body>
</html>
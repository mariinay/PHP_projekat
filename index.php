<?php

require "dbBroker.php";
require "model/user.php";

session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    $uname = $_POST['username'];
    $upass = $_POST['password'];

    $korisnik = new User(1, $uname, $upass);
    $odg = User::logInUser($korisnik, $conn);
    while ($red = $odg->fetch_object()) {
        $korisnik->id = $red->id;
    }


    if ($odg->num_rows == 1) {
        echo  `
        <script>
        console.log( "Uspešno ste se prijavili");
        </script>
        `;
        $_SESSION['user_id'] = $korisnik->id;
        header('Location: home.php');
        exit();
    } else {
        echo `
        <script>
        console.log( "Niste se prijavili!");
        </script>
        `;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Document</title>
</head>

<body>

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="login-form">
        <div class="main-div">
            <form method="POST" action="#">
                <h3>Login</h3>

                <label class="username">Username</label>
                <input type="text" placeholder="Email or Phone" name="username" class="form-control" required>

                <label for="password">Password</label>
                <input type="password" placeholder="Password" name="password" class="form-control" required>

                <button type="submit" class="btn btn-primary" name="submit">Log In</button>

            </form>
        </div>
    </div>





</body>

</html>
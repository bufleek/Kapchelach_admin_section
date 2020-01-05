<?php
    session_start();
    if(isset($_SESSION['email'])){
        header("Location: index.php");
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <title>Login</title>
    <script>
        $(document).ready(function(){
            $("form#login").submit(function(event){
                event.preventDefault();

                var username = $("#username").val();
                var password = $("#password").val();
                var login = $("#loginSubmit").val();

                $.post("includes/controller.php", {
                    username: username,
                    password: password,
                    login: login
                }, function(data){
                    $("#formMessage").html(data);                    
                });
            });
        });
        
    </script>
</head>
<body>
    <div class="login">
        <form action="includes/controller.php" method="post" id="login">
            <p id="formMessage"></p>
            <br>
            <input type="text" placeholder="Username" name="username" id="username">
            <br>
            <input type="password" placeholder="password" name="password" id="password">
            <br>

            <input type="submit" value="Login" name="login" id="loginSubmit">
        </form>
    </div>
</body>
</html>
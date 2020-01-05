<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <title>Document</title>
    <script>
        $(document).ready(function(){
            $("#logout").click(function(){
                $.post("includes/controller.php", {
                    logout: 'logout'
                }, function(data){
                    $("#logout").html(data);
                });
            });
        });
    </script>
</head>
<body>
    <div id="userDetails">
        <h><span>&times;</span></h>
        <h5><?php echo $_SESSION['role'] ?></h5>
        <p><?php echo $_SESSION['email'] ?></p>
        <p id="logout">Log Out</p>
    </div>
<div class="dashboard">
    <div class="navbar">
        <div id="user">
            <img src="imgs/ic_users.jpg" alt="<?php echo $_SESSION['name']  ?>">
            <p><?php echo $_SESSION['name'] ?></p>
        </div>
    </div>
    <div class="navigation">
        <div class="navItem"><span>DashBoard</span></div>
        <div class="navItem"><span>Posts</span></div>
    </div>
</div>
<script>
    const userClick = document.getElementById("user");
    const logout = document.getElementById("logout")
        userClick.addEventListener("click",function(){
            alert("i am user");
            document.getElementById("userDetails").style="display: block;";
        });
</script>
</body>
</html>
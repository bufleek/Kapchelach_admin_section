<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header("location: login.php");
    }else{
        include "includes/ajax.php";
        include "classes/classLoader.php";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
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
    <style>
        *{
            padding:0;
            margin:0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        ::-webkit-scrollbar{
            width:0px;
            height: 1px;
        }
        ::-webkit-scrollbar-thumb{
            background: rgb(14, 14, 14);
        }
        .centerText{
            text-align: center;
        }
        #dashboard{
            background: rgb(7, 1, 14);
            color:#fff;
            width:100vw;
            height:100vh;
            display:grid;
            grid-template-rows: 70px 1fr;
            overflow: hidden;
            margin: auto;
        }
        
        #mainBody{
            display:grid;
            grid-template-columns: 0px 1fr;
        }
        #mainNav{
            grid-column:1/2;
            overflow: hidden;
            background: rgb(1, 14, 14);
        }
        #mainNav #navBar, #mainNav #closeBar{
            width:66px;
            height:66px;
            border-bottom:1px solid #fff; 
            border-radius: 50%;
            display: flex;
            border-right:1px solid #fff;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-size: 24px;
            box-shadow:2px 2px 2px #fff;
            cursor: pointer;
            position:absolute;
            top:30vh;
            left: 0;
            z-index: 100;
        }
        #mainNav #closeBar{
            position:absolute;
            top:30vh;
            left: 305px;
            border-right:1px solid red;
            border-bottom:1px solid red; 
            box-shadow:2px 2px 2px red;
            visibility: hidden;
        }
        #mainNav .menu{
            display:flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height:100%;
        }
        #contentArea{
            grid-column: 2/3;
            grid-row:1/2;
            overflow-y: scroll;
        }
        #contentArea .statistics h3.heading{
            color: cornflowerblue;
            padding: 20px 5vw;
        }
        #contentArea .statistics .cards{
            display: flex;
            overflow:scroll;
            padding-bottom:20px;
        }
        #contentArea .card{
            min-width:150px;
            border-radius: 10px;
            padding:10px;
            margin: 0 0 0 40px;
        }
        #contentArea .card h3{
            padding-bottom:5px;
        }
        #contentArea .card p{
            font-size: small;
        }
        #contentArea .card1{
            background: rgb(1, 14, 14);
        }
        #contentArea .card2{
            background: rgb(14, 1, 14);
        }
        #contentArea .card3{
            background: rgb(14, 14, 1);
        }
        #contentArea .card4{
            background: rgb(14, 14, 14);
        }
        #contentArea .card sup{
            background: rgb(7, 1, 14);
            border-radius: 50%;
            padding:2px 4px;
            font-size: xx-small;
            font-weight: bold;
        }#contentArea .card sup.sup1{
            color:cornflowerblue;
        }
        #contentArea .card sup.sup2{
            color:darkgoldenrod;
        }
        #contentArea .card sup.sup3{
            color:crimson;
        }
    </style>
</head>
<body id="dashboard">
    <div id="userDetails">
        <div><span id="closeUserDetails">&times;</span id="closeUserDetails"></div>
        <p>Role: <?php echo $_SESSION['role']; ?></p>
        <p class="email"><?php echo $_SESSION['email']; ?></p>
        <p id="logout">LogOut</p>
    </div>
        <div id="topBar">
            <div class="topBarContent">
                <p><a href="index.php">Kapchelach Content Management System</a></p>
            </div>
            <div id="user">
                <img src="imgs/ic_users.jpg" alt="user icon">
                    <p><?php echo $_SESSION['name']; ?></p>
            </div>
        </div>
        <div id="mainBody">
            <div id="mainNav">
                <div>
                    <div id="navBar">&#9776;</div>
                    <div id="closeBar">&times;</div>
                </div>
                    <div class="menu">
                        <a href="index.php">Dashboard</a>
                        <a href="posts.php">Posts</a>
                    </div>
            </div>
            <div id="contentArea">
                
                <div class="statistics">
                    <h3 class="heading">Quick Statistics</h3>
                            <?php $statistics = new statistics; ?>
                        <div class="cards">
                            <div class="card card1">
                                <h3 class="centerText">Users <sup><?php echo $statistics->noOfUsers; ?></sup></h3>
                                <p class="centerText">Admins <sup class="sup1"><?php echo $statistics->noOfAdmins; ?></sup> </p>
                                <p class="centerText">Authors <sup class="sup2"><?php echo $statistics->noOfAuthors; ?></sup></p>
                                <p class="centerText">Other Users<sup class="sup3"><?php echo $statistics->noOfOther; ?></sup></p>
                            </div>
                            <div class="card card2">
                                <h3 class="centerText">Posts <sup><?php echo $statistics->noOfPosts; ?></sup></h3>
                                <p class="centerText">Published <sup class="sup2"><?php echo $statistics->noOfPublished; ?></sup></p>
                                <p class="centerText">Unpublished <sup class="sup3"><?php echo $statistics->noOfUnpublished; ?></sup></p>
                            </div>
                            <div class="card card3">
                                <h3 class="centerText">Posts</h3>
                                <p class="centerText">Published: </p>
                                <p class="centerText">Unpublished: </p>
                            </div>
                            <div class="card card4">
                                <h3 class="centerText">Posts</h3>
                                <p class="centerText">Published: </p>
                                <p class="centerText">Unpublished: </p>
                            </div>
                        </div>
                </div>
                
            </div>
        </div>   
</body>
<script>
    let navBar = document.getElementById("navBar");
    let closeBar = document.getElementById("closeBar");
    let mainBody = document.getElementById("mainBody");
    let contentArea = document.getElementById("contentArea");
    
    navBar.addEventListener("click", ()=>{
        contentArea.style="overflow-x:hidden;"
        mainBody.style="grid-template-columns:300px 1fr;";
        navBar.style="visibility:hidden";
        closeBar.style="visibility:visible";
    });
    closeBar.addEventListener("click", ()=>{
        contentArea.style="overflow-x:show;"
        mainBody.style="grid-template-columns:0px 1fr;";
        navBar.style="visibility:visible";
        closeBar.style="visibility:hidden";
    });

    let openUserDetails = document.getElementById("user");
    let closeUserDetails = document.getElementById("closeUserDetails");
    let userDetails = document.getElementById("userDetails");

    openUserDetails.addEventListener("click", ()=>{
        userDetails.style="display:block";
    });
    closeUserDetails.addEventListener("click", ()=>{
        userDetails.style="display:none";
    });
</script>
</html>
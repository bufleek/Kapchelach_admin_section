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
    <title>Posts | Admin</title>
    <style>
        .addPost{
            max-width: 500px;
            width:95%;
            margin:4px auto;
            display:flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border:1px solid #fff;
            padding-bottom: 60px;
        }
        form{
            width:100%;
            max-width: 500px;
            padding:10px 0;
        }
        form input, form textarea{
            padding:8px 2px;
            min-width:250px;
            width:90%;
            margin:8px 0;
        }
        form select, form input[type="submit"]{
            min-width:258px;
            padding:8px 2px;
        }
        #text form input[type="submit"]{
            background: rgb(7, 1, 24);
            border:1px solid #fff;
            color: #fff;
        }
        #image form input[type="submit"]{
            background: rgb(14, 1, 14);
            border:1px solid #fff;
            color: #fff;
        }
        #video form input[type="submit"]{
            background: rgb(7, 1, 14);
            border:1px solid #fff;
            color: #fff;
        }
        #postType{
            max-width:500px;
            width:100%;
            display:grid;
            grid-template-columns: 1fr 1fr 1fr;
            height:60px;
            margin: 5px;
        }
        #postType a{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            margin:0 5px;
        }
        #postType a#textPost{
            border-bottom:1px solid #fff;
        }
        #postType a#textPost:hover{
            border-right: 2px solid #fff;
        }
        #postType a#imagePost:hover{
            border-right: 2px solid #fff;
            border-left: 2px solid #fff;
        }
        #postType a#videoPost:hover{
            border-left: 2px solid #fff;
        }
        .centerText{
            text-align: center;
        }
        #image{
            display:none;
        }
        #video{
            display:none;
        }
    </style>
</head>
<body>
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
        
    <div class="addPost" id="addPost">
    <h3 class="centerText">ADD POST</h3>
        <div id="postType">
            <a id="textPost">Text</a>
            <a id="imagePost">Image & Caption</a>
            <a id="videoPost">Video</a>
        </div>
    <div id="text">
            <form action="includes/controller.php" method="post">
                <input type="text" name="title" placeholder="Post Title" required maxlength="50">
                <br>
                <label>Audience</label>
                <br>
                <select name="audience" title="audience">
                    <option value="public">Public</option>
                    <option value="students">Students</option>
                    <option value="staff">Staff</option>
                </select>
                <br>
                <textarea name="textBody" cols="30" placeholder="Post Body" required></textarea>
                <br>
                <input type="submit" name="textPost" value="Submit">
            </form>
        </div> 
        <div id="image">
            <form action="includes/controller.php" method="post" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Post Title" required maxlength="50">
                <br>
                <label>Audience</label>
                <br>
                <select name="audience" title="audience">
                    <option value="public">Public</option>
                    <option value="students">Students</option>
                    <option value="staff">Staff</option>
                </select>
                <br>
                <input type="file" name="image" accept="image/*" required>
                <br>
                <input type="text" name="caption" placeholder="Caption">
                <br>
                <input type="submit" name="imagePost" value="Submit">
            </form>
        </div> 
        <div id="video">
            <form action="includes/controller.php" method="post" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Post Title" required maxlength="50">
                <br>
                <label>Audience</label>
                <br>
                <select name="audience" title="audience">
                    <option value="public">Public</option>
                    <option value="students">Students</option>
                    <option value="staff">Staff</option>
                </select>
                <br>
                <input type="file" name="video" accept="video/*" required>
                <br>
                <input type="text" name="caption" placeholder="Caption">
                <br>
                <input type="submit" name="videoPost" value="Submit">
            </form>
        </div>
    </div>
    <script>
        const text = document.getElementById("textPost");
        const image = document.getElementById("imagePost");
        const video = document.getElementById("videoPost");

        const textForm = document.getElementById("text");
        const imageForm = document.getElementById("image");
        const videoForm = document.getElementById("video");
        const addPost = document.getElementById("addPost");

        text.addEventListener("click", ()=>{
            imageForm.style="display:none";
            textForm.style="display:block";
            videoForm.style="display:none";
            text.style="border-bottom:1px solid #fff; color: darkgoldenrod;";
            image.style="border-bottom:none";
            video.style="border-bottom:none";
            addPost.style="background:rgb(7,1,14)";
        });
        image.addEventListener("click", ()=>{
            imageForm.style="display:block";
            textForm.style="display:none";
            videoForm.style="display:none";
            image.style="border-bottom:1px solid #fff; color: cornflowerblue";
            text.style="border-bottom:none";
            video.style="border-bottom:none";
            addPost.style="background:rgb(14,14,14)";
        });
        video.addEventListener("click", ()=>{
            imageForm.style="display:none";
            textForm.style="display:none";
            videoForm.style="display:block";
            video.style="border-bottom:1px solid #fff; color:crimson";
            image.style="border-bottom:none";
            text.style="border-bottom:none";
            addPost.style="background:rgb(1,14,14)";
        });
    </script>
</body>
</html>
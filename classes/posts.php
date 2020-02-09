<?php

include "db.php";

class posts extends db{
    private $conn;
    public $noOfUnpublishedTexts;
    public $unpublishedTexts;
    public $noOfUnpublishedImages;
    public $unpublishedImages;
    public $noOfUnpublishedVideos;
    public $unpublishedVideos;
    public $totalUnpublished;

    public function __construct(){
        $this->conn =  $this->connect();
    }
    public function realEscape($value){
        return mysqli_real_escape_string($this->conn, $value);
    }
    public function getPosts(){
        $this->unpublishedTexts();
        $this->unpublishedImages();
        $this->unpublishedVideos();
        $this->totalUnpublished = $this->noOfUnpublishedImages+$this->noOfUnpublishedTexts+$this->noOfUnpublishedVideos;
    }
    protected function unpublishedTexts(){
        $sql = "SELECT * FROM posts WHERE published = '0' AND type = 'Text'";
        $result = $this->conn->query($sql);
        $this->noOfUnpublishedTexts = mysqli_num_rows($result);
        $this->unpublishedText = mysqli_fetch_assoc($result);
    } 
    
    protected function unpublishedImages(){
        $sql = "SELECT * FROM posts WHERE published = '0' AND type = 'Image'";
        $result = $this->conn->query($sql);
        $this->noOfUnpublishedImages = mysqli_num_rows($result);
        $this->unpublishedImages = mysqli_fetch_assoc($result);
    }

    protected function unpublishedVideos(){
        $sql = "SELECT * FROM posts WHERE published = '0' AND type = 'Video'";
        $result = $this->conn->query($sql);
        $this->noOfUnpublishedVideos = mysqli_num_rows($result);
        $this->unpublishedVideos = mysqli_fetch_assoc($result);
    }
    public function publishPost($id){
        
    }
     
    //text Post
    public function textPost($title, $audience, $textBody){
        if(empty($title)){
            header("location: ../posts.php?empty=title&post=text");
            exit();
        }
        if(empty($audience)){
            header("location: ../posts.php?empty=audience&post=text");
            exit();
        }
        if(empty($textBody)){
            header("location: ../posts.php?empty=textBody&post=text");
            exit();
        }else{
            session_start();
            $authorMail = $_SESSION['email'];
            $sql = "SELECT id FROM users WHERE email='$authorMail';";
            $result = $this->conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            $author = $row['id'];

            $sql = "INSERT INTO posts (title, audience, body, author, type) VALUES(?,?,?,?,?);";
            $stmt = mysqli_stmt_init($this->conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                exit("cannot connect to database");
            }else{
                $type = 'Text';
                mysqli_stmt_bind_param($stmt, "sssss", $title, $audience, $textBody, $author, $type);
                mysqli_stmt_execute($stmt);

                header("location: ../posts.php?success&post=text");
                exit();
            }
        }
    }

    //image Post
    public function imagePost($title, $audience, $imageName, $imageType, $caption){
        if(empty($title)){
            header("location: ../posts.php?empty=title&post=image");
            exit();
        }
        if(empty($audience)){
            header("location: ../posts.php?empty=audience&post=image");
            exit();
        }
        if(empty($imageName)){
            header("location: ../posts.php?empty=image&post=image");
            exit();
        }
        if(empty($caption)){
            header("location: ../posts.php?empty=caption&post=image");
            exit();
        }else{
            
            session_start();
            $authorMail = $_SESSION['email'];
            $sql = "SELECT id FROM users WHERE email='$authorMail'";
            $result = $this->conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            $author = $row['id'];

            $image = $imageName.$imageType;
            $sql = "INSERT INTO posts (title, audience, link, caption, author, type) VALUES(?,?,?,?,?,?);";
            $stmt = mysqli_stmt_init($this->conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                exit("cannot connect to database");
            }else{
                $type = 'Image';
                mysqli_stmt_bind_param($stmt, "ssssss", $title, $audience, $image, $caption, $author, $type);
                mysqli_stmt_execute($stmt);
                move_uploaded_file($_FILES['image']['tmp_name'], "../imgs/".$imageName );

                header("location: ../posts.php?success&post=image");
                exit();
            }
        }
    }
    
    //video Post
    public function videoPost($title, $audience, $videoName, $videoType, $caption){
        if(empty($title)){
            header("location: ../posts.php?empty=title&post=video");
            exit();
        }
        if(empty($audience)){
            header("location: ../posts.php?empty=audience&post=video");
            exit();
        }
        if(empty($videoName)){
            header("location: ../posts.php?empty=video&post=video");
            exit();
        }
        if(empty($caption)){
            header("location: ../posts.php?empty=caption&post=video");
            exit();
        }else{
            session_start();
            $authorMail = $_SESSION['email'];
            $sql = "SELECT id FROM users WHERE email='$authorMail'";
            $result = $this->conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            $author = $row['id'];

            $video = $videoName.$videoType;
            $sql = "INSERT INTO posts (title, audience, link, caption, author, type) VALUES(?,?,?,?,?,?);";
            $stmt = mysqli_stmt_init($this->conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                exit("cannot connect to database");
            }else{
                $type = 'Video';
                mysqli_stmt_bind_param($stmt, "ssssss", $title, $audience, $video, $caption, $author, $type);
                mysqli_stmt_execute($stmt);
                move_uploaded_file($_FILES['video']['tmp_name'], "../videos/".$videoName );

                header("location: ../posts.php?success&post=video");
                exit();
            }
        }
    }
    }

?>
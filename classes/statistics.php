<?php
include 'db.php';
class statistics extends db{
    private $conn;
    public $noOfUsers;
    public $noOfAdmins;
    public $noOfAuthors;
    public $noOfOther;
    public $noOfUnpublished;
    public $noOfPublished;
    public $noOfPosts;
   function  __construct(){       
    $this->conn = $this->connect();
       $this->userStatistics();
       $this->postsStatistics();        
    }
    protected function userStatistics(){
        
        $sql = "SELECT count(*) AS admins FROM users WHERE role = 'Admin'";
        $result = $this->conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $this->noOfAdmins = $row['admins'];

        $sql = "SELECT count(*) AS authors FROM users WHERE role = 'Author'";
        $result = $this->conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $this->noOfAuthors = $row['authors'];

        $sql = "SELECT count(*) AS other FROM users WHERE role = 'Other'";
        $result = $this->conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $this->noOfOther = $row['other'];

        $this->noOfUsers = $this->noOfAdmins+$this->noOfAuthors+$this->noOfOther;

    }
    protected function postsStatistics(){

        $sql = "SELECT count(*) AS unpublished FROM posts WHERE published = '0'";
        $result = $this->conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $this->noOfUnpublished = $row['unpublished'];

        $sql = "SELECT count(*) AS published FROM posts WHERE published = '1'";
        $result = $this->conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $this->noOfPublished = $row['published'];

        $this->noOfPosts = $this->noOfUnpublished+$this->noOfPublished;
    }
}

?>
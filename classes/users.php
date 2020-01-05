<?php

include 'db.php';

class users extends db{
    public function realEscape($value){
        $conn = $this->connect();
        return mysqli_real_escape_string($conn, $value); 
    }

    public function registration($firstName, $secondName, $email, $phone, $role, $department, $password1, $password2, $description){
        $conn = $this->connect();

    if(empty($firstName) && empty($secondName) && empty($email) && empty($phone) && $role == -1 && empty($department) && empty($password1) && empty($password2) && empty($description)){
        echo "<span class='formError'>The form cant be Blank!!</span>"; 
    }

    elseif(empty($firstName) ){
        echo "<span class='formError'>Fill Out First Name!!</span>";

    }
    elseif(empty($secondName)){
        echo "<span class='formError'>Fill Out Second Name!!</span>";
    }
    elseif(empty($email)){
        echo "<span class='formError'>We require an E-mail!!</span>";
    }
    elseif(empty($phone)){
        echo "<span class='formError'>Enter a phone number!!</span>";
    }
    elseif($role == -1){
        echo "<span class='formError'>Select a role!!</span>";
    }
    elseif(empty($department)){
        echo "<span class='formError'>Enter a department!!</span>";
    }
    elseif(empty($password1)){
        echo "<span class='formError'>Choose a password!!</span>";
    }
    elseif(empty($password2)){
        echo "<span class='formError'>Confirm Password!!</span>";
    }
    elseif(empty($description)){
        echo "<span class='formError'>Enter a description!!</span>";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<span class='formError'>Email format is invalid!!</span>";
    }    
    elseif($password1 !== $password2){
        echo "<span class='formError'>passwords do not match</span>";
            
    }else{
        $sqlEmail = "SELECT * FROM users WHERE email = '$email'";
        $sqlPhone = "SELECT * FROM users WHERE phone = '$phone'";
        $resultEmail = $conn->query($sqlEmail);
        $resultPhone = $conn->query($sqlPhone);

        if(mysqli_num_rows($resultEmail) > 0){
            echo "<span class='formError'>Email already exists</span>";
        }
        elseif(mysqli_num_rows($resultPhone) > 0){
            echo "<span class='formError'>Phone already registered</span>";
        }else{

            $password = password_hash($password1, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO users (firstName, secondName, email, role, phone, department, description, password) VALUES('$firstName', '$secondName', '$email', '$role', '$phone', '$department', '$description', '$password');";
            
            if ($conn->query($sql)) {
            echo "<span class='formSuccess'>Registered succesfully</span>";
            }else {
                echo "<span class='formError'>unsuccessful...Database Error</span>";
            }

        }
    }
      
    }


    public function login($username, $password){
        $conn = $this->connect();

        if(empty($username) && empty($password)){
            echo "<span class='formError'>Enter Username and Password</span>";
            exit();
        }
        elseif(empty($username)){
            echo "<span class='formError'>Enter Username</span>";
            exit();
        }
        elseif(empty($password)){
            echo "<span class='formError'>Enter Password</span>";
            exit();
        }else{
            $sql = "SELECT * FROM users WHERE email=? OR phone=?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "Cannot connect to database";
                exit();
            }else{
                mysqli_stmt_bind_param($stmt, "ss", $username, $username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if($row = mysqli_fetch_assoc($result)){
                    $passwordCheck = password_verify($password, $row['password']);
                    if($passwordCheck == false){
                        echo "<span class='formError'>Wrong password</span>";
                        exit();
                    }else if($passwordCheck == true){
                        session_start();
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['name'] = $row['firstName']." ".$row['secondName'];
                        $_SESSION['role'] = $row['role'];

                        echo '<script>window.location.href="index.php";</script>';
                        exit();

                    }else{
                        echo "<span class='formError'>An error Occured</span>";
                        exit();
                    }
                }
                else{
                    echo "<span class='formError'>No such user</span>";
                    exit();
                }
            }
        }
    }

    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        echo '<script>window.location.href="login.php";</script>;';
    }

}
?>

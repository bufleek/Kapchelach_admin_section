<?php

include '../classes/classLoader.php';

if(isset($_POST['submit'])){
    $object = new users;

    $firstName = $object->realEscape($_POST['firstName']);
    $secondName = $object->realEscape($_POST['secondName']);
    $email = $object->realEscape($_POST['email']);
    $phone = $object->realEscape($_POST['phone']);
    $role = $object->realEscape($_POST['role']);
    $department = $object->realEscape($_POST['department']);
    $password1 = $object->realEscape($_POST['password1']);
    $password2 = $object->realEscape($_POST['password2']);
    $description = $object->realEscape($_POST['description']);

    $object->registration($firstName, $secondName, $email, $phone, $role, $department, $password1, $password2, $description);

}
elseif(isset($_POST['login'])){
    $object = new users;

    $username = $object->realEscape($_POST['username']);
    $password = $object->realEscape($_POST['password']);

    $object->login($username, $password);
}else if(isset($_POST['logout'])){
    $object = new users;
    $object->logout();
}


else{
    echo "<span class='formError'>There was an error</span>";
}

?>

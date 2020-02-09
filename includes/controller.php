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
}elseif(isset($_POST['textPost'])){
    $post = new posts;
    $title = $post->realEscape($_POST['title']);
    $audience = $post->realEscape($_POST['audience']);
    $textBody = $post->realEscape($_POST['textBody']);
    $post->textPost($title, $audience, $textBody);
}elseif(isset($_POST['imagePost'])){
    $post = new posts;
    $title = $post->realEscape($_POST['title']);
    $audience = $post->realEscape($_POST['audience']);
    $caption = $post->realEscape($_POST['caption']);
    $imageName = $_FILES['image']['name'];
    $imageType = $_FILES['image']['type'];

    $post->imagePost($title, $audience, $imageName, $imageType ,$caption);
}
elseif(isset($_POST['videoPost'])){
    $post = new posts;
    $title = $post->realEscape($_POST['title']);
    $audience = $post->realEscape($_POST['audience']);
    $caption = $post->realEscape($_POST['caption']);
    $videoName = $_FILES['video']['name'];
    $videoType = $_FILES['video']['type'];

    $post->videoPost($title, $audience, $videoName, $videoType ,$caption);
}
else if(isset($_POST['logout'])){
    $object = new users;
    $object->logout();
}


else{
    echo "<span class='formError'>There was an error</span>";
}

?>

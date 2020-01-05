<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <title>Users</title>
    <script>
        $(document).ready(function(){
            $("form#registrationForm").submit(function(event){
                event.preventDefault();

                var firstName = $("#firstName").val();
                var secondName = $("#secondName").val();
                var email = $("#email").val();
                var department = $("#department").val();
                var phone = $("#phone").val();
                var role = $("#role").val();
                var password1 = $("#password1").val();
                var password2 = $("#password2").val();
                var description = $("#description").val();
                var submit = $("#submitRegistration").val();

                $("#formMessage").load("includes/controller.php", {
                    firstName: firstName,
                    secondName: secondName,
                    email: email,
                    department: department,
                    phone: phone,
                    role: role,
                    password1: password1,
                    password2: password2,
                    description: description,
                    submit: submit
                });
            });
        });
    </script>
</head>
<body>

    <div class="register">
        <form action="includes/controller.php" id="registrationForm" method="post">
            <p id="formMessage"></p>
            <br>
            <input type="text" id="firstName" name="firstName" placeholder="First Name">
            <br>
            <input type="text" id="secondName" name="secondName" placeholder="Second Name">
            <br>
            <input type="email" id="email" name="email" placeholder="E-mail">
            <br>
            <input type="text" id="department" name="department" placeholder="Department">
            <br>
            <input type="text" id="phone" name="phone" placeholder="Phone Number">
            <br>
            <select name="role" id="role">
                <option value="-1">--Select a role--</option>
                <option value="Admin">Admin</option>
                <option value="Author">Author</option>
                <option value="Other">Other</option>
            </select>
            <br>
            <input type="password" id="password1" name="password1" placeholder="Password">
            <br>
            <input type="password" id="password2" name="password2" placeholder="Confirm Password">
            <br>
            <textarea name="description" id="description" cols="30" rows="6" placeholder="Description ... "></textarea>
            <br>

            <input type="submit" value="submit" name="submit" id="submitRegistration">
        </form>
    </div>
    
</body>
</html>
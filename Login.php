<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="Login.css">
    <title>Document</title>
</head>
<body>

<?php
error_reporting(0);
$email= $_POST['email'];
$name= $_POST['user'];
$password = $_POST['password'];

if(isset($_POST['dark'])){

}

if(isset($_POST['submit'])) {
    if(empty($_POST['user'])) {
        $errName= 'Please enter your user name';
    }

    else if(empty($_POST['email'])) {
        $errEmail = 'Please enter a valid email address';
    }

    else if(empty($_POST['password']) || (preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST["password"]) === 0)) {
        $errPass = '<p class="errText">Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit</p>';
    }

    else {
        echo "The form has been submitted";
    }
}
?>
<div class="container">
    <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" required>
                <?php echo $errEmail; ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputUser" class="col-sm-2 col-form-label">User Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputUser" name="user" placeholder="Username" required>
                <?php echo $errName; ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" required>
                <?php echo $errPass; ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <input type="submit" value="Sign in" name="submit" class="btn btn-primary"/>
            </div>
        </div>
    </form>
</div>

<?php
    $localhost = "localhost";
    $username = "root";
    $password = "";
    $dbname = "finalprojectphp";

    $conn = new mysqli($localhost,$username,$password,$dbname);

    if(isset($_POST['submit'])){
        if($conn->connect_error){
            die("Connection failed".$conn->connect_error);
        }
        $email = $_POST['email'];
        $user = $_POST['user'];
        $pwd = $_POST['password'];

        $sql = "SELECT * FROM loginpage";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if($email == $row['email']){
                    echo "email are already in database";
                }elseif($user == $row["username"]){
                    echo "Username can't be same"."<br/>";
                }
                else{
                    $email = $_POST['email'];
                    $username1 = $_POST['user'];
                    $pwd = $_POST['password'];
                    if($email != $row['email'] && $user != $row['username']) {
                        $sql = "INSERT INTO loginpage (email, username, password) VALUES ('$email','$username1','$pwd')";

                        if ($conn->query($sql) === TRUE) {
                            echo "New record inserted";
                        } else {
                            echo "error" . $sql . "<br>" . $conn->error;
                        }
                    }
                }
            }

        }
    }
?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

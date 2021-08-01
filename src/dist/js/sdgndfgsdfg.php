<?php

define('host','localhost');
define('user','jacoombes22');
define('password','');
define('dba','test');

$db = mysqli_connect($host, $user, $password, $dba);

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['username'];
    $pass= $_POST['password'];

    $sql="select * from test.users where username = '$uname' and password
            = '$pass'";
    $result=mysqli_query($db,$sql) or die(mysqli_error($db));
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active=$row['active'];

    if(mysqli_num_rows($result)!=0) {
        echo "Your answer is this: NEVER_GONNA_GIVE_YOU_UP";
        exit();
    }
    else {
        echo "Not quite - try again!";
        exit();
    }
}

?>

<!DOCTYPE html>

<html>
<head>
    <title>Extremely legit login site</title>
</head>
<body>
<h1>Login Form</h1>

<div class="container">
    <form method="POST" action="#">
        <div class="form_input">
            <input type="text" name="username" placeholder="Username"/>
        </div>
        <div class="form_input">
            <input type="text" name="password" placeholder="Password"/>
        </div>
        <input type="submit" name="submit" value="LOGIN" class="btn-login"/>
    </form>
</div>
</body>
</html>

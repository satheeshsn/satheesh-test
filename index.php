<?php
$error = '';
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $message = "Username or Password is invalid";
    } else {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $connection = mysql_connect("localhost", "root", "password");

        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = mysql_real_escape_string($username);
        $password = mysql_real_escape_string($password);

        $db = mysql_select_db("login", $connection);

        $query = mysql_query("select * from login where password='$password' AND username='$username'", $connection);
        $rows = mysql_num_rows($query);
        if ($rows == 1) {

            //header("location: profile.php"); 
            $logged_in = "logged_in";
            header("location: index.php?message=" . $logged_in);
        } else {
            $message = "Username or Password is invalid";
        }
        mysql_close($connection); // Closing Connection
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <div id="main">
            <?php if (!isset($_GET['message'])) { ?>
                <h1>Login</h1>
                <div id="login">
                    <h2>Login Form</h2>
                    <form action="" method="post">
                        <label>UserName :</label>
                        <input id="name" name="username" placeholder="username" type="text">
                        <label>Password :</label>
                        <input id="password" name="password" placeholder="**********" type="password">
                        <input name="submit" type="submit" value=" Login ">
                        <span><?php echo $message; ?></span>
                    </form>
                <?php } else { ?>
                    <h1>Logged In</h1>
                    <span><p><?php echo "You are logged in as user"; ?></p></span>
                <?php } ?>
            </div>
        </div>
    </body>
</html>


<?php
if ($_POST) {
    $subject = implode(",", $_POST["mytext"]);
    echo $text;
}
?>
<?php
if (isset($_POST["mytext"])) {

    $capture_field_vals = "";
    foreach ($_POST["mytext"] as $key => $text_field) {
        $capture_field_vals .= $text_field . ", ";
    }

    echo $capture_field_vals;
}
?>
<?php
//Open a new connection to the MySQL server
$mysqli = new mysqli('localhost', 'root', 'password', 'login');

//Output any connection error
if ($mysqli->connect_error) {
    die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$capture_field_vals = "";
if (isset($_POST["mytext"])) {
    foreach ($_POST["mytext"] as $key => $text_field) {
        $capture_field_vals .= $text_field . ", ";
    }
}

//MySqli Insert Query
$insert_row = $mysqli->query("INSERT INTO checktable ( captured_fields ) VALUES( $capture_field_vals )");

if ($insert_row) {
    print 'Success! ID of last inserted record is : ' . $mysqli->insert_id . '<br />';
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post" action="">
            <div class="input_fields_wrap">
                <button class="add_field_button">Add More Fields</button>
                <div><input type="text" name="mytext[]"></div>
                <div><input type="text" name="mytext[]"></div>
                <div><input type="text" name="mytext[]"></div>
                <div><input type="text" name="mytext[]"></div>
                <div><input type="text" name="mytext[]"></div>
            </div>
        </form>
    </body>
</html>

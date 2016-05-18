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
if (isset($_POST['submit'])) {
    $capture_field_vals = "";
    foreach ($_POST["mytext"] as $key => $text_field) {
        $capture_field_vals .= $text_field . ", ";
    }
    $link = mysqli_connect("localhost", "root", "password", "login") or die("Error " . mysqli_error($link));
//MySqli Insert Query
//$insert_row = $mysqli->query("INSERT INTO table ( captured_fields ) VALUES( $capture_field_vals )");
    $sql = "INSERT INTO boxes ( values ) VALUES( $capture_field_vals )";
//if($insert_row){
//print 'Success! ID of last inserted record is : ' .$mysqli->insert_id .'<br />';
//}
    $link->query($sql);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="//code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                var max_fields = 10; //maximum input boxes allowed
                var wrapper = $(".input_fields_wrap"); //Fields wrapper
                var add_button = $(".add_field_button"); //Add button ID

                var x = 1; //initlal text box count
                $(add_button).click(function (e) { //on add input button click
                    e.preventDefault();
                    if (x < max_fields) { //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
                    }
                });

                $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                })
            });
        </script>
    </head>
    <body>
        <!--<div class="input_fields_wrap">-->
        <!--<button class="add_field_button">Add More Fields</button>-->
        <!--<div><input type="text" name="mytext[]"></div>-->
        <!--</div>-->
        <form method="post" action="">
            <div class="input_fields_wrap">
                <button class="add_field_button">Add More Fields</button>
                <div><input type="text" name="mytext[]"></div>
                <div><input type="text" name="mytext[]"></div>
                <div><input type="text" name="mytext[]"></div>
                <div><input type="text" name="mytext[]"></div>
                <div><input type="text" name="mytext[]"></div>
            </div>
            <div><input type="submit" name="submit" value="submit" /></div>
        </form>
    </body>
</html>

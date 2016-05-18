<?php
$link = mysql_connect("localhost", "root", "password") or die("Error " . mysql_error());
$db = mysql_select_db("login", $link);
$result = array();

if (!empty($_POST['submit'])) {
    //$serialized_boxes = serialize($_POST['boxes']);
    //$sql = "INSERT INTO boxes (values) VALUES ($serialized_boxes);";
    //mysql_query($sql);

    $sql = "SELECT * FROM boxes;";
    $result = mysql_query($sql, $link);
    //while ($product = mysql_fetch_assoc($result)) {
    //}
    //print_r(mysql_fetch_assoc($result));
}
?>
<?php
// Connect to the DB
//$link = mysqli_connect("localhost", "root", "password", "login") or die("Error " . mysqli_error($link));
// store in the DB 
//if (!empty($_POST['submit'])) {
//if (!empty($_POST['delete_ids']) and is_array($_POST['delete_ids'])) {
// you can optimize below into a single query, but let's keep it simple and clear for now:
//foreach ($_POST['delete_ids'] as $id) {
//$sql = "DELETE FROM products WHERE id=$id";
//$link->query($sql);
//}
//}
// now, to edit the existing data, we have to select all the records in a variable.
//$sql = "SELECT * FROM products ORDER BY id";
//$result = $link->query($sql);
// now edit them
//while ($product = mysqli_fetch_array($result)) {
// remember how we constructed the field names above? This was with the idea to access the values easy now
//$sql = "UPDATE products SET qty='" . $_POST['qty' . $product['id']] . "', name='" . $_POST['name' . $product['id']] . "'
//WHERE id='$product[id]'";
//$link->query($sql);
//}
// adding new products
//if (!empty($_POST['qty'])) {
//foreach ($_POST['qty'] as $cnt => $qty) {
//$sql = "INSERT INTO products (qty, name) VALUES ('$qty', '" . $_POST['name'][$cnt] . "');";
//$link->query($sql);
//}
//}
//}
// select existing products here
//$sql = "SELECT * FROM products ORDER BY id";
//$result = $link->query($sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Form Page</title>
        <script type="text/javascript" src="//code.jquery.com/jquery-latest.js"></script>
        <style type="text/css">
            <!--
            #main {
                max-width: 800px;
                margin: 0 auto;
            }
            -->
        </style>
    </head>
    <body>
        <div id="main">
            <h1>Form Page</h1>
            <div class="my-form">
                <form role="form" method="post">
                    <?php
//$link = mysql_connect("localhost", "root", "password", "login") or die("Error " . mysql_error($link));
//$serialized_boxes = serialize($_POST['boxes']);
//$sql = "INSERT INTO boxes (values) VALUES ($serialized_boxes);";
//mysql_query($sql);
//mysql_query("INSERT INTO `table_name`(column_name) VALUES ('" . mysql_real_escape_string($serialized_boxes) . "')");
                    $data = 'a:3:{i:0;s:14:"Value in Box 1";i:1;s:7:"Value 2";i:2;s:11:"Box 3 Value";}';
                    $data_page = mysql_fetch_assoc($result);
                    //print_r($data_page);
                    $data1 = unserialize($data);
//print_r($data1);

                    if (!empty($data)) {
                        foreach (unserialize($data) as $key => $value) :
                            ?>
                            <p class="text-box">
                                <label for="box<?php echo $key + 1; ?>">Box <span class="box-number"><?php echo $key + 1; ?></span></label>
                                <input type="text" name="boxes[]" id="box<?php echo $key + 1; ?>" value="<?php echo $value; ?>" />
                                <?php echo ( 0 == $key ? '<a href="#" class="add-box">Add More</a>' : '<a href="#" class="remove-box">Remove</a>' ); ?>
                            </p>
                            <?php
                        endforeach;
                    }
                    else {
                        ?>
                        <p class="text-box">
                            <label for="box1">Box <span class="box-number">1</span></label>
                            <input type="text" name="boxes[]" value="" id="box1" />
                            <a class="add-box" href="#">Add More</a>
                        </p>
                        <?php
                    }
                    ?>
                    <p><input type="submit" name="submit" value="Submit" /></p>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $('.my-form .add-box').click(function () {
                    var n = $('.text-box').length + 1;
                    if (5 < n) {
                        //alert('Stop it!');
                        return false;
                    }
                    var box_html = $('<p class="text-box"><label for="box' + n + '">Box <span class="box-number">' + n + '</span></label> <input type="text" name="boxes[]" value="" id="box' + n + '" /> <a href="#" class="remove-box">Remove</a></p>');
                    box_html.hide();
                    $('.my-form p.text-box:last').after(box_html);
                    box_html.fadeIn('slow');
                    return false;
                });
                $('.my-form').on('click', '.remove-box', function () {
                    $(this).parent().css('background-color', '#FF6C6C');
                    $(this).parent().fadeOut("slow", function () {
                        $(this).remove();
                        $('.box-number').each(function (index) {
                            $(this).text(index + 1);
                        });
                    });
                    return false;
                });
            });
        </script>
    </body>
</html>
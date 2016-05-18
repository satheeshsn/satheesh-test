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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script type="text/javascript">
                    $(".addQF").hide();
                    $(document).on("click", ".remQF", function () {
            $(this).parent().parent().remove();
                    var emptyfield = 0;
            $.each($('[name^=qualifications]'), function () {
                    if (this.value == "") {
                    emptyfield = 1;
                    }
                    });
                    if (emptyfield == 0) {
                    $(".addQF").show();
                    } else {
            $(".addQF").hide();
            }
            });
            $(".addQF").click(function () {
            var select_course_value = $("#select_box_course").val();
                    var qf_select_box_year = $("#qf_select_box_year").val();
                    var empty = $('#customFieldsQF input').find("input").filter(function () {
            return this.value === "";
            });
                    if (!empty.length) {
            $('<div class="added_additionalQF"><div class="col-xs-12 col-sm-4 col-md-4">' + select_course_value + '</div><div class="col-xs-12 col-sm-3 col-md-3"><select class="code form-control not_chosen trades" id="trades[]" name="trades[]"><option value="">Trade</option></select></div><div class="col-xs-12 col-sm-3 col-md-3"><!--<input type="text" class="code form-control" id="year_completion[]" name="year_completion[]" value="" placeholder="Year Passed" maxlength="4"/>-->' + qf_select_box_year + '</div><div class="col-xs-12 col-sm-1 col-md-1 rmDivQF"><a href="javascript:void(0);" class="remQF">Remove</a></div></div>').insertBefore("#last_toappendQF");
                        $(".addQF").hide();
                }

                });
                        $(document.body).on('change', '[name^=qualifications]', function () {
        var emptyfield = 0;
        $.each($('[name^=qualifications]'), function () {
            if (this.value == "") {
                emptyfield = 1;
            }
        });
        if (emptyfield == 0) {
            $(".addQF").show();
        } else {
            $(".addQF").hide();
        }
    });
    $(document.body).on('change', '.qualifications', function () {
        //$(".trades").html('<option value="">Trades</option>');
        var lookup_type = $(this).val();
        var current = $(this);
        $(current).removeClass("not_chosen");
        $(current).parent().siblings().children('select.trades').html('<option value="">Trade</option>');

        var base_url = $('#base_url').val();
        var dataString = 'lookup_type=' + lookup_type;
        var trade_post_url = base_url + "ajax_call/show_trade";
        $.ajax
                ({
                    type: "POST",
                    url: trade_post_url,
                    data: dataString,
                    cache: false,
                    success: function (result)
                    {
                        $(current).parent().siblings().children('select.trades').append(result);
                    }

                });

    });
    function checkFile() {
    if ($('select').length) {
        // Traverse through all dropdowns
        $.each($('select'), function (i, val) {
            var $el = $(val);

            if (!$el.val()) {
                $el.addClass("not_chosen");
            }

            $el.on("change", function () {
                if (!$el.val())
                    $el.addClass("not_chosen");
                else
                    $el.removeClass("not_chosen");
            });
        });
    }
}
        </script>
    </head>
    <body>
        <div class="form-group">
            <h3>Qualifications</h3><hr />

            <div  id="customFieldsQF" >    
                <div class="col-xs-12 col-sm-4 col-md-4">
<!--<input type="text" class="code form-control" id="qualifications[]" name="qualifications[]" value="" placeholder="Qualification (Highest First)"/>-->
                    <?php
                    $course_data = array();
                    if ($ug_data) {
                        $course_data[0] = $ug_data;
                    } if ($pg_data) {
                        $course_data[1] = $pg_data;
                    }
                    $select_box = '';
                    $select_box .= "<select class='code form-control not_chosen qualifications' id='qualifications[]' name='qualifications[]' onclick='checkFile();'>";
                    $select_box .= "<option value=''>Course (Highest First)</option>";
                    $select_box .= "<optgroup label='PG'>";
                    foreach ($course_data[1] as $pg) {
                        $select_box .= "<option value={$pg["lookup_id"]}>{$pg["lookup_value"]}</option>";
                    }
                    $select_box .= "</optgroup>";


                    $select_box .= "<optgroup label='UG'>";
                    foreach ($course_data[0] as $ug) {
                        $select_box .= "<option value={$ug["lookup_id"]}>{$ug["lookup_value"]}</option>";
                    }
                    $select_box .= "</optgroup></select>";
                    echo $select_box;
                    ?>
                </div>

                <div class="col-xs-12 col-sm-3 col-md-3">

                    <select class="code form-control not_chosen trades" id="trades[]" name="trades[]">
                        <option value="" class="select_trade">Trade</option>
                    </select>
                    <input type="hidden" id="select_box_course" value="<?php echo $select_box; ?>" />
                </div>

                <div class="col-xs-12 col-sm-3 col-md-3">
                    <!--
                    <input type="text" class="code form-control" id="year_completion[]" name="year_completion[]" value="" placeholder="Year Passed" maxlength="4"/>-->
                    <?php
                    $qf_select_box = '';
                    $start_year = 1970;
                    $end_year = intval(date('Y'));
                    //echo $end_year;
                    $qf_select_box .= "<select class='code form-control not_chosen qf_year' id='year_completion[]' name='year_completion[]' onclick='checkFile();'>";
                    $qf_select_box .= "<option value=''>Year Passed</option>";
                    for ($i = $start_year; $i <= $end_year; $i++) {
                        $qf_select_box .= "<option value=" . $i . ">" . $i . "</option>";
                    }
                    $qf_select_box .= "</select>";
                    echo $qf_select_box;
                    ?>
                </div>
                <div class="col-xs-12 col-sm-1 col-md-1" id="qualif_add">
                    <a href="javascript:void(0);" class="addQF">Add</a>
                </div>
                <div id="last_toappendQF" class="col-xs-12 col-sm-7 col-md-7"></div>
            </div>
            <input type="hidden" id="qf_select_box_year" value="<?php echo $qf_select_box; ?>" />
        </div> 
    </body>
</html>

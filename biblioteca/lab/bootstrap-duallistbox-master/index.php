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
        <!-- Bootstrap CSS -->
        <link href="../../bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <link href="../../bootstrap/fontawesome-free-5.13.0-web/css/all.min.css" rel="stylesheet" type="text/css"/>

        <link href="dist/bootstrap-duallistbox.min.css" rel="stylesheet" type="text/css"/>
        <!-- jQuery -->
        <script src="../../bootstrap/4.5.0/js/jquery-3.5.1.slim.min.js" type="text/javascript"></script>
        <script src="../../bootstrap/4.5.0/js/popper.min.js" type="text/javascript"></script>
        <script src="../../bootstrap/4.5.0/js/bootstrap.min.js" type="text/javascript"></script>  

        <script src="../../bootstrap/fontawesome-free-5.13.0-web/js/all.min.js" type="text/javascript"></script>

        <script src="dist/jquery.bootstrap-duallistbox.min.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <h1>Hello, world!</h1>    

        <i class="fas fa-angle-double-left"></i>
        <i class="fas fa-angle-double-right"></i>
        <i class="fas fa-hand-point-left"></i>
        <i class="fas fa-hand-point-right"></i>
        <i class="fas fa-chevron-left"></i>
        <i class="fas fa-chevron-right"></i>


        <div class="container-fluid">
            <select multiple="multiple" size="10" name="duallistbox_demo1[]" style="display: none;">
                <option value="option1">Option 1</option>
                <option value="option2" data-sortindex="5">Option 2</option>
                <option value="option3" selected="selected">Option 3</option>
                <option value="option4">Option 4</option>
                <option value="option5">Option 5</option>
                <option value="option6" selected="selected">Option 6</option>
                <option value="option7">Option 7</option>
                <option value="option8">Option 8</option>
                <option value="option9">Option 9</option>
                <option value="option0" data-sortindex="11">Option 10</option>
            </select>  
            <br>
            <button type="button" class="btn btn-primary btn-block" onclick="getData()">Submit data</button>
        </div>     

        <script>
            $(document).ready(function () {
                var demo1 = $("select[name='duallistbox_demo1[]']").bootstrapDualListbox();
                getData = function () {
                    console.log($('[name="duallistbox_demo1[]"]').val());
                }
            });
        </script>

    </body>
</html>

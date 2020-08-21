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
        <!-- Iconos CSS -->
        <link href="../../bootstrap/fontawesome-free-5.13.0-web/css/all.min.css" rel="stylesheet" type="text/css"/>
        <!-- checkbox CSS -->
        <link href="css/style.css" rel="stylesheet" type="text/css"/>

        <!-- jQuery -->
        <script src="../../bootstrap/4.5.0/js/jquery-3.5.1.slim.min.js" type="text/javascript"></script>
        <script src="../../bootstrap/4.5.0/js/popper.min.js" type="text/javascript"></script>
        <script src="../../bootstrap/4.5.0/js/bootstrap.min.js" type="text/javascript"></script>  
        <!-- Iconos JS -->
        <script src="../../bootstrap/fontawesome-free-5.13.0-web/js/all.min.js" type="text/javascript"></script>

    </head>
    <body>
        <?php
        // put your code here
        ?>
        <h1>Hello, world!</h1>    

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <input type="checkbox" name="vehicle3" value="Boat" onclick="console.log(this);">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" onclick="" checked>
                        <span class="custom-control-indicator"></span>
                    </label>
                </div>
            </div>
        </div>        

        <main class="container pt-5">
            <div class="card mb-5">
                <div class="card-header">Fearures</div>
                <div class="card-block p-0">
                    <form>        
                        <table class="table table-bordered table-sm m-0">
                            <thead class="">
                                <tr>
                                    <th>
                                        #
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="select_all" class="custom-control-input" onclick="">
                                            <span class="custom-control-indicator"></span>
                                        </label>                                
                                    </th>
                                    <th>Name</th>
                                    <th>Registration Date</th>
                                    <th>E-mail address</th>
                                    <th>Premium Plan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="select_1" name="select[]" class="custom-control-input" onclick="">
                                            <span class="custom-control-indicator"></span>
                                        </label>
                                    </td>
                                    <td>John Lilki</td>
                                    <td>September 14, 2013</td>
                                    <td>jhlilk22@yahoo.com</td>
                                    <td>No</td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="select_2" name="select[]" class="custom-control-input" onclick="">
                                            <span class="custom-control-indicator"></span>
                                        </label>
                                    </td>
                                    <td>John Lilki</td>
                                    <td>September 14, 2013</td>
                                    <td>jhlilk22@yahoo.com</td>
                                    <td>No</td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="select_1" name="select[]" class="custom-control-input" onclick="">
                                            <span class="custom-control-indicator"></span>
                                        </label>
                                    </td>
                                    <td>John Lilki</td>
                                    <td>September 14, 2013</td>
                                    <td>jhlilk22@yahoo.com</td>
                                    <td>No</td>
                                </tr>
                            </tbody>
                        </table>
                        <form>        

                            </div>

                            </main>

                            <script>
                                $(document).ready(function () {


                                    $('#select_all').change(function () {
                                        var checkboxes = $(this).closest('form').find(':checkbox');
                                        checkboxes.prop('checked', $(this).is(':checked'));
                                    });
                                });
                            </script>    

                            </body>
                            </html>

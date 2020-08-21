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
        echo '<h1>' . getcwd() . '</h1>';
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                                <label class="switch">
                                    <input type="checkbox" class="success" checked>
                                    <span class="slider round"></span>
                                </label>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card" style="margin:50px 0">
                        <!-- Default panel contents -->
                        <div class="card-header">Checkbox to Switch</div>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                Bootstrap Switch Default
                                <label class="switch ">
                                    <input type="checkbox" class="default">
                                    <span class="slider"></span>
                                </label>
                            </li>
                            <li class="list-group-item">
                                Bootstrap Switch Primary
                                <label class="switch ">
                                    <input type="checkbox" class="primary">
                                    <span class="slider"></span>
                                </label>
                            </li>
                            <li class="list-group-item">
                                Bootstrap Switch Success
                                <label class="switch ">
                                    <input type="checkbox" class="success">
                                    <span class="slider"></span>
                                </label>
                            </li>
                            <li class="list-group-item">
                                Bootstrap Switch Info
                                <label class="switch ">
                                    <input type="checkbox" class="info">
                                    <span class="slider"></span>
                                </label>
                            </li>
                            <li class="list-group-item">
                                Bootstrap Switch Warning
                                <label class="switch ">
                                    <input type="checkbox" class="warning">
                                    <span class="slider"></span>
                                </label>
                            </li>
                            <li class="list-group-item">
                                Bootstrap Switch Danger
                                <label class="switch ">
                                    <input type="checkbox" class="danger">
                                    <span class="slider"></span>
                                </label>
                            </li>
                        </ul>
                    </div> 
                </div>
                <div class="col-md-6">
                    <div class="card" style="margin:50px 0">
                        <!-- Default panel contents -->
                        <div class="card-header">Checkbox to Round Switch</div>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                Bootstrap Switch Default
                                <label class="switch ">
                                    <input type="checkbox" class="default">
                                    <span class="slider round"></span>
                                </label>
                            </li>
                            <li class="list-group-item">
                                Bootstrap Switch Primary
                                <label class="switch ">
                                    <input type="checkbox" class="primary">
                                    <span class="slider round"></span>
                                </label>
                            </li>
                            <li class="list-group-item">
                                Bootstrap Switch Success
                                <label class="switch ">
                                    <input type="checkbox" class="success">
                                    <span class="slider round"></span>
                                </label>
                            </li>
                            <li class="list-group-item">
                                Bootstrap Switch Info
                                <label class="switch ">
                                    <input type="checkbox" class="info">
                                    <span class="slider round"></span>
                                </label>
                            </li>
                            <li class="list-group-item">
                                Bootstrap Switch Warning
                                <label class="switch ">
                                    <input type="checkbox" class="warning">
                                    <span class="slider round"></span>
                                </label>
                            </li>
                            <li class="list-group-item">
                                Bootstrap Switch Danger
                                <label class="switch ">
                                    <input type="checkbox" class="danger">
                                    <span class="slider round"></span>
                                </label>
                            </li>
                        </ul>
                    </div> 
                </div>
            </div>
        </div>



    </body>
</html>

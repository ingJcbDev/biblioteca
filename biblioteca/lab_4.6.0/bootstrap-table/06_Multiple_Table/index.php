<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="../../../bootstrap/4.6.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../../../bootstrap/fontawesome-free-5.13.0-web/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap-table_1.21.2/css/bootstrap-table.min.css" rel="stylesheet">
    <!-- Bootstrap CSS fin -->

    <!-- Optional JavaScript -->
    <script src="../../../bootstrap/4.6.0/dist/js/jquery-3.5.1.js" type="text/javascript"></script>
    <script src="../../../bootstrap/4.6.0/dist/js/popper.min.js" type="text/javascript"></script>
    <script src="../../../bootstrap/4.6.0/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../bootstrap/fontawesome-free-5.13.0-web/js/all.min.js" type="text/javascript"></script>
    <script src="../bootstrap-table_1.21.2/js/bootstrap-table.min.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <title>Bootstrap Table</title>

</head>

<body>

    <style>
        .left {
            float: left;
        }

        .right {
            float: right;
        }

        .like {
            margin-right: 10px;
        }

        .item {
            margin-bottom: 20px;
        }
    </style>

    <div class="item">
        <table data-toggle="table" data-url="json/data3.json">
            <thead>
                <tr>
                    <th data-field="github.name" data-formatter="operateFormatter" data-events="operateEvents">Bookmark 1</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="item">
        <table data-toggle="table" data-url="json/data3.json">
            <thead>
                <tr>
                    <th data-field="github.name" data-formatter="operateFormatter" data-events="operateEvents">Bookmark 2</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="item">
        <table data-toggle="table" data-url="json/data3.json">
            <thead>
                <tr>
                    <th data-field="github.name" data-formatter="operateFormatter" data-events="operateEvents">Bookmark 3</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="item">
        <table data-toggle="table" data-url="json/data3.json">
            <thead>
                <tr>
                    <th data-field="github.name" data-formatter="operateFormatter" data-events="operateEvents">Bookmark 4</th>
                </tr>
            </thead>
        </table>
    </div>

    <script>
        window.operateEvents = {
            'click .like': function(e, value, row) {
                alert('You click like action, row: ' + JSON.stringify(row))
            },
            'click .remove': function(e, value, row) {
                alert('You click remove action, row: ' + JSON.stringify(row))
            }
        }

        function operateFormatter(value, row, index) {
            return [
                '<div class="left">',
                '<a href="https://github.com/wenzhixin/' + value + '" target="_blank">' + value + '</a>',
                '</div>',
                '<div class="right">',
                '<a class="like" href="javascript:void(0)" title="Like">',
                '<i class="fa fa-heart"></i>',
                '</a>  ',
                '<a class="remove" href="javascript:void(0)" title="Remove">',
                '<i class="fa fa-trash"></i>',
                '</a>',
                '</div>'
            ].join('')
        }
    </script>

</body>
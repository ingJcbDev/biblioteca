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

    <button id="button" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalTable">
        Launch modal table
    </button>
    <div id="modalTable" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal table</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="table" data-toggle="table" data-height="345" data-url="json/data1.json">
                        <thead>
                            <tr>
                                <th data-field="id">ID</th>
                                <th data-field="name">Item Name</th>
                                <th data-field="price">Item Price</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var $table = $('#table')

        $(function() {
            $('#modalTable').on('shown.bs.modal', function() {
                $table.bootstrapTable('resetView')
            })
        })
    </script>
</body>
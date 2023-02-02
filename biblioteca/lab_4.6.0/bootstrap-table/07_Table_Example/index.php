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
    <!-- <link href="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table.min.css" rel="stylesheet"> -->

    <!-- Optional JavaScript -->
    <script src="../../../bootstrap/4.6.0/dist/js/jquery-3.5.1.js" type="text/javascript"></script>
    <script src="../../../bootstrap/4.6.0/dist/js/popper.min.js" type="text/javascript"></script>
    <script src="../../../bootstrap/4.6.0/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../bootstrap/fontawesome-free-5.13.0-web/js/all.min.js" type="text/javascript"></script>
    <script src="../bootstrap-table_1.21.2/js/tableExport.min.js"></script>
    <script src="../bootstrap-table_1.21.2/js/bootstrap-table.min.js"></script>
    <script src="../bootstrap-table_1.21.2/js/bootstrap-table-locale-all.min.js"></script>
    <script src="../bootstrap-table_1.21.2/js/extensions/export/bootstrap-table-export.min.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table-locale-all.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.21.2/dist/extensions/export/bootstrap-table-export.min.js"></script> -->

    <title>Bootstrap Table</title>

</head>

<body> 

    <div class="row">
        <div class="col-12" style="text-align: center;">
            <br>
            <div id="h1_id">
                <h1 class="mb-3" style="color: blueviolet;">Bootstrap 4 Table</h1>
            </div>
        </div>
    </div>

    <style>
        .select,
        #locale {
            width: 100%;
        }

        .like {
            margin-right: 10px;
        }
    </style>

    <div class="select">
        <select class="form-control" id="locale">
            <option value="af-ZA">af-ZA</option>
            <option value="ar-SA">ar-SA</option>
            <option value="ca-ES">ca-ES</option>
            <option value="cs-CZ">cs-CZ</option>
            <option value="da-DK">da-DK</option>
            <option value="de-DE">de-DE</option>
            <option value="el-GR">el-GR</option>
            <option value="en-US">en-US</option>
            <option value="es-AR">es-AR</option>
            <option value="es-CL" selected>es-CL</option>
            <option value="es-CR">es-CR</option>
            <option value="es-ES">es-ES</option>
            <option value="es-MX">es-MX</option>
            <option value="es-NI">es-NI</option>
            <option value="es-SP">es-SP</option>
            <option value="et-EE">et-EE</option>
            <option value="eu-EU">eu-EU</option>
            <option value="fa-IR">fa-IR</option>
            <option value="fi-FI">fi-FI</option>
            <option value="fr-BE">fr-BE</option>
            <option value="fr-FR">fr-FR</option>
            <option value="he-IL">he-IL</option>
            <option value="hr-HR">hr-HR</option>
            <option value="hu-HU">hu-HU</option>
            <option value="id-ID">id-ID</option>
            <option value="it-IT">it-IT</option>
            <option value="ja-JP">ja-JP</option>
            <option value="ka-GE">ka-GE</option>
            <option value="ko-KR">ko-KR</option>
            <option value="ms-MY">ms-MY</option>
            <option value="nb-NO">nb-NO</option>
            <option value="nl-NL">nl-NL</option>
            <option value="pl-PL">pl-PL</option>
            <option value="pt-BR">pt-BR</option>
            <option value="pt-PT">pt-PT</option>
            <option value="ro-RO">ro-RO</option>
            <option value="ru-RU">ru-RU</option>
            <option value="sk-SK">sk-SK</option>
            <option value="sv-SE">sv-SE</option>
            <option value="th-TH">th-TH</option>
            <option value="tr-TR">tr-TR</option>
            <option value="uk-UA">uk-UA</option>
            <option value="ur-PK">ur-PK</option>
            <option value="uz-Latn-UZ">uz-Latn-UZ</option>
            <option value="vi-VN">vi-VN</option>
            <option value="zh-CN">zh-CN</option>
            <option value="zh-TW">zh-TW</option>
        </select>
    </div>

    <div id="toolbar">
        <button id="remove" class="btn btn-danger" disabled>
            <i class="fa fa-trash"></i> Delete
        </button>
    </div>
    <table id="table" data-toolbar="#toolbar" data-search="true" data-show-refresh="true" data-show-toggle="true" data-show-fullscreen="true" data-show-columns="true" data-show-columns-toggle-all="true" data-detail-view="true" data-show-export="true" data-click-to-select="true" data-detail-formatter="detailFormatter" data-minimum-count-columns="2" data-show-pagination-switch="true" data-pagination="true" data-id-field="id" data-page-list="[10, 25, 50, 100, all]" data-show-footer="true" data-side-pagination="server" data-url="json/data.json" data-response-handler="responseHandler">
    </table>
    <!-- Esta url puede ser un archivo json como lo vemos en el ejemplo -->
    <!-- data-url="https://examples.wenzhixin.net.cn/examples/bootstrap_table/data" -->

    <script>
        var $table = $('#table')
        var $remove = $('#remove')
        var selections = []

        function getIdSelections() {
            return $.map($table.bootstrapTable('getSelections'), function(row) {
                return row.id
            })
        }

        function responseHandler(res) {
            $.each(res.rows, function(i, row) {
                row.state = $.inArray(row.id, selections) !== -1
            })
            return res
        }

        function detailFormatter(index, row) {
            var html = []
            $.each(row, function(key, value) {
                html.push('<p><b>' + key + ':</b> ' + value + '</p>')
            })
            return html.join('')
        }

        function operateFormatter(value, row, index) {
            return [
                '<a class="like" href="javascript:void(0)" title="Like">',
                '<i class="fa fa-heart"></i>',
                '</a>  ',
                '<a class="remove" href="javascript:void(0)" title="Remove">',
                '<i class="fa fa-trash"></i>',
                '</a>'
            ].join('')
        }

        window.operateEvents = {
            'click .like': function(e, value, row, index) {
                alert('You click like action, row: ' + JSON.stringify(row))
            },
            'click .remove': function(e, value, row, index) {
                $table.bootstrapTable('remove', {
                    field: 'id',
                    values: [row.id]
                })
            }
        }

        function totalTextFormatter(data) {
            return 'Total'
        }

        function totalNameFormatter(data) {
            return data.length
        }

        function totalPriceFormatter(data) {
            var field = this.field
            return '$' + data.map(function(row) {
                return +row[field].substring(1)
            }).reduce(function(sum, i) {
                return sum + i
            }, 0)
        }

        function initTable() {
            $table.bootstrapTable('destroy').bootstrapTable({
                height: 550,
                locale: $('#locale').val(),
                columns: [
                    [{
                        field: 'state',
                        checkbox: true,
                        rowspan: 2,
                        align: 'center',
                        valign: 'middle'
                    }, {
                        title: 'Item ID',
                        field: 'id',
                        rowspan: 2,
                        align: 'center',
                        valign: 'middle',
                        sortable: true,
                        footerFormatter: totalTextFormatter
                    }, {
                        title: 'Item Detail',
                        colspan: 3,
                        align: 'center'
                    }],
                    [{
                        field: 'name',
                        title: 'Item Name',
                        sortable: true,
                        footerFormatter: totalNameFormatter,
                        align: 'center'
                    }, {
                        field: 'price',
                        title: 'Item Price',
                        sortable: true,
                        align: 'center',
                        footerFormatter: totalPriceFormatter
                    }, {
                        field: 'operate',
                        title: 'Item Operate',
                        align: 'center',
                        clickToSelect: false,
                        events: window.operateEvents,
                        formatter: operateFormatter
                    }]
                ]
            })
            $table.on('check.bs.table uncheck.bs.table ' +
                'check-all.bs.table uncheck-all.bs.table',
                function() {
                    $remove.prop('disabled', !$table.bootstrapTable('getSelections').length)

                    // save your data, here just save the current page
                    selections = getIdSelections()
                    // push or splice the selections if you want to save all data selections
                })
            $table.on('all.bs.table', function(e, name, args) {
                console.log(name, args)
            })
            $remove.click(function() {
                var ids = getIdSelections()
                alert("Cuan se selecciona los check:" + JSON.stringify(ids));
                $table.bootstrapTable('remove', {
                    field: 'id',
                    values: ids
                })
                $remove.prop('disabled', true)
            })
        }

        $(function() {
            initTable()

            $('#locale').change(initTable)
        })
    </script>

</body>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>jqGrid UI</title>
    <link rel='stylesheet' type='text/css' href='http://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css' />
    <link rel='stylesheet' type='text/css' href='http://www.trirand.com/blog/jqgrid/themes/ui.jqgrid.css' />

    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

    <script type='text/javascript' src='http://www.trirand.com/blog/jqgrid/js/i18n/grid.locale-en.js'></script>
    <script type='text/javascript' src='http://www.trirand.com/blog/jqgrid/js/jquery.jqGrid.js'></script>

    <script>
        $(document).ready(function () {
            $("#list_records").jqGrid({
                url: "getGridData.php",
                datatype: "json",
                mtype: "GET",
                colNames: ["No Kamar", "Date Executed", "User"]
                colModel: [
                    { name: "no_kamar",align:"right"},
                    { name: "date_tap_time_card"},
                    { name: "user"}
                ],
                pager: "#perpage",
                rowNum: 10,
                rowList: [10,20],
                sortname: "userId",
                sortorder: "asc",
                height: 'auto',
                viewrecords: true,
                gridview: true,
                caption: ""
            });
        });
    </script>
</head>

<body>
<table id="list_records"><tr><td></td></tr></table>
<div id="perpage"></div>
</body>
</html>

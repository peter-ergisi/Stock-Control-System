<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Table</title>

    <link href="styles/bootstrap.css" rel="stylesheet">
</head>
<body onload = "viewData();">

    <div class ="container" style ="margin-top:40px">
        <table id = "tabledit" class = "table table-bordered table-striped">
            <thead>
            <tr>
                <th> ID </th>
                <th> Category Name </th>
            </tr>
            </thead>
        </table>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/jquery.tabledit.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    function viewData(){
        $.ajax({
            url: 'process.php?p=view',
            method: 'GET'
        }).done(function(data){
            $('tbody').html(data)
            tableData()
        })
    }
    function tableData(){
        alert("got here");
        $('#tabledit').Tabledit({
            url: 'process.php',
            columns: {
                identifier: [0, 'category_ID'],
                editable: [[1, 'category_Name']]
            }
        });
    }
    </script>


</body>
</html>
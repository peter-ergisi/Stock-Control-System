<?php

session_start();


if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){

    header("location: index.php");
    exit;
} else if (isset($_SESSION["isStaff"]) && $_SESSION["isStaff"] == 0){
    header("location: index.php");
    exit;
}
?>

<?php include("includes/header.php") ?>

    <head>
        <div id="homeText"> <h1>Categories</h1></div>
        <div id="searchBar">
            <form id="searchForm">
                <input name="search" type="text" placeholder="Search.." >
                <button type="submit">Search!</button>
            </form>
        </div>
    </head>


    <body>
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

        <script src="js/jquery.tabledit.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script>
            function viewData(){
                $.ajax({
                    url: 'process.php?p=view',
                    method: 'GET'
                }).done(function(data){
                    alert(data)
                    $('tbody').html(data)
                    tableData()
                })
            }
            function tableData(){
                $('#tabledit').Tabledit({
                    url: 'process.php',
                    columns: {
                        identifier: [0, 'category_ID'],
                        editable: [[1, 'category_Name']]
                    }
                });
            }
            window.onload = viewData();
        </script>
    </body>



<?php include("includes/footer.php") ?>
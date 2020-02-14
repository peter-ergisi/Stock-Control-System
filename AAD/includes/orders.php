<?php
$connect = mysqli_connect("localhost", "root", "zwofverOPZi21ME", "storedb");
$query = "SELECT * FROM orders";
$result = mysqli_query($connect, $query);
?>

<div id class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading panelBG">
			<div class="row">
				<div class="tableTitle">
					<h3 class="panel-title">Orders</h3>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-12 table-responsive">
					<div class="row">
						<div class="col-sm-12">
							<table id = "tableBody" class="table table-bordered table-striped">
								<thead>
									<tr role="row">
										<th rowspan="1">ID</th>
										<th rowspan="1">Buyer</th>
										<th rowspan="1">Order Date</th>
										<th rowspan="1">Order Total</th>
									</tr>
								</thead>
                                <tbody>
                                <?php
                                while($row = mysqli_fetch_array($result))
                                {
                                    echo '
                                      <tr>
                                       <td>'.$row["order_ID"].'</td>
                                       <td>'.$row["user_ID"].'</td>
                                       <td>'.$row["order_Date"].'</td>
                                       <td>'.$row["order_Total"].'</td>
                                      </tr>
                                      ';
                                }
                                ?>
                                </tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="js/jquery.tabledit.min.js"></script>
<script>
    $(document).ready(function(){
        $('#tableBody').Tabledit({
            url:'/mainproject/actions/actionorders.php',
            columns:{
                identifier:[0, "uid"],
                editable:[[2, 'order_Date'], [3, 'order_Total']]
            },
            restoreButton:false,
            onSuccess:function(data, textStatus, jqXHR)
            {
                console.log(data);
                if(data.action == 'delete')
                {
                    $('#'+data.uid).remove();

                }
            },
            onError: function(xhr, status, error) {
                console.log(xhr.responseText);
                alert(xhr.responseText);
            }
        });

    });
</script>
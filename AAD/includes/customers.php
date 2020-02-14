<?php
$connect = mysqli_connect("localhost", "root", "zwofverOPZi21ME", "storedb");
$query = "SELECT * FROM users ORDER BY user_ID ASC";
$result = mysqli_query($connect, $query);
?>

<div id class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading panelBG">
			<div class="row">
				<div class="tableTitle">
					<h3 class="panel-title">Customers</h3>
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
										<th rowspan="1">Username</th>
										<th rowspan="1">First Name</th>
                                        <th rowspan="1">Last Name</th>
										<th rowspan="1">Charge Code</th>
										<th rowspan="1">Admin Access?</th>
									</tr>
								</thead>
                                <tbody>
                                <?php
                                while($row = mysqli_fetch_array($result))
                                {
                                    echo '
                                      <tr>
                                       <td>'.$row["user_ID"].'</td>
                                       <td>'.$row["username"].'</td>
                                       <td>'.$row["firstName"].'</td>
                                       <td>'.$row["lastName"].'</td>
                                       <td>'.$row["chargeCode"].'</td>
                                       <td>'.$row["isStaff"].'</td>
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
            url:'/mainproject/actions/actioncustomers.php',
            columns:{
                identifier:[0, "uid"],
                editable:[[1, 'username'], [2, 'firstName'], [3, 'lastName'], [4, 'chargeCode'], [5, 'isStaff']]
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
            }
        });

    });
</script>
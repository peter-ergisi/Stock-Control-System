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
										<th rowspan="1">Full Name</th>
										<th rowspan="1">Charge Code</th>
										<th rowspan="1">Admin Access?</th>
										<th rowspan="1"> </th>
										<th rowspan="1"> </th>
										<th rowspan="1"> </th>
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
                                       <td>'.$row["chargeCode"].'</td>
                                       <td>'.$row["isStaff"].'</td>
                                       <td rowspan="1"><button class="btn btn-success">View</button></th>
									   <td rowspan="1"><button class="btn btn-warning">Update</button></th>
									   <td rowspan="1"><button class="btn btn-danger">Delete</button></th>
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
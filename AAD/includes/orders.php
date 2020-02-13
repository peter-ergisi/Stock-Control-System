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
                                       <td>'.$row["order_ID"].'</td>
                                       <td>'.$row["user_ID"].'</td>
                                       <td>'.$row["order_Date"].'</td>
                                       <td>'.$row["order_Total"].'</td>
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

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
                                       <td><button data-id="'.$row["order_ID"].'"class="btn btn-warning btn-xs">VIEW</button></td>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript">
    function loadPHP()
    {
        var id = $(this).attr('data-id');
        console.log(id);

        $.ajax({
            url: "actions/lookup.php",
            data: id,
            type: "POST",
            cache: false,
            dataType: "json"
        }).done(function(response) {
            if (response) {
                alert(JSON.stringify(response));
            }
        });
    }
    function loadVar()
    {
        //set trigger
        trigger = $('#tableBody tbody td button');
        //set container
        container = $('#adminPanel');

        trigger.on('click',loadPHP);
    }
    $(document).ready(loadVar);
</script>
<script>
    $(".btn").click(function(){
        var id = this.id;
        console.log(id);
    });
</script>

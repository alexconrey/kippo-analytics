<?php
include('header.php');
global $mysqli;
global $settings;
global $sensors;
//        $mysqli = new mysqli('ml1db1.zynchost.local','kippo','JpcEQKrcSQ==','kippo');
if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM auth, sessions WHERE auth.session = sessions.id AND auth.session = '$id' LIMIT 256";
        if(!$result = $mysqli->query($sql)) {
                echo "Couldn't run that query";
		echo $mysqli->connect_error;
                exit;
        }
        if($result->num_rows === 0) {
                $error = throwError("That ID isn't showing in the records.");
        }
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">Search By ID: <?php echo $_GET['id']; ?></h1>

		<?php if(isset($error)) {
		        echo $error;
		        exit;
		}
		?>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<td>ID</td>
						<td>Start Time</td>
						<td>End Time</td>
						<td>Sensor</td>
						<td>Username</td>
						<td>Password</td>
						<td>IP</td>
					</tr>
				</thead>
			<tbody>
		<?php
	        while($attempt = $result->fetch_assoc()) {
				$list['id'] = $attempt['id'];
				$list['starttime'] = $attempt['starttime'];
				$list['endtime'] = $attempt['endtime'];
				$list['sensor'] = $attempt['sensor'];
				echo "<tr>";
                echo "<td><a href='searchByID.php?id=".$attempt['session']."'>".$attempt['session']."</a></td>";
				echo "<td>".$attempt['starttime']."</td>";
				echo "<td>".$attempt['endtime']."</td>";
				echo "<td><a href='searchBySensor.php?id=".$attempt['sensor']."'>".$sensors[$attempt['sensor']]['hostname']."</a></td>";
                echo "<td><a href='searchByUser.php?user=".$attempt['username']."'>".$attempt['username']."</a></td>";
				echo "<td>".$attempt['password']."</td>";
				echo "<td><a href='searchByIP.php?ip=".$attempt['ip']."'>".$attempt['ip']."</a></td>";
				echo "</tr>";	
	        }
?>
			</tbody>
			</table>
			</div>
		</div>
	</div>
</div>

<?php
} else {
?>
<div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Search By ID</h1>
          <div class="col-lg-6">
          	<div class="input-group input-group-lg">
          		<form action="#" method="get">
          		<input type="text" class="form-control" name="id" placeholder="Search for...">
          		<span class="input-group-btn">
          			<button class="btn btn-default" type="submit">Go!</button>
          		</span>
          	</div>
          </div>
        </div>
      </div>
</div>


<?php
}
?>
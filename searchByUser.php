<?php
	include('header.php');
	global $mysqli;
	if(isset($_GET['user'])) {
	    $user = $_GET['user'];
	//        $mysqli = new mysqli('ml1db1.zynchost.local','kippo','JpcEQKrcSQ==','kippo');
	    $sql = "SELECT sessions.id,starttime,endtime,sensor,username,password,ip FROM auth, sessions WHERE auth.session = sessions.id AND username = '".$user."'";
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
	          <h1 class="page-header">Search By Username: <?php echo $_GET['user']; ?></h1>

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
				echo "<tr>";
				echo "<td><a href='searchByID.php?id=".$attempt['id']."'>".$attempt['id']."</a></td>";
				echo "<td>".$attempt['starttime']."</td>";
				echo "<td>".$attempt['endtime']."</td>";
				echo "<td><a href='searchBySensor.php?id=".$attempt['sensor']."'>".$attempt['sensor']."</a></td>";
				echo "<td>".$attempt['username']."</td>";
				echo "<td>".$attempt['password']."</td>";
				echo "<td>".$attempt['ip']."</td>";
				echo "</tr>";	
	        }
	?>
			</tbody>
		</table>
	</div>
<?php } else { ?>
<div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Search By Username</h1>
          <div class="col-lg-6">
          	<div class="input-group input-group-lg">
          		<form action="#" method="get">
          		<input type="text" class="form-control" name="user" placeholder="Search for...">
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
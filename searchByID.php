<?php
include('header.php');
global $mysqli;
        $id = $_GET['id'];
//        $mysqli = new mysqli('ml1db1.zynchost.local','kippo','JpcEQKrcSQ==','kippo');
        $sql = "SELECT * FROM auth, sessions WHERE auth.session = sessions.id AND auth.session = '$id'";
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
		echo "<td>".$attempt['id']."</td>";
		echo "<td>".$attempt['starttime']."</td>";
		echo "<td>".$attempt['endtime']."</td>";
		echo "<td>".$attempt['sensor']."</td>";
		echo "<td>".$attempt['username']."</td>";
		echo "<td>".$attempt['password']."</td>";
		echo "<td>".$attempt['ip']."</td>";
		echo "</tr>";	
        }


?>
	</tbody>
</table>
</div>

<?php
include('header.php');
global $mysqli;
if(isset($_GET['ip'])) {
	$ip = $_GET['ip'];
//	$mysqli = new mysqli('ml1db1.zynchost.local','kippo','JpcEQKrcSQ==','kippo');
	$sql = "SELECT * FROM auth, sessions WHERE auth.session = sessions.id AND sessions.ip = '".$ip."'";
	if(!$result = $mysqli->query($sql)) {
		echo "Couldn't run that query";
//		exit;
	}
	if($result->num_rows === 0) {
		$error = throwError("That IP isn't showing in the records.");
	}
?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Search By IP: <?php echo $_GET['ip']; ?></h1>

<?php if(isset($error)) {
	echo $error;
	exit;
}
?>


<table>
<tr>
	<td>Session ID</td>
	<td>Username</td>
	<td>Password</td>
	<td>Timestamp</td>
	<td>IP</td>
</tr>
<?php

while($attempt = $result->fetch_assoc()) {
	echo "<tr>";
	echo "<td><a href='searchByID.php?id=".$attempt['session']."'>".$attempt['session']."</a></td>";
	echo "<td>".$attempt['username']."</td>";
	echo "<td>".$attempt['password']."</td>";
	echo "<td>".$attempt['timestamp']."</td>";
	echo "<td>".$attempt['ip']."</td>";
	echo "</td>";
}
?>
</table>
<?php

} else {
?>
<div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Search By IP</h1>
          <div class="col-lg-6">
          	<div class="input-group">
          		<form action="#" method="get">
          		<input type="text" class="form-control" name="ip" placeholder="Search for...">
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

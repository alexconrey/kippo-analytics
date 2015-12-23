<?php

include('header.php');
global $sensors;

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  if(!$result = $mysqli->query("SELECT * FROM sessions WHERE sensor = '".$id."'")) {
          echo "Couldn't run that query right now.";
          exit;
  }
          if($result->num_rows === 0) {
                  $error = throwError("That ID isn't showing in the records.");
          }
  ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Sensor <?php echo $sensors[$_GET['id']]['hostname']; ?></h1>

          <div class="row placeholders">
          </div>
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
            <td>IP</td>
          </tr>
        </thead>
      <tbody>
		<?php
		while($session = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td><a href='searchByID.php?id=".$session['id']."'>".$session['id']."</a></td>";
			echo "<td>".$session['starttime']."</td>";
			echo "<td>".$session['endtime']."</td>";
			echo "<td>".$sensors[$session['sensor']]['hostname']."</td>";
			echo "<td><a href='searchByIP.php?ip=".$session['ip']."'>".$session['ip']."</a></td>";
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
          <h1 class="page-header">Search By Sensor</h1>
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

include('footer.php');

?>
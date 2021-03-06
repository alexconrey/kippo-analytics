<?php
global $mysqli;
global $sensors;

if(!$result = $mysqli->query("SELECT auth.session,starttime,endtime,sensor,ip FROM auth,sessions WHERE auth.session = sessions.id ORDER BY starttime DESC LIMIT 50")) {
        echo "Couldn't run that query right now.";
        
}
if($result->num_rows === 0) {
        echo "Could not find any established connections";
        
}

?>

          <h2 class="sub-header">Sessions</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Session ID</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Sensor</th>
                  <th>Source IP</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while($session = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><a href='searchByID.php?id=".$session['session']."'>".$session['session']."</a></td>";
                        echo "<td>".$session['starttime']."</td>";
                        echo "<td>".$session['endtime']."</td>";
//                        echo "<td><a href='searchBySensor.php?id=".$session['sensor']."'>".$session['sensor']."</a></td>";
			echo "<td><a href='searchBySensor.php?id=".$session['sensor']."'>".$sensors[$session['sensor']]['hostname']."</a></td>";
                        echo "<td><a href='searchByIP.php?ip=".$session['ip']."'>".$session['ip']."</a></td>";
                        echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>

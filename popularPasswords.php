<?php
include('header.php');
		global $mysqli;
        $sql = "SELECT password FROM auth WHERE timestamp BETWEEN '".date('Y-m-d')." 00:00:00' AND '".date('Y-m-d')." 23:59:59' LIMIT 128";
        if(!$result = $mysqli->query($sql)) {
                echo "Couldn't run that query";
                exit;
        }
        if($result->num_rows === 0) {
                $error = throwError("That isn't showing in the records.");
                exit;
        }

        $list = array();
        while($attempt = $result->fetch_assoc()) {
                $list[] = $attempt['password'];
        }

        $unique_list = array_unique($list);
	$counted_list = array_count_values($list);
	$sane_list = $counted_list;
	arsort($counted_list);
//	print_r($counted_list);

?>


    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Popular Passwords</h1>

<?php if(isset($error)) {
        echo $error;
        exit;
}
?>
<div class="table-responsive">
        <table class="table table-striped">
                <thead>
                        <tr>
                                <td>Password</td>
                                <td>Attempts</td>
                        </tr>
                </thead>
        <tbody>
                <?php
                        foreach(array_keys($sane_list) as $item) {
                                echo "<tr>";
                                echo "<td>".$item."</td>";
                                echo "<td>".$sane_list[$item]."</td>";
                                echo "</tr>";
                        }
                ?>
        </tbody>
</table>
</div>

?>
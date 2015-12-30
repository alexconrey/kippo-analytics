<?php
include('header.php');

if(isset($_GET['keyword'])) {
	if(substr_count($_GET['keyword'], ".") == '3') {
		header('Location: searchByIP.php?ip='.$_GET['keyword']);
	} else if(strlen($_GET['keyword']) == '32') {
		header('Location: searchByID.php?id='.$_GET['keyword']);
	} else if(var_dump(checkdate(strtotime($_GET['keyword'])))) {
		header('Location: searchByDate.php?date='$_GET['keyword']);
	} 
} else {
?>
<div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Search For Something</h1>
          <div class="col-lg-6">
          	<div class="input-group input-group-lg">
          		<form action="#" method="get">
          		<input type="text" class="form-control" name="keyword" placeholder="Search By ID, IP, or Username">
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
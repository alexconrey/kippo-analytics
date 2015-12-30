<?php
include('header.php');

if(isset($_GET['keyword'])) {
	if(substr_count($_GET['keyword'], ".") = '3') {
		header('Location: searchByIP.php?ip='.$_GET['keyword']);
	}
} else {
?>


<?php
}
?>
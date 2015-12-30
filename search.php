<?php
include('header.php');

if(isset($_GET['keyword'])) {
	echo substr_count($_GET['keyword'], ".");
} else {
?>


<?php
}
?>
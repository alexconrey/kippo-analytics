<?php

class Widget {
	function load($name) {
		$path = "widgets/".$name.".php";
		include($path);
	}
}

?>

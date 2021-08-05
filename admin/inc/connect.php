<?php 
	$db = mysqli_connect("localhost","root","","ledp");
	if($db){
		//echo "database is connected";
	}
	else{
		echo "connection faild".mysqli_error($db);
	}
?>
<?php
	include("inc/connect.php") 
?>
<?php 
	function delete($del_id, $table, $table_id, $redirect_page){
		
            global $db;
            $query = "DELETE FROM $table WHERE $table_id = '$del_id'"; 
            $result = mysqli_query($db,$query);

            if ($result) {
                header('location: '.$redirect_page.'');
            }
            else{
                echo "error in delete user function";
            }
       
	}
?>
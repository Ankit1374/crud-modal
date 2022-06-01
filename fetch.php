<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'phpcrud');

  
        $e_id = $_POST['employee_id'];
        // $result_array = [];
        $query = "SELECT * FROM records WHERE id= '$e_id'";
        $query_run = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($query_run);
        echo json_encode($row);
?>

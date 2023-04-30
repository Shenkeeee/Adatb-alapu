<!DOCTYPE html>
<html>
<head>
    <link href="../css/listaz.css" rel="stylesheet">
</head>
<body>

<?php

echo "<h1> ETR </h1>";
echo "<h2>A tárgy kurzusai</h2>";

require "../tools/connect.php";
	
	session_start();
	$username=$_SESSION['username'];
	
	if (!isset($_SESSION["username"])) {
        header("Location: bejelentkezes.php");
    }

require "../tools/connect.php";
	
	//require_once "../tools/hallgatovizsgalat.php";
	
	
	

		if(isset($_GET['kurzuskód'])) { 
			$kurzuskód = $_GET['kurzuskód'];
			
			$query = oci_parse($conn, "DELETE FROM vizsgazik WHERE eha_kod='$username' AND azonosito='$kurzuskód'");
			$result = oci_execute($query, OCI_DEFAULT);
			if($result)
			{
			oci_commit($conn); //*** Commit Transaction ***//
			echo "Data Deleted Successfully.";
			header("location: ../php/vizsgaim.php");

			}
			else{
			echo "Error.";
			}
		
		}
		


?>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <link href="../css/listaz.css" rel="stylesheet">
</head>
<body>

<?php

echo "<h1> ETR </h1>";
echo "<h2>A tárgy kurzusai</h2>";
	
	$tns = "
(DESCRIPTION =
(ADDRESS_LIST =
(ADDRESS = (PROTOCOL = TCP)(HOST = orania2.inf.u-szeged.hu)(PORT = 1521))
)
(CONNECT_DATA =
(SID = orania2)
)
)";
	
	session_start();
	$username=$_SESSION['username'];
	
	if (!isset($_SESSION["username"])) {
        header("Location: bejelentkezes.php");
    }
	
	$conn=oci_connect("C##EL9JKS","C##EL9JKS",$tns, 'UTF8');

	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
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
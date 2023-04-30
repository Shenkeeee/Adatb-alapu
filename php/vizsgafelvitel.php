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
	
	require_once "../tools/hallgatovizsgalat.php";
	
	
	

		if(isset($_GET['kurzuskód'])) { 
		$kurzuskód = $_GET['kurzuskód'];
		
		
				$sqlp = "SELECT * FROM vizsgazik WHERE kurzus_kod='$kurzuskód' AND hallgato_eha_kod='$username'";
				
				$stmt = oci_parse($conn, $sqlp);
				if ($stmt){
					oci_execute($stmt, OCI_DEFAULT);
					oci_fetch($stmt);
					$kk = oci_result($stmt,"HALLGATO_EHA_KOD");
					if ($kk == $username) { 
						
						echo "<script> alert('Egy tárgynál egynpél több kurzust nem vehet fel! Kérem jelentkezen le a felvett kurzusról!');window.location='kurzusaim.php' </script>";
					}
					else { 
						
						$query = oci_parse($conn, "INSERT INTO vizsgazik VALUES ('$username','$kurzuskód',1)");
						$result = oci_execute($query, OCI_DEFAULT);
						if($result)
						{
						oci_commit($conn); //*** Commit Transaction ***//
						echo "Data Added succesfully.";
						echo "<script> alert('A vizsgát sikeresen felvetted!');window.location='vizsgaim.php' </script>";

					}
						else{
						echo "Error.";
						}
						
					}
					oci_free_statement($stmt);
					
				}
		
		}
		


?>
</body>
</html>
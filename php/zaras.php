<?php


session_start();
$username=$_SESSION['username'];

if (!isset($_SESSION["username"])) {
      header("Location: bejelentkezes.php");
}
require_once "../tools/navbar.php";

$tns = "
(DESCRIPTION =
(ADDRESS_LIST =
(ADDRESS = (PROTOCOL = TCP)(HOST = orania2.inf.u-szeged.hu)(PORT = 1521))
)
(CONNECT_DATA =
(SID = orania2)
)
)";


$conn=oci_connect("C##EL9JKS","C##EL9JKS",$tns, 'UTF8');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

				if(isset($_GET['kod'])) { 
					$kod = $_GET['kod'];
					
					$sqlp = "SELECT * FROM kurzus  WHERE kod='$kod'";
					
					
					$stmt = oci_parse($conn, $sqlp);
				if ($stmt){
					oci_execute($stmt, OCI_DEFAULT);
					oci_fetch($stmt);
					$kk = oci_result($stmt,"ZART");
					if ($kk == 0) { 
						// itt nem tudom hogy hogy lehet egyszerre többet - talan igy
						$query = oci_parse($conn, "UPDATE kurzus SET zart=1 WHERE kod='$kod'");
						$result = oci_execute($query, OCI_DEFAULT);
						if($result)
						{
						oci_commit($conn); //*** Commit Transaction ***//
						echo "Data Added succesfully.";
						header("location: ../php/kurzusListaz.php");

						}
						else{
						echo "Error.";
						}
					}
					else { 
						// itt nem tudom hogy hogy lehet egyszerre többet - talan igy
						echo "fnknf";
						$query = oci_parse($conn, "UPDATE kurzus SET zart=0 WHERE kod='$kod'");
						$result = oci_execute($query, OCI_DEFAULT);
						if($result)
						{
						oci_commit($conn); //*** Commit Transaction ***//
						echo "Data Added succesfully.";
						header("location: ../php/kurzusListaz.php");

						}
						else{
						echo "Error.";
						}
					
					}
					oci_free_statement($stmt);
					
				}
					
					
				}
				else { 
					echo "kidjf";
				}
				

?>
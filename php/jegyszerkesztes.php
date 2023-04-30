<?php

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

if (!isset($_SESSION["username"])) {
      header("Location: bejelentkezes.php");
}

$conn=oci_connect("C##EL9JKS","C##EL9JKS",$tns, 'UTF8');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

	if(isset($_POST['jegym'])) { 
		$errors = array();
		$true = true;
		if(empty($_POST['jegy'])) { 
			$true=false;
			array_push($errors,"Nem adtál meg jegyet!");
		}
		if($true) { 
				
				$jegy = $_POST["jegy"];
				$eha_kod = $_POST["eha"];
				$kurzuskód = $_POST["kurzuskod"];
				
						$query = oci_parse($conn, "UPDATE resztvesz SET erdemjegy='$jegy' WHERE hallgato_eha_kod='$eha_kod' AND kurzus_kod='$kurzuskód'");
						$result = oci_execute($query, OCI_DEFAULT);
						if($result)
						{
						oci_commit($conn); //*** Commit Transaction ***//
						echo "A jegy módosítás sikeresen megtörtént kérlek kattints a vissza gombra, hogy megnézd, hogy módosítást.";
						echo "<script> alert('A jegymódósítás sikeresen megtörtént!')window.location='kurzusListaz.php'; </script>";

					}
						else{
						echo "Error.";
						}
					
			}
			else {
				
				array_push($errors,"Hibás felhasználónév vagy jelszó!");
			}
		}
		
		
		if(isset($_POST['vjegym'])) { 
		$errors = array();
		$true = true;
		if(empty($_POST['jegy'])) { 
			$true=false;
			array_push($errors,"Nem adtál meg jegyet!");
		}
		if($true) { 
				
				$jegy = $_POST["jegy"];
				$eha_kod = $_POST["eha"];
				$kurzuskód = $_POST["kurzuskod"];
				
						$query = oci_parse($conn, "UPDATE vizsgazik SET erdemjegy='$jegy' WHERE eha_kod='$eha_kod' AND azonosito='$kurzuskód'");
						$result = oci_execute($query, OCI_DEFAULT);
						if($result)
						{
						oci_commit($conn); //*** Commit Transaction ***//
						echo "A jegy módosítás sikeresen megtörtént kérlek kattints a vissza gombra, hogy megnézd, hogy módosítást.";
						echo "<script> alert('A jegymódósítás sikeresen megtörtént!')window.location='kurzusListaz.php'; </script>";

					}
						else{
						echo "Error.";
						}
					
			}
			else {
				
				array_push($errors,"Hibás felhasználónév vagy jelszó!");
			}
		}
oci_close($conn);


	if(!empty($errors)) { 
		foreach($errors as $key) { 
			echo $key."<br/>";
		
		}
	}

?>
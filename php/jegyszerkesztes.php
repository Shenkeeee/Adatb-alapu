<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/listaz.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

</body>
</html>
<?php


session_start();
$username=$_SESSION['username'];

if (!isset($_SESSION["username"])) {
     header("Location: bejelentkezes.php");
	}

if (!isset($_SESSION["username"])) {
      header("Location: bejelentkezes.php");
}
require "../tools/connect.php";


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
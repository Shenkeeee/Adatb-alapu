<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
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


				$sqlp = "SELECT * FROM resztvesz WHERE kurzus_kod='$kurzuskód' AND hallgato_eha_kod='$username'";

				$stmt = oci_parse($conn, $sqlp);
				if ($stmt){
					oci_execute($stmt, OCI_DEFAULT);
					oci_fetch($stmt);
					$kk = oci_result($stmt,"HALLGATO_EHA_KOD");
					if ($kk == $username) {

						echo "<script> alert('Egy tárgynál egynpél több kurzust nem vehet fel! Kérem jelentkezen le a felvett kurzusról!');window.location='kurzusaim.php' </script>";
					}
					else {

						$query = oci_parse($conn, "INSERT INTO resztvesz VALUES ('$username','$kurzuskód',1)");
						$result = oci_execute($query, OCI_DEFAULT);
						if($result)
						{
						oci_commit($conn); //*** Commit Transaction ***//
						echo "Data Added succesfully.";
						echo "<script> alert('A kurzust sikeresen felvetted!');window.location='kurzusaim.php' </script>";

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



<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="styles.css"/>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
		<span class="icon-bar"></span>

	  </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">

	  <ul class="nav navbar-nav">
		<li> <a href="Saját profil.php" style="color: rgb(230, 149, 92);"> Saját profil </a> </li>
		<li> <a href="tárgyaklistája.php"> Tárgyfelvétel </a> </li>
		<li> <a href="targyakbeszurasa.php"> Tárgy létrehozása </a> </li>
		<li> <a href="sajáttárgyak.php"> Felvett Kurzusok </a> </li>
		<li> <a href="termeklistája.php"> Termek megtekintése </a> </li>
		<li> <a href="teremfelvitel.php"> Termek hozzáadása </a> </li>
		<li> <a href="felhasznalok.php"> Felhasználók kezelése </a> </li>

	</ul>
      <ul class="nav navbar-nav navbar-right">
        <li> <a href="logout.php"> <span class="glyphicon glyphicon-log-in"></span> Kijelentkezés </a> </li>
      </ul>
    </div>
  </div>
</nav>
<body>

<h1> Kurzus leadás </h1>

<?php


	$conn = new mysqli("localhost","root","","etr");
	session_start();
	$username=$_SESSION['username'];

	if (!isset($_SESSION["username"])) {
        header("Location: bejelentkezés.php");
    }

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

		if(isset($_GET['id'])) {

			$kurzuskód = $_GET['id'];


			$sql_oktato_tor = "DELETE  FROM tartja WHERE Kurzuskód='$kurzuskód'";
			if ($conn->query($sql_oktato_tor) === TRUE) {
				echo " <script> alert('A kurzus oktatóinak törlése sikeresen megtörtént!'); </script>";
			} else {
				echo "Error deleting record: " . $conn->error;
				}


			$sql_hallg_tor = "DELETE  FROM résztvesz WHERE kurzuskód='$kurzuskód'";
			if ($conn->query($sql_hallg_tor) === TRUE) {
				echo " <script> alert('A kurzus hallgatóinak törlése sikeresen megtörtént!'); </script>";
			} else {
				echo "Error deleting record: " . $conn->error;
				}

			$sql = "DELETE  FROM kurzusok WHERE kurzuskód='$kurzuskód'";

			if ($conn->query($sql) === TRUE) {
				echo " <script> alert('A kurzus törlése sikeresen megtörtént!');window.location='sajáttárgyak.php' </script>";
			} else {
				echo "Error deleting record: " . $conn->error;
				}

		}



		if(isset($_GET['kurzuskód'])) {
		$kurzuskód = $_GET['kurzuskód'];

		$sql_kurzus = "SELECT kurzuskód,név,kredit,maxfő,nap,kezdet,vég,óraszám,teremnév FROM kurzusok WHERE kurzuskód='$kurzuskód'";
		$result_kurzus = $conn->query($sql_kurzus);







		if ($result_kurzus->num_rows == 1) {
		echo " <form action='kurzustorles.php' method='POST'>
		<table>";
		while($row = $result_kurzus->fetch_assoc()) {
			echo " 
			<tr> <td> kurzuskód </td> <td>" . $row['kurzuskód']. "</td> </tr>
			<tr> <td> név </td> <td>" . $row['név']. "</td> </tr>
			<tr> <td> kredit </td> <td>" . $row['kredit']. "</td> </tr>
			<tr> <td> maxfő </td> <td>" . $row['maxfő']. "</td> </tr>
			<tr> <td> időpont </td> <td>" . $row['nap']. ": " . $row['kezdet']. " - " . $row['vég']. " </td> </tr>
			<tr> <td> óraszám </td> <td>" . $row['óraszám']. "</td> </tr>
			<tr> <td> teremnév </td> <td>" . $row['teremnév']. "</td> </tr>
			<tr> <td>  </td> <td> <a href='kurzustorles.php?id=".$row["kurzuskód"]."'> Leadás </a> </td> </tr>";
		}
		echo "</table>
		</form>";

	} else {
		echo "Nincsenek tárgyak rögzítve!";
	}


	}
	else {
		echo "Hiba!";
	}

?>
<script>
	function figyelmezetetoablak_torles() {
		return confirm('Biztosan leszeretné adni ezt a kurzust?')
	}

</script>
</body>
</html>
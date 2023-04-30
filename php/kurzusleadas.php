<!DOCTYPE html>
<html>
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

			$query = oci_parse($conn, "DELETE FROM resztvesz WHERE hallgato_eha_kod='$username' AND kurzus_kod='$kurzuskód'");
			$result = oci_execute($query, OCI_DEFAULT);
			if($result)
			{
			oci_commit($conn); //*** Commit Transaction ***//
			echo "Data Deleted Successfully.";
			header("location: ../php/kurzusaim.php");

			}
			else{
			echo "Error.";
			}

		}

			if(isset($_GET['vizsgakod'])) {
			$vizsgakod = $_GET['vizsgakod'];

			$query = oci_parse($conn, "DELETE FROM vizsgazik WHERE azonosito='$vizsgakod' AND eha_kod='$username'");
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










<!---->
<!---->
<!--$kod= $_POST["kod"];-->
<!---->
<!--echo $kod. " ot torlom elv " . ' <br>';-->
<!---->
<!--$query = oci_parse($conn, "DELETE FROM kurzus WHERE kod='" . $kod. "'");-->
<!--$result = oci_execute($query, OCI_DEFAULT);-->
<!--if($result)-->
<!--{-->
<!--    oci_commit($conn); //*** Commit Transaction ***//-->
<!--    echo "Data Deleted Successfully.";-->
<!--    header("location: ../php/kurzusListaz.php");-->
<!---->
<!--}-->
<!--else{-->
<!--    echo "Error.";-->
<!--}-->
<!---->
<!---->
<!---->
<!---->



<!DOCTYPE html>
<html>
<body>

<h1> Kurzus leadás </h1>

<?php

	session_start();
	$username=$_SESSION['username'];
	$conn = new mysqli("localhost","root","","etr");
	
	
	if (!isset($_SESSION["username"])) {
        header("Location: bejelentkezés.php");
    }
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

		if(isset($_GET['id'])) {

			$kurzuskód = $_GET['id'];


			$sql_oktato= "SELECT * FROM `oktatók` WHERE EHA_kód='$username'";
			$result_oktato = $conn->query($sql_oktato);

			if($result_oktato->num_rows == 1) {
				$sql = "DELETE FROM tart WHERE EHA_kód='$username' AND kurzuskód='$kurzuskód'";

			if ($conn->query($sql) === TRUE) {

                // 5. eljaras

                $query = oci_parse($conn, 'BEGIN diak_lejelentkezes(:p_eha_kod, :p_kod); END;');
                oci_bind_by_name($query, ':p_eha_kod', $username);
                oci_bind_by_name($query, ':p_kod', $kurzuskód);
                oci_execute($query);

				echo " <script> alert('A kurzus leadása sikeresen megtörtént!');window.location='sajáttárgyak.php' </script>";
			} else {
				echo "Error deleting record: " . $conn->error;
				}
			}
			else {
				$sql = "DELETE FROM résztvesz WHERE EHA_kód='$username' AND kurzuskód='$kurzuskód'";

			if ($conn->query($sql) === TRUE) {

                // 5. eljaras

                $query = oci_parse($conn, 'BEGIN diak_lejelentkezes(:p_eha_kod, :p_kod); END;');
                oci_bind_by_name($query, ':p_eha_kod', $username);
                oci_bind_by_name($query, ':p_kod', $kurzuskód);
                oci_execute($query);

				echo " <script> alert('A kurzus leadása sikeresen megtörtént!');window.location='sajáttárgyak.php' </script>";
			} else {
				echo "Error deleting record: " . $conn->error;
				}


			}


		}



		if(isset($_GET['kurzuskód'])) {
		$kurzuskód = $_GET['kurzuskód'];
		
		$sql_kurzus = "SELECT kurzuskód,név,kredit,maxfő,nap,kezdet,vég,óraszám,teremnév FROM kurzusok WHERE kurzuskód='$kurzuskód'";
		$result_kurzus = $conn->query($sql_kurzus);
		
		
		
		
		
		
		
		if ($result_kurzus->num_rows == 1) {
		echo " <form action='kurzusleadas.php' method='POST'>
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
			<tr> <td>  </td> <td> <a href='kurzusleadas.php?id=".$row["kurzuskód"]."'> Leadás </a> </td> </tr>";
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
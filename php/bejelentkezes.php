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


$conn=oci_connect("C##EL9JKS","C##EL9JKS",$tns, 'UTF8');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

	if(isset($_POST['submit'])) { 
		$errors = array();
		$true = true;
		if(empty($_POST['username'])) { 
			$true=false;
			array_push($errors,"A felhasználónév üres!");
		}
		if(empty($_POST['password'])) { 
			$true=false;
			array_push($errors,"A jelszó üres!");
		}
		if($true) { 
				
				$username = $_POST["username"];
				$jsz = $_POST["password"];
				
				$sqlp = "SELECT * FROM felhasznalo WHERE eha_kod='$_POST[username]' AND jelszo='$_POST[password]'";
				
				$stmt = oci_parse($conn, $sqlp);
				if ($stmt){
					oci_execute($stmt, OCI_DEFAULT);
					oci_fetch($stmt);
					$kk = oci_result($stmt, "JELSZO");
					$kk2 = oci_result($stmt,"EHA_KOD");
					if ($kk == $jsz && $kk2 == $username) { 
						session_start();
						$_SESSION['username'] = $username;
						//echo "<script> alert('Sikeres bejelentkezés!'); </script>";
						echo "<script> alert('Sikeres bejelentkezés!');window.location='index.php' </script>";
					}
					else { 
						echo "Rossz felhasználónév vagy jelszó!";
					}
					oci_free_statement($stmt);
					
			}
			else {
				
				array_push($errors,"Hibás felhasználónév vagy jelszó!");
			}
		}
	
	}
	oci_close($conn);
?>

<html>

<body>
	<h1> ETR </H1>
	<h2> Bejelentkezés </h2>

	<form method="POST" action="bejelentkezes.php">
    <fieldset>
    <legend> Bejelentkezés</legend>
      <label for="felhasznalonev">EHA_kód:</label>
      <input type="text" id="felhasznalonev" name="username" placeholder="EL9JKS" required /> <br/><br/>
      <label for="passwdl">Jelszó:</label>
      <input type="password" id="passwdl" name="password" required /> <br/><br/>
      <input type="submit" name="submit" value="Bejelentkezés"/>
    </fieldset>
  </form>
	
	<?php 
	if(!empty($errors)) { 
		foreach($errors as $key) { 
			echo $key."<br/>";
		
		}
	}
	?>
	

</body>

</html>
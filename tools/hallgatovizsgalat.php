<?php

                require "../tools/connect.php";
				
				//$username=$_SESSION['username'];
				
				$sqlp = "SELECT * FROM hallgato  WHERE eha_kod='$username'";
				
				$stmt = oci_parse($conn, $sqlp);
				if ($stmt){
					oci_execute($stmt, OCI_DEFAULT);
					oci_fetch($stmt);
					$kk = oci_result($stmt,"EHA_KOD");
					if ($kk != $username) { 
						
						echo "<script> alert('Nem vagy hallgató ezért minek veszed fel a kurzust!');window.location='index.php' </script>";
					}
					oci_free_statement($stmt);
					
				}



?>
<?php
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

$rowsadmin = "";


$query = 'SELECT SZAKID FROM SZAK';
$stid = oci_parse($conn, $query);
oci_execute($stid);

$targykod = $_POST["targykod"];
$nev = $_POST["nev"];
$ajanlottfelev = $_POST["ajanlottfelev"];
$oraszam = $_POST["oraszam"];
$szakid = $_POST["szakid"];

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/listaz.css" rel="stylesheet">

    <title>Tárgy módosít</title>
</head>
<body>
<h1>Tárgy módosítása</h1>

<form action="../tools/targyModositTool.php" method="POST">

    Tárgykód
    <input name="targykod" disabled value="<?php echo $targykod ?>">   <br>

    Név
    <input name="nev" value="<?php echo $nev ?>">  <br>

    Óraszám
    <input name="oraszam" value="<?php echo $oraszam ?>">  <br>

    Ajánlott félév
    <input name="ajanlottfelev" value="<?php echo $ajanlottfelev ?>">  <br>

    SzakID
    <select name="szakid">
        <?php
        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $szakid = $row['SZAKID'];
            echo "<option value=\"$szakid\">$szakid</option>";
        }
        ?>
    </select><br>

    <button type="submit">Modosit</button> <br>
</form>

</body>
</html>

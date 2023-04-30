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

$teremnev = $_POST["teremnev"];
$ferohely = $_POST["ferohely"];

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/listaz.css" rel="stylesheet">

    <title>Terem módosít</title>
</head>
<body>
<h1>Terem módosítása</h1>

<form action="../tools/teremModositTool.php" method="POST">

    Teremnév
    <input name="teremnev" disabled value="<?php echo $teremnev?>">   <br>

    Gépes
    <select name="gepes">
        <option value="1">Igen</option>
        <option value="0">Nem</option>
    </select>

    Férőhely
    <input name="ferohely" type="number" value="<?php echo $ferohely ?>">  <br>

    <button type="submit">Modosit</button> <br>
</form>

</body>
</html>

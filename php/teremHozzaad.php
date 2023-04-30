<?php
require_once "../tools/navbar.php";
require "../tools/connect.php";

// adminhoz - hogy olyat ne lehessen kivalasztani aki mar admin

$stid2 = oci_parse($conn, 'SELECT eha_kod FROM adminisztrator');
oci_execute($stid2);



// felhasznalokhoz

$stid = oci_parse($conn, 'SELECT eha_kod FROM felhasznalo');
oci_execute($stid);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/listaz.css" rel="stylesheet">

    <title>Terem hozzáad</title>
</head>
<body>

<h1>Terem hozzáadása</h1>

<form action="../tools/teremHozzaaadTool.php" method="POST">

    Teremnev
<input name="teremnev">  <br>

    Gépes
    <input type="checkbox" name="gepes" value="1">

    Ferohely
<input name="ferohely" type="number">  <br>

    <button type="submit">Hozzaad</button> <br>
</form>

</body>
</html>

<?php
require_once "../tools/navbar.php";
require "../tools/connect.php";


// adminhoz - hogy olyat ne lehessen kivalasztani aki mar admin

$stid2 = oci_parse($conn, 'SELECT eha_kod FROM adminisztrator');
oci_execute($stid2);



// felhasznalokhoz

$stid = oci_parse($conn, 'SELECT eha_kod FROM felhasznalo');
oci_execute($stid);


// Generate new szakid
$max_id_query = oci_parse($conn, 'SELECT MAX(szakid) FROM szak');
oci_execute($max_id_query);
$max_id_result = oci_fetch_assoc($max_id_query);
$szakid = intval($max_id_result['MAX(SZAKID)']) + 1;





?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/listaz.css" rel="stylesheet">

    <title>Szak hozzáad</title>
</head>
<body>
<h1>Szak hozzáadása</h1>

<form action="../tools/szakHozzaaadTool.php" method="POST">

    SzakID

<label name="szakid" placeholder="<?php echo $szakid; ?>">  <br>

    Szaknev
<input name="szaknev">  <br>

    <button type="submit">Hozzaad</button> <br>
</form>

</body>
</html>

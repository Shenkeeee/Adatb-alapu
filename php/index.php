<?php

session_start();
$username=$_SESSION['username'];

if (!isset($_SESSION["username"])) {
      header("Location: bejelentkezes.php");
}

require "../tools/connect.php";

require_once "../tools/navbar.php";

echo "Szevasz. na hova tova?";

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/listaz.css" rel="stylesheet">
    <title>Index</title>
</head>
<body>

</body>
</html>
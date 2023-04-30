<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--    <link rel="stylesheet" href="../css/forAll.css">-->
<!--    <link rel="stylesheet" href="../css/chat.css">-->

<!--    <link rel="icon" href="../img/icon.png">-->
</head>
<body>
<div class="main">

    <?php

    session_start();
    $username=$_SESSION['username'];

    if (!isset($_SESSION["username"])) {
        header("Location: bejelentkezes.php");
    }


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


    ?>

    <div class="content">
        <div class="container">

            <h1>Uzenetek</h1>

            <main>
                <form action="../tools/uzenetHozzaaadTool.php" method="POST">
<!--                    <label for="messages">Messages</label>-->
                    <!-- listing messages -->
                    <textarea  style="width: 1000px;" id="messages" name="messages" rows="22" readonly><?php
//
//                        if($userTo==="Everyone")
//                        {

                        $stid = oci_parse($conn, 'SELECT * FROM uzenet');
                        oci_execute($stid);

                        //                        }
//                        $messagesData = mysqli_query($conn,$sql);
//
                        $messages = "";
//
                        while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS))
                        {
                            $messages .= $row["EHA_KOD"] . ": " . $row["DATUM"] . ": " . $row["TARTALOM"] . "\n";
                        }
//
//                        // if there were no previous messages
                        if($messages === "")
                        {
                            $messages = "Start chatting!";
                        }
//
                        echo $messages;
                        ?></textarea>
                    <br>

                     <input type="hidden" name="ehakod" value="<?php echo $username ?>">
                     <input type="hidden" name="datum" value="<?php echo date('Y-m-d H:i:s');?>">


                    <label for="tartalom">Write</label>
                    <input  style="width: 300px;" type="text" id="tartalom" name="tartalom" required>

                    <button type="submit">Send Message</button>
                    <button type="reset">Reset</button>


                </form>
            </main>


        </div>
    </div>
</div>

</body>
</html>
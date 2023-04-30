<?php
$tns = "
        (DESCRIPTION =
            (ADDRESS_LIST =
              (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
            )
            (CONNECT_DATA =
              (SID = orania2)
            )
          )";

$username = 'C##EL9JKS';
$password = 'C##EL9JKS';

$conn = oci_connect("$username", "$password", $tns,'AL32UTF8');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['Error'], ENT_QUOTES), E_USER_ERROR);
}


//mienk


//
//$tns = "
//(DESCRIPTION =
//(ADDRESS_LIST =
//(ADDRESS = (PROTOCOL = TCP)(HOST = orania2.inf.u-szeged.hu)(PORT = 1521))
//)
//(CONNECT_DATA =
//(SID = orania2)
//)
//)";
//
//$conn=oci_connect("C##EL9JKS","C##EL9JKS",$tns, 'UTF8');
//
//if (!$conn) {
//    $e = oci_error();
//    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
//}

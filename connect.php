<?php
$serverName = "167.114.14.136\sqlexpress"; //serverName\instanceName
$connectionInfo = array( "Database"=>"test_android", "UID"=>"elixirapp", "PWD"=>"newpassword@123#");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
die( print_r( sqlsrv_errors(), true));
}
?>
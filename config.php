<?php
$serverName = "167.114.14.136"; //serverName\instanceName
$connectionInfo = array( "Database"=>"test_android", "UID"=>"elixirapp", "PWD"=>"newpassword@123#");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
?>
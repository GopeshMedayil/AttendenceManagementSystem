<?php
$serverName = "167.114.14.136"; //serverName\instanceName
$connectionInfo = array( "Database"=>"test_android", "UID"=>"elixirapp", "PWD"=>"newpassword@123#");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}

$sql = "select table_name from information_schema.tables";
$stmt = sqlsrv_query( $conn, $sql);

echo "------------------------------------------.<br />";
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
    echo $row['table_name']."<br />";
}

if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}

echo "------------------------------------------.<br />";

$query = sqlsrv_query($conn, 'SELECT * FROM branchUsers');
echo "Branch user.<br/>";
echo "<table cellspacing='10'>";
echo "<th>user_id</th><th>user_name</th><th>branch_code</th><th>pwd</th><th>userprof_code</th><th>ref_code</th><th>emp_name</th><th>active</th><th>logged_in</th>";
while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
	echo "<tr><td>".$row['user_id']."</td><td>".$row['user_name']."</td><td>".$row['branch_code']."</td><td>".$row['pwd']."</td><td>".$row['userprof_code']."</td><td>".$row['ref_code']."</td><td>".$row['emp_name']."</td><td>".$row['active']."</td><td>".$row['logged_in']."</td></tr>";
}
echo "</table>";

echo "------------------------------------------.<br />";



$query = sqlsrv_query($conn, 'SELECT * FROM branchUserProfile');
echo "branchUserProfile<br/>";
echo "<table cellspacing='10'>";
echo "<th>userprof_code</th><th>branch_code</th><th>ug_code</th><th>teaching_staff</th><th>userprof_name</th><th>active</th>";
while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
	echo "<tr><td>".$row['userprof_code']."</td><td>".$row['branch_code']."</td><td>".$row['ug_code']."</td><td>".$row['teaching_staff']."</td><td>".$row['userprof_name']."</td><td>".$row['active']."</td></tr>";
}
echo "</table>";
echo "------------------------------------------.<br />";


$query = sqlsrv_query($conn, 'SELECT * FROM staffMaster');
echo "staffMaster<br/>";
echo "<table cellspacing='10'>";
echo "<th>staff code</th><th>branch_code</th><th>appoint_year</th><th>staff_id</th><th>staff_name</th><th>userprof_code</th><th>img</th><th>dob</th><th>contact_no</th><th>email</th><th>cur_status</th>";
while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
	echo "<tr><td>".$row['staff_code']."</td><td>".$row['branch_code']."</td><td>".$row['appoint_year']."</td><td>".$row['staff_id']."</td><td>".$row['staff_name']."</td><td>".$row['userprof_code']."</td><td>".$row['img']."</td><td>".$row['dob']."</td><td>".$row['contact_no']."</td><td>".$row['email']."</td><td>".$row['cur_status']."</td></tr>";
}
echo "</table>";
echo "------------------------------------------.<br />";

$query = sqlsrv_query($conn, 'SELECT * FROM studentMaster');
echo "studentMaster<br/>";
echo "<table cellspacing='10'>";
echo "<th>stud_id</th><th>branch_code</th><th>acadyear_id</th><th>admn_no</th><th>stud_name</th><th>img</th><th>address1</th><th>birth_place</th><th>father_name</th><th>father_dob</th><th>father_occupation</th><th>mother_name</th><th>parent_contno</th><th>mailid</th>";
while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
	echo "<tr><td>".$row['stud_id']."</td><td>".$row['branch_code']."</td><td>".$row['acadyear_id']."</td><td>".$row['admn_no']."</td><td>".$row['stud_name']."</td><td>".$row['img']."</td><td>".$row['address1']."</td><td>".$row['birth_place']."</td><td>".$row['father_name']."</td><td>".$row['father_dob']."</td><td>".$row['father_occupation']."</td><td>".$row['mother_name']."</td><td>".$row['parent_contno']."</td><td>".$row['mailid']."</td></tr>";
}
echo "</table>";
echo "------------------------------------------.<br />";

$query = sqlsrv_query($conn, "SELECT * FROM branchUsers where user_name = 'studuser1'");
while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
	$userId = $row['user_id'];
	$username = $row['user_name'];
	$profileCode = $row['userprof_code'];
	$refCode = $row['ref_code'];
}

$result = array();
if($profileCode == 1 || $profileCode == 2){
	//$query = "select * FROM staffMaster where staff_id = ".$refCode."";	
	$query = sqlsrv_query($conn, "select * FROM staffMaster where staff_id = '".$refCode."' ");
	while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
		$result['branchCode'] = $row['branch_code'];
		$result['staffId'] = $row['staff_id'];
		$result['staffName'] = $row['staff_name'];
		$result['contact'] = $row['contact_no'];
	}	
}else{
	//$query = "select * FROM studentMaster where admn_no = '".$refCode."' ";	
	$query = sqlsrv_query($conn, "select * FROM studentMaster where admn_no = '".$refCode."' ");
	while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
		$result['branchCode'] = $row['branch_code'];
		$result['admn_no'] = $row['admn_no'];
		$result['stud_name'] = $row['stud_name'];
		$result['address1'] = $row['address1'];
	}	
}

//header('Content-type: application/json');
//echo json_encode($result);

/*
echo "JOIN QUERY";
$username = 'studuser1';
$sql="select * FROM branchUsers INNER JOIN ".$tableName." ON ref_code = admn_no where user_name = 'studuser1'";
echo $sql;
$query = sqlsrv_query($conn, $sql);
$row = sqlsrv_fetch_array($query);

header('Content-type: application/json');
echo json_encode($row);
*/

//header('Content-type: application/json');
//echo json_encode($result);

?>
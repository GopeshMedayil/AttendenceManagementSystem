<?php
include("config.php");

if($conn){

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

$query = sqlsrv_query($conn, "SELECT * FROM branchUsers where user_name = '".$username."' ");
while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
	$userId = $row['user_id'];
	$username = $row['user_name'];
	$profileCode = $row['userprof_code'];
	$refCode = $row['ref_code'];
}

$result = array();
$data = array();
if($profileCode == 1 || $profileCode == 2){
	//$query = "select * FROM staffMaster where staff_id = ".$refCode."";	
	$query = sqlsrv_query($conn, "select * FROM staffMaster where staff_id = '".$refCode."' ");
	while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
		$data['roleTypeId'] = $profileCode;
		$data['staffCode'] = $row['staff_code'];
		$data['branchCode'] = $row['branch_code'];
		$data['staffId'] = $row['staff_id'];
		$data['staffName'] = $row['staff_name'];
		$data['userprofCode'] = $row['userprof_code'];
		$data['img'] = $row['img'];
		$data['dob'] = $row['dob'];
		$data['perm_addline1'] = $row['perm_addline1'];
		$data['perm_addline2'] = $row['perm_addline2'];
		$data['cont_addline1'] = $row['cont_addline1'];
		$data['cont_addline2'] = $row['cont_addline2'];
		$data['contact_no'] = $row['contact_no'];
		$data['sms_no'] = $row['sms_no'];
		$data['email'] = $row['email'];
		$data['cur_status'] = $row['cur_status'];
	}	
}else{
	$query = sqlsrv_query($conn, "select * FROM studentMaster where admn_no = '".$refCode."' ");
	while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
		$data['roleTypeId'] = $profileCode;
		$data['stud_id'] = $row['stud_id'];
		$data['branchCode'] = $row['branch_code'];
		$data['admn_no'] = $row['admn_no'];
		$data['stud_name'] = $row['stud_name'];
		$data['img'] = $row['img'];
		$data['address1'] = $row['address1'];
		$data['address2'] = $row['address2'];
		$data['birth_place'] = $row['birth_place'];
		$data['father_name'] = $row['father_name'];
		$data['father_dob'] = $row['father_dob'];
		$data['father_dob'] = $row['father_dob'];
		$data['mother_name'] = $row['mother_name'];
		$data['mother_occupation'] = $row['mother_occupation'];
		$data['parent_contno'] = $row['parent_contno'];
		$data['localguard_name'] = $row['localguard_name'];
		$data['localguard_relation'] = $row['localguard_relation'];
		$data['localguad_contno'] = $row['localguad_contno'];
		$data['sms_no'] = $row['sms_no'];
		$data['mailid'] = $row['mailid'];
		$data['cur_status'] = $row['cur_status'];
		$data['is_deleted'] = $row['is_deleted'];
	}	
}

}


$result['data'] = $data;
header('Content-type: application/json');
echo json_encode($result);

?>
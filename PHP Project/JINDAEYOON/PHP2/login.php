<?
	$DVID = $_POST['DeviceID'];
	$PN = $_POST['Phone_Number'];

	require "./db_connect.php";			

	$sql = "select * from user where PhoneNumber='$PN' and DeviceID = '$DVID'";           
	//휴대전화번호가 같은 회원이 있는지 검사
	$result = mysql_query($sql , $connect);
	$idnum = mysql_num_rows($result);
	if($idnum<1){
		echo "일치하는 회원 정보가 없습니다.";
		//exit;
	}else{
		echo "로그인 성공했습니다.";
	}
?>
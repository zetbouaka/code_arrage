<?
	echo "이름 : {$_POST['name']}<BR>";
	echo "디바이스 ID : {$_POST['DeviceID']}<BR>";
	echo "휴대전화번호 : {$_POST['Phone_Number']}<BR>";
	
	echo "데이터 베이스에 접속합니다...<BR>";

	$name = $_POST['name'];
	$PN = $_POST['Phone_Number'];
	$DIV = $_POST['DeviceID'];
	
	require "./db_connect.php";																		
	
	//mysql에 접속한다
	echo "데이터 베이스 접속완료<p>";
	echo "이름 : $name<p>휴대전화번호 : $PN<p>디바이스 ID : $DIV";
	$sql = "select * from user where PhoneNumber='$PN'";           //휴대전화번호가 같은 회원이 있는지 검사
	$result = mysql_query($sql , $connect);
	$idnum = mysql_num_rows($result);
	if($idnum){
		echo "이미 같은 휴대전화번호의 유저가 있습니다.";
		exit;
	}else{
		$sql = "insert into user SET Name = '$name', PhoneNumber = '$PN', DeviceID = '$DIV' ";
		mysql_query($sql, $connect);
		$sql = "insert into group_user (PhoneNumber, Group) values('$PN', NONE)";
		mysql_query($sql, $connect);
		
		echo "가입이 완료되었습니다<p>";
		echo ("
			<form name=main method=post action='user_join.php'>
			<input type=submit name=submit value=회원가입으로 돌아가기>
			</form>
			");
	}
	
?>
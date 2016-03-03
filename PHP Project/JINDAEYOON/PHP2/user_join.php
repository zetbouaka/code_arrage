<?
#	echo "이름 : {$_POST['name']}<BR>";
#	echo "디바이스 ID : {$_POST['DeviceID']}<BR>";
#	echo "이메일 : {$_POST['email']}<BR>";
#	echo "휴대전화번호 : {$_POST['phonenum']}<BR>";
	
#	echo "데이터 베이스에 접속합니다...<BR>";

	$name = $_POST['name'];
	$PN = $_POST['phonenum'];
	$DIV = $_POST['deviceID'];
	$EM = $_POST['email'];
	
	#$name = "A";
	#$PN = "01074423141";
	
	require "./db_connect.php";																		
	
	//mysql에 접속한다

#	echo "데이터 베이스 접속완료<p>";
#	echo "이름 : $name<p>휴대전화번호 : $PN<p>디바이스 ID : $DIV";
	$sql = "SELECT * FROM user WHERE phonenum='$PN'";           //휴대전화번호가 같은 회원이 있는지 검사
	$result = mysql_query($sql , $connect);
	$idnum = mysql_num_rows($result);
	if($idnum){
		echo "이미 같은 휴대전화번호의 유저가 있습니다.";
		exit;
	}else{
		$sql = "INSERT INTO user SET name = '$name', phonenum = '$PN', deviceID = '$DIV', email = '$EM'";
		mysql_query($sql, $connect);
		$sql = "SELECT * FROM user WHERE phonenum='$PN'";
		$result = mysql_query($sql, $connect);
		$num = mysql_num_rows($result);
		if ($num==0){
			echo "일치하는 일정잡기가 없습니다.";
			exit;
		}
		$list = mysql_fetch_array($result);
		$key = $list[userID];
		echo "$key";
	}
?>
<?PHP
	#echo "그룹 ID : ?";
	#echo "소유자 아이디 : {$_POST['userID']}";
	#echo "그룹 이름 : {$_POST['name']}";

	require "./db_connect.php";																		
	
	$group_name = $_POST['name'];
	$group_userID = $_POST['userID'];
	
	//mysql에 접속한다
	#echo "데이터 베이스 접속완료<p>";
	//echo "EE";
	#$group_name = "진대윤";
	#$group_userID = 25;

	$sql = "SELECT * FROM grouplist WHERE name = '$group_name'";
	//그룹 이름이 같은 그룹이 있는지 조사
	$result = mysql_query($sql , $connect);
	$idnum = mysql_num_rows($result);
	if($idnum){
		echo "이미 같은 이름의 그룹이 있습니다.";
		exit;
	}else{

		$sql = "INSERT INTO grouplist SET name = '$group_name', userID = $group_userID";
		mysql_query($sql, $connect);
		
		$sql = "SELECT * FROM grouplist WHERE name = '$group_name'";
		$result = mysql_query($sql , $connect);
		$idnum = mysql_num_rows($result);

		$list = mysql_fetch_array($result);
		$key=$list[ID];
		echo "$key";
		#echo "그룹 추가가 완료되었습니다<p>";
	}
?>
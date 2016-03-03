<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>무제 문서</title>
</head>

<body>
<?

	echo "데이터 베이스에 접속합니다...<BR>";

	$Gname = $_POST['group_name'];
	
	require "./db_connect.php";																		
	
	//mysql에 접속한다
	echo "데이터 베이스 접속완료<p>";
	echo "그룹 이름 : $Gname<p>";
	$sql = "select * from GroupList where Name='$Gname'";           //그룹 이름이 이미 존재하고 있는지 확인
	$result = mysql_query($sql , $connect);
	$idnum = mysql_num_rows($result);
	if($idnum){
		echo "이미 같은 이름의 그룹이 존재합니다.";
		exit;
	}else{
		$sql = "INSERT INTO GroupList SET Name = '$Gname'";
		mysql_query($sql, $connect);
		echo "$Gname 그룹을 생성했습니다.<p>";
		echo ("
			<form name=main method=post action='group_make_form.php'>
			<input type=submit name=submit value=그룹 만들기으로 돌아가기>
			</form>
			");
	}
	
?>
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>무제 문서</title>
</head>

<body>
<?
echo "데이터 베이스에 접속합니다...<BR>";

$PN = $_POST['Phone_Number'];
$GROUP = $_POST['Group'];

//휴대전화 $PN 회원을 $GROUP 그룹으로 옮긴다.

	require "./db_connect.php";																		
	require "./login.php";
	
	//mysql에 접속한다
	echo "데이터 베이스 접속완료<p>";
	echo "회원 $PN을 $GROUP 그룹으로 옮깁니다.<p>";
	
	$sql = "select * from group_user where PhoneNumber='$PN'"; 
	
	$result = mysql_query($sql , $connect);
	$idnum = mysql_num_rows($result);
	
	if(!$idnum){
		echo "회원 $PN이 데이터베이스에 존재하지 않습니다.";
		exit;
	}else{
		$sql = "DELETE from group_user where PhoneNumber='$PN'"; 
		$result1 = mysql_query($sql , $connect);
		if(!$result1){
			echo "회원 $PN 데이터를 삭제하는데 실패했습니다</p>";
			exit;
		}
		$sql = "INSERT into group_user SET PhoneNumber='$PN', Gcheck='$GROUP'"; 
		$result2 = mysql_query($sql , $connect);
		if(!$result2){
			echo "회원 $PN 데이터를 입력 실패했습니다</p>";
			exit;
		}
		echo "회원 $PN을 $GROUP 그룹으로 옮기는 것에 성공했습니다.</p>";
	}
?>
</body>
</html>

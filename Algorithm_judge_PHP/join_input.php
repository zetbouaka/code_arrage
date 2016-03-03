<?
header('Content-Type: text/html; charset=euc-kr');
?>
<?PHP
require "config.php";         //세팅파일 로드

$id=$_POST["id"];
$pass1=$_POST["pass1"];
$pass2=$_POST["pass2"];
$nickname=$_POST["nickname"];
if(!$id) {
	echo "비밀번호를 입력하세요";
	exit;
} elseif(!$pass1) {
	echo "비밀번호를 입력하세요";
	exit;
} elseif($pass1 !== $pass2) {
	echo "비밀번호가 일치하지 않아요.";
	exit;
} else {
	require "./db_connect.php";																		//mysql에 접속한다
	echo "데이터베이스 접속완료<p>";
	echo "아이디 : $id<p>닉네임 : $nickname<p>";
	$sql = "select * from liveon_user where id='$id'";           //입력한 이름와 같은 이름을 검색한다
	$result = mysql_query($sql , $connect);
	$idnum = mysql_num_rows($result);
	echo "아이디 중복검사...<p>";
	if($idnum) {
		echo "중복된 아이디가 있습니다.";
		exit;
	} else {
		$sql = "insert into liveon_user (id,pass,name) values('$id', md5('$pass1'), '$nickname')";
		mysql_query($sql , $connect);
		echo "가입완료<p>";
		$file="data/".$id."_deck.txt";
		$handle=fopen($file,"w");
		fputs($handle,"0");
			echo ("
				<form name=main method=post action='./login.php'>
				<input type=submit name=submit value=돌아가기>
				</form>
					");
	}
}
?>
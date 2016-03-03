<?
header('Content-Type: text/html; charset=euc-kr');
?>
<?
	require "db_connect.php";
	require "config.php";         //세팅파일 로드
	session_start();
	if(empty($_SESSION['id']))
	{
		echo "로그인 해 주세요.<br>";
		echo "<a href=\"login.php\">로그인</a><br>";
		echo "<a href=\"join.php\">회원가입</a><br>";
		exit;
	}
	
	$problem_code = $_GET["pcode"];

	if(empty($problem_code)){
		echo "문제 이름이 지정되어 있지 않습니다.<br>";
		exit;
	}

#  if($game[mode] == 0) {
echo ("	Problem code = {$problem_code}<br><br>
		Source : <form name=form1 method=post action=submit_result.php?pcode={$problem_code}>
				
				<textarea name=src cols=80 rows=30></textarea>
				<br><input type=submit name=Submit value='submit'>
				</form>
	
			<a href=\"index.php\">메인 화면으로</a><br>");
 # } else {
#	  echo "회원가입기간이 아닙니다";
 # }
?>
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
	
	$ids = $_SESSION['id'];
	
#  if($game[mode] == 0) {
	echo ("Max Length : 100<br>");
echo ("	To freeboard : <form name=form1 method=post action=toadmin_submit.php>
				
				<input type=text name=src size = '200' maxlength = 100></textarea>
				<br><input type=submit name=Submit value='submit'>
				</form>
	
			<a href=\"index.php\">Main</a><br>");
 # } else {
#	  echo "회원가입기간이 아닙니다";
 # }
?>
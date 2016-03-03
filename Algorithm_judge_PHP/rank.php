<?
header('Content-Type: text/html; charset=euc-kr');
?>
<?PHP #Programmed by LIGHTNET
	include "db_connect.php";
	session_start();
//	echo "{$user_id}::";
//	exit;
	
	if(empty($_SESSION['id']))
	{
		echo "로그인 해 주세요.<br>";
		echo "<a href=\"login.php\">로그인</a><br>";
		echo "<a href=\"join.php\">회원가입</a><br>";
	}
	else
	{
		echo "$_SESSION[id]'s stat.<br>";
		
		$id = $_SESSION['id'];

		$sql = "select * from user_data where userid='$id'" ;
		$result = mysql_query($sql, $connect);

		$num = mysql_num_rows($result);

		$sum = 0;

		while(1){
			$list = mysql_fetch_array($result);
			if($list==NULL){
				break;
			}
			else
			{
				$pcode=$list[problem_code];
				$score=$list[score];
				$count=$list[submit_count];
				$sum = $sum + $score;
				echo "Problem $pcode : $score Point / {$count} submit<p>";
			}
		}

		echo "Sum = {$sum}<p>";
		echo "<a href=\"index.php\">Main</a><br>";
	}
?>
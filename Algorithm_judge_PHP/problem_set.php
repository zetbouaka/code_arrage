<?
header('Content-Type: text/html; charset=euc-kr');
?>
<?PHP #Programmed by LIGHTNET
	include "db_connect.php";
	session_start();
	$user_id=$_SESSION['id'];
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
		$user_name=$_SESSION['name'];
		echo "Welecome {$user_name}!<br>";

		$sql = "select * from problem_contest";
#		$result = mysql_query($sql, $connect);
#		$num = mysql_num_rows($result);
#	$sql = "select * from liveon_user" ;
	$result = mysql_query($sql, $connect);
	#$Resultfornummembers = mysql_query($sql,$connect); 
	$num = mysql_num_rows($result); 

		if($num==0){
			echo("The Number of Problem Set is 0.<br>");
		}
		else
		{
			echo "<p><p>Problem Set List:<p>";
			for ($i=0;$i<$num;$i++)
			{
				$list = mysql_fetch_array($result);
				if($list==NULL){	
					break;
				}
				else
				{
					$no = $list[no];
					
					$cname = $list[contest_name];
					$code = $list[contest_code];
					
					echo "Contest ID {$no} | <a href=\"problem_set_view.php?ccode={$code}\">{$cname}/{$code}</a><br>";
				}
			}
		}
		echo "<a href=\"index.php\">Main</a><br>";
	}
?>
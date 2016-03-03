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
		$inputed_string = $_GET['ccode'];
		echo "Welecome {$user_name}!<br>";

		$sql = "select * from problem_contest_context where contest_code = '$inputed_string'";

#		$result = mysql_query($sql, $connect);
#		$num = mysql_num_rows($result);
#	$sql = "select * from liveon_user" ;
	$result = mysql_query($sql, $connect);
	#$Resultfornummembers = mysql_query($sql,$connect); 
	$num = mysql_num_rows($result); 

		if($num==0){
			echo("The Number of Problem in Set is 0.<br>");
		}
		else
		{
			echo "<p><p>Problem List:<p>";
			for ($i=0;$i<$num;$i++)
			{
				$list = mysql_fetch_array($result);
				if($list==NULL){	
					break;
				}
				else
				{
					$no = $list[no];
					
					$cname = $list[problem_name];
					$code = $list[problem_code];
					
					echo "<a href=\"problem_view.php?pcode={$code}\">{$cname}/{$code}</a><br>";
				}
			}
		}
		echo "<a href=\"index.php\">Main</a><br>";
	}
?>
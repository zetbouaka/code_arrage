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
		echo "어서오세요. {$user_name}님.<br>";

		$sql = "select * from problem_queue order by no DESC";
#		$result = mysql_query($sql, $connect);
#		$num = mysql_num_rows($result);
#	$sql = "select * from liveon_user" ;
	$result = mysql_query($sql, $connect);
	#$Resultfornummembers = mysql_query($sql,$connect); 
	$num = mysql_num_rows($result); 

		if($num==0){
			echo("queue is null.<br>");
		}
		else
		{
			echo "<p><p>(latest 10)<p>";
			echo "run-id | user-id | problem_code | score_result | process_time | submit_time<br>";

			for ($i=0;$i<10;$i++)
			{
				$list = mysql_fetch_array($result);
				if($list==NULL){	
					break;
				}
				else
				{
					$queue_id = $list[no];
					
					$queue_userid = $list[userid];
					$queue_problem_name = $list[problem_code];
					$queue_source_link = $list[source_link];
					$queue_score_result = $list[score_result];
					$queue_process_time = $list[process_time];
					$queue_submit_time = $list[submit_time];

#					$pname = $list[problem_name];
#					$code = $list[problem_code];

					echo "{$queue_id} | {$queue_userid} | {$queue_problem_name} | {$queue_score_result} | {$queue_process_time} | {$queue_submit_time}<br>";
				}
			}
		}
		echo "<a href=\"index.php\">메인 화면으로</a><br>";
	}
?>
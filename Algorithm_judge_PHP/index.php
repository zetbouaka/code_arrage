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
		echo "�α��� �� �ּ���.<br>";
		echo "<a href=\"login.php\">Login</a><br>";
		echo "<a href=\"join.php\">Join</a><br>";
	}
	else
	{
		echo "�������. $_SESSION[name]��.<br>";
		echo "<a href=\"problem.php\">Problem</a><br>";
		echo "<a href=\"problem_set.php\">Problem Group</a><br>";
		echo "<a href=\"rank.php\">Your Stat</a><br>";
		echo "<a href=\"toadmin.php\">Freeboard write</a><br>";
		echo "<a href=\"queue.php\">Submit Queue</a><br>";
		echo "<a href=\"logout.php\">Logout</a>";

		echo "<p><p>Freeboard :<p><hr>";
		$sql = "select * from toadmin_context order by no ASC" ;
		$result = mysql_query($sql, $connect);

		while(1)
		{
			$list = mysql_fetch_array($result);
			if($list==NULL){
				break;
			}
			else
			{
				$board_userid=$list[userid];
				$board_username=$list[username];
				$board_context=$list[context];
				echo "{$board_username} : {$board_context}<p>";
			}
		}
	}
?>
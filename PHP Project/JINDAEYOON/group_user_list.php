<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>무제 문서</title>
</head>

<body>
<?
	require "db_connect.php";

	$sql = "select * from user order by name ASC" ;
	$result = mysql_query($sql, $connect);
	
	$num = mysql_num_rows($result);
	
	if($num==0){
		echo("현재 존재하는 가입자가 없습니다");
	}
	else
	{
		echo "<p><p>현재 가입자 :<p>";
		while(1)
		{
			$list = mysql_fetch_array($result);
			if($list==NULL){
				break;
			}
			else
			{
				$username=$list[name];
				$PN=$list[PhoneNumber];
				echo "$username : $PN<p>";
				//
				$sql2 = "SELECT * FROM group_user WHERE PhoneNumber = '$PN'";
				$result2 = mysql_query($sql2, $connect);
				$num2 = mysql_num_rows($result2);
				if($num2!=1){
					echo "$username:$PN 가입자의 그룹이 여러개 존재합니다. ";
				}
				while(1)
				{
					$list2 = mysql_fetch_array($result);

					while($list2 = mysql_fetch_array($result2))
					{
						$groupname = $list2[group];
						echo "$groupname ";
					}
					echo "<p>";
				}
			}
		}
	}
?>
</body>
</html>

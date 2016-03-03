<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>무제 문서</title>
</head>

<body>
<?
	require "db_connect.php";

	$sql = "SELECT * FROM GroupList" ;
	$result = mysql_query($sql, $connect);
	$num = mysql_num_rows($result);
	if($num==0){
		echo("현재 존재하는 그룹이 없습니다");
	}
	else
	{
		echo "<p><p>현재 존재하는 그룹 리스트 :<p>";
		while(1)
		{
			$list = mysql_fetch_array($result);
			if($list==NULL){
				break;
			}
			else
			{
				$groupname=$list[Name];
				echo "$groupname<p>";
			}
		}
	}
?>
</body>
</html>

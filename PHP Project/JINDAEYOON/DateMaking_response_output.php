<?PHP
	require "./db_connect.php";	
	#require "./login.php";
	
	#$input_timefixtitle = $_POST['timeFixTitle'];
	$input_timefixtitle = "TFT";
	echo "<xmp>";
	echo "<body>";
	$sql = "SELECT * FROM DateMaking WHERE timeFixTitle = '$input_timefixtitle'" ;
	$result = mysql_query($sql, $connect);
	$num = mysql_num_rows($result);
	if ($num==0){
		echo "일치하는 DM이 없습니다.";
		exit;
	}
	$list = mysql_fetch_array($result);
	$input_key = (int)$list[No];
	echo "<body>";
	$sql = "SELECT * FROM DateMaking_response WHERE No = '$input_key'";
	$result = mysql_query($sql, $connect);
	$num = mysql_num_rows($result);
	if ($num==0){
		echo "nothing data";
	}else
	{
		$i=0;
		while(1)
		{
			$list = mysql_fetch_array($result);
			if($list==NULL){
				break;
			}
			else
			{
				$input_user_name[$i] = $list[Name];
				$input_user_phonenum[$i] = $list[phonenum];
				$input_user_resp[$i] = $list[resp];
				$input_user_time[$i] = $list[time];
				$i++;
			}
		}
		for ($j=0;$j<$i;$j++){
#			echo "<name>$input_user_name[$j]</name><phonenum>$input_user_phonenum[$j]</phonenum><response>$input_user_resp[$j]</response>";
			echo "<phonenum>$input_user_phonenum[$j]</phonenum><response>$input_user_resp[$j]</response><time>$input_user_time[$i]</time>";
		}
	}
	echo "</body>";
	echo "</xmp>";
?>
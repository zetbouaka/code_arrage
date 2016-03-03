<?PHP
	require "./db_connect.php";	
	#require "./login.php";
	
	$input_key = $_POST['key'];
#	$input_timefixtitle = "TFT";
	echo "<xmp>";
	echo "<body>";
	$sql = "SELECT * FROM TimeMaking_context WHERE key = $input_key ORDER BY time" ;
	$result = mysql_query($sql, $connect);
	$num = mysql_num_rows($result);
	if ($num==0){
		echo "</body></xmp>";
		exit;
	}
	$list = mysql_fetch_array($result);	
	$result = mysql_query($sql, $connect);
	$num = mysql_num_rows($result);
	if ($num==0){
		
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
				$input_user_title[$i] = $list[title];
				$input_user_phonenum[$i] = $list[phonenum];
				$input_user_context[$i] = $list[context];
				$input_user_time[$i] = $list[time];
				$i++;
			}
		}
		for ($j=0;$j<$i;$j++){
			echo "<title>$input_user_title[$j]</title><phonenum>$input_user_phonenum[$j]</phonenum><context>$input_user_context[$j]</context><time>$input_user_time[$i]</time>";
		}
	}
	echo "</body>";
	echo "</xmp>";
?>
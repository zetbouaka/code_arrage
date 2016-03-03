<?PHP
	require "./db_connect.php";	
	require "./login.php";
	
	$input_user_number = $_POST['PhoneNumber'];
	
	$sql = "SELECT * FROM group_user WHERE PhoneNumber = '$input_user_number'";
	$result = mysql_query($sql, $connect);
	$num = mysql_num_rows($result);
	if($num==0){
		
	}else{
		$n = 0;
		while(1)
		{
			$list = mysql_fetch_array($result);
			if ($list==NULL)
				break;
			else
			{
				$input_GNO[$n] = $list[Gcheck];
				$n++;
			}						
		}
	}
	for ($i=0;$i<$n;$i++){
		$sql = "SELECT * FROM DateMaking WHERE GroupTitle = '$input_GNO[$i]'";
		$result = mysql_query($sql, $connect);
		$num = mysql_num_rows($result);
		if ($num==0){
		}else
		{
			$m = 0;
			while(1)
			{
				$list = mysql_fetch_array($result);
				if ($list==NULL)
					break;
				else
				{
					$input_GNO_number[$m] = $list[No];
					$n++;
				}						
			}
		}
	}
	
?>
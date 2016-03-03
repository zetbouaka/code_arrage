<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>무제 문서</title>
</head>

<body>
<p>
  <?PHP
	require "./db_connect.php";	
	require "./login.php";
	
	$input_key = $_GET['key'];
	$input_user_phonenum = $_GET['phonenum'];
	
	$sql = "SELECT * FROM TimeMaking_response WHERE No = '$input_key' AND phonenum = '$input_user_phonenum' AND resp = 'NO RESPONSE'" ;
	$result = mysql_query($sql, $connect);
	$num = mysql_num_rows($result);
	if ($num==0){	
		$sql = "INSERT INTO SET TimeMaking_response SET No = '$input_key',phonenum = '$input_user_phonenum', resp = 'NO RESPONSE'" ;
		$result = mysql_query($sql, $connect);
		$num = mysql_num_rows($result);
		if ($num!=0){
			echo "DateSeding Error.";
			exit;
		}
	}
	$sql = "SELECT * FROM TimeMaking WHERE No = '$input_key'" ;
	$result = mysql_query($sql, $connect);
	$num = mysql_num_rows($result);
	if ($num==0){
		echo "일치하는 시간잡기가 없습니다.";
		exit;
	}
	$list = mysql_fetch_array($result);
	$input_grouptitle = $list[GroupTitle];
	$input_meetingtitle = $list[meetingTitle];
	$input_metingoutline = $list[meetingOutline];
	$input_key = $list[No];
	
	$sql = "SELECT * FROM TimeMaking_dateList";
	$result = mysql_query($sql, $connect);
	$num = mysql_num_rows($result);
	if ($num==0){
		echo "시간잡기에 날짜 E $input_key";
		exit;
	}else
	{
		$dateN = 0;
		while(1)
		{
			$list = mysql_fetch_array($result);		
			if ($list==NULL)
				break;
			$input_date[$dateN] = $list[date];
			$dateN = $dateN + 1;
		}
	}
	
	$sql = "SELECT * FROM TimeMaking_timeList";
	$result = mysql_query($sql, $connect);
	$num = mysql_num_rows($result);
	if ($num==0){
		echo "시간잡기에 시간이 등록되있지 않습니다. E";
		exit;
	}else
	{
		$timeN = 0;
		while(1)
		{
			$list = mysql_fetch_array($result);		
			if ($list==NULL)
				break;
			$input_time[$timeN] = $list[time];
			$timeN = $timeN + 1;
		}
	}
	
?>
</p>
<form id="form1" name="form1" method="post" ACTION = "TimeMaking_datesending.php">

<p>
  <?PHP
	global $input_user_phonenum, $input_key;
	echo "휴대전화번호 : <input name=\"phonenum\" type=\"text\" disabled=\"disabled\" id=\"phonenum\" value=\"$input_user_phonenum\"/><br>";
	echo "인증 키 : <input name=\"key\" type=\"text\" disabled=\"disabled\" id=\"key\" value=\"$input_key\"/>";	
?>
</p>
<p>&nbsp; </p>
<table width="442" height="237" border="1">
  <tr>
    <td width="35">X</td>
    <td width="75">
    <?PHP
		global $input_date;
		echo $input_date[0];
    ?></td>
    <td width="75">
        <?PHP
			global $input_date;
			echo $input_date[1];
	    ?>
    </td>
    <td width="75">
		<?PHP
			global $input_date;
			echo $input_date[2];
		?>
    </td>    <td width="75">
		<?PHP
			global $input_date;
			echo $input_date[3];
		?>
    </td>    <td width="75">
		<?PHP
			global $input_date;
			echo $input_date[4];
		?>
    </td>
  </tr>
  <tr>
    <td>
    <?PHP
		global $input_time;
		echo $input_time[0];
	?>
    </td>
    <td><input type="checkbox" name="check0" id="check0" /></td>
    <td><input type="checkbox" name="check1" id="check1" /></td>
    <td><input type="checkbox" name="check2" id="check2" /></td>
    <td><input type="checkbox" name="check3" id="check3" /></td>
    <td><input type="checkbox" name="check4" id="check4" /></td>
  </tr>
  <tr>
    <td>
	<?PHP
		global $input_time;
		echo $input_time[1];
	?>
    </td>
    <td><input type="checkbox" name="check5" id="check5" /></td>
    <td><input type="checkbox" name="check6" id="check6" /></td>
    <td><input type="checkbox" name="check7" id="check7" /></td>
    <td><input type="checkbox" name="check8" id="check8" /></td>
    <td><input type="checkbox" name="check9" id="check9" /></td>
  </tr>
  <tr>
    <td>
	<?PHP
		global $input_time;
		echo $input_time[2];
	?>
    </td>
    <td><input type="checkbox" name="check10" id="check10" /></td>
    <td><input type="checkbox" name="check11" id="check11" /></td>
    <td><input type="checkbox" name="check12" id="check12" /></td>
    <td><input type="checkbox" name="check13" id="check13" /></td>
    <td><input type="checkbox" name="check14" id="check14" /></td>
  </tr>
  <tr>
    <td>
	<?PHP
		global $input_time;
		echo $input_time[3];
	?>
    </td>
    <td><input type="checkbox" name="check15" id="check15" /></td>
    <td><input type="checkbox" name="check16" id="check16" /></td>
    <td><input type="checkbox" name="check17" id="check17" /></td>
    <td><input type="checkbox" name="check18" id="check18" /></td>
    <td><input type="checkbox" name="check19" id="check19" /></td>
  </tr>
  <tr>
    <td>
	<?PHP
		global $input_time;
		echo $input_time[4];
	?>
    </td>
    <td><input type="checkbox" name="check20" id="check20" /></td>
    <td><input type="checkbox" name="check21" id="check21" /></td>
    <td><input type="checkbox" name="check22" id="check22" /></td>
    <td><input type="checkbox" name="check23" id="check23" /></td>
    <td><input type="checkbox" name="check24" id="check24" /></td>
  </tr>
</table>

</form>
  <p>&nbsp;  </p>
  <p>
    <input type="submit" name="button" id="button" value="전송" />
    </form>
  </p>
<p>&nbsp;</p>
</body>
</html>

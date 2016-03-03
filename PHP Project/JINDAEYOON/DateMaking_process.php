<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>무제 문서</title>
</head>

<body>
<?PHP
	require "./db_connect.php";	
	
	
	$input_key = $_GET['key'];
	$input_user_phonenum = $_GET['phonenum'];
	$sql = "SELECT * FROM DateMaking_response WHERE DM_ID = '$input_key' AND phonenum = '$input_user_phonenum' AND response = 0" ;
	$result = mysql_query($sql, $connect);
	$num = mysql_num_rows($result);
	if ($num==0){	
		$sql = "INSERT INTO SET DateMaking_response SET DM_ID = '$input_key',phonenum = '$input_user_phonenum', response = '0'" ;
		$result = mysql_query($sql, $connect);
		$num = mysql_num_rows($result);
		if ($num!=0){
			echo "DateSeding Error.";
			exit;
		}
	}
	
	$sql = "SELECT * FROM DateMaking WHERE ID = $input_key" ;
	$result = mysql_query($sql, $connect);
	$num = mysql_num_rows($result);
	if ($num==0){
		echo "일치하는 일정잡기가 없습니다.";
		exit;
	}
	$list = mysql_fetch_array($result);
#	$input_grouptitle = $list[GroupTitle];
	$input_meetingtitle = $list[timeFIxTitle];
	$input_timefixoutline = $list[timeFixOutline];
	$input_eventtime = $list[eventTime];
	$input_choice = $list[choice];
#	$input_key = $list[ID];
	
?>
<table width="200" border="1">
  <tr>
    <td height="19">
    <?PHP
		global $input_grouptitle;
		echo "$input_grouptitle";
    ?>
    </td>
    <td>
    <?PHP
		global $input_timefixtitle;
		echo "$input_timefixtitle";
    ?>
    </td>
  </tr>
  <tr>
    <td>
    <?PHP
		global $input_timefixoutline;
		echo "$input_timefixoutline";
	?>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<?PHP
global $input_key, $input_user_phonenum;
$input_cont = 'http://125.209.196.29/new/DateMaking_datesending.php?phonenum='.$input_user_phonenum.'&key='.$input_key.'&response=1';
$input_cont2 = 'http://125.209.196.29/new/DateMaking_datesending.php?phonenum='.$input_user_phonenum.'&key='.$input_key.'&response=0';
echo '<a href = '.$input_cont.'>참석</a><br>';
echo '<a href = '.$input_cont.'>불참</a><br>';

?>

</body>
</html>

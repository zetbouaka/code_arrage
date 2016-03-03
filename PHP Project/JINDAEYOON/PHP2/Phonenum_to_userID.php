<?PHP
	
	function Phonenum_to_userID($PN)
	{
		require './db_connect.php';
		$sql = "SELECT * FROM contactslist WHERE phonenum = '$PN'";
		$result2 = mysql_query($sql, $connect);
		$list2 = mysql_fetch_array($result2);
		
		$key = $list2[ID];	
		#echo "E:$key::";
		return $key;
	}
	
	function userID_to_Phonenum($contactsID)
	{
		require './db_connect.php';
		
		$sql = "SELECT * FROM contactslist WHERE ID = $contactsID";
		$result2 = mysql_query($sql, $connect);
		$list2 = mysql_fetch_array($result2);
		$key = $list2[phonenum];	
		return $key;
	}
?>
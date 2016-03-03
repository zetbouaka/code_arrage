<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>무제 문서</title>
</head>

<body>
<?PHP
	$input_user_phonenum = $_GET[phonenum];
	$input_key = $_GET[key];
?>
<FORM METHOD="POST" ACTION = "TimeMaking_contextsending.php">
  <p>&nbsp;</p>
  <table width="509" border="1">
    <tr>
      <td>휴대전화번호</td>
      <td><?PHP
	  		echo "<input name=\"phonenum\" type=\"text\" disabled=\"disabled\" id=\"phonenum\" value=\"$input_user_phonenum\"/><br>";
      ?></td>
    </tr>
    <tr>
      <td>시간잡기번호</td>
      <td><?PHP
	  		echo "<input name=\"key\" type=\"text\" disabled=\"disabled\" id=\"key\" value=\"$input_key\"/>";	
      ?>
      </td>
    </tr>
    <tr>
    <td width="86">제목 </td>
    <td width="407"><input name="title" type="text" size="40" maxlength="30" /></td>
  </tr>
  <tr>
    <td>내용</td>
    <td><textarea name="context" cols="40" rows="3"></textarea></td>
  </tr>
</table>

<p>
  <input type="submit" name="button" id="button" value="전송" />
  <br>
 
</p>
</FORM>
</body>
</html>

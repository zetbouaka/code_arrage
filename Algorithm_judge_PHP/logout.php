<?
header('Content-Type: text/html; charset=euc-kr');
?>
<?PHP
	session_start();
	session_unset();
	session_destroy();
?>
�α׾ƿ� �Ͽ����ϴ�.
<?PHP
echo "<script>location.replace('login.php');</script>";
?>


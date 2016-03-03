<?
header('Content-Type: text/html; charset=euc-kr');
?>
<?PHP
	session_start();
	session_unset();
	session_destroy();
?>
로그아웃 하였습니다.
<?PHP
echo "<script>location.replace('login.php');</script>";
?>


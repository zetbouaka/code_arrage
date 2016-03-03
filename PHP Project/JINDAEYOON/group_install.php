<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>무제 문서</title>
</head>

<body>
<?
session_start();
session_unset();
session_destroy();
require "db_connect.php";
echo "이전에 있던 테이블 삭제<p>";
$sql = "DROP TABLE GroupList";
mysql_query($sql,$connect);
$table_name="GroupList";
$sql = "CREATE TABLE $table_name
(
No integer auto_increment,
Name varchar(30) not null,
primary key(Name)
);";
mysql_query($sql,$connect);
echo "그룹 테이블 작성에 성공했습니다.<br>";
?>
</body>
</html>

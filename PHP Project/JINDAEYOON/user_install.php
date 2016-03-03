<?

require "db_connect.php";
echo "이전에 있던 테이블 삭제<p>";
$sql = "DROP TABLE user";
mysql_query($sql,$connect);
$table_name="user";
$sql = "CREATE TABLE user
(
No integer auto_increment,
Name varchar(30) not null,
PhoneNumber varchar(30) not null,
DeviceID varchar(30) not null,
Authkey varchar(40) not null,
primary key(No)
);";
mysql_query($sql,$connect);
echo "유저테이블 작성에 성공했습니다.<br>";
?>


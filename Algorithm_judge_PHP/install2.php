<?PHP
session_start();
session_unset();
session_destroy();
require "db_connect.php";
echo "������ �ִ� ���̺� ����<p>";
$sql = "DROP TABLE liveon_user";
mysql_query($sql,$connect);
$table_name="liveon_user";
$sql = "CREATE TABLE $table_name
(
no integer auto_increment,
id varchar(30) not null,
name varchar(30) not null,
pass varchar(40) not null,
primary key(no),
index(id)
);";
mysql_query($sql,$connect);
echo "�������̺� �ۼ�<br>";

$table_name="problem_list";
$sql = "CREATE TABLE $table_name
(
no integer auto_increment,
problem_name varchar(40) not null,
problem_code varchar(120) not null,
status varchar(40) not null,
primary key(no)
);";
mysql_query($sql,$connect);
echo "problem_list �ۼ�<br>";
$sql = "create table user_data
(
no integer auto_increment,
userid varchar(30) not null,
score integer not null,
primary key(no)
);";

$table_name="problem_contest";
$sql = "CREATE TABLE $table_name
(
no integer auto_increment,
contest_name varchar(40) not null,
contest_code varchar(40) not null,
contest_stat varchar(10) not null,
contest_context varchar(200) not null,
contest_starttime date not null,
contest_endtime date not null,
primary key(no),
index(contest_name)
);";
mysql_query($sql,$connect);
echo "���׽�Ʈ ���̺� �ۼ�<br>";

$table_name="problem_queue";
$sql = "CREATE TABLE problem_queue
(
no integer auto_increment,
userid varchar(30) not null,
problem_code varchar(50) not null,
source_link varchar(50) not null,
score_result integer not null,
process_time double not null,
submit_time timestamp not null,
primary key(no)
);";
mysql_query($sql,$connect);

echo "queue table �ۼ�<br>";
$table_name="problem_contest_context";
$sql = "CREATE TABLE problem_contest_context
(
no integer auto_increment,
contest_name varchar(40) not null,
contest_code varchar(40) not null,
problem_name varchar(40) not null,
primary key(no),
index(contest_name)
);";
mysql_query($sql,$connect);
echo "problem_contest_context �ۼ�<br>";

?>
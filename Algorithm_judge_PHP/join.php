<?
header('Content-Type: text/html; charset=euc-kr');
?>
<?
  require "db_connect.php";
  require "config.php";         //세팅파일 로드
  #$sql = "select * from cube_game where no=1";
  #$result = mysql_query($sql,$connect);
  #$game = mysql_fetch_array($result);



#  if($game[mode] == 0) {
echo ("
				<form name=form1 method=post action=join_input.php>
				  <table width=400 border=1 bordercolor=gray>
					<tr>
					  <td width=100>아이디</td>
					  <td><input type=text name=id></td>
					</tr>
					<tr>
					  <td>비밀번호</td>
					  <td><input type=password name=pass1></td>
					</tr>
					<tr>
					  <td>비밀번호 확인</td>
					  <td><input type=password name=pass2></td>
					</tr>
					<tr>
					<tr>
					  <td>닉네임</td>
					  <td><input type=text name=nickname></td>
					</tr>
					<tr>
					  <td colspan=2 align=center><input type=submit name=Submit value=입력하기>
					  <input type=reset name=Submit2 value=다시쓰기></td>
					</tr>
				  </table>
				</form>
			");
 # } else {
#	  echo "회원가입기간이 아닙니다";
 # }
?>
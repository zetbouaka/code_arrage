<?
/** @brief Mail 보내기
 *
 * @param $fromName 보내는 사람 이름
 * @param $fromEmail 보내는 사람 메일
 * @param $toName 받는 사람 이름
 * @param $toEmail 받는 사람 메일
 * @param $subject 메일제목
 * @param $contents 메일 내용
 * @param $isDebug 디버깅할때 1로 해서 사용하세요.
 * @return sendmail_flag 성공(true) 실패(false) 여부
 */
function sendMail($fromName, $fromEmail, $toName, $toEmail, $subject, $contents, $isDebug=0)
{
 //Configuration
 $smtp_host = "localhost";
 $port = 25;
 $type = "text/html";
 $charSet = "UTF-8";
 
 //Open Socket
 $fp = @fsockopen($smtp_host, $port, $errno, $errstr, 1); 
 if($fp){
  //Connection and Greetting
  $returnMessage = fgets($fp, 128);
  if($isDebug)
   print "CONNECTING MSG:".$returnMessage."\n";
  fputs($fp, "HELO YA\r\n"); 
  $returnMessage = fgets($fp, 128); 
  if($isDebug)
   print "GREETING MSG:".$returnMessage."\n";
  
  fputs($fp, "MAIL FROM: <".$fromEmail.">\r\n"); 
  $returnvalue[0] = fgets($fp, 128); 
  fputs($fp, "rcpt to: <".$toEmail.">\r\n"); 
  $returnvalue[1] = fgets($fp, 128);
  
  if($isDebug){
   print "returnvalue:";
   print_r($returnvalue);
  }
  
  //Data
  fputs($fp, "data\r\n");
  $returnMessage = fgets($fp, 128);
  if($isDebug)
   print "data:".$returnMessage;
  fputs($fp, "Return-Path: ".$fromEmail."\r\n");
  $fromName = "=?".$fromName."?B?".base64_encode($fromName)."?=";  
  fputs($fp, "From: ".$fromName." <".$fromEmail.">\r\n"); 
  fputs($fp, "To: <".$toEmail.">\r\n"); 
  $subject = "=?".$charSet."?B?".base64_encode($subject)."?=";
  
  fputs($fp, "Subject: ".$subject."\r\n"); 
  fputs($fp, "Content-Type: ".$type."; charset=\"".$charSet."\"\r\n"); 
  fputs($fp, "Content-Transfer-Encoding: base64\r\n"); 
  fputs($fp, "\r\n"); 
  $contents= chunk_split(base64_encode($contents));
  
  fputs($fp, $contents); 
  fputs($fp, "\r\n"); 
  fputs($fp, "\r\n.\r\n");
  $returnvalue[2] = fgets($fp, 128);
  
  //Close Connection
  fputs($fp, "quit\r\n");
  fclose($fp);
  
  //Message
  if (ereg("^250", $returnvalue[0])&&ereg("^250", $returnvalue[1])&&ereg("^250", $returnvalue[2])){
   $sendmail_flag = true;
  }else { 
   $sendmail_flag = false;
   print "NO :".$errno.", STR : ".$errstr;
  }   
 }
 
 if (!$sendmail_flag){
  echo "메일 보내기 실패";
 }
 return $sendmail_flag;
} 

#sendMail($fromName, $fromEmail, $toName, $toEmail, $subject, $contents, $isDebug=0)
#$i = sendMail("JDY", "zetbouaka@gmail.com", "JDY2", "zetbouaka@gmail.com", "SUB3", "CON", 0);

#print "!".$i."<br>";

?>

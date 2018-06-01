<?php
require 'PHPMailerAutoload.php';

//取得從content.php傳過來的表單變數
$Sendto=$_POST['to'];	
$Subject=$_POST['subject'];
$Sendbody=$_POST['body'];
 
$mail= new PHPMailer(); //建立新物件
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->IsSMTP(); //設定使用SMTP方式寄信
$mail->SMTPAuth = true; //設定SMTP需要驗證
$mail->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線
$mail->Host = "smtp.gmail.com"; //Gamil的SMTP主機
$mail->Port = 465;  //Gamil的SMTP主機的埠號(Gmail為465)。
$mail->CharSet = "utf-8"; //郵件編碼
 
$mail->Username = "dick6313@gmail.com"; //Gamil帳號
$mail->Password = "Yan206458"; //Gmail密碼
 
$mail->From = "XXX@gmail.com"; //寄件者信箱
$mail->FromName = "XXX購物網客服"; //寄件者姓名
 
$mail->Subject =$Subject;  //郵件標題
$mail->Body = "郵件內容:".$Sendbody; //郵件內容
 
$mail->IsHTML(true); //郵件內容為html ( true || false)
$mail->AddAddress($Sendto); //收件者郵件及名稱
 
if(!$mail->Send()) {
	echo "發送錯誤: " . $mail->ErrorInfo;
} else {
	echo "<div align=center>信件已成功寄出!!</div>";
}
?>
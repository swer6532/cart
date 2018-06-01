<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_chijajia_Conn = "sql104.byethost.com";
$database_chijajia_Conn = "b13_21858978_chiajia";
$username_chijajia_Conn = "b13_21858978";
$password_chijajia_Conn = "1235287231";
$chijajia_Conn = mysql_pconnect($hostname_chijajia_Conn, $username_chijajia_Conn, $password_chijajia_Conn) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("SET NAMES UTF8");
?>
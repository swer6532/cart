<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_chijajia_Conn = "localhost";
$database_chijajia_Conn = "chiajia_cart";
$username_chijajia_Conn = "admin";
$password_chijajia_Conn = "123456";
$chijajia_Conn = mysql_pconnect($hostname_chijajia_Conn, $username_chijajia_Conn, $password_chijajia_Conn) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("SET NAMES UTF8");
?>
<?php
session_start();
   unset($_SESSION['O_ID']);
   unset($_SESSION['Cart']);
   unset($_SESSION['Name']);
   unset($_SESSION['Price']);
   unset($_SESSION['Quantity']);
   header("Location:index.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
</body>
</html>
<?php
session_start();
if(!isset($_SESSION['O_ID']))
  $_SESSION['O_ID']= date("YmdHis").substr(md5(uniqid(rand())),0,10);
?>
<?php require_once('Connections/chijajia_Conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
  function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
  {
    if (PHP_VERSION < 6) {
      $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

    switch ($theType) {
      case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
      case "long":
      case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
      case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
      case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
      case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
    }
    return $theValue;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  /*重複插入資料*/	
  foreach($_POST['D_pname'] as $i => $val){
    $insertSQL = sprintf("INSERT INTO ordertail (O_oid, D_pname, D_pprice, D_pquantity, D_itemtotal) VALUES (%s, %s, %s, %s, %s)",
     GetSQLValueString($_POST['O_oid'], "text"),
     GetSQLValueString($_POST['D_pname'][$i], "text"),
     GetSQLValueString($_POST['D_pprice'][$i], "int"),
     GetSQLValueString($_POST['D_pquantity'][$i], "int"),
     GetSQLValueString($_POST['D_itemtotal'][$i], "int"));


    mysql_select_db($database_chijajia_Conn, $chijajia_Conn);
    $Result1 = mysql_query($insertSQL, $chijajia_Conn) or die(mysql_error());
  }
  /*結尾部分要在insertgoto前面*/
  $insertGoTo = "purchase.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>巧家精緻盒餐</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/checkout.css">
	<script src="js\jquery-3.3.1.min.js"></script>
	<script src="js\bootstrap.min.js"></script>
	<script src="js\wow.min.js"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116611686-1"></script>
  <script>
   window.dataLayer = window.dataLayer || [];
   function gtag(){dataLayer.push(arguments);}
   gtag('js', new Date());

   gtag('config', 'UA-116611686-1');
 </script>

</head>
<body>
	<!--navbar-->
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">巧家精緻盒餐</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-center navbar-right">
					<li><a href="http://chiaojia.byethost13.com/index.php">購物車</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!--banner-->
	<div class="container-fluid">
		<div class="row">
			<div class="jumbotron"><img src="images/banner.png" class="center-block img-responsive wow bounceInDown">
			</div>
		</div>
	</div>

	<!--aboutus-->
	<div class="container aboutus">
		<div class="page-header">
			<h3>｜結帳 
				<small class="pro_sm">Check out</small>
				<span  class="pro_sp">
					<a href="index.php">瀏覽商品</a>
					<span> / </span>
					<a href="showcart.php">瀏覽購物車</a>
					<span> / </span>
					<a href="des_session.php">清除購物車</a>
				</span>
			</h3>
		</div>
		<div class="about_background">
      <div align="center">
        <form action="<?php echo $editFormAction; ?>" name="form1" method="POST">
          <div class="order">訂單編號:<span ><?php echo $_SESSION['O_ID']; ?></span></div>
          <input name="O_oid" type="hidden" id="O_oid" value="<?php echo $_SESSION['O_ID']; ?>">
          <table class="table">
            <tr class="table_tr">
              <td>商品名稱</td>
              <td>商品單價</td>
              <td>訂購數量</td>
              <td>小計</td>
            </tr>
            <tr class="table_tr2">
              <?php
              foreach($_SESSION['Cart'] as $i =>$val){
               ?>   
               <td style="text-align: center; 
               font-size: 16px; 
               background-color: #FF5511; 
               color:white;"><?php echo $_SESSION['Name'][$i]; ?>
               <input name="D_pname[]" type="hidden" id="D_pname[]" value="<?php echo $_SESSION['Name'][$i]; ?>"></td>
               <td style="text-align: center; 
               font-size: 16px; 
               background-color: #FF5511; 
               color:white;"><?php echo $_SESSION['Price'][$i]; ?>
                <input name="D_pprice[]" type="hidden" id="D_pprice[]" value="<?php echo $_SESSION['Price'][$i]; ?>"></td>
                <td style="text-align: center; 
               font-size: 16px; 
               background-color: #FF5511; 
               color:white;"><?php echo $_SESSION['Quantity'][$i]; ?>
                  <input name="D_pquantity[]" type="hidden" id="D_pquantity[]" value="<?php echo $_SESSION['Quantity'][$i]; ?>"></td>
                  <td style="text-align: center; 
               font-size: 16px; 
               background-color: #FF5511; 
               color:white;"><?php echo $_SESSION['itemTotal'][$i]; ?>
                    <input name="D_itemtotal[]" type="hidden" id="D_itemtotal[]" value="<?php echo $_SESSION['itemTotal'][$i]; ?>"></td>
                  </tr>
                  <?php } ?>
                  <tr class="tr_3">
                    <td colspan="4"height="80">總計:<?php echo $_SESSION['Total']; ?></td>
                  </tr>
                </table>
                <p>
                  <input  class="btn btn-danger btn-block" type="submit" name="button" id="button" value="送出" style="width: 20em;">
                </p>
                <input type="hidden" name="MM_insert" value="form1">
              </form>

            </div>
          </div>
        </div>
        <!--footer-->
        <footer><p>巧家精緻盒餐 © Copyright All Rights Reserved - Design By Terry</p></footer>
      </body>
      </html>
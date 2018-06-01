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
  $insertSQL = sprintf("INSERT INTO orders1 (O_oid, O_cname, O_caddr, O_cphone, O_email, O_date, O_total, O_state) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['O_oid'], "text"),
                       GetSQLValueString($_POST['O_cname'], "text"),
                       GetSQLValueString($_POST['O_caddr'], "text"),
                       GetSQLValueString($_POST['O_cphone'], "text"),
                       GetSQLValueString($_POST['O_email'], "text"),
                       GetSQLValueString($_POST['O_date'], "date"),
                       GetSQLValueString($_POST['O_total'], "int"),
                       GetSQLValueString($_POST['O_state'], "text"));

  mysql_select_db($database_chijajia_Conn, $chijajia_Conn);
  $Result1 = mysql_query($insertSQL, $chijajia_Conn) or die(mysql_error());

  $insertGoTo = "mail.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>巧家精緻盒餐</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/purchase.css">
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
	<nav class="navbar navbar-default"); ">
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
			<h3>｜訂單 <small class="pro_sm">Orders</small><span class="pro_sp"><a href="index.php" >瀏覽商品</a><span> / </span><a href="showcart.php" >瀏覽購物車</a><span> / </span><a href="des_session.php" >清除購物車</a></span></h3>
		</div>
		<div class="about_background">
        <div align="center">
          <form action="<?php echo $editFormAction; ?>" name="form1" method="POST">
<table class="table">
          <tr class="tr1">
            <td class="td1" width="200" height="100" >訂單編號:</td>
            <td class="td2" width="700"><label for="textfield5"></label>
            <?php echo $_SESSION['O_ID']; ?></td>
          </tr>
          <tr class="tr2">
            <td>姓名</td>
            <td><label for="O_cname"></label>
            <div class="tr2_div"><input type="text" name="O_cname" id="O_cname"></div>
       		</td>
          </tr>
          <tr class="tr2">
            <td>電話</td>
            <td><label for="O_cphone"></label>
            <div class="tr2_div">
              <input type="text" name="O_cphone" id="O_cphone">
            </div>
            </td>
          </tr>
          <tr class="tr2">
            <td>e-mail</td>
            <td><label for="O_email"></label>
            <div class="tr2_div"><input type="text" name="O_email" id="O_email"></div>
            </td>
          </tr>
          <tr class="tr2">
            <td>住址</td>
            <td><label for="O_caddr"></label>
            <div class="tr2_div"><input type="text" name="O_caddr" id="O_caddr"></div>
            </td>
          </tr>
          <tr>
            <td><input name="O_oid" type="hidden" id="O_oid" value="<?php echo $_SESSION['O_ID']; ?>">
            <input name="O_total" type="hidden" id="O_total" value="<?php echo $_SESSION['Total']; ?>">
            <input name="O_date" type="hidden" id="O_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input name="O_state" type="hidden" id="O_state" value="處理中"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>
            	<div style="text-align: center;">
            		<input type="submit" name="button" id="button" class="btn btn-danger btn-block center-block" value="送出" style="width: 20em;">
            	</div>
            </td>
          </tr>
          </table>
            <p>&nbsp;</p>
            <input type="hidden" name="MM_insert" value="form1">
          </form>
          
        </div>
		</div>
	</div>
	<!--footer-->
		<footer><p>巧家精緻盒餐 © Copyright All Rights Reserved - Design By Terry</p></footer>
	</body>
	</html>
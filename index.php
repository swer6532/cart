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
/*產生資料集*/
mysql_select_db($database_chijajia_Conn, $chijajia_Conn);
$query_productRec = "SELECT * FROM prodcut ORDER BY p_id DESC";
$productRec = mysql_query($query_productRec, $chijajia_Conn) or die(mysql_error());
$row_productRec = mysql_fetch_assoc($productRec);
$totalRows_productRec = mysql_num_rows($productRec);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>巧家精緻盒餐</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/index_php.css">
	<script src="js\jquery-3.3.1.min.js"></script>
	<script src="js\bootstrap.min.js"></script>
	<script src="js\wow.min.js"></script>
	<style>
	</style>
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
					<li><a href="http://chiaojia.byethost13.com/" class="nav_a">形象網</a></li>
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
			<h3>｜產品 
				<small class="pro_sm">Product</small>
				<span class="pro_sp">
					<a href="index.html" class="pro_a">形象網</a>
					<span> / </span>
					<a href="showcart.php">瀏覽購物車</a>
					<span> / </span>
					<a href="des_session.php">清除購物車</a>
				</span>
			</h3>  
		</div>
			<div class="about_background">
				<div class="row">
					<?php do { ?>
					<div class="col-md-3 col-xs-12">
						<div class="about_div">
							<img src="<?php echo $row_productRec['p_img']; ?>" style="width:100%;">
							<div class="aboutus_text">
								<h3><?php echo $row_productRec['p_name']; ?></h3>
								<h3 class="h3_2">NT$:<?php echo $row_productRec['p_price']; ?></h3>		      
							</div>
						</div>
						<form action="addcart.php" method="post" name="form1" id="form1">
							<input type="submit" name="button" id="button" value="Add Cart" style="font-style: italic;"  class="btn btn-danger btn-block">
							<input name="p_id" type="hidden" id="p_id" value="<?php echo $row_productRec['p_id']; ?>">
							<input name="p_name" type="hidden" id="p_name" value="<?php echo $row_productRec['p_name']; ?>">
							<input name="p_price" type="hidden" id="p_price" value="<?php echo $row_productRec['p_price']; ?>">
						</form>
						<p>&nbsp;</p>				    
					</div>
					<?php } while ($row_productRec = mysql_fetch_assoc($productRec)); ?>
				</div>
			</div>
		</div>
		<!--footer-->
		<footer><p>巧家精緻盒餐 © Copyright All Rights Reserved - Design By Terry</p></footer>
	</body>
	</html>
	<?php
	mysql_free_result($productRec);
	?>

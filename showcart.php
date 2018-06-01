<?php 

session_start();
		if(isset($_POST['Modify'])){
			foreach($_SESSION['Quantity'] as $i => $val){
				$_SESSION['Quantity'][$i]=$_POST['Modify'][$i];
			}
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
	<link rel="stylesheet" href="css/showcart.css">
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
			<h3>｜購物車 
				<small class="pro_sm">Cart</small>
				<span class="pro_sp">
					<a href="index.php" >瀏覽商品</a>
					<span> / </span>
					<a href="des_session.php">清除購物車</a>
				</span>
			</h3>
		</div>
		<div class="about_background">
        <div align="center">
          <form name="form1" method="post" action="showcart.php">
          <?php 			
		  		if(!isset($_SESSION['Cart'])){
				echo "請增加商品";
				
			}
	else{
		?>
          <table class="table">
            <tr class="table_tr">
              <td width="200" height="40">商品</td>
              <td width="200">價錢</td>
              <td width="200">數量</td>
              <td width="200">小計</td>
            </tr>
            <tr class="table_tr2">
			 <?php
				$_SESSION['Total'] = 0;
				foreach($_SESSION['Cart'] as $i => $val){
			?>        
              <td class="td1" style="text-align: center; font-size: 16px; background-color: #FF5511; color:white;"><?php echo $_SESSION['Name'][$i]; ?></td>
              <td class="td1" style="text-align: center; font-size: 16px; background-color: #FF5511; color:white;"><?php echo $_SESSION['Price'][$i]; ?></td>
              <td class="td1" style=" text-align: center; font-size: 16px; background-color: #FF5511;color:black;"><input name="Modify[]" type="text" id="Modify[]" size="8" value="<?php echo $_SESSION['Quantity'][$i]; ?>"></td>
              <td style=" text-align: center; font-size: 16px; background-color: #FF5511;color:black;">
             <?php  //小記&價格
		  echo $_SESSION['itemTotal'][$i] = $_SESSION['Price'][$i] * $_SESSION['Quantity'][$i];
		  $_SESSION['Total'] += $_SESSION['itemTotal'][$i];
			?>
              </td>
            </tr>
             <?php } ?>
          </table>
          <br>
          <br>
          <p class="total">總計:<?php echo $_SESSION['Total'];
		  }?>
          </p>
          <p>
          
            <input type="submit" class="btn btn-info" name="button" id="button" value="更新">
            <a href="checkout.php" class="btn btn-danger ">送出</a></p>
          </form>
          
        </div>
		</div>
	</div>
	<!--footer-->
		<footer><p>巧家精緻盒餐 © Copyright All Rights Reserved - Design By Terry</p></footer>
	</body>
	</html>
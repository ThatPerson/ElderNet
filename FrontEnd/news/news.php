<?php
	include(../../CVESimp/DBManager/database_stuff.php);
	
	$database = new t_database("hostname", "username", "password", "dbname");
	
	$relevant_articles = get_relevant_articles("userId");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>News</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
		<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
		<!--script src="js/less-1.3.3.min.js"></script-->
		<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
		
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/style.css" rel="stylesheet">
		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<![endif]-->
		<!-- Fav and touch icons -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../img/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../img/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../img/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="../img/apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="../img/favicon.png">
		
		<script type="text/javascript" src="../js/jquery.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/scripts.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row clearfix mt">
				<div class="col-md-4 column">
					<div class="row clearfix">
					</div>
				</div>
			</div>
			<div class="row clearfix prime">
				<div class="col-md-6 column ">
					<span class="black">Project</span> <span class="silver">NEWS</span>
				</div>
				<div class="col-md-6 column">
					<form role="form">
						<div class="form-group">
							<input type="search" class="form-control" id="query" placeholder="Search...">
						</div>
					</form>
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-md-6 column">
					<div class="row clearfix">
						<div class="col-md-6 column slogan">
							<?php
								echo $relevant_articles[0]["name"]
							?>
						</div>
						<div class="col-md-6 column link">
							<?php
								echo $relevant_articles[0]["simplified"]
							?>
						</div>
				</div>
				<div class="col-md-6 column">
				</div>
			</div>
		</div>
	</body>
</html>
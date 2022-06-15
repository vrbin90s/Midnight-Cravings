<!---=== SITE NAVIGATION ===-->
<body> <!--Start of the page body content-->
	<nav class="navbar navbar-expand-md fixed-top navbar_home">
		<div class="container-fluid">
			<a class="navbar-brand domain_name" href="index.php">Midnight Cravings</a> 
			<button class="navbar-toggler" data-target="#navbarResponsive" data-toggle="collapse" type="button">
				<span class="custom-toggler-icon"><i class="fas fa-bars burger"></i></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="#recipes">Recipes</a></li>
					<li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
					<li class="nav-item mobile_toolbar_nav">
						<button class="btn btn-link mobile_logout_btn_h" type="submit">Sign Out</button>
					</li>
					<li class="nav-item mobile_toolbar_nav">
						<form action="" method="post">
							<input type="hidden" name="action" value="logout">
							<input type="hidden" name="goto" value="..">
							<button class="btn btn-link mobile_logout_btn_h" type="submit">Sign Out</button>
						</form>
					</li>
				</ul>
			</div>
		</div>
	</nav>

<!---=== END OF NAVIGATION ===-->
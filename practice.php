<?php 
	session_start(); 
	// Secure the about page: redirect to login if session username is not set
	if (!isset($_SESSION['username'])) {
		header("Location: login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>About Us | UniNavigator</title>
	
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="unnavigator_logo.png">
	
	<!-- Styling -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="practice.css">
	
	<!-- Fonts & Icons -->
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

	<div class="page-bg-overlay"></div>

	<!-- Premium Glass Navbar (matches home.php exactly) -->
	<nav class="navbar sticky-top navbar-expand-md navbar-dark custom-nav">
		<div class="container-fluid">
			<a class="navbar-brand d-flex align-items-center" href="home.php">
				<img src="unnavigator_logo.png" width="36" height="36" class="brand-logo-img mr-2 animate-float" alt="UniNavigator"> 
				<span class="brand-logo-text">UniNavigator</span>
			</a>
			
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			
			<div class="collapse navbar-collapse" id="navbarContent">
				<ul class="navbar-nav ml-auto align-items-center">
					<li class="nav-item">
						<a class="nav-link" href="home.php"><i class="fa fa-dashboard mr-1"></i> Predictor</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="practice.php"><i class="fa fa-info-circle mr-1"></i> About Us</a>
					</li>
					<li class="nav-item ml-md-2">
						<a class="logout-btn" href="login.php">
							<i class="fa fa-sign-out mr-1"></i> Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="about-wrapper">
		<!-- Inspirational Quote Panel -->
		<div class="glass-card quote-card animate-fade-in">
			<div class="quote-content">
				<i class="fa fa-quote-left quote-icon"></i>
				<p>Nothing in this world can take the place of persistence. Talent will not: nothing is more common than unsuccessful men with talent. Genius will not; unrewarded genius is almost a proverb. Education will not: the world is full of educated derelicts. Persistence and determination alone are omnipotent.</p>
			</div>
		</div>

		<!-- About Us Details Panel -->
		<div class="glass-card about-card animate-fade-in" style="animation-delay: 0.1s;">
			<h1 class="about-title"><i class="fa fa-compass mr-2 text-primary"></i> About UniNavigator</h1>
			<p class="about-lead">UniNavigator is a modern college prediction system engineered to blend high-fidelity technological matching with accurate academic data analysis.</p>
			
			<div class="about-divider"></div>
			
			<div class="about-paragraphs">
				<p>Our workspace is designed as a direct solution to simplify course and institute selection for students looking to map out undergraduate (UG) and postgraduate (PG) careers. Built with absolute precision in prediction calculation and a custom weighted scoring index, we enable students to determine their campus eligibility across premier engineering centers instantly.</p>

				<p>Through our advanced predictor engine, education seekers get a tailored dashboard based on competitive examination performance—such as JEE Main, BITSAT, SRMJEEE, and VITEEE. The decision-making is empowered with zero friction, displaying instant campus recommendations and clear eligibility badges matching tier cutoffs.</p>

				<p>UniNavigator represents the smartest gateway for modern academic routing, combining database credibility and rapid front-end responsive calculation to give students personalized insights to make informed career, course and college decisions. Our visual ecosystem is crafted with state-of-the-art styling standards, offering a premium and focus-oriented interface to make mapping your future an inspiring experience.</p>
			</div>
		</div>
	</div>

	<!-- Core Bootstrap Scripts -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

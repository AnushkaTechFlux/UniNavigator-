<?php
	session_start();
	if(isset($_SESSION['username']))
		unset($_SESSION['username']);
	session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="UniNavigator is a highly precise college prediction system designed to map your test scores and grades to matching engineering institutions.">
	<title>UniNavigator | Smart College Predictor</title>
	
	<!-- Favicon -->
	<link rel="icon" href="unnavigator_logo.png" type="image/png">
	
	<!-- Styling -->
	<link rel="stylesheet" type="text/css" href="Login.css">
	
	<!-- Fonts & Icons -->
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="page-bg-overlay"></div>

<div class="app-container">
	<!-- Brand Title Section -->
	<div class="brand-section">
		<img src="unnavigator_logo.png" alt="UniNavigator Logo" class="brand-logo animate-float">
		<h1 class="brand-title">UniNavigator</h1>
		<p class="brand-subtitle">Plan and predict your ideal academic path with advanced data matching.</p>
	</div>

	<!-- Login Form Panel -->
	<div class="form-container" id="login">
		<div class="glass-box">
			<h2 class="form-header">Welcome Back</h2>
			<p class="form-subheader">Sign in to search & predict engineering colleges</p>
			
			<div class="social-container">
				<a href="#" aria-label="Sign in with Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
				<a href="#" aria-label="Sign in with Google"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
				<a href="#" aria-label="Sign in with LinkedIn"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
			</div>
			
			<div class="form-divider">
				<span>or use credentials</span>
			</div>
			
			<div class="php-feedback">
				<?php
					function test_input($data) {
						$data = trim($data);
						$data = stripslashes($data);
						$data = htmlspecialchars($data);
						return $data;
					}
					
					if (isset($_GET['signup']) && $_GET['signup'] == 'success') {
						echo "<div class='alert success-alert'><i class='fa fa-check-circle'></i> Registration successful! Please log in.</div>";
					}

					if (isset($_POST['login'])) {
						session_start();
						$username = $password = "";
						if ($_SERVER["REQUEST_METHOD"] == "POST") {
							$username = test_input($_POST['Username']);
							$password = test_input($_POST['Password']);

							$link = mysqli_connect("localhost", "root", "");
							if (mysqli_connect_errno()) {
								echo "<div class='alert error-alert'><i class='fa fa-exclamation-circle'></i> Connection failed: " . mysqli_connect_error() . "</div>";
							} else {
								mysqli_select_db($link, "test_db");
								
								// Sanitize variables for query to prevent basic SQL injection
								$username_escaped = mysqli_real_escape_string($link, $username);
								$password_escaped = mysqli_real_escape_string($link, $password);
								
								$results = mysqli_query($link, "SELECT * FROM usertable WHERE Username='$username_escaped' AND Password='$password_escaped'") 
									or die("<div class='alert error-alert'>Database error: " . mysqli_error($link) . "</div>");
								
								$row = mysqli_fetch_array($results);
								if ($row && $row['Username'] == $username && $row['Password'] == $password) {
									$_SESSION['username'] = $username;
									$_SESSION['mes'] = "true";
									header("Location: home.php");
									exit();
								} else {
									echo "<div class='alert error-alert'><i class='fa fa-exclamation-circle'></i> Invalid username or password!</div>";
								}
								mysqli_close($link);
							}
						}
					} 
				?>	
			</div>
			
			<form action="login.php" method="POST" class="auth-form">
				<div class="input-wrapper">
					<i class="fa fa-user input-icon"></i>
					<input class="input" type="text" name="Username" placeholder="Username" required autocomplete="username">
				</div>
				<div class="input-wrapper">
					<i class="fa fa-lock input-icon"></i>
					<input class="input" type="password" name="Password" placeholder="Password" required autocomplete="current-password">
				</div>
				<input class="button" type="submit" name="login" value="LOGIN">
				<div class="form-links">
					<a id="oksignup" class="toggle-link">Create an account</a>
					<span class="link-separator">|</span>
					<a href="#" class="forgot-link">Forgot Password?</a>
				</div>
			</form>
		</div>
	</div>

	<!-- Sign Up Form Panel -->
	<div class="form-container reg" id="signup">
		<div class="glass-box">
			<h2 class="form-header">Create Account</h2>
			<p class="form-subheader">Register to start predicting your target campuses</p>
			
			<div class="social-container">
				<a href="#" aria-label="Sign up with Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
				<a href="#" aria-label="Sign up with Google"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
				<a href="#" aria-label="Sign up with LinkedIn"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
			</div>
			
			<div class="form-divider">
				<span>or fill details</span>
			</div>
			
			<div class="php-feedback">
				<?php
					if (isset($_POST['signup'])) {
						$usernameSub = $password1 = $password2 = "";
						if ($_SERVER["REQUEST_METHOD"] == "POST") {
							$usernameSub = test_input($_POST['Username']);
							$password1 = test_input($_POST['Password']);
							$password2 = test_input($_POST['ConfirmPassword']);

							$link = mysqli_connect("localhost", "root", "");
							if (mysqli_connect_errno()) {
								echo "<div class='alert error-alert'><i class='fa fa-exclamation-circle'></i> Connection failed: " . mysqli_connect_error() . "</div>";
							} else {
								mysqli_select_db($link, "test_db");
								
								if (empty($usernameSub)) {
									echo "<div class='alert error-alert'>Please enter a username</div>";
								} else if (empty($password1)) {
									echo "<div class='alert error-alert'>Please enter a password</div>";
								} else if ($password1 != $password2) {
									echo "<div class='alert error-alert'><i class='fa fa-exclamation-circle'></i> Passwords do not match!</div>";
								} else {
									$usernameSub_escaped = mysqli_real_escape_string($link, $usernameSub);
									$password1_escaped = mysqli_real_escape_string($link, $password1);
									
									// Check if user already exists
									$check_existing = mysqli_query($link, "SELECT * FROM usertable WHERE Username='$usernameSub_escaped'");
									if (mysqli_num_rows($check_existing) > 0) {
										echo "<div class='alert error-alert'><i class='fa fa-exclamation-circle'></i> Username already exists!</div>";
									} else {
										mysqli_query($link, "INSERT INTO usertable(Username, Password) VALUES('$usernameSub_escaped', '$password1_escaped')") 
											or die("<div class='alert error-alert'>Registration failed: " . mysqli_error($link) . "</div>");
										
										mysqli_close($link);
										header("Location: login.php?signup=success");
										exit();
									}
								}
								if (isset($link) && $link) {
									mysqli_close($link);
								}
							}
						}
					}
				?>
			</div>
			
			<form action="login.php" method="POST" class="auth-form">
				<div class="input-wrapper">
					<i class="fa fa-user input-icon"></i>
					<input class="input" type="text" name="Username" placeholder="Username" required autocomplete="username">
				</div>
				<div class="input-wrapper">
					<i class="fa fa-lock input-icon"></i>
					<input class="input" type="password" name="Password" placeholder="Password" required autocomplete="new-password">
				</div>
				<div class="input-wrapper">
					<i class="fa fa-check-circle input-icon"></i>
					<input class="input" type="password" name="ConfirmPassword" placeholder="Confirm Password" required autocomplete="new-password">
				</div>
				<input class="button" type="submit" name="signup" value="SIGN UP">
				<div class="form-links">
					<a id="oklogin" class="toggle-link">Already have an account? Login</a>
				</div>
			</form>
		</div>
	</div>
</div>

<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script type="text/javascript" src="Login.js"></script>
</body>
</html>

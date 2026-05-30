<?php 
	session_start(); 
	// Secure the dashboard: redirect to login if session username is not set
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
	<title>Dashboard | UniNavigator</title>
	
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="unnavigator_logo.png">
	
	<!-- Styling -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="Home.css">
	
	<!-- Fonts & Icons -->
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

	<div class="page-bg-overlay"></div>

	<!-- Premium Glass Navbar -->
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
					<li class="nav-item active">
						<a class="nav-link" href="home.php"><i class="fa fa-dashboard mr-1"></i> Predictor</a>
					</li>
					<li class="nav-item">
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

	<div class="dashboard-wrapper">
		<!-- Header Greeting Section -->
		<div class="welcome-banner">
			<h1>Hello, <span class="user-highlight"><?php echo htmlspecialchars($_SESSION['username']); ?></span>!</h1>
			<p>Welcome to your counselor workspace. Enter your grades and scorecards below to navigate matching engineering universities.</p>
		</div>

		<!-- Main Layout Grid -->
		<div class="dashboard-grid">
			
			<!-- Left Column: Quote and Inputs -->
			<div class="dashboard-left">
				<!-- Academic Quote Card -->
				<div class="glass-card quote-card">
					<div class="quote-content">
						<i class="fa fa-quote-left quote-icon"></i>
						<p>Research shows that there is only half as much variation in student achievement between schools as there is among classrooms in the same school. Getting assigned to a great learning workspace is the core multiplier of talent.</p>
					</div>
				</div>

				<!-- Predictor Form Card -->
				<div class="glass-card form-card">
					<h2 class="card-title"><i class="fa fa-sliders mr-2"></i> Score Predictor</h2>
					<p class="card-subtitle">Input your board percentage and exam scores (JEE, BITS, VIT, SRM)</p>
					
					<form method="post" action="home.php" class="predictor-form">
						<div class="form-input-group">
							<label for="board"><i class="fa fa-percent"></i> Board's Percentage <span class="required">*</span></label>
							<input class="ip" type="number" step="0.01" min="0" max="100" name="board" id="board" placeholder="e.g. 85.5" required value="<?php echo isset($_POST['board']) ? htmlspecialchars($_POST['board']) : ''; ?>">
						</div>
						
						<div class="form-input-group">
							<label for="jee"><i class="fa fa-graduation-cap"></i> JEE Main Score <span class="required">*</span></label>
							<input class="ip" type="number" min="0" max="360" name="jee" id="jee" placeholder="e.g. 240 (Out of 360)" required value="<?php echo isset($_POST['jee']) ? htmlspecialchars($_POST['jee']) : ''; ?>">
						</div>
						
						<div class="form-input-group">
							<label for="bits"><i class="fa fa-circle-o-notch"></i> BITSAT Score</label>
							<input class="ip" type="number" min="0" max="450" name="bits" id="bits" placeholder="e.g. 310" value="<?php echo isset($_POST['bits']) ? htmlspecialchars($_POST['bits']) : ''; ?>">
						</div>
						
						<div class="form-input-group">
							<label for="vit"><i class="fa fa-bookmark"></i> VITEEE Score</label>
							<input class="ip" type="number" min="0" max="150" name="vit" id="vit" placeholder="e.g. 95" value="<?php echo isset($_POST['vit']) ? htmlspecialchars($_POST['vit']) : ''; ?>">
						</div>
						
						<div class="form-input-group">
							<label for="srm"><i class="fa fa-bookmark-o"></i> SRMJEEE Score</label>
							<input class="ip" type="number" min="0" max="200" name="srm" id="srm" placeholder="e.g. 155" value="<?php echo isset($_POST['srm']) ? htmlspecialchars($_POST['srm']) : ''; ?>">
						</div>
						
						<button class="submit-button" type="submit" name="submit">
							<i class="fa fa-compass mr-1"></i> Calculate Matches
						</button>
					</form>
				</div>
			</div>

			<!-- Right Column: Predictor Results -->
			<div class="dashboard-right">
				<?php 
					function test_input($data) {
						$data = trim($data);
						$data = stripslashes($data);
						$data = htmlspecialchars($data);
						return $data;
					}

					if (isset($_POST['submit'])) {
						if ($_SERVER["REQUEST_METHOD"] == "POST") {
							$board = floatval(test_input($_POST['board']));
							$jee = floatval(test_input($_POST['jee']));
							$bits = isset($_POST['bits']) && $_POST['bits'] !== "" ? floatval(test_input($_POST['bits'])) : 0;
							$vit = isset($_POST['vit']) && $_POST['vit'] !== "" ? floatval(test_input($_POST['vit'])) : 0;
							$srm = isset($_POST['srm']) && $_POST['srm'] !== "" ? floatval(test_input($_POST['srm'])) : 0;

							$avg = (($board * 60) + ((($jee * 100) / 360) * 40)) / 100;
							
							echo "<div class='glass-card results-container animate-fade-in'>";
							echo "<h2 class='card-title'><i class='fa fa-trophy mr-2 text-warning'></i> Matching Results</h2>";
							
							// Overall Stats Section
							echo "<div class='stats-banner'>";
							echo "  <div class='stat-box'>";
							echo "    <span class='stat-val'>" . number_format($avg, 1) . "%</span>";
							echo "    <span class='stat-lbl'>Weighted Index</span>";
							echo "  </div>";
							echo "  <div class='stat-box'>";
							echo "    <span class='stat-val'>" . $board . "%</span>";
							echo "    <span class='stat-lbl'>Board Grade</span>";
							echo "  </div>";
							echo "  <div class='stat-box'>";
							echo "    <span class='stat-val'>" . $jee . "</span>";
							echo "    <span class='stat-lbl'>JEE Score</span>";
							echo "  </div>";
							echo "</div>";

							if ($board < 60) {
								echo "<div class='no-match-alert'>";
								echo "  <i class='fa fa-ban warning-icon'></i>";
								echo "  <h4>Threshold Unmet</h4>";
								echo "  <p>Most premier engineering institutes require a minimum board percentage of <strong>60%</strong>. Your current grade does not meet the basic eligibility criteria for college matching in this application.</p>";
								echo "</div>";
							} else {
								echo "<p class='results-summary-text'>Based on your custom scoring metrics, you are eligible to apply for the following premier engineering campuses:</p>";
								echo "<div class='college-cards-grid'>";

								$matched = false;

								// 1. IIT Match Check
								if ($avg > 87) {
									$matched = true;
									echo "<div class='college-result-card iit-card'>";
									echo "  <div class='college-avatar'><i class='fa fa-university'></i></div>";
									echo "  <div class='college-info'>";
									echo "    <h4>Indian Institute of Technology (IIT)</h4>";
									echo "    <p class='college-details'>National Importance | Tier 1</p>";
									echo "    <span class='badge-eligible'><i class='fa fa-check'></i> Highly Eligible</span>";
									echo "  </div>";
									echo "  <div class='criteria-pill'>Req: Weighted Index > 87%</div>";
									echo "</div>";
								}

								// 2. NIT Match Check
								if ($avg > 60) {
									$matched = true;
									echo "<div class='college-result-card nit-card'>";
									echo "  <div class='college-avatar'><i class='fa fa-university'></i></div>";
									echo "  <div class='college-info'>";
									echo "    <h4>National Institute of Technology (NIT)</h4>";
									echo "    <p class='college-details'>Centrally Funded | Tier 1</p>";
									echo "    <span class='badge-eligible'><i class='fa fa-check'></i> Eligible</span>";
									echo "  </div>";
									echo "  <div class='criteria-pill'>Req: Weighted Index > 60%</div>";
									echo "</div>";
								}

								// 3. BITS Match Check
								if ($bits > 280) {
									$matched = true;
									echo "<div class='college-result-card bits-card'>";
									echo "  <div class='college-avatar'><i class='fa fa-university'></i></div>";
									echo "  <div class='college-info'>";
									echo "    <h4>Birla Institute of Technology & Science (BITS)</h4>";
									echo "    <p class='college-details'>Private Premium | Tier 1</p>";
									echo "    <span class='badge-eligible'><i class='fa fa-check'></i> Eligible</span>";
									echo "  </div>";
									echo "  <div class='criteria-pill'>Req: BITSAT > 280</div>";
									echo "</div>";
								}

								// 4. SRM Match Check
								if ($srm > 140) {
									$matched = true;
									echo "<div class='college-result-card srm-card'>";
									echo "  <div class='college-avatar'><i class='fa fa-university'></i></div>";
									echo "  <div class='college-info'>";
									echo "    <h4>SRM Institute of Science and Technology</h4>";
									echo "    <p class='college-details'>Private Premium | Tier 2</p>";
									echo "    <span class='badge-eligible'><i class='fa fa-check'></i> Eligible</span>";
									echo "  </div>";
									echo "  <div class='criteria-pill'>Req: SRMJEEE > 140</div>";
									echo "</div>";
								}

								// 5. VIT Match Check
								if ($vit > 80) {
									$matched = true;
									echo "<div class='college-result-card vit-card'>";
									echo "  <div class='college-avatar'><i class='fa fa-university'></i></div>";
									echo "  <div class='college-info'>";
									echo "    <h4>Vellore Institute of Technology (VIT)</h4>";
									echo "    <p class='college-details'>Private Premium | Tier 2</p>";
									echo "    <span class='badge-eligible'><i class='fa fa-check'></i> Eligible</span>";
									echo "  </div>";
									echo "  <div class='criteria-pill'>Req: VITEEE > 80</div>";
									echo "</div>";
								}

								if (!$matched) {
									echo "<div class='no-match-alert info-alert'>";
									echo "  <i class='fa fa-info-circle warning-icon'></i>";
									echo "  <h4>No Direct Matches</h4>";
									echo "  <p>You met the board threshold, but your competitive exam scores (JEE, BITSAT, SRMJEEE, VITEEE) did not meet the direct cutoffs for premier matching. Consider checking individual state university counseling guidelines.</p>";
									echo "</div>";
								}

								echo "</div>";
							}
							echo "</div>";
						}
					} else {
						// Display initial placeholder view on the right panel before calculation
						echo "<div class='glass-card right-placeholder-card'>";
						echo "  <div class='placeholder-icon'><i class='fa fa-compass'></i></div>";
						echo "  <h3>Awaiting Inputs</h3>";
						echo "  <p>Please enter your academic percentages and entrance exam scores in the input panel on the left, then click <strong>Calculate Matches</strong> to view your target campuses in real time.</p>";
						echo "</div>";
					}
				?>
			</div>

		</div>
	</div>

	<!-- Core Bootstrap Scripts -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

<?php
	// This is the index page.
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<!-- Bootstrap MaxCDN -->
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/tweetSearch/css/style.css">
	</head>
	<body>
	<div class="container home">
			<div class="logo"><img src="/tweetSearch/images/logo.png"></div>
			<h3>Twitter Hashtag Search</h3>
			<form class="form-horizontal" action="insert.php" method="get">

				<div class="form-group">
					<label class="control-label col-sm-4" for="keyword">Hashtag Search:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="keyword" name="keyword" placeholder="e.x. chicken" required>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-4" for="streetAddress">Street Address:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="streetAddress" name="streetAddress" placeholder="e.x. 123 Abc St, Hooville, LA" required>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-4" for="radius">Radius in miles:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="radius" name="radius" placeholder="e.x. 123" required>
					</div>
				</div>

				<div class="col-sm-12" style="text-align:right;">
					<button type="submit" class="btn btn-default" style="margin-bottom: 10px;">Submit</button> <!-- button to submit form -->
				</div>

			</form>

	</div>
	<!-- Scripts that shouldnt effect page load go right before the closing body tag -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>

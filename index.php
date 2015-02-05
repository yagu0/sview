<?php include 's.php'; ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8"/>
	<title><?php echo isset($s_title)?$s_title:$b_title; ?></title>
	<!--CSS styles-->
	<?php echo isset($s_header)?$s_header:$b_header; ?>
</head>

<body>

<!--Insert code for the menu here (or after the banner)-->

<!--Some website banner (could also come before the menu)-->

<div class="container">
	<!--A content is always page-specific, thus always defined, and has no default value-->
	<?php echo $content; ?>
</div>

<!--Write the footer here. It is not supposed to be redefined.-->

<?php echo isset($s_javascripts)?$s_javascripts:$b_javascripts; ?>

</body>

</html>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>

<!--
<form action="send.php" method="post">
	<textarea name="message" rows="15" cols="40"></textarea><br/>
	<input type="submit" name="send email">
</form>
-->
<form action="send.php" method="POST" id="contact-form"> <!--Start Contant Form-->
	<div class="messages"></div>
	<div class="controls"></div>
	<div class="form-group">
		<input type="text" id="form-name" name="name" class="form-control" required="required" placeholder="Name">
	</div>
	<div class="form-group">
		<input type="email" id="form-name" name="email" class="form-control" required="required" placeholder="Email address">
	</div>
	<div class="form-group">
		<input type="text" id="form-name" name="subject" class="form-control" required="required" placeholder="Subject">
	</div>
	<div class="form-group">
		<textarea name="message" id="form-message" rows="4" class="form-control" required="required" placeholder="Message"></textarea>
	</div>
	<input type="submit" class="btn btn-outline-light text-uppercase rounded-0 send_mail_button" value="send email">
</form> <!--End Contact Form-->

</body>
</html>
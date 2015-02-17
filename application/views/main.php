<html>
<head>
	<title>Login/Registration</title>
	<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
	 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	  <script>
		  $(function() {
		    $( "#datepicker" ).datepicker();
		  });
	  </script>
	


</head>
<body>


<h1>Welcome!</h1>
<?= $this->session->flashdata('registration'); ?>
<div id='register'>
	<p id="error"><?= $this->session->flashdata('blank_error'); ?></p>
	<p>* = required</p>
	<form action='register' method="post">
		<p>Name:* <input type='text' name='name'></p>
		<p>Alias:* <input type="text" name="alias"></p>
		<p>Email:* <input type='text' name='email'><?= $this->session->flashdata('email_error'); ?></p>
		<p>Password:* <input type='password' name='password' placeholder="* At least 8 characters"><?= $this->session->flashdata('password_error'); ?></p>
		<p>Confirm PW:* <input type='password' name='confirm_pw'><?= $this->session->flashdata('confirmpw_error'); ?></p>
		<p>Date of Birth: <input type='text' id='datepicker' name='dob'></p>
		<input type="submit" value="Register">
	</form>
</div>

<div id='login'>
<p id="error">
<?= $this->session->flashdata('login_error'); ?>
</p>
	<form action="login" method="post">
		<p>Email: <input type='text' name='email'></p>
		<p>Password: <input type='password' name='password'></p>
		<input type="submit" value="Login">
	</form>
</div>

</body>
</html>
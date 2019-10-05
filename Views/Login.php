<?php namespace Views;?>
<!DOCTYPE html>
<html>
<head>

	<title>CountMoney - Entrar o Registrarse</title>
	<link rel="stylesheet" href="/<?= BASE_URL ?>Css/mainPage.css"/>
	<link rel="stylesheet" href="/<?= BASE_URL ?>Css/login.css"/>
</head>
<body class="body">
	<div class="ul">
		<p class="subtitle">Count Money</p>
	</div>
	<div class="container">
	
		<div class="lateral">
			<br>
			<div class="mainTitle"><h1>Start session in CountMoney</h1></div>
			<form  action="/<?= BASE_URL ?>login/loginProcess" method="post">
				<label class="label" for="user">User Name: </label>
				<input class="input" type="text" name="user" placeholder="Username or email...">
				<br>
				<label class="label" for="password">Password: </label>
				<input class="input" type="password" name="password" placeholder="Password...">
				<br>
				<input type="submit" value="Submit">

				<?php 
				//TO SHOW ALERTS OF THE LOGIN
				if (isset($msj) && !strcmp($msj, "") == 0) { ?>
					<div class="alertMsjFromLogin">
						<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
						<?=$msj;?>
					</div>
				<?php }
				$msj="";
				?>

				<br>
				<a href="#" class="label"> Do you forgot your account?</a>
				<br>
				<p>----------------------------  o ----------------------------</p>

				<button class="btn"> Sing in </button>
			</form>
		</div>
		<div class="main">
		<h1 class="mainTitle">Count money help you to count your money as easy as eat a pinapple.</h1>
			<img class="image" src="/<?= BASE_URL ?>resources/images/pinapple.png">
			
		</div>
	</div>

</body>
</html>
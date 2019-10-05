<?php namespace Views;

	$importantNoteLine1 = "Este microservicio te ayudará a llevar un libro diario de tus cuentas hogareñas, o de varios hogares de una manera muy simple.";
	$importantNoteLine2 = "Solo dejate llevar por la magia de Count Money y todo será muy sencillo.";
	$importantNoteLine3 = "¡Comencemos!"; 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>countMoney</title>
	<link rel="stylesheet" href="/<?= BASE_URL ?>Css/mainPage.css"/>
</head>
<body class="body">
	<br>
	<HEADER class="header">
		<h1 class="mainTitle"><strong>Count Money</strong></h1>				
		<h2 class="subtitle">¡¡Bienvenidos!!</h2>	

	</HEADER>
	<br>
	<NAV>
		<div style="display:none" id="mySidebar" class="mySidebar">
  			<button class="item" id="closeNavBar" onclick="closeNavBar()">Cerrar &times;</button>
  			<a href="/<?= BASE_URL ?>movements/index" class="item" id="itemMovements">Movimientos</a>		
			<a href="#" class="item" id="itemDetails">Detalles</a>
  			<a href="#" class="item" id="itemTickets">Tickets</a>
		</div>
		<ul class="ul">
			<div class="li"><li><a href="/<?= BASE_URL ?>login/logout">Salir</a></li></div>
    		<div class="li"><li><a><?= $_SESSION['user']->getUsername(); ?></a></li></div>
   			<div class="li"><li><a href="#">Usuario</a></li></div>
			<div class="li"><li><a href="#">Ayuda</a></li></div>
   			<button id="sidebar-btn" class="sidebar-btn" onclick="openNavBar()">&#9776;</button>
  		</ul>
	</NAV>
	<SECTION>
		<br>
		<HEAD>
		<p class="importantNote"> 
				<?= $importantNoteLine1 ?>
				<br>
				<?= $importantNoteLine2 ?>
				<br>
				<?= $importantNoteLine3 ?> 
			</p>
			<hr>
		</HEAD>
		<ARTICLE>
			<br>
			<table id="diaryBookTable" class="diaryBookTable" >
				<tr>
					<th id="date" class="entradaysalida">Fecha</th>
					<th id="detalle" class="detalle">Detalle</th>
					<th id="entrada" class="entradaysalida">Entrada</th>
					<th id="salida" class="entradaysalida">Salida</th>
					<th id="salida" class="entradaysalida">Saldo</th>
				</tr>
				<?php 
				$saldo=0;
				if(isset($movements) & !is_string($movements)){
					$i=0;
					while($i< count($movements)){  ?>
						<tr>
							<td><?=$movements[$i]->getDate();?></td>
							<td><?=$movements[$i]->getDetail();?></td>
							<?php if($movements[$i]->getType()=="entrada"){?> 
								<td><?=$movements[$i]->getAmount();?></td>
								<td></td>
								<td><?php $saldo = $saldo+$movements[$i]->getAmount(); echo $saldo;?></td>
							<?php } else{?>
								<td></td>
								<td><?=$movements[$i]->getAmount()?></td>
								<td><?php $saldo = $saldo-$movements[$i]->getAmount(); echo $saldo;?></td>
							<?php } ?>
						</tr>
					<?php $i=$i+1; } } else{ ?>
						<tr>
							<td colspan=4> no tiene registrados movimientos</td> 
							<td>$0</td>
						</tr>
					<?php } ?>

			</table>
		</ARTICLE>
	</SECTION>
	<ASIDE>
		
	</ASIDE>
	<FOOTER></FOOTER>

<script type="text/javascript" src="/<?= BASE_URL ?>resources/javascriptCode/index.js"></script>  
<script type="text/javascript">
	alert("Bienvenidos a count money la pagina para contar dinero");
</script>
</body>
</html>
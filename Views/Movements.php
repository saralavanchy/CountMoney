<?php namespace Views;?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>countmoney | movimientos </title>
    <link rel="stylesheet" href="/<?= BASE_URL ?>Css/mainPage.css"/>
    <link rel="stylesheet" href="/<?= BASE_URL ?>Css/movements.css"/>
    <link rel="stylesheet" href="/<?= BASE_URL ?>Css/login.css"/>
</head>
<body class="body">
	<br>
	<HEADER class="header">
		<h1 class="mainTitle"><strong>Count Money</strong></h1>				
		<h2 class="subtitle">menu de movimientos</h2>	

	</HEADER>
	<br>
	<NAV>
		<div style="display:none" id="mySidebar" class="mySidebar">
  			<button class="item" id="closeNavBar" onclick="closeNavBar()">Cerrar &times;</button>
			<a href="#" class="item" id="itemDetails">Detalles</a>
            <a href="#" class="item" id="itemTickets">Tickets</a>
            <a href="/<?= BASE_URL ?>mainpage" class="item" id="mainMenuDir">Menu principal</a>
		</div>
		<ul class="ul">
			<div class="li"><li><a href="/<?= BASE_URL ?>login/logout">Salir</a></li></div>
    		<div class="li"><li><a><?= $_SESSION['user']->getUsername(); ?></a></li></div>
            <div clas="li"><button id="movement-btn" class="movement-btn" onclick="openForm()">nuevo movimiento</button></div>
            <div clas="li"><button id="close-movement-btn" class="movement-btn" onclick="openFormDelete()">eliminar movimiento</button></div>
   			<button id="sidebar-btn" class="sidebar-btn" onclick="openNavBar()">&#9776;</button>
  		</ul>
    </NAV>
    <SECTION>
        <HEAD>
            <?php 
    			if (isset($possitiveMsj) && !strcmp($possitiveMsj, "") == 0) { ?>
					<div class="alertPstMsjFrom">
						<span id="closeMessageBtn" class="closebtn" onclick="closeMessage()">&times;</span>
						<?=$possitiveMsj;?>
					</div>
				<?php }
			$possitiveMsj="";
			?>
            <?php 
    			if (isset($msj) && !strcmp($msj, "") == 0) { ?>
					<div class="alertMsjFromLogin">
						<span id="closeMessageBtn" class="closebtn" onclick="closeMessage()">&times;</span>
						<?=$msj;?>
					</div>
				<?php }
			$msj="";
			?>
        </HEAD>
        <ARTICLE>
            <div class="form-popup" id="newMovementForm">
                <form action="/<?= BASE_URL ?>movements/addMovement" class="form-container" method="post">
                    <div class="ul"><h1 class="h1">Nuevo moviento</h1></div>
                    <label class="input-movements" for="date"><b>Fecha: </b></label>
                    <input type="date" placeholder="dd/mm/aaaa" name="date">
                    <br>
                    <label class="input-movements" for="amount"><b>Dinero: </b></label>
                    <input type="number" placeholder="cantidad de dinero en numeros" name="amount" tittle="solo montos numericos hasta 1000000"  max="1000000" min="0" >
                    <br>
                    <label class="input-movements" for="type"><b>Tipo de Movimiento: </b></label>
                    <select id="typeOfMovement" name="type">
                        <option value="" disabled selected>Elige el tipo de movimiento..</option>
                        <option value="1"> Entrada </option>
                        <option value="2"> Salida </option>
                    </select>
                    <br>
                    <label class="input-movements" for="detail"><b>Detalle: </b></label>
                    <select id="details" name="detail">
                        <option value="" disabled selected>Elige el detalle..</option>
                        <?php if(isset($detail)){ 
                            $i=0;
                            while($i < count($detail)){?>
                              <option value="<?=$detail[$i]->getIdDetail();?>"> <?=$detail[$i]->getDetail();?> </option>
                        <?php $i++;}}?>
                    </select> 
                    <br>
                    <input type="submit" class="btn btn-charge" value='cargar movimiento'>
                    <button class="btn cancel" onclick="closeFormDelete()">Cerrar</button>
                </form>
            </div> 
		</ARTICLE>
        <ARTICLE>
            <div class="form-popup" id="deleteMovementForm">
            <form action="/<?= BASE_URL ?>movements/deleteMovement"  method="post">
                <div class="ul"><h1 class="h1">Eliminar moviento</h1></div>
                <table id="diaryBookTable" class="diaryBookTable" >
                    <tr>
                        <th id="date" class="entradaysalida">Fecha</th>
                        <th id="detalle" class="detalle">Detalle</th>
                        <th id="entrada" class="entradaysalida">Entrada</th>
                        <th id="salida" class="entradaysalida">Salida</th>
                        <th id="salida" class="entradaysalida">Saldo</th>
                        <th></th>
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
                                
                                    <input type="hidden" value="<?=$movements[$i]->getIdMovement()?>">
                                    <td><input type="submit" class="btn btn-charge" value='x'></td>
                               
                            </tr>
                        <?php $i=$i+1; } } else{ ?>
                            <tr>
                                <td colspan=4> no tiene registrados movimientos</td> 
                                <td>$0</td>
                            </tr>
                        <?php } ?>
                </table>
                <button class="btn cancel" onclick="closeFormDelete()">Cerrar</button>
                </form>
             </div>
		</ARTICLE>



    </SECTION>

    <script type="text/javascript" src="/<?= BASE_URL ?>resources/javascriptCode/index.js"></script>  
</body>
</html>
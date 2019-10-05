		'use strict'
		/*alert for the initial welcome*/
		//var welcome = "Bienvenidos";
		//const programName = "Count Money";
		//let programFunction = "pagina para contar dinero";
		//alert(welcome + " a " + programName +" !! la mejor "+programFunction);
		
		/*functions for the nav-bar*/
		function openNavBar() {
    		document.getElementById("mySidebar").style.display = "block";
		}
		function closeNavBar() {
  		  document.getElementById("mySidebar").style.display = "none";
		}

		/*-para escribir en js usamos document.write
		  -console.log() para mostrar cosas en la consola
		  -si pongo 'use strict' al principio activo al modo estricto de javascript
		  -var es una variable global y let variable local a nivel de bloque(si la creo en un if fuera del if no existe)
		  -const es una variable estatica 
		*/

		//for the movements modals
		function openFormDelete(){
			document.getElementById("deleteMovementForm").style.display = "block";

		}

		function closeFormDelete(){
			document.getElementById("deleteMovementForm").style.display = "none";
			window.location="deleteMovement";
		}

		function openForm() {
			document.getElementById("newMovementForm").style.display = "block";
		  }
		  
		  function closeForm() {
			document.getElementById("newMovementForm").style.display = "none";
		  } 

		  function closeMessage(){
			document.getElementById("closeMessageBtn").style.display='none';
			window.location = "index";
		  }

		
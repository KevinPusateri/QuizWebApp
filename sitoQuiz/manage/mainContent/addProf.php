<?php

	echo"
	
		<form action='homePageAdmin.php' onsubmit='return checkPsw()' class='crea' method='post' onsubmit='registra();'>
			
			<div class='cont'>
				<input type='text' name='username' placeholder='Username' required/>
				<br/><br/>
				<input type='text' name='password' id='psw' placeholder='Password' required/>
				<br/><br/>
				<input type='text' name='password2' id='psw2' placeholder='Reinserire password' required/>
				<br/><br/>

				<input type='text' name='nome' placeholder='Nome' required/>
				<br/><br/>
				<input type='text' name='cognome' placeholder='Cognome' required/>
				<br/><br/>

				<input type='submit' class='btn' value='Registra'  style='margin-left:200px'/>
				<input type='hidden' value='insegnante' name='ruolo'/>
				</div>
		</form>
		
	
	";
	
?>
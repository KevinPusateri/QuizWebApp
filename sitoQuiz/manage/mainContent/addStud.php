<?php

	echo"

	
	
		<form action='homePageAdmin.php' onsubmit='return checkPsw()' class='crea' method='post' onsubmit='return registra();'>
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
			
			<select name='nClasse' required>
				<option value='1'>1&#170</option>
				<option value='2'>2&#170</option>
				<option value='3'>3&#170</option>
				<option value='4'>4&#170</option>
				<option value='5'>5&#170</option>
			</select>
			<select name='sezione' required>
				<option value='A'>A</option>
				<option value='B'>B</option>
				<option value='C'>C</option>
				<option value='D'>D</option>
				<option value='E'>E</option>
				<option value='F'>F</option>
				<option value='G'>G</option>
				<option value='H'>H</option>
				<option value='I'>I</option>
				<option value='L'>L</option>
				<option value='M'>M</option>
				<option value='N'>N</option>
			</select>
			<br/><br/>
			<input type='submit' class='btn' value='Registra'  style='margin-left:200px'/>
			<input type='hidden' value='studente' name='ruolo'/>
			</div>
		</form>
		
	
	";
	
?>
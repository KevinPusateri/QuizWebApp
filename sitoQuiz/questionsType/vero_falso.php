<?php
	
	echo "
			<form action='createQuiz.php' method='post' class='contDomanda'>
			<div class='domanda'>
				Domanda: <input type='text' autocomplete='off' name='qst' id='qst' required/><br/><br/>
				Punti domanda: <input type='number' min='0' name='punti' id='punti' step='0.5' required/>
				<br/><br/><br/>
				<input type='radio' name='ans' value='vero' required/>Vero<br/>
				<input type='radio' name='ans' value='falso'/>Falso<br/><br/><br/><br/>
				<input type='submit' class='btn' value='Aggiungi quesito'/><br/><br/><br/>
				
				<input type='hidden' name='tipo' value='v-f' />
			</div>

			</form>
	
	";
	
	

?>
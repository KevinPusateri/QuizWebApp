<?php
	
	echo "
			<form action='createQuiz.php' method='post' class='contDomanda'>
			<div class='domanda'>
				Domanda: <input type='text' name='qst' id='qst' autocomplete='off' required/>
				 Punti domanda: <input type='number' min='0' name='punti' id='punti' step='0.5' autocomplete='off' required/>
				<br/><br/><br/>
				(selezionare la risposta corretta)<br/><br/>
				<input type='radio' name='ans' value='1' required/><input type='text' name='ans1' id='ans1' placeholder='risposta 1' autocomplete='off' required/><br/><br/>
				<input type='radio' name='ans' value='2'/><input type='text' name='ans2' id='ans2' placeholder='risposta 2' autocomplete='off' required/><br/><br/>
				<input type='radio' name='ans' value='3'/><input type='text' name='ans3' id='ans3' placeholder='risposta 3' autocomplete='off'/><br/><br/>
				<input type='radio' name='ans' value='4'/><input type='text' name='ans4' id='ans4' placeholder='risposta 4' autocomplete='off'/><br/><br/>
				<input type='submit' class='btn' value='Aggiungi quesito' style='margin-left:200px'/>
				<input type='hidden' name='tipo' value='multi' />
				</div>
			</form>
	
	";
?>
<?php
		
	
	$path="'../../questionsType/riempimento_risp.php'";
	$divId="'risp_riemp'";
	
		echo "
				<form action='createQuiz.php' method='post' class='contDomandariemp'>
				<div class='domandariemp'>
				
					<p style='color:grey; font-style:italic'>(Indicare con * la parola mancante, es.:La capitale della * &#232 Zurigo)</p><br/>
					<input type='text' rows='10' cols='50' required style='margin-left:20px;' name='qst' id='qst' autocomplete='off' onkeyup=".'"'."getAjaxAutoComplete($path, $divId, this.value)".'"'." />
					Punti domanda: <input type='number' min='0' name='punti' id='punti' step='0.5' required /> 
					<br/><br/>
					 
					<div id='risp_riemp'>
					</div>
					</br/><br/><br/>
					<input type='submit' class='btn' value='Aggiungi quesito' style='margin-top:8px; float:left;'/></br>
					<input type='hidden' name='tipo' value='fill' />
					
				</div>
				</form>
		
		";
	
?>
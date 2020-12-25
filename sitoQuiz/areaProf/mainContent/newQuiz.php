<?php

	echo"
	
		<form class='crea' action='subPages/createQuiz.php' method='get'>
		
			<div class='cont'>
			
			<input type='text' name='nomeTab' autocomplete='off' placeholder='Nome quiz' required/>
			<br/><br/>
			<select name='nClasse'>
				<option value='1'>1&#170</option>
				<option value='2'>2&#170</option>
				<option value='3'>3&#170</option>
				<option value='4'>4&#170</option>
				<option value='5'>5&#170</option>
			</select>
			<select name='sezione'>
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
			<select name='materia'>
				<option value='Italiano'>Italiano</option>
				<option value='Storia'>Storia</option>
				<option value='Geografia'>Geografia</option>
			</select>
			<br/><br/>
			<input type='submit' class='btn' value='Crea..' style='margin-left:200px'/>
			
			</div>
		</form>
		
	";
?>
<?php

	$num = (isset($_GET["num"])) ? $_GET["num"] : 0;

	if($num>0){
		
		echo "<p style='color:grey; font-style:italic'>(non &#232 necessario riempire tutti i campi)</p><br/>
				<input type='hidden' name='num_ans' value='$num'/>
			";
		$n_num=1;
	
		while($n_num<=$num){
			
			echo"
					<div id='risp'>
					Parola $n_num:</br>
					<input type='radio' name='".$n_num."ansR' value='".$n_num."1' required/><input type='text' name='ans[]' id='ans1' placeholder='risposta 1' autocomplete='off'/><br/><br/>
					<input type='radio' name='".$n_num."ansR' value='".$n_num."2'/><input type='text' name='ans[]' id='ans2' placeholder='risposta 2' autocomplete='off'/><br/><br/>
					<input type='radio' name='".$n_num."ansR' value='".$n_num."3'/><input type='text' name='ans[]' id='ans3' placeholder='risposta 3' autocomplete='off'/><br/><br/>
					<input type='radio' name='".$n_num."ansR' value='".$n_num."4'/><input type='text' name='ans[]' id='ans4' placeholder='risposta 4' autocomplete='off'/><br/><br/>
					<input type='radio' name='".$n_num."ansR' value='".$n_num."5'/><input type='text' name='ans[]' id='ans5' placeholder='risposta 5' autocomplete='off'/><br/><br/>
					<input type='radio' name='".$n_num."ansR' value='".$n_num."6'/><input type='text' name='ans[]' id='ans6' placeholder='risposta 6' autocomplete='off'/><br/><br/>
					</div>
			";
			$n_num++;
		}
	}
	
	else echo "";
		
?> 
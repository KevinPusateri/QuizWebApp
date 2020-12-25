<html>
<head>
 <link rel="stylesheet" href="../../src/styleProfessor.css"/>
		<link rel="stylesheet" href="../../src/styleStudente.css"/>
</head>
<body class='bodyc'>
<?php

	session_start();
	require_once("../../lib/connection.php");
	$conn = Connection::connect();
	
	require_once("../../lib/splitString.php");
	
	$tabName = $_POST["idQuiz"];
	$user = $_POST["user"];
	
	$result=$conn->query("SELECT * FROM risultati WHERE username='$user' AND codiceQuiz='$tabName'");
	if($result->num_rows==0){
	
	$sql = "INSERT INTO risultati (username,codiceQuiz) VALUES ('$user','$tabName')";
	$conn->query($sql);
	}
//-------------------------------------------------------------------------------
	
	echo "<form action='correggi.php' method='post'>";
	$sql = "SELECT * FROM `$tabName` ";
	
	$result = $conn->query($sql);
	if($result->num_rows>0){
		echo"<div class='visSvolgi'>";
			echo"<div class='contSvolgi'>"; 
		$ord=0;	
		while($row=$result->fetch_assoc()){
			$ord++;
			/*echo "$ord</br></br>";*/
			echo"<div class='testoquiz'>";
						echo"<font size='5'>".$row["id"].")</font> ";
						getQst($row["id"], $row["tipoDomanda"],$row["testoDomanda"],$row["risposte"]);
				
				echo"</div>";
		}
		echo"<input type='submit' class='btn' style='margin: 1.8em; float:right;padding: 0.8em 1.5em;' value='Finisci'/>
		<div style='clear:both;'></div>
			</div>
		
		";
	}
	else echo "Error: nessun quesito inserito in questo quiz";
		
	function getQst($id, $tipo, $domanda, $risposte){
		
		switch($tipo){
			
			case "v-f":{
				$risp = array();
				$risp = expString($risposte, "*");
				echo "<font size='5'>".$domanda."</font>";
				echo "
					<br/><br/>
					<input type='radio' name='risp".$id."[]' value='vero'/>$risp[0]<br/>
					<input type='radio' name='risp".$id."[]' value='falso'/>$risp[1]
				";
				break;
			}
			case "multi":{
				$risp = array();
				$risp = expString($risposte, "*");
				echo "<font size='5'>".$domanda."</font>";
				echo "
					<br/><br/>";
				foreach($risp as $k => $r){
					echo"	<input type='radio' name='risp".$id."[]' value='$r'/>$r<br/>
					";
					}
				break;
			}
			case "fill":{
				$setSelect = expString($risposte, "-");
				$risp = array();

				$n=0;
				for($k=0; $k<strlen($domanda); $k++){
					
					
					if(substr($domanda,$k,1)!="*"){
						echo substr($domanda,$k,1);
					}
					else{
						$risp = expString($setSelect[$n],"*");
						$n++;
						
						echo "<select name='risp".$id."[]'>";
						echo "<option value='-'>-</option>";
						for($y=0; $y<count($risp); $y++){
							if($risp[$y]!=" ") echo "<option value='".$risp[$y]."'>".$risp[$y]."</option>";
						}
						echo "</select>";
					}	
				}
			}
			
		}
	}
	
	
	echo "
		<input type='hidden' name='idQuiz' value='$tabName'/>
		<input type='hidden' name='user' value='$user'/>
		</form>
	";
		echo"</div>";

	$conn->close();
	
?>
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
	
	if(isset($_SESSION["tabella"])){
		$tabName = $_SESSION["tabella"];
	}
	
	if(isset($_POST["idQst"])){
		$conn->query("DELETE FROM `$tabName` WHERE id='".$_POST["idQst"]."'");
	}
	if(isset($_POST["tabName"])){
		$tabName=$_POST["tabName"];
		$_SESSION["tabella"] = $tabName;
	}
	
	
	
	$sql="SELECT * FROM `$tabName` ";
	
	$result = $conn->query($sql);
	if($result->num_rows>0){
		echo"<div class='visSvolgi'>";
			echo"<div class='contSvolgi'>"; 
		while($row=$result->fetch_assoc()){
				echo"<div class='testoquiz'>";
					echo $row["id"].") ";
					getQst($row["id"], $row["tipoDomanda"],$row["testoDomanda"],$row["risposte"],$row["punti"]);
				echo"</div>";
		}
				echo"</div>";

	}
	else echo "<b>Nessun quesito inserito in questo quiz</b><br/>";
			
			
			
	function getQst($id, $tipo,$domanda,$risposte,$punti){
		
		switch($tipo){
			
			case "v-f":{
				$risp = array();
				$risp = expString($risposte, "*");
				echo "<font size='5'>".$domanda."</font>";
				echo "
					<br/><br/>
					<input type='radio' name='risp".$id."' value='vero'/>$risp[0]<br/>
					<input type='radio' name='risp".$id."' value='falso'/>$risp[1]<br/>
					<br/>Punti quesito: $punti
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
					echo"	<input type='radio' name='risp".$id."' value='ans".$k."'/>$r<br/>
					";
					}
					echo "<br/><br/>Punti quesito: $punti	
					";
				break;
			}
			case "fill":{
				$setSelect = expString($risposte, "-");
				$risp = array();

				$n=0;
				for($k=0; $k<strlen($domanda); $k++){
					
					if(substr($domanda,$k,1)!="*")echo substr($domanda,$k,1);
					else{
						$risp = expString($setSelect[$n],"*");
						$n++;
						
						echo "<select name='risp".$id."'>";
						echo "<option value='ans0'>-</option>";
						for($y=0; $y<count($risp); $y++){
							if($risp[$y]!=" ")echo "<option value='ans".($y+1)."'>".$risp[$y]."</option>";
						}
						echo "</select>";
					}	
				}
				echo"<br/><br/>Punti quesito: $punti";
			}
			
		}
		echo"
			<form action='reviewQuiz.php' method='post'/>
				<input type='submit' class='btn' style='float:right;' value='elimina quesito'/>
				<input type='hidden' value='$id' name='idQst'/>
			</form>
		";
	}
	

	echo "<script>
				function goBack() {
					location.href='createQuiz.php';
				}
				function save(){
					location.href='../homePageProf.php';
				}
		</script>
<button  onclick='goBack()'  class='btn btnaggiungi'>Aggiungi quesito</button>
		
			<button id='save' class='btn btnaggiungi' onclick='save()'>Salva ed esci</button>";
echo"<div style='clear:both;'></div></div>";
	
?>
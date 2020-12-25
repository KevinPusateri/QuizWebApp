<html>
<head>
 <link rel="stylesheet" href="../../src/styleProfessor.css"/>
		<link rel="stylesheet" href="../../src/styleStudente.css"/>
</head>
<body class='bodyc'>
<?php
echo"<div class='visSvolgi'>";
	class Cont {
		static $n_fillRisp;
	}

	session_start();
	require_once("../../lib/connection.php");
	$conn = Connection::connect();
	
	require_once("../../lib/splitString.php");

	$tabName = $_POST["idQuiz"];
	$user = $_POST["user"];
	
	$sql = "SELECT consegnato FROM risultati WHERE username='$user' AND codiceQuiz='$tabName'";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
	
	if($row["consegnato"]==0){
		
		$sql = "SELECT id FROM `$tabName`";
		$result=$conn->query($sql);
		$vettId=array();
		
		for($i=0; $row=$result->fetch_assoc(); $i++) {$vettId[$i]=$row["id"];}
		
		$risposte = "";
		$vettRispUser = array();
		$vettCorrette = array();
		
		$k=0;
		for($i=0; $i<count($vettId); $i++){
			if(isset($_POST["risp".$vettId[$i]][1])){
				for($j=0; isset($_POST["risp".$vettId[$i]][$j]); $j++){
					$vettRispUser[$k]=$_POST["risp".$vettId[$i]][$j];
					$risposte.=$_POST["risp".$vettId[$i]][$j]."*";
					$k++;
				}
			}
			else{
				if(isset($_POST["risp".$vettId[$i]][0])){
					$vettRispUser[$k]=$_POST["risp".$vettId[$i]][0];
					$risposte.=$_POST["risp".$vettId[$i]][0]."*";
				}
				else{
					$vettRispUser[$k]=" ";
					$risposte.=" ";
				}
				$k++;
			}
		}
		
		$sql = "SELECT rispostaCorretta,punti FROM `$tabName`";
		$result=$conn->query($sql);
		$rispCorrette="";
		$vettPunti=array();
		for($i=0; $row=$result->fetch_assoc(); $i++){
			$rispCorrette.=$row["rispostaCorretta"]."*";
			$vettPunti[$i]=$row["punti"];
		}
		$vettCorrette = expString($rispCorrette,"*");

		for($i=0; $i<count($vettCorrette); $i++){
			if(!isset($vettRispUser[$i])) $vettRispUser[$i]=$i."_";
		}
		
		//print_r($vettCorrette);echo"rights<br/>";
		//print_r($vettRispUser);echo"user<br/>";
		//print_r($vettPunti);echo"points<br/>";
	
	
			echo"<div class='contSvolgi'>";

	echo "<form action='../homePageStudente.php'>";
	
	$sql = "SELECT * FROM `$tabName` ";
	$risultato=0;
	
	$result = $conn->query($sql);
	if($result->num_rows>0){
		
	
		$crd=0;
		for($i=0; $row=$result->fetch_assoc(); $i++)
		{
			echo"<div class='testoquiz'>";
					Cont::$n_fillRisp=0;
					$crd++;
				echo $crd.") ";
						
							$risultato+= getQst($row["id"], $row["tipoDomanda"],$row["testoDomanda"], $vettRispUser, $vettCorrette, $vettPunti[$crd-1], $i);
						echo"</div>";

				if(Cont::$n_fillRisp!=0)$i+=Cont::$n_fillRisp-1;
		}
		
	}
	else echo "Error";
	
	$totPunt=0;
	for($i=0; $i<count($vettPunti); $i++)$totPunt+=$vettPunti[$i];
	echo"<div class='contSvolgi'>";
			echo"<div class='testoquiz'>";
		echo " Punteggio realizzato: $risultato/$totPunt</br></br>
			<input type='submit' class='btn' tyle='margin: 1.8em; float:right; padding: 0.8em 1.5em;' value='Esci'/></div></div>
			<input type='hidden' name='puntiUser' value='$risultato'/>
			<input type='hidden' name='user' value='$user'/>
			</form>
		";
	
	$sql = "UPDATE risultati 
	SET risposte='$risposte', punteggio='$risultato', consegnato='1' 
	WHERE username='$user' AND codiceQuiz='$tabName'
	";
	$conn->query($sql);
	
	}
	else{
		echo "
		<div class='contSvolgi'>
		<div class='testoquiz'>
			<p style='text-align:center;'>Verifica già completata, entrare nella sezione <i><b>Vedi quiz svolti</b></i> per rivedere i risultati<p></br></br>
			<form action='../homePageStudente.php'>
			<input type='submit' class='btn' tyle='margin: 1.8em auto; float:right; padding: 0.8em 1.5em;' value='Esci'/></div>
				<div style='clear:both;'></div>
			</form>
		";
	}
	
	function checkId($l,$rispUser){
		$sId="";
		if(isset($rispUser[$l])){
			for($k=0; substr($rispUser[$l],$k,1)!="_" && $k<4; $k++){
				$sId=$k;
			}
		}
		return $sId+1;
	}
		
	function getQst($id, $tipo, $domanda, $rispUser, $rispRight, $punteggio, $i){
		
		switch($tipo){
			
			case "v-f":{
				echo "<font size='5'>".$domanda."</font>";
				echo "
					<br/><br/>
					Hai risposto: <b>".$rispUser[$i]."</b>
				";
				if($rispUser[$i]==$rispRight[$i]){
					echo " <i style='color:green'><b> [risposta corretta]</b></br></i>
							</br></br> Punti: $punteggio/$punteggio";
				}
				else {
					echo " <i style='color:red'><b> [risposta errata]</b></i>
							La risposta corretta era <b>".$rispRight[$i]."</b>
							</br></br> Punti: 0/$punteggio";
					$punteggio=0;
				}
				break;
			}
			
			case "multi":{
				
				echo "<font size='5'>".$domanda."</font>";
				echo"<br/><br/>Hai risposto: <b>".$rispUser[$i]."</b>";
				if($rispUser[$i]==$rispRight[$i]){
					echo " <i style='color:green'><b> [risposta corretta]</b></i>
							</br></br> Punti: $punteggio/$punteggio";
							
				}
				else {
					echo " <i style='color:red'><b> [risposta errata]</b></i>
							La risposta corretta era <b>".$rispRight[$i]."</b>
							</br></br> Punti: 0/$punteggio";
					$punteggio=0;
				}
				break;
			}

			case "fill":{
				$punts=0;
				echo $domanda;
				for($k=0; $k<strlen($domanda); $k++){
					if(substr($domanda,$k,1)=="*")Cont::$n_fillRisp++;
				}
				
				$n_parziali=Cont::$n_fillRisp;
				
				for($j=0; $j<$n_parziali; $j++){
					
					echo "
						<br/><br/>
						Risposta ".($j+1)."</br>
						Hai risposto: <b>".$rispUser[$i+$j]."</b>
					";
					if($rispUser[$i+$j]==$rispRight[$i+$j]){
						echo " <i style='color:green'> <b> [risposta corretta]</b></i>
								</br></br><u> Punti parziali: ".($punteggio/$n_parziali)."/".$punteggio."</u>";
								$punts+=($punteggio/$n_parziali);
					}
					else {
						echo " <i style='color:red'> <b> [risposta errata]</b></i>
								La risposta corretta era <b>".$rispRight[$i+$j]."</b>
								</br></br><u> Punti parziali: 0/".$punteggio."</u>";
					}
					
				}
				echo "</br></br>Punti: ".$punts."/".$punteggio;
				$punteggio=$punts;
				break;
			}
			
		}
	
	
		
		return $punteggio;
	echo"</div>";
	}

?>
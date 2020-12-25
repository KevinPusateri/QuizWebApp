<html>
<head>
 <link rel="stylesheet" href="../../src/styleProfessor.css"/>
		<link rel="stylesheet" href="../../src/styleStudente.css"/>
</head>
	

		<script>
			function goBack() {
                location.href='../homePageStudente.php';
            }
		</script>
	
	<button id='back' class='btn' onclick='goBack()'  >Indietro</button>

<body class='bodyc'>
<?php

	session_start();
	$user = $_SESSION["username"];
	
	require_once("../../lib/connection.php");
	$conn = Connection::connect();
	
	$sql = "SELECT * FROM `elencoquiz` 
			INNER JOIN risultati 
			ON risultati.codiceQuiz = elencoquiz.id 
			AND risultati.username='$user' 
			AND risultati.consegnato='1'
		";
	
	$result = $conn->query($sql);

	if($result->num_rows>0){
		echo"<div class='visSvolgi'>";
			echo"<div class='contSvolgi'>"; 

		while($row=$result->fetch_assoc()){
			
			$res2 = $conn->query("SELECT SUM(punti) AS punts FROM `".$row["codiceQuiz"]."`");
			$row2 = $res2->fetch_assoc();
			$puntTot = $row2["punts"];
			
			echo"<div class='testoquiz'>";
			echo"
				
					<b>Quiz:</b> ".$row["nome"]."</br></br>
					<b>Materia:</b> ".$row["materia"]."</br></br>
					<b>Punteggio:</b> ".$row["punteggio"]." / $puntTot"."
				
			</div>
			";
		}echo"</div>";
	}
		echo"</div>";

?></body>
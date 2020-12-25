<?php
	session_start();
	require_once("../../lib/connection.php");
	$conn = Connection::connect();
	$username = $_SESSION['username'];
	
	if(isset($_GET["val"])){
		$sql = "DELETE FROM elencoquiz WHERE id='".$_GET["val"]."'";
		$conn->query($sql);
		
		$sql = "DROP TABLE `".$_GET["val"]."`";
		$conn->query($sql);
	}

	$sql = "SELECT * FROM elencoquiz WHERE insegnante='$username'";
	$result = $conn->query($sql);
	
	if($result->num_rows>0){
		$i=1;
		
		echo"<div class='visquiz'>";
		while($row = $result->fetch_assoc()){
			echo "
				<div class='cont'>
					<div class='testo'>
					<b>$i) Quiz:</b> ".$row['nome'].".
					<span><b>Creato il:</b> ".substr($row['id'],4,10)."</span>
					<br/>
					<b>Materia:</b> ".$row['materia']."
					<br/>
					<b>Classe:</b> ".$row['classe'];
					
					echo "</br>
						<form action='subPages/reviewQuiz.php' method='post'>
							<input type='button' class='btn' style='float:right' value='Elimina' onclick=".'"'."delQuiz('".$row['id']."')".'"'."/>
							<input type='submit' value='Rivedi quiz' class='btn' style='float:right'/>
							<input type='hidden' value='".$row['id']."' name='tabName'/>
						</form>
					";
					
					echo "<div id='btnQuiz".$i."'>";
					if($row['attiva']=="no")echo "<button id='attBtn' class='btnatt' onclick=".'"'."getAjax('mainContent/att_dis.php', 'btnQuiz".$i."', '1', '".$row["id"]."')".'"'.">Attiva quiz</button>";
					else echo "<button id='disBtn' class='btndis' style='backgroung-color:red;' onclick=".'"'."getAjax('mainContent/att_dis.php', 'btnQuiz".$i."', '0', '".$row["id"]."')".'"'.">Disattiva quiz</button>";
				echo"</div>";
				
			echo"
				</div>
				</div>
				<br/></br>
			";
			$i++;
		}
		
		echo"</div>";
	}
	else echo "Nessun quiz disponibile";

?>
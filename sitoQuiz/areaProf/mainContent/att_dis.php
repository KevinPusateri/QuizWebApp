<?php
	require_once("../../lib/connection.php");
	$conn = Connection::connect();
	
	$opz = $_GET["val"];
	$id = $_GET["val2"];
	$div = $_GET["idDiv"];
	
	$result = $conn->query("SELECT classe FROM elencoquiz WHERE id='$id'");
	$row=$result->fetch_assoc();
	$classe = $row["classe"];
	
	if($opz == "1"){
		
		$result = $conn->query("SELECT attiva FROM elencoquiz WHERE attiva='si' AND classe='$classe'");
		if($result->num_rows==0){
			$conn->query("UPDATE elencoquiz SET attiva='si' WHERE id='$id'");
			echo "<button id='attBtn' class='btndis' onclick=".'"'."getAjax('mainContent/att_dis.php', '$div', '0', '$id')".'"'.">Disattiva quiz</button>";
		}
		else echo "<button id='disBtn' class='btnatt' onclick=".'"'."getAjax('mainContent/att_dis.php', '$div', '1', '$id')".'"'.">Attiva quiz</button><sub style='color:red'>(Per questa classe &#232 gi&#224 attivo un quiz)</sub>";
	}
	else if($opz == "0"){
		
		$conn->query("UPDATE elencoquiz SET attiva='no' WHERE id='$id'");
		echo "<button id='disBtn' class='btnatt' onclick=".'"'."getAjax('mainContent/att_dis.php', '$div', '1', '$id')".'"'.">Attiva quiz</button>";
	}

?>
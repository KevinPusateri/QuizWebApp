<?php 
//inizia sessione
session_start();

//require_once(); di oggetti e librerie necessarie
require_once("../lib/connection.php");

//Controllo sessione e tipo di account accesso, se credenziali errati porta al login
if(!isset($_SESSION['username'])||$_SESSION['tipoAccount'] != "studente"){
    header("Location: ../index.php");
    die();
}

//crea connessione al DB
$conn = Connection::connect();

//ottieni username dell'utente accesso
$username = $_SESSION['username'];

//se viene ricevuto una form(in post)
if(isset($_POST)){
    //codice
}

//se vengono ricevuti parametri get
if(isset($_GET)){
    //codice
}

function view($conn,$username){
	
	$sql = "SELECT classe FROM studente WHERE username='$username'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$classe = $row["classe"];
	
	$sql = "SELECT * FROM elencoquiz WHERE classe='$classe' AND attiva='si'";
	$result = $conn->query($sql);
	
	if($result->num_rows>0){
		
		while($row=$result->fetch_assoc()){
			echo "<div class='avvia'>
				<div class='contAvvia'>";
			echo "<b>Quiz: </b>".$row["nome"]."<br/><br/><b>Materia: </b>".$row["materia"]."<br/><br/>";
			echo"
				<form action='subPages/svolgiQuiz.php' method='post'>
						<input type='submit' class='btn' style='padding: 10px;font-size: 19px;font-family: Verdana;' value='Avvia' />
						<input type='hidden' name='idQuiz' value='".$row["id"]."'/>
						<input type='hidden' name='user' value='$username'/>
					</div>
				</form>
			";
			echo "</div>";
		}
	}
	else echo"Nessun quiz disponibile";


//chiude connessione DB
$conn->close();
}
?>

<html>
    <head>
        <!--TITOLO PAGINA-->
        <title>Home Studente</title>
		
        <meta charset="utf-8">
		
        <!--LINK AI FILE CSS-->
        <link rel="stylesheet" href="../src/styleProfessor.css"/>
		<link rel="stylesheet" href="../src/styleStudente.css"/>
        <!--LINK AI FILE JS-->
        <script src='../src/js_innerHtml_ajax.js'></script>
		
		
        <!--JS INTERNO-->
        <script>
            function goBack() {
                
            }
        </script>
		
    </head>
	
	
    <body>
        <!--HEADER-->
        <?php require_once("../lib/headerStudente.php"); ?>

        <!--CONTENUTI PRINCIPALI-->
        <div id='main' class="mainContent">
		
			<?php
			view($conn,$username);	
			?>

        </div>
        
        <!--FOOTER-->
        <?php //include "lib/footer.php"; ?>
    </body>
	
	
</html>
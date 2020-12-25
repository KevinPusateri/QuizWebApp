<?php 
//inizia sessione
session_start();

//require_once(); di oggetti e librerie necessarie
require_once("../lib/connection.php");

//Controllo sessione e tipo di account accesso, se credenziali errati porta al login
if(!isset($_SESSION['username'])||$_SESSION['tipoAccount'] != "insegnante"){
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

//chiude connessione DB
$conn->close();
?>

<html>
    <head>
        <!--TITOLO PAGINA-->
        <title>Home Insegnante</title>
		
        <meta charset="utf-8">
		
        <!--LINK AI FILE CSS-->
        <link rel="stylesheet" href="../src/styleProfessor.css"/>
		
        <!--LINK AI FILE JS-->
        <script src='../src/js_innerHtml_ajax.js'></script>
		
		
        <!--JS INTERNO-->
        <script>
            function delQuiz(id){
                
				if(confirm("Sicuro di eliminare ?")){
					getAjax("mainContent/visualQuiz.php", "main", id, "");
				}
            }
        </script>
		
    </head>
	
	
    <body>
        <!--HEADER-->
        <?php require_once("../lib/headerProf.php"); ?>

        <!--CONTENUTI PRINCIPALI-->
        <div id='main' class="mainContent">
		
		

        </div>
        
        <!--FOOTER-->
        <?php //include "lib/footer.php"; ?>
    </body>
	
	
</html>
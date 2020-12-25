<?php 
//inizia sessione
session_start();

//require_once(); di oggetti e librerie necessarie
require_once("../lib/connection.php");

//Controllo sessione e tipo di account accesso, se credenziali errati porta al login
if(!isset($_SESSION['username'])||$_SESSION['tipoAccount'] != "admin"){
    header("Location: ../index.php");
    die();
}

//crea connessione al DB
$conn = Connection::connect();

//ottieni username dell'utente accesso
$username = $_SESSION['username'];

//se viene ricevuto una form(in post)

if(isset($_POST['ruolo'])){
	
		$sql = "SELECT username FROM account WHERE username='".$_POST["username"]."'";
		$result=$conn->query($sql);
		
		if($result->num_rows<1){
		
			$ruolo=$_POST['ruolo'];

			if($ruolo=="insegnante"){
				
				$username=$_POST['username'];
				$nome=$_POST['nome'];
				$cognome=$_POST['cognome'];
				$password=$_POST['password'];
				
					$sql= "INSERT INTO insegnante (username,nome,cognome) 
						VALUES('$username','$nome','$cognome')";
						$conn->query($sql);
					
					$sql= "INSERT INTO account(username, password, tipoAccount) 
						VALUES('$username','$password','insegnante')";
						$conn->query($sql);
			}
			
			else if($ruolo=="studente"){
				
				$username=$_POST['username'];
				$nome=$_POST['nome'];
				$cognome=$_POST['cognome'];
				$password=$_POST['password'];
				$classe = $_POST['nClasse'];
				$sezione = $_POST['sezione'];
			
			
				$classe .= $sezione;
									
					$sql= "INSERT INTO studente(username, nome,cognome, classe) 
							VALUES('$username','$nome','$cognome', '$classe')";
							$conn->query($sql);
						
					$sql= "INSERT INTO account(username, password, tipoAccount) 
						VALUES('$username','$password','studente')";
						$conn->query($sql);
			}
				
		}
		
		else{
			
			echo '
				<script>
				alert("Username scelto già esistente");
				';
				
			if($_POST["ruolo"]=="insegnante") echo 'getAjax("mainContent/addProf.php", "main");';
			else echo 'getAjax("mainContent/addStud.php", "main");';
			
			echo'</script>';
		}
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
        <title>Home Admin</title>
		
        <meta charset="utf-8">
		
        <!--LINK AI FILE CSS-->
        <link rel="stylesheet" href="../src/styleProfessor.css"/>
		
        <!--LINK AI FILE JS-->
        <script src='../src/js_innerHtml_ajax.js'></script>
		
		
        <!--JS INTERNO-->
        <script>
			function checkPsw(){
				if(document.getElementById("psw").value==document.getElementById("psw2").value)return true;
				else{
					alert("Le password non coincidono");
					return false;
				}
			}
        </script>
		
    </head>
	
	
    <body>
        <!--HEADER-->
        <?php require_once("../lib/headerAdmin.php"); ?>

        <!--CONTENUTI PRINCIPALI-->
        <div id='main' class="mainContent">
		
		

        </div>
        
        <!--FOOTER-->
        <?php //include "lib/footer.php"; ?>
    </body>
	
	
</html>
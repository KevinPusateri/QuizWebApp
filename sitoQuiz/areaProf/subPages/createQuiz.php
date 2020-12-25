<?php 
//inizia sessione
session_start();

//require_once(); di oggetti e librerie necessarie
require_once("../../lib/connection.php");

//Controllo sessione e tipo di account accesso, se credenziali errati porta al login
/*if(!isset($_SESSION['username'])||$_SESSION['tipoAccount'] != "insegnante"){
    header("Location: ../../index.php");
    die();
}*/

//crea connessione al DB
$conn = Connection::connect();

//ottieni username dell'utente accesso
$username = $_SESSION['username'];
//echo $_SESSION["tabella"];

//se viene ricevuto una form(in post)
if(isset($_POST)){
    
	$tipo = (isset($_POST["tipo"])) ? $_POST["tipo"] : "";
	$question = (isset($_POST["qst"])) ? $_POST["qst"] : "";
	$punti = (isset($_POST["punti"])) ? $_POST["punti"] : "";
	
	if($tipo=="v-f"){
		$ans = (isset($_POST["ans"])) ? $_POST["ans"] : "";
		
		$sql = "INSERT INTO `".$_SESSION["tabella"]."` (tipoDomanda, testoDomanda, risposte, rispostaCorretta, punti) VALUES ('$tipo','$question','vero*falso','$ans', '$punti')";
		$conn->query($sql);
	}
	
	else if($tipo=="multi"){
		$ans1 = (isset($_POST["ans1"])) ? $_POST["ans1"] : "";
		$ans2 = (isset($_POST["ans2"])) ? $_POST["ans2"] : "";
		$ans3 = (isset($_POST["ans3"])) ? $_POST["ans3"] : "";
		$ans4 = (isset($_POST["ans4"])) ? $_POST["ans4"] : "";
		$rightAns = (isset($_POST["ans"])) ? $_POST["ans"] : "";
		
		switch($rightAns){
			case "1":{
				$rightAns=$ans1;
				break;
			}
			case "2":{
				$rightAns=$ans2;
				break;
			}
			case "3":{
				$rightAns=$ans3;
				break;
			}
			case "4":{
				$rightAns=$ans4;
				break;
			}
		}
		
		$risp = $ans1."*".$ans2."*".$ans3."*".$ans4;
		
		$sql = "INSERT INTO `".$_SESSION["tabella"]."` (tipoDomanda, testoDomanda, risposte, rispostaCorretta, punti) VALUES ('$tipo','$question','$risp','$rightAns', '$punti')";
		$conn->query($sql);
	}

	else if($tipo=="fill"){
		
		$ansX = array();
		$n_ans = (isset($_POST["num_ans"])) ? $_POST["num_ans"] : 0;
		
		$rightAns = array();
		$ans = array();
		
		//ciclo crea vettore campi risposte dal post
		for($i=0; $i<($n_ans)*6; $i++){
			
			$ansX[$i] = $_POST["ans"][$i];
		}
		
		//crea vettore risposte corrette
		for($i=0; $i<$n_ans; $i++){
			$index = ($i+1)."ansR";
			$rightAns[$i] = $_POST[$index];
		}

		//crea vettore con ogni risposta
		$l=0;
		$i=0;
		$sei=6;
		while($i<count($ansX)){
			//echo $i."-".$l."<br/>";
			if($l==$sei){
				$ans[$l]="-";
				$sei+=7;
				$l++;
				$ans[$l]=$ansX[$i];
			}
			else {
				if($ansX[$i]!="")$ans[$l]=$ansX[$i];
				else $ans[$l]=" ";
			}
			$l++;
			$i++;
		}
		
		//crea stringa delle risposte
		$risp="";
		for($i=0; $i<count($ans); $i++){
			
			if($ans[$i]=="-")$risp .= $ans[$i];
			else $risp .= $ans[$i]."*";
		}
		
		//crea stringa risposte corrette
		$k=0;
		for($i=0; $i<count($rightAns); $i++){
			$s=substr($rightAns[$i],1,1);
			
			switch($s){
				case "1":{
					$rightAns[$i]=$ans[0+$k];
					$k+=7;
					break;
				}
				case "2":{
					$rightAns[$i]=$ans[1+$k];
					$k+=7;
					break;
				}
				case "3":{
					$rightAns[$i]=$ans[2+$k];
					$k+=7;
					break;
				}
				case "4":{
					$rightAns[$i]=$ans[3+$k];
					$k+=7;
					break;
				}
				case "5":{
					$rightAns[$i]=$ans[4+$k];
					$k+=7;
					break;
				}
				case "6":{
					$rightAns[$i]=$ans[5+$k];
					$k+=7;
					break;
				}
			}
		}
		
		//echo "ansX->"; print_r($ansX);
		//echo "<br/>ans->"; print_r($ans);
		//echo "<br/>risp->"; print_r($risp);

		
		$rispRight="";
		for($i=0; $i<count($rightAns); $i++){
			$rispRight .= $rightAns[$i]."*";
		}
		
		$sql = "INSERT INTO `".$_SESSION["tabella"]."` (tipoDomanda, testoDomanda, risposte, rispostaCorretta, punti) VALUES ('$tipo','$question','$risp','$rispRight', '$punti')";
		$conn->query($sql);
	}
}

//se vengono ricevuti parametri get
if(isset($_GET)){
	$nome = (isset($_GET["nomeTab"])) ? $_GET["nomeTab"] : "";
	$classe = (isset($_GET["nClasse"])) ? $_GET["nClasse"] : "";
	$sezione = (isset($_GET["sezione"])) ? $_GET["sezione"] : "";
	$materia = (isset($_GET["materia"])) ? $_GET["materia"] : "";
	
	if($nome!="" && $classe!="" && $sezione!="" && $materia!=""){
		$classe .= $sezione;
		date_default_timezone_set("Europe/Rome");	
		$tabName="quiz".date("d/m/Y")."_".date("h:i:sa");
		
		$sql="
			INSERT INTO elencoquiz (id, nome, insegnante, classe, materia) 
			VALUES ('$tabName', '$nome', '$username', '$classe', '$materia')
		";
		$conn->query($sql);
		
		$sql="
			CREATE TABLE `$tabName` (
			id int(255) NOT NULL AUTO_INCREMENT,
			tipoDomanda varchar(30) NOT NULL,
			testoDomanda varchar(255) NOT NULL,
			risposte varchar(255) NOT NULL,
			rispostaCorretta varchar(255) NOT NULL,
			punti float(10) NOT NULL,
			PRIMARY KEY (id)
			)			
		";
		$conn->query($sql);
		
		$_SESSION["tabella"]=$tabName;
	}
	
}

//chiude connessione DB
$conn->close();
?>


<html>
    <head>
        <!--TITOLO PAGINA-->
        <title>Crea Quiz</title>
		
        <meta charset="utf-8">
		
        <!--LINK AI FILE CSS-->
        <link rel="stylesheet" href="../../src/styleProfessor.css"/>
		
        <!--LINK AI FILE JS-->
        <script src='../../src/js_innerHtml_ajax.js'></script>
		
		
        <!--JS INTERNO-->
        <script>
            function goBack() {
                location.href='../homePageProf.php';
            }
			function review() {
                location.href='reviewQuiz.php';
            }
			function checkBtn() {
				
				for(var n=1; n<5; n++) document.getElementById(n).value = document.getElementById("ans"+n).value;
			}
        </script>
		
    </head>
	
	
    <body>

        <!--CONTENUTI PRINCIPALI-->
        <div class="mainContent">
		
		
			<div id="btnQuestions">
			
				<form>
				<div class="contTip">
					<div class="tipologia">
					Scegli tipologia domanda da aggiungere:</br></br>
					<input type="button" class='btn' value="vero/falso" onclick="getAjax('../../questionsType/vero_falso.php', 'question')"/>
					<input type="button" class='btn' value="risposta multipla" onclick="getAjax('../../questionsType/multipla.php', 'question')"/>
					<input type="button" class='btn' value="domanda a riempimento" onclick="getAjax('../../questionsType/riempimento.php', 'question')"/>
					</div>
				</div>	
				</form>
			
			</div>
		
			<div id="question">
				<!--qui andrà la domanda-->
			</div>


        </div>
		
		<!--BOTTONE RITORNO-->
		 <div class="sotto">
			 <button id="btnRev" class="btn" onclick="review()" style="float:right;">Rivedi test completo</button>
         </div>
		 
        <!--FOOTER-->
        <?php //include "lib/footer.php"; ?>
    </body>
	
	
</html>
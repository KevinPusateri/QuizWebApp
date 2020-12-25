<?php

	require_once("../lib/connection.php");
	$conn = Connection::connect(); 	
	session_start();
		
		if(isset($_POST["submit"])){	
			$user=$_POST['username'];
			$pass=$_POST['password'];
			$num="insegnante";
			$num2="studente";
			$num3="admin";
			
			$sql=("SELECT * FROM account WHERE username='$user' && password='$pass'");
			$result=$conn->query($sql);
			if($result->num_rows>0){
	
				$row=$result->fetch_assoc();
				
				$_SESSION["tipoAccount"]=$row["tipoAccount"];
				$_SESSION["username"]=$row["username"];
				$_SESSION["password"]=$row["password"];
				
				switch($row["tipoAccount"]){
					
					case "insegnante":{
						header("refresh:0;url=../areaProf/homePageProf.php");
						break;
					}
					case "studente":{
						header("refresh:0;url=../areaStudente/homePageStudente.php");
						break;
					}
					case "admin":{
						header("refresh:0;url=../manage/homePageAdmin.php");
						break;
					}
					
				}
				die();
			}
			else{
				header("Location:../index.php?msg");
			}
			
		}

?>
<?php
	session_start();

	if(isset($_SESSION["username"])){
		switch($_SESSION["tipoAccount"]){
			case "insegnante":{
				header ("Location: areaProf/homePageProf.php");
				die();
				break;
			}
			case "studente":{
				header ("Location: areaStudente/homePageStudente.php");
				die();
				break;
			}
		}
	}
?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}


/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    position: relative;
	margin: 12%;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 7px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #dedacd;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 30%; /* Could be more or less, depending on screen size */
	height: 70%;
}


/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}
    
@keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}


</style>
	<title>Login</title>
	<link href="login/stylelogin.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
	
<body>

<img class="header__logo" src="images/logo_sito.png" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">
		
	<div id="id01" class="modal">
  
		<form class="modal-content animate">
			<div class="imgcontainer">
		  
			<img src="images/logo_sito.png" >
			</div>

    
		</form>
	</div>
	
	<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
		
	<div class="loginBox">

		<img  class="user" src="images/user.png">
		
		<h3>Accedi qui</h3>
		 	<?php	
		if(isset($_GET['msg']))
			{
				$Message = "<font face='Verdana' size='4' color='black' >Accesso negato riprovare..</font>";
				echo $Message;
			}
			?>
		<form action="login/sessione.php" method="post">
		
			<div class="inputBox">
				<span><i class="fa fa-user" aria-hidden="true"></i></span>
				<input type="text" name="username" placeholder="Username" autocomplete="off" required>
			</div>
			
			<div class="inputBox">
				<span><i class="fa fa-lock" aria-hidden="true"></i></span>
				<input type="password" name="password" placeholder="Password" autocomplete="off" required>
			</div>
				<input type="submit" name="submit" value="Login">
		</form> 
		
	</div>
</body>
</html>
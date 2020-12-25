<?php
echo "

<div class='header clearfix' >
		<img class='header__logo' src='../images/logo_sito2.png'>
		<a href='' class='header__icon-bar'>
			<span></span>
			<span></span>
			<span></span>
		</a>
		<ul class='header__menu animate'>
			<li class='header__menu__item' ><a href='../lib/logout.php' >Logout</a></li>
			<li class='header__menu__item' onclick=".'"'."getAjax('mainContent/newQuiz.php', 'main')".'"'." ><a  href='#' >Crea Quiz</a></li>
			<div class='dropdown'>
			  <button class='dropbtn'>Visualizza</button>
			  <div class='dropdown-content'>
				<a  href='#' onclick=".'"'."getAjax('mainContent/visualQuiz.php', 'main')".'"'.">Quiz Creati</a>
				<a href='stats.php'>Statistiche quiz</a>
			  </div>
			</div>

			
		</ul>
	</div>
	
	";
?>
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
			<div class='dropdown'>
			  <button class='dropbtn'>Aggiungi</button>
			  <div class='dropdown-content'>
				<a  href='#' onclick=".'"'."getAjax('mainContent/addProf.php', 'main')".'"'.">Professore</a>
				<a  href='#' onclick=".'"'."getAjax('mainContent/addStud.php', 'main')".'"'.">Studente</a>
				

			  </div>
			</div>

			
		</ul>
	</div>
	
	";
?>
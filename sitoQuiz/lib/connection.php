<?php

	require_once("common.php");

	class Connection{
	
		static function connect(){
			
			$conndb = new mysqli(Conn::$IPSERVER,Conn::$USER,Conn::$PASSWORD,Conn::$DBNAME);
			return $conndb;
		}
		
	
	}

?>
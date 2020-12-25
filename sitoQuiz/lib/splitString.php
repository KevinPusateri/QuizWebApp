<?php
	function expString($str, $symb){
		$Xvett = array();
		$vett = array();
		
		$Xvett = explode($symb, $str);
		
		$lung=count($Xvett);
		$i=0;
		$j=0;
		while($lung>0){
			if($Xvett[$i]!=""){
				$vett[$j]=$Xvett[$i];
				$j++;
			}
			$i++;
			$lung--;
		}
		return $vett;
	}
?>
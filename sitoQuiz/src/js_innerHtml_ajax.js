
function getAjax(urlPhp, idDiv){
	
	var xhttp = new XMLHttpRequest();
				
		xhttp.onreadystatechange = 
		function(){
			if(this.readyState == 4 && this.status == 200){
				document.getElementById(idDiv).innerHTML = this.responseText;
			}
		};
		
		xhttp.open("GET",
			urlPhp,
			true);
		xhttp.send();
}

function getAjax(urlPhp, idDiv, val, val2){
	
	var xhttp = new XMLHttpRequest();
				
		xhttp.onreadystatechange = 
		function(){
			if(this.readyState == 4 && this.status == 200){
				document.getElementById(idDiv).innerHTML = this.responseText;
			}
		};
		
		xhttp.open("GET",
			urlPhp+"?val="+val+"&val2="+val2+"&idDiv="+idDiv,
			true);
		xhttp.send();
}

function getAjaxAutoComplete(urlPhp, idDiv, str){
	
	var numAns=0;
	//alert(str);
	
	for(var i=0; i<str.length; i++){
		if(str.charAt(i)=='*')numAns++;
	}
		
	var xhttp = new XMLHttpRequest();
	
		xhttp.onreadystatechange = 
		function(){
			if(this.readyState == 4 && this.status == 200){
				document.getElementById(idDiv).innerHTML = this.responseText;
			}
		};
		
		xhttp.open("GET",
			urlPhp+"?num="+numAns,
			true);
		xhttp.send();
	
}
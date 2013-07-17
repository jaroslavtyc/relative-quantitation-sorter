function get_element(id,strict) {

	if(id){
		var element = document.getElementById(id);
	}else if(!strict){//nedostali jsme id objektu, ve kterem chceme hledat prvky tridy a mame povoleno hledat v body
		var element = document.getElementsByTagName('body')[0];//prohledame cely dokument
	}
	
	return element;

}
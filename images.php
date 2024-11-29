<?php

function limpanome($path,$nomecomextensao){
	
	$nomec = pathinfo($path.$nomecomextensao, PATHINFO_FILENAME);
	$ext   = pathinfo($path.$nomecomextensao, PATHINFO_EXTENSION);
	
	$string = iconv( "UTF-8" , "ASCII//TRANSLIT//IGNORE" , $nomec );
	$string = preg_replace( array( '/[ ]/' , '/[^A-Za-z0-9\-]/' ) , array( '' , '' ) , $string );
	
	rename($path.$nomecomextensao, $path.$string.".".$ext);
	
	return $string.".".$ext;
	
}

$path = "themes/cartorio/video_images/";

$files = scandir($path);
$arrayJson = array();
foreach($files as $key=>$f){
	if(($f!='.') && ($f!='..')){		
		$arrayJson[] = limpanome($path,$f);		
	}
}
/*
$arrayJson = array(
 	'escriturapublica.mp4',
	'autenticacao.mp4',    	
	'autorizacaoviagem.mp4',
	'emancipacao.mp4',
);
//codificar para Json (isso será passado para o Javascript)
*/
echo json_encode($arrayJson);

?>
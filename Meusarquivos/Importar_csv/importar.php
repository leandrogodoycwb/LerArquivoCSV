<?php
$conn = new mysqli("localhost", "root", "","csv");
mysqli_set_charset($conn, "utf8");

$arquivo = $_FILES["file"]["tmp_name"];
$nome    = $_FILES["file"]["name"];

$ext = explode(".", $nome);

$extensao = end($ext);

if($extensao != "CSV"){
	echo "Extensão Invalida";
}else{
	$objeto = fopen($arquivo, 'r');

	  while(($dados = fgetcsv($objeto, 1000, ";"))!== FALSE){
	  	$numero_nf  = utf8_decode($dados[0]);
	  	$data       = utf8_decode($dados[1]);
	  	$codigo     = utf8_decode($dados[2]);
	  	$descricao  = utf8_decode($dados[3]);
	  	$valor_unitario = utf8_decode($dados[4]);
	  	$quantidade = utf8_decode($dados[5]);

	 

	  	$result = $conn->query("INSERT INTO produtos (numero_nf, data, codigo, descricao, valor_unitario, quantidade) VALUES ('$numero_nf', '$data','$codigo', '$descricao', '$valor_unitario', '$quantidade')");


	  }

	  if($result){
	  	echo "Dados inseridos com sucesso";
	  }else{
	  	echo "Erro ao inserir dados";
	  }
}



?>

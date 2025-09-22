<?php
require_once "model/cidade.model.php";
require_once "service/cidade.service.php";
require_once "conexao/conexao.php";

@$acaoc = isset($_GET['acaoc']) ? $_GET['acaoc'] : $acaoc;
@$idc = isset($_GET['idc']) ? $_GET['idc'] : $idc;

if ($acaoc == 'inserir') {
	$cidade = new Cidade();
	$cidade->__set('nome', $_POST['nome']);

	$conexao = new Conexao();
	$cidadeService = new CidadeService($cidade, $conexao);
	$cidadeService->inserir();

}

if ($acaoc == 'recuperar') {
	$cidade = new Cidade();
	$conexao = new Conexao();

	$cidadeService = new CidadeService($cidade, $conexao);
	$cidade = $cidadeService->recuperar();
}

if ($acaoc == 'recuperarCidade') {
	$cidade = new Cidade();
	$conexao = new Conexao();

	$cidadeService = new CidadeService($cidade, $conexao);
	$cidade = $cidadeService->recuperarCidade($idc);
}

if ($acaoc == 'excluir') {
	$cidade = new Cidade();
	$conexao = new Conexao();

	$cidade->__set('id', $_POST['idc']);


	$cidadeService = new CidadeService($cidade, $conexao);
	$cidadeService->excluir();
}

if ($acaoc == 'alterar') {
	$cidade = new Cidade();
	$cidade->__set('nome', $_POST['nome']);
	$cidade->__set('id', $_POST['idc']);


	$conexao = new Conexao();
	$cidadeService = new CidadeService($cidade, $conexao);
	$cidadeService->alterar();
	//header('location:index.php');
}

if ($acaoc == 'sair') {
	session_destroy();
	header('location:index.php');
}
?>
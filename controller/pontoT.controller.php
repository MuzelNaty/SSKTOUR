<?php
require_once "model/pontoT.model.php";
require_once "service/pontoT.service.php";
require_once "conexao/conexao.php";

@$acaop = isset($_GET['acaop']) ? $_GET['acaop'] : $acaop;
@$idp = isset($_GET['idp']) ? $_GET['idp'] : $idp;

if ($acaop == 'inserir') {
	$pontoT = new pontoT();
	$pontoT->__set('nome', $_POST['nome']);
	$pontoT->__set('endereco', $_POST['endereco']);
	$pontoT->__set('descricao', $_POST['descricao']);
	
	$conexao = new Conexao();
	$pontoTService = new pontoTService($pontoT, $conexao);
	$pontoTService->inserir();
}

if ($acaop == 'recuperar') {
	$pontoT = new pontoT();
	$conexao = new Conexao();

	$pontoTService = new pontoTService($pontoT, $conexao);
	$pontoT = $pontoTService->recuperar();
}

if ($acaop == 'recuperarpontoT') {
	$pontoT = new pontoT();
	$conexao = new Conexao();

	$pontoTService = new pontoTService($pontoT, $conexao);
	$pontoT = $pontoTService->recuperarpontoT($idp);
}

if ($acaop == 'excluir') {
	$pontoT = new pontoT();
	$conexao = new Conexao();

	$pontoT->__set('id', $_POST['idp']);


	$pontoTService = new pontoTService($pontoT, $conexao);
	$pontoTService->excluir();
}

if ($acaop == 'alterar') {
	$pontoT = new pontoT();
	$pontoT->__set('nome', $_POST['nome']);
	$pontoT->__set('endereco', $_POST['endereco']);
	$pontoT->__set('descricao', $_POST['descricao']);
	$pontoT->__set('id', $_POST['idp']);


	$conexao = new Conexao();
	$pontoTService = new pontoTService($pontoT, $conexao);
	$pontoTService->alterar();
	//header('location:index.php');
}

if ($acaop == 'sair') {
	session_destroy();
	header('location:index.php');
}
?>
<?php
require_once "model/aces.model.php";
require_once "service/aces.service.php";
require_once "conexao/conexao.php";

@$acaoa = isset($_GET['acaoa']) ? $_GET['acaoa'] : $acaoa;
@$ida = isset($_GET['ida']) ? $_GET['ida'] : $ida;

if ($acaoa == 'inserir') {
	$aces = new Aces();
	$aces->__set('tipo', $_POST['tipo']);

	$conexao = new Conexao();
	$acesService = new AcesService($aces, $conexao);
	$acesService->inserir();

}

if ($acaoa == 'recuperar') {
	$aces = new Aces();
	$conexao = new Conexao();

	$acesService = new AcesService($aces, $conexao);
	$aces = $acesService->recuperar();
}

if ($acaoa == 'recuperaraces') {
	$aces = new Aces();
	$conexao = new Conexao();

	$acesService = new AcesService($aces, $conexao);
	$aces = $acesService->recuperaraces($ida);
}

if ($acaoa == 'excluir') {
	$aces = new Aces();
	$conexao = new Conexao();

	$aces->__set('id', $_POST['ida']);
	$acesService = new AcesService($aces, $conexao);
	$acesService->excluir();
}

if ($acaoa == 'alterar') {
	$aces = new Aces();
	$aces->__set('tipo', $_POST['tipo']);
	$aces->__set('id', $_POST['ida']);

	$conexao = new Conexao();
	$acesService = new AcesService($aces, $conexao);
	$acesService->alterar();
	//header('location:index.php');
}

if ($acaoa == 'sair') {
	session_destroy();
	header('location:index.php');
}
?>
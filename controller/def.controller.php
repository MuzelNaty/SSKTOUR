<?php
require_once "model/def.model.php";
require_once "service/def.service.php";
require_once "conexao/conexao.php";

@$acaod = isset($_GET['acaod']) ? $_GET['acaod'] : $acaod;
@$idd = isset($_GET['idd']) ? $_GET['idd'] : $idd;

if ($acaod == 'inserir') {
	$def = new Def();
	$def->__set('tipo', $_POST['tipo']);

	$conexao = new Conexao();
	$defService = new DefService($def, $conexao);
	$defService->inserir();
}

if ($acaod == 'recuperar') {
	$def = new Def();
	$conexao = new Conexao();

	$defService = new DefService($def, $conexao);
	$def = $defService->recuperar();
}

if ($acaod == 'recuperarDef') {
	$def = new Def();
	$conexao = new Conexao();

	$defService = new DefService($def, $conexao);
	$def = $defService->recuperardef($idd);
}

if ($acaod == 'excluir') {
	$def = new Def();
	$conexao = new Conexao();

	$def->__set('id', $_POST['idd']);
	$defService = new DefService($def, $conexao);
	$defService->excluir();
}

if ($acaod == 'alterar') {
	$def = new Def();
	$def->__set('tipo', $_POST['tipo']);
	$def->__set('id', $_POST['idd']);

	$conexao = new Conexao();
	$defService = new DefService($def, $conexao);
	$defService->alterar();
	//header('location:index.php');
}

if ($acaod == 'sair') {
	session_destroy();
	header('location:index.php');
}
?>
<?php
require_once "model/hotel.model.php";
require_once "service/hotel.service.php";
require_once "conexao/conexao.php";

@$acaoh = isset($_GET['acaoh']) ? $_GET['acaoh'] : $acaoh;
@$idh = isset($_GET['idh']) ? $_GET['idh'] : $idh;

if ($acaoh == 'inserir') {
	$hotel = new Hotel();
	$hotel->__set('nome', $_POST['nome']);
	$hotel->__set('endereco', $_POST['endereco']);

	$conexao = new Conexao();
	$hotelService = new HotelService($hotel, $conexao);
	$hotelService->inserir();
}

if ($acaoh == 'recuperar') {
	$hotel = new Hotel();
	$conexao = new Conexao();

	$hotelService = new HotelService($hotel, $conexao);
	$hotel = $hotelService->recuperar();
}

if ($acaoh == 'recuperarHotel') {
	$hotel = new Hotel();
	$conexao = new Conexao();

	$hotelService = new HotelService($hotel, $conexao);
	$hotel = $hotelService->recuperarHotel($idh);
}

if ($acaoh == 'excluir') {
	$hotel = new Hotel();
	$conexao = new Conexao();

	$hotel->__set('id', $_POST['idh']);
	$hotelService = new HotelService($hotel, $conexao);
	$hotelService->excluir();
}

if ($acaoh == 'alterar') {
	$hotel = new Hotel();
	$hotel->__set('nome', $_POST['nome']);
	$hotel->__set('endereco', $_POST['endereco']);
	$hotel->__set('id', $_POST['idh']);

	$conexao = new Conexao();
	$hotelService = new HotelService($hotel, $conexao);
	$hotelService->alterar();
	//header('location:index.php');
}

if ($acaoh == 'sair') {
	session_destroy();
	header('location:index.php');
}
?>
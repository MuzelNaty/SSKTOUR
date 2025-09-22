<?php
require_once "model/hotel.model.php";
require_once "service/hotel.service.php";
require_once "conexao/conexao.php";

@$acaoh = isset($_GET['acaoh']) ? $_GET['acaoh'] : $acaoh;
@$idc = isset($_GET['idc']) ? $_GET['idc'] : $idc;

if ($acaoh == 'inserir') {
	$hotel = new Hotel();
	$hotel->__set('nome', $_POST['nome']);

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
	$hotel = $hotelService->recuperarHotel($idc);
}

if ($acaoh == 'excluir') {
	$hotel = new Hotel();
	$conexao = new Conexao();

	$hotel->__set('id', $_POST['idc']);


	$hotelService = new HotelService($hotel, $conexao);
	$hotelService->excluir();
}

if ($acaoh == 'alterar') {
	$hotel = new Hotel();
	$hotel->__set('nome', $_POST['nome']);
	$hotel->__set('id', $_POST['idc']);


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
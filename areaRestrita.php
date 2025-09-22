<?php 
//if(!isset($_SESSION['usuarioLogado'])){
   // header("location:index.php?link=9");
//}else{
    $acaoc = 'recuperar';
    require_once 'cidade.controller.php';
    require_once 'hotel.controller.php';
    require_once 'pontoT.controller.php';
    require_once 'aces.controller.php';
//}
?>

<table class="table">
    <h1>Cidades</h1>
    <thead>
        <tr>
            <th scope="col">
                Nome
            </th>
            <th scope="col">
            </th>
            <th scope="col"> 
            </th>
        </tr>
    </thead>
    
    <?php foreach($cidade as $key => $cidade){?>
    <tbody>
        <tr>
            <td><?= $cidade->nome?></td>
            <td><a href="forms.cidade.php?metodo=alterar&idc=<?= $cidade->id?>"> Alterar</a></td>
            <td><a href="forms.cidade.php?metodo=excluir&idc=<?= $cidade->id?>"> Excluir</a></td>
        </tr>
    </tbody>
    <?php }?>
</table>


<table class="table">
    <h1>Ponto Turístico</h1>
    <thead>
        <tr>
            <th scope="col">
                Nome
            </th>
            <th scope="col">
                Endereço
            </th>
            <th scope="col">
                Descrição
            </th>
        </tr>
    </thead>
    
    <?php foreach($pontoT as $key => $pontoT){?>
    <tbody>
        <tr>
            <td><?= $pontoT->nome?></td>
            <td><a href="forms.pontoT.php?metodo=alterar&idp=<?= $pontoT->id?>"> Alterar</a></td>
            <td><a href="forms.pontoT.php?metodo=excluir&idp=<?= $pontoT->id?>"> Excluir</a></td>
        </tr>
    </tbody>
    <?php }?>
</table>


<table class="table">
    <h1>Acessibilidade</h1>
    <thead>
        <tr>
            <th scope="col">
                Tipo
            </th>
            <th scope="col">
            </th>
            <th scope="col">
            </th>
        </tr>
    </thead>
    
    <?php foreach($aces as $key => $aces){?>
    <tbody>
        <tr>
            <td><?= $aces->nome?></td>
            <td><a href="forms.aces.php?metodo=alterar&ida=<?= $aces->id?>"> Alterar</a></td>
            <td><a href="forms.aces.php?metodo=excluir&ida=<?= $aces->id?>"> Excluir</a></td>
        </tr>
    </tbody>
    <?php }?>
</table>
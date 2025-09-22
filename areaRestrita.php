<?php 
    $acaoc = 'recuperar';
    require_once 'cidade.controller.php';
    $acaoh = 'recuperar';
    require_once 'hotel.controller.php';
    //$acaop = 'recuperar';
    //require_once 'pontoT.controller.php';
    //$acaoa = 'recuperar';
    //require_once 'aces.controller.php';
    //$acaod = 'recuperar';
    //require_once 'def.controller.php';
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
    <h1>Hotéis</h1>
    <thead>
        <tr>
            <th scope="col">
                Nome
            </th>
            <th scope="col">
                Endereço
            </th>
            <th scope="col"> 
            </th>
        </tr>
    </thead>
    <?php foreach($hotel as $key => $hotel){?>

    <tbody>
        <tr>
            <td><?= $hotel->nome?></td>
            <td><?= $hotel->endereco?></td>
            <td><a href="forms.hotel.php?metodo=alterar&idh=<?= $hotel->id?>"> Alterar</a></td>
            <td><a href="forms.hotel.php?metodo=excluir&idh=<?= $hotel->id?>"> Excluir</a></td>
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
            <td><?= $pontoT->endereco?></td>
            <td><?= $pontoT->descricao?></td>
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
            <td><?= $aces->tipo?></td>
            <td><a href="forms.aces.php?metodo=alterar&ida=<?= $aces->id?>"> Alterar</a></td>
            <td><a href="forms.aces.php?metodo=excluir&ida=<?= $aces->id?>"> Excluir</a></td>
        </tr>
    </tbody>
    <?php }?>
</table>


<table class="table">
    <h1>Deficiência</h1>
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
    <?php foreach($def as $key => $def){?>

    <tbody>
        <tr>
            <td><?= $def->tipo?></td>
            <td><a href="forms.def.php?metodo=alterar&idd=<?= $def->id?>"> Alterar</a></td>
            <td><a href="forms.def.php?metodo=excluir&idd=<?= $def->id?>"> Excluir</a></td>
        </tr>
    </tbody>
    <?php }?>
</table>
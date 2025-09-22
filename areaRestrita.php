<?php 
//if(!isset($_SESSION['usuarioLogado'])){
   // header("location:index.php?link=9");
//}else{
    $acaoc = 'recuperar';
    require_once 'cidade.controller.php';
   
//}
  


?>

<table class="table">
    <h1>Cidades </h1>
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
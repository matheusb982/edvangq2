<?php include("cabecalho.php");?>
  <?php include("conexao.php");?>

  <?php

  $cep =  isset($_GET["cep"]) ? $_GET["cep"] : '';
  $logradouro = isset($_GET["logradouro"]) ? $_GET["logradouro"] : '';
  $numero = isset($_GET["numero"]) ? $_GET["numero"] : '';
  $complemento = isset($_GET["complemento"]) ? $_GET["complemento"] : '';
  $bairro = isset($_GET["bairro"]) ? $_GET["bairro"] : '';
  $cidade = isset($_GET["cidade"]) ? $_GET["cidade"] : '';
  $estado = isset($_GET["estado"]) ? $_GET["estado"] : '';


  $conexao = pg_connect($dados_conexao); 

  $comandoSQL = "INSERT INTO endereco(logradouro, numero, complemento, bairro, cidade, estado, cep)".
        "VALUES ('".$logradouro."', ".$numero.", '".$complemento."', '".$bairro."', '".$cidade."', '".$estado."', '".$cep."')";


  $resultado = pg_query($conexao, $comandoSQL);


  if (!$resultado) {
    echo "Erro: " . "<a href='cadastro01.php?cep=" . $cep . "'</a>" . "Voltar";
  }

  pg_close($conexao);

  $conexao = pg_connect($dados_conexao);  

  $resultado = pg_query($conexao, "select * from endereco");

  $arr_resultado = pg_fetch_all($resultado);  

  ?>

  <div class="container">

  <?php echo "<h3>Endereços</h3>"; ?>

  <form name="form1" method="GET" action="cadastro01.php">
    <input type="submit" name="submit" value="Cadastrar" class="waves-effect waves-light btn">
  </form>

  <table class="table-responsive" align="center">
    <br/>
            <tr align="center">
                <th>Cep</th>
                <th>Logradouro</th>
                <th>Cidade/Estado</th>
            </tr>
            <?php foreach($arr_resultado as $l){?>
              <tr align="center">
                  <td><?=$l['cep']?></td>
                  <td><?= $l['logradouro']?></td>                
                  <td><?= $l['cidade']?>/<?= $l['estado']?></td>
              </tr>
            <?php } ?>
  </table>
  </div>

  <?php include("rodape.php");?>
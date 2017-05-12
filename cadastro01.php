  <?php include("cabecalho.php");?>
  
 <?php 
 $logradouro_ =  isset($_GET["logradouro"]) ? $_GET["logradouro"] : '';

 $form_page = isset($logradouro_) && !empty(trim($logradouro_)) ? "cadastrar01.php" : "cadastro01.php";

$cep_ =  isset($_GET["cep"]) ? $_GET["cep"] : '';
 if (!empty($cep_)) {
  $url = "http://api.postmon.com.br/v1/cep/".$cep_;
  $conteudo = file_get_contents($url);

  $json_str = json_decode($conteudo);

  $logradouro = $json_str->logradouro;
  $bairro = $json_str->bairro;
  $estado = $json_str->estado;
  $cidade = $json_str->cidade;

  $cep = $cep_;

  $numero =  isset($_GET["numero"]) ? $_GET["numero"] : '';
  $complemento =  isset($_GET["complemento"]) ? $_GET["complemento"] : '';

  $form_page =  "cadastrar01.php";
 }


 ?>

  <form name="form1" method="GET" action="<?=$form_page?>">

    <table>

      <tr>
          <td>
            <label for="cep">CEP</label>
            <input type="text" name="cep" id="cep" placeholder="Informe o CEP:" value="<?=isset($cep) ? $cep : ''?>" autofocus>
          </td>
      </tr>
                  
      <tr>
          <td>
            <label for="logradouro">Logradouro</label>
            <input type="text" name="logradouro" id="logradouro" value="<?=isset($logradouro) ? $logradouro : ''?>">
          </td>
      </tr>

      <tr>
          <td>
            <label for="numero">Número</label>
            <input type="text" name="numero" id="numero" placeholder="Informe o número:" value="<?=isset($numero) ? $numero : ''?>" >
          </td>
      </tr>

      <tr>
          <td>
            <label for="complemento">Complemento</label>
            <input type="text" name="complemento" id="complemento" placeholder="Informe o complemento:" value="<?=isset($complemento) ? $complemento : ''?>">
          </td>
      </tr>

      <tr>
          <td>
            <label for="bairro">Bairro</label>
            <input type="text" name="bairro" id="bairro" value="<?=isset($bairro) ? $bairro : '' ?>">
          </td>
      </tr>

      <tr>
          <td>
            <label for="cidade">Cidade</label>
            <input type="text" name="cidade" id="cidade" value="<?=isset($cidade) ? $cidade : '' ?>">
          </td>
      </tr>

      <tr>
          <td>
            <label for="estado">Estado</label>
            <input type="text" name="estado" id="estado" value="<?=isset($estado) ? $estado : ''?>" >
          </td>
      </tr>

    </table>

    <input type="submit" name="submit" value="Cadastrar">
  </form>

   <?php include("rodape.php");?>
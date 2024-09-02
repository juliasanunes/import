<?php
include_once "conexao.php";

$arquivo = $_FILES['arquivo'];
//var_dump($arquivo);

$linhas_importadas= 0;
$linhas_nao_importadas = 0;


if ($arquivo['type'] == "text/csv") {

  $dados_arquivo = fopen($arquivo['tmp_name'], "r");

  while ($linha = fgetcsv($dados_arquivo, 1000, ";")) {
    array_walk_recursive($linha, 'converter');
    //var_dump($linha);
   $query_FROTAS_CONSUMO = " INSERT INTO FROTAS_CONSUMO (DATA, KMINICIAL, KMFINAL, KMRODADOS, LITROS, CUSTOTOTAL, CUSTOLITRO, KMLITRO, CUSTOKM,PLACA) 
      VALUES(:DATA, :KMINICIAL, :KMFINAL, :KMRODADOS, :LITROS, :CUSTOTOTAL, :CUSTOLITRO, :KMLITRO, :CUSTOKM,:PLACA) ";

   $cad_CONSUME = $conn->prepare($query_FROTAS_CONSUMO); 

   $cad_CONSUME->bindValue(':DATA', ($linha[1] ?? "NULL"));
   $cad_CONSUME->bindValue(':KMINICIAL', ($linha[2] ?? "NULL"));
   $cad_CONSUME->bindValue(':KMFINAL', ($linha[3] ?? "NULL"));
   $cad_CONSUME->bindValue(':KMRODADOS', ($linha[4] ?? "NULL"));
   $cad_CONSUME->bindValue(':LITROS', ($linha[5] ?? "NULL"));
   $cad_CONSUME->bindValue(':CUSTOTOTAL', ($linha[6] ?? "NULL"));
   $cad_CONSUME->bindValue(':CUSTOLITRO', ($linha[7] ?? "NULL"));
   $cad_CONSUME->bindValue(':KMLITRO', ($linha[8] ?? "NULL"));
   $cad_CONSUME->bindValue(':CUSTOKM', ($linha[9] ?? "NULL"));
   $cad_CONSUME->bindValue(':PLACA', ($linha[10] ?? "NULL"));

   $cad_CONSUME->execute();

   if($cad_CONSUME->rowCount()){
      $linhas_importadas++;
      
   }else {
      $linhas_nao_importadas++;
      
   }

  }

  echo "$linhas_importadas linha(s) importada(s), $linhas_nao_importadas, linha(s) não importada(s) ";

} else {
  echo "Seu arquivo precisa ser do tipo csv!"; 
}

function converter(&$dados_arquivo) {
  $dados_arquivo = mb_convert_encoding($dados_arquivo, "UTF-8", "ISO-8859-1");
}

?>


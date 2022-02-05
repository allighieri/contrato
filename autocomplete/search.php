<?php
 include_once("../database/Database.class.php");

 $database = new Database();

 $idReceita = $_GET['id'];

 $sql = "SELECT * FROM cnt_receita_descricao WHERE id_receita = '".$idReceita."'";
 $resultado = $database->conexao->query($sql);

 $numero_de_linhas = $resultado->rowCount();

 if ($numero_de_linhas > 0){

  for ($i = 0; $i <$numero_de_linhas; $i++) {

   $linha_descricao = $resultado->fetch(PDO::FETCH_ASSOC);

   $dadosReceitaDescricao[$i] = array(
    'numero_de_linhas' => $numero_de_linhas,
    'id_descricao' => $linha_descricao['id_descricao'],
    'decricao' => $linha_descricao['descricao'],
    'complemento' => $linha_descricao['complemento'],
    'valor_unitario' => $linha_descricao['valor_unitario'],
    'todos_meses' => $linha_descricao['todos_meses'],
    'numero_de_meses' => $linha_descricao['numero_de_meses']
  );
 }
}

echo json_encode($dadosReceitaDescricao);
?>

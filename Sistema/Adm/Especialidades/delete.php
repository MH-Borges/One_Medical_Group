<?php

require_once("../../configs/conexao.php"); 

$id = $_POST['id_espec_delete'];

$res = $pdo->query("SELECT * FROM especialidade where id = '$id'"); 
$dados = $res->fetchAll(PDO::FETCH_ASSOC);

$nome_espec = $dados[0]['nome'];
$foto_espec = $dados[0]['foto'];

$res2 = $pdo->query("SELECT * FROM medicos where especialidade = '$nome_espec'"); 
$dados2 = $res2->fetchAll(PDO::FETCH_ASSOC);
if(@count($dados2) != 0){
    echo 'Existe um medico(a) atrelado(a) a esta especialidade, remova esta especialidade de todos os medicos antes de exclui-lá';
    exit();
}

$res3 = $pdo->query("SELECT * FROM tratamentos where especialidade_atr = '$nome_espec'"); 
$dados3 = $res3->fetchAll(PDO::FETCH_ASSOC);
if(@count($dados3) != 0){
    echo 'Existe um tratamento atrelado(a) a esta especialidade, remova esta especialidade de todos os tratamentos antes de exclui-lá';
    exit();
}

$res4 = $pdo->query("SELECT * FROM blog where tag_especialidade = '$nome_espec'"); 
$dados4 = $res4->fetchAll(PDO::FETCH_ASSOC);
if(@count($dados4) != 0){
    echo 'Existe postagens do blog com especialidade trelada, remova esta especialidade de todas as postagens antes de exclui-lá';
    exit();
}

$caminho_arquivo = '../../../assets/especialidades/'.$foto_espec;
if(file_exists($caminho_arquivo) && $foto_espec !== "placeholder.webp"){
    unlink($caminho_arquivo);
}

$pdo->query("DELETE from especialidade WHERE id = '$id'");
echo 'Excluído com Sucesso!!';

?>
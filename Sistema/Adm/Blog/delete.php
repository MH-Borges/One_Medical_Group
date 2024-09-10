<?php

require_once("../../configs/conexao.php"); 

$id = $_POST['id_Post_Delete'];

$res = $pdo->query("SELECT * FROM blog where id = '$id'"); 
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$banner_post = $dados[0]['banner'];


$caminho_arquivo = '../../../assets/blog/'.$banner_post;
if(file_exists($caminho_arquivo) && $banner_post !== "banner_placeholder.webp"){
    unlink($caminho_arquivo);
}

$pdo->query("DELETE from blog WHERE id = '$id'");
echo 'Excluído com Sucesso!!';

?>
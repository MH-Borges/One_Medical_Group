<?php

require_once("../../configs/conexao.php"); 
$id = $_POST['id_medico_delete'];

$res = $pdo->query("SELECT * FROM medicos WHERE id = '$id' LIMIT 1"); 
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
if(@count($dados) > 0){
    $nome = $dados[0]['nome'];
    $nome_novo = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($nome)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
    $nome_tratado = preg_replace('/[ -]+/', '_', $nome_novo);
    $diretorio = '../../../assets/medicos/'.$nome_tratado.'';
}

function deletar($pasta){ 
  $iterator     = new RecursiveDirectoryIterator($pasta,FilesystemIterator::SKIP_DOTS);
  $rec_iterator = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST);

  foreach($rec_iterator as $file){ 
    $file->isFile() ? unlink($file->getPathname()) : rmdir($file->getPathname()); 
  } 
  rmdir($pasta); 
}

if(is_dir($diretorio) == "true"){
    deletar($diretorio);
}

$pdo->query("DELETE from medicos WHERE id = '$id'");
echo 'Excluído com Sucesso!!';

?>
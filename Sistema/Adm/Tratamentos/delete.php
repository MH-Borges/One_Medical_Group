<?php

require_once("../../configs/conexao.php"); 
$id = $_POST['id_tratamento_delete'];

$res = $pdo->query("SELECT * FROM tratamentos WHERE id = '$id' LIMIT 1"); 
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
if(@count($dados) > 0){
    $titulo = $dados[0]['titulo'];
    if($titulo != ""){
      $titulo_novo = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($titulo)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
      $titulo_tratado = preg_replace('/[ -]+/', '_', $titulo_novo);
      $diretorio = '../../../assets/tratamentos/'.$titulo_tratado.'';
    }
    else{
      $diretorio = 'false';
    }
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

$pdo->query("DELETE from tratamentos WHERE id = '$id'");
echo 'Excluído com Sucesso!!';

?>
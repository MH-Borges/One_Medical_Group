<?php
require_once("../configs/conexao.php"); 

$emailAntigo = $_POST['antigoEmail'];
$novoEmail = filter_var($_POST['novoEmail'], FILTER_SANITIZE_EMAIL);
$confirmaNovoEmail = filter_var($_POST['confirmaNovoEmail'], FILTER_SANITIZE_EMAIL);

$idUser = $_POST['idUserEmail'];
$emailUserSemAlteracoes = $_POST['emailUserSemAlteracoes'];

$novoEmail = strtolower($novoEmail);
$confirmaNovoEmail = strtolower($confirmaNovoEmail);

if($emailAntigo == ""){
    echo 'Por-favor preencha o campo de e-mail antigo!';
    exit();
}

if($novoEmail == ""){
    echo 'Por-favor preencha o campo de novo e-mail!';
    exit();
}

if($confirmaNovoEmail == ""){
    echo 'Por-favor preencha o campo de confirma novo e-mail!';
    exit();
}

if($emailAntigo != $emailUserSemAlteracoes){
    echo 'E-mail antigo não coicide com nenhum e-mail cadastrado no banco de dados!';
    exit();
}

if($novoEmail != $confirmaNovoEmail){
    echo 'Novo e-mail e confirmação de novo e-mail não coicidem!';
    exit();
}

if($novoEmail == $emailUserSemAlteracoes){
    echo 'Novo e-mail é identico a e-mail já cadastrada!';
    exit();
}

$res2 = $pdo->query("SELECT * FROM medicos where nivel = 'adm'"); 
$dados2 = $res2->fetchAll(PDO::FETCH_ASSOC);
$email_adm = $dados2[0]['email'];

if($novoEmail === $email_adm){
    echo 'E-mail do perfil administrativo não pode ser utilizado! Por riscos de gerar conflitos no banco de dados.';
    exit();
}

$res = $pdo->prepare("UPDATE medicos SET email = :email WHERE id = :id");

$res->bindValue(":email", $novoEmail);
$res->bindValue(":id", $idUser);

$res->execute();


echo 'E-mail alterado com Sucesso!';

?>
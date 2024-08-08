<?php
    $nome = addslashes($_POST['nome']);
    $email = filter_var(addslashes($_POST['email']), FILTER_SANITIZE_EMAIL);
    $telefone = addslashes($_POST['telefone']);
    $mensagem = addslashes($_POST['mensagem']);
    $checkbox = @$_POST['termosPrivacidade'];

    if($nome == ""){
        echo "Preencha o campo de 'Nome completo'";
        exit();
    }
    if($email == ""){
        echo "Preencha o campo de E-mail";
        exit();
    }
    if($mensagem == ""){
        echo "O campo de mensagem está vazio!";
        exit();
    }

    if($checkbox != 'on'){
        echo "Para continuar, é necessario aceitar os termos de privacidade!";
        exit();
    }

    $to = "contato@onemedicalgroup.com.br";
    $subject = "Contato formulario do site - Paciente: ($nome)";
    $body = utf8_decode(
        'Nome: ' .$nome. "\r\n"."\r\n".
        'Email: ' .$email. "\r\n"."\r\n".
        'Telefone: '.$telefone. "\r\n"."\r\n".
        'Mensagem:'. "\r\n"."\r\n". $mensagem
    );

    $header = 'From:contato@onemedicalgroup.com.br'."\r\n"."Reply-To:".$email;

    if(mail($to,$subject,$body,$header)){
        echo ("Mensagem enviada com sucesso! Entraremos em contato em breve!");
    }

?>
<?php
    @session_start();
    require_once("../../configs/conexao.php"); 

    $email = filter_var($_POST['email_Medico'], FILTER_SANITIZE_EMAIL);
    $senha_temp = $_POST['senha_Temp'];

    $senha_crip = md5($senha_temp);
    $email = strtolower($email);

    // ===== VERIFICAÇÃO DE INPUTS VAZIOS + VERIFICAÇÃO DE POSSIVEIS ERROS =====
    if($email == ""){
        echo 'Preencha o campo de email';
        exit();
    }
    if($senha_temp == ""){
        echo 'Preencha o campo de senha temporaria!';
        exit();
    }
   
    $status = 'inativo';
    $nivel = 'med';
    $date_criacao = date('Y/m/d H:i:s');

    // ===== INSERÇÃO DE DADOS NO BANCO =====
    $res = $pdo->query("SELECT * FROM medicos where email = '$email'"); 
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);

    if(@count($dados) == 0){
        $res = $pdo->prepare("INSERT INTO medicos (status_perfil, nivel, email, senha_crip, senha_temp, data_registro) VALUES (:status_perfil, :nivel, :email, :senha_crip, :senha_temp, :data_registro)");
        $res->bindValue(":status_perfil", $status);
        $res->bindValue(":nivel", $nivel);
        $res->bindValue(":email", $email);
        $res->bindValue(":senha_crip", $senha_crip);
        $res->bindValue(":senha_temp", $senha_temp);
        $res->bindValue(":data_registro", $date_criacao);
        $res->execute();

        $link = "https://www.onemedicalgroup.com.br/Sistema/";

        //ENVIAR O EMAIL DE ACESSO
        $destinatario = $email;
        $assunto = 'One Medical Group - Seja bem vindo(a)!';
        $mensagem = utf8_decode("
                                Seja Bem vindo a equipe One Medical Group!
                                
                                Por favor acesse o seu perfil e preencha suas informações! 
                                
                                IMPORTANTE!!
                                Apenas após o preenchimento das informações do seu perfil ele se tornará ativo.
                                
                                

                                O Link para acesso do seu perfil é: $link
                                
                                O email para acesso é: ".$email."
                                A senha temporaria de acesso é: ".$senha_temp."");
        $cabecalhos = "From: ".$email;
        
        if(mail($destinatario, $assunto, $mensagem, $cabecalhos)){
            echo 'Perfil de medico(a) criado com Sucesso!!';
        }
    }
    else{
        echo 'E-mail ja cadastrado no banco de dados!!';
    }
?>
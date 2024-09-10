<?php
    @session_start();
    require_once("../../configs/conexao.php"); 

    $id_Postagem = $_POST['id_post_edit'];
    $data_criacao = $_POST['data_criacao'];

    $banner_edit = $_POST['banner_edit'];
    @$Banner_Input_default = $_POST["Banner_Input_default"];

    $especialidade = $_POST['especialidade'];

    $titulo = $_POST['titulo'];
    $resumo = $_POST['resumo'];
    
    $titulo_h2 = $_POST['h2'];
    $titulo_h3 = $_POST['h3'];
    $titulo_h4 = $_POST['h4'];
    $titulo_h5 = $_POST['h5'];
    $titulo_h6 = $_POST['h6'];

    $text_h2 = $_POST['text_h2'];
    $text_h3 = $_POST['text_h3'];
    $text_h4 = $_POST['text_h4'];
    $text_h5 = $_POST['text_h5'];
    $text_h6 = $_POST['text_h6'];

    $seo = $_POST['seo'];

    // ===== VERIFICAÇÃO DE INPUTS VAZIOS + VERIFICAÇÃO DE POSSIVEIS ERROS =====
    if($data_criacao !== ""){
        $data_criacao = $data_criacao;
    }
    if($data_criacao === ""){
        $data_criacao = date('d/m/Y');
    }
    if($titulo == ""){
        echo 'Preencha o campo de titulo';
        exit();
    }
    if($titulo != ""){
        $res = $pdo->query("SELECT * FROM blog where id != '$id_Postagem'"); 
        $dados = $res->fetchAll(PDO::FETCH_ASSOC);
        for ($i=0; $i < count($dados); $i++) { 
            $titulos = $dados[$i]['titulo_princ'];
            if($titulos === $titulo){
                echo 'O titulo é identico a outra postagem já postada!';
                exit();
            }
        }
    }
    if($especialidade == "" || $especialidade == 'null'){
        echo 'Selecione uma especialidade para continuar!';
        exit();
    }
    if($resumo == ""){
        echo 'Preencha o campo de resumo com um resumo simples';
        exit();
    }
    if($resumo !== ""){
        $resumo = nl2br(htmlentities($resumo, ENT_QUOTES, 'UTF-8'));
    }
    if($text_h2 !== ""){
        $text_h2 = nl2br(htmlentities($text_h2, ENT_QUOTES, 'UTF-8'));
    }
    if($text_h3 !== ""){
        $text_h3 = nl2br(htmlentities($text_h3, ENT_QUOTES, 'UTF-8'));
    }
    if($text_h4 !== ""){
        $text_h4 = nl2br(htmlentities($text_h4, ENT_QUOTES, 'UTF-8'));
    }
    if($text_h5 !== ""){
        $text_h5 = nl2br(htmlentities($text_h5, ENT_QUOTES, 'UTF-8'));
    }
    if($text_h6 !== ""){
        $text_h6 = nl2br(htmlentities($text_h6, ENT_QUOTES, 'UTF-8'));
    }
    if($seo == ""){
        echo 'Adicione pelo menos uma palavra chave!';
        exit();
    }

    //VALIDAÇÃO DE CARACTERES IMPROPRIOS NO TITULO
    $caracteresProibidos = ['_', '{', '}', '|', '\\', '^', '[', ']', '`', ';', '/', '?', ':', '@', '&', '=', '+', '$', ','];
    foreach ($caracteresProibidos as $caractere) {
        if (str_contains($titulo, $caractere)) {
            echo "O caractere '$caractere' não pode ser utilizado";
            exit();
        }
    }

    // ===== SCRIPTS PARA SUBIR IMGS E VIDEO PARA O BANCO =====
    function uploadImage($inputName, $targetDir, $titulo) {
        $uploadedFile = @$_FILES[$inputName];
        $imageName = preg_replace('/[ -]+/' , '-' , $uploadedFile['name']);
        $imageName = preg_replace('/_/' , '-' , $uploadedFile['name']);
        $imageName = $titulo." ".$uploadedFile['name'];
        $targetPath = $targetDir . $imageName;

        $imageTemp = $uploadedFile['tmp_name'];
        $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
        $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp'];

        if (in_array($imageExt, $allowedExtensions)) {
            move_uploaded_file($imageTemp, $targetPath);
            return $imageName;
        } else {
            echo "Extensão da imagem não permitida!";
            exit();
        }
    }

    // Diretórios e imagens padrão
    $diretorio_User = '../../../assets/blog/';

    if($_FILES['Banner_Input']['name'] == ""){
        if($Banner_Input_default == "true"){
            $banner = 'banner_placeholder.webp';
        }
        else{
            if($banner_edit != ""){
                $banner = $banner_edit;
            }
            if($banner_edit == ""){
                $banner = 'banner_placeholder.webp';
            }
        }
    }
    else{
        if($_FILES['Banner_Input']['name'] == $banner_edit){
            $banner = $banner_edit;
        }
        else{
            $banner = uploadImage('Banner_Input', $diretorio_User, $titulo);
        }
    }

    // ===== INSERÇÃO DE DADOS NO BANCO =====
    if($id_Postagem == ""){
        $res = $pdo->prepare("INSERT INTO blog (banner, tag_especialidade, data_criacao, titulo_princ, resumo, titulo_h2, titulo_h3, titulo_h4, titulo_h5, titulo_h6, text_h2, text_h3, text_h4, text_h5, text_h6, seo) VALUES (:banner, :tag_especialidade, :data_criacao, :titulo_princ, :resumo, :titulo_h2, :titulo_h3, :titulo_h4, :titulo_h5, :titulo_h6, :text_h2, :text_h3, :text_h4, :text_h5, :text_h6, :seo)");
    }
    else{
        $res = $pdo->prepare("UPDATE blog SET banner = :banner, tag_especialidade = :tag_especialidade, data_criacao = :data_criacao, titulo_princ = :titulo_princ, resumo = :resumo, titulo_h2 = :titulo_h2, titulo_h3 = :titulo_h3, titulo_h4 = :titulo_h4, titulo_h5 = :titulo_h5, titulo_h6 = :titulo_h6, text_h2 = :text_h2, text_h3 = :text_h3, text_h4 = :text_h4, text_h5 = :text_h5, text_h6 = :text_h6, seo = :seo WHERE id = :id");
        $res->bindValue(":id", $id_Postagem);
    }

    $res->bindValue(":banner", $banner);
    $res->bindValue(":tag_especialidade", $especialidade);
    $res->bindValue(":data_criacao", $data_criacao);

    $res->bindValue(":titulo_princ", $titulo);
    $res->bindValue(":resumo", $resumo);

    $res->bindValue(":titulo_h2", $titulo_h2);
    $res->bindValue(":titulo_h3", $titulo_h3);
    $res->bindValue(":titulo_h4", $titulo_h4);
    $res->bindValue(":titulo_h5", $titulo_h5);
    $res->bindValue(":titulo_h6", $titulo_h6);
    $res->bindValue(":text_h2", $text_h2);
    $res->bindValue(":text_h3", $text_h3);
    $res->bindValue(":text_h4", $text_h4);
    $res->bindValue(":text_h5", $text_h5);
    $res->bindValue(":text_h6", $text_h6);

    $res->bindValue(":seo", $seo);

    if ($res->execute()) {
        if($id_Postagem == ""){
            echo 'Postagem criada com Sucesso!!';
        }
        else{
            echo 'Postagem atualizada com Sucesso!!';
        }
    } else {
        echo 'Erro: Tente novamente!';
    }
?>
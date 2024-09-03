<?php
    @session_start();
    require_once("../../configs/conexao.php"); 

    $id_espec_edit = $_POST['id_espec_edit'];
    $nome_espec_edit = $_POST['nome_espec_edit'];
    $nome_espec = $_POST['nome_espec'];
    $descri_Espec = $_POST["descri_Espec"];

    $img_espec_edit = $_POST["img_espec_edit"];
    @$foto_espec_Input_default = $_POST["foto_espec_Input_default"];

    // ===== VERIFICAÇÃO DE INPUTS VAZIOS + VERIFICAÇÃO DE POSSIVEIS ERROS =====
    if($id_espec_edit == ""){
        $res = $pdo->query("SELECT * FROM especialidade where nome = '$nome_espec'"); 
        $dados = $res->fetchAll(PDO::FETCH_ASSOC);
        if(@count($dados) != 0){
            echo 'Especialidade já cadastrada no Banco de dados!';
            exit();
        }
    }
    if($id_espec_edit != ""){
        $res = $pdo->query("SELECT * FROM especialidade where id != '$id_espec_edit'"); 
        $dados = $res->fetchAll(PDO::FETCH_ASSOC);
        for ($i=0; $i < count($dados); $i++) { 
            $nomes_especs = $dados[$i]['nome'];

            if($nome_espec === $nomes_especs){
                echo 'Nome de especialidade já utilizado!';
                exit();
            }
        }
    }
    if($nome_espec == ""){
        echo 'Preencha o campo de nome da Especialidade!';
        exit();
    }
    $caracteresProibidos = ['_', '{', '}', '|', '\\', '^', '[', ']', '`', ';', '/', '?', ':', '@', '&', '=', '+', '$', ','];
    foreach ($caracteresProibidos as $caractere) {
        if (str_contains($nome_espec, $caractere)) {
            echo "O caractere '$caractere' não pode ser utilizado";
            exit();
        }
    }
    if($descri_Espec == ""){
        echo 'Preencha o campo de descrição!';
        exit();
    }
    if($descri_Espec !== ""){
        $descri_Espec = nl2br(htmlentities($descri_Espec, ENT_QUOTES, 'UTF-8'));
    }

    // ===== SCRIPTS PARA SUBIR IMG PARA O BANCO =====
    function uploadImage($inputName, $targetDir) {
        $uploadedFile = @$_FILES[$inputName];
        $imageName = preg_replace('/[ -]+/' , '-' , $uploadedFile['name']);
        $imageName = preg_replace('/_/' , '-' , $uploadedFile['name']);
        $targetPath = $targetDir . $imageName;

        $imageTemp = $uploadedFile['tmp_name'];
        $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
        $allowedExtensions = ['png', 'webp', 'jpg', 'jpeg'];

        if (in_array($imageExt, $allowedExtensions)) {
            move_uploaded_file($imageTemp, $targetPath);
            return $imageName;
        } else {
            echo "Extensão da imagem não permitida!";
            exit();
        }
    }
    
    if($_FILES['foto_espec_Input']['name'] == ""){
        if($foto_espec_Input_default == "true"){
            $img_espec = 'placeholder.webp';
        }
        else{
            if($img_espec_edit != ""){
                $img_espec = $img_espec_edit;
            }
        }
    }
    else{
        if($_FILES['foto_espec_Input']['name'] == $img_espec_edit){
            $img_espec = $img_espec_edit;
        }
        else{
            // Diretórios e imagens padrão
            $img_espec_Diret = '../../../assets/especialidades/';
            $img_espec = uploadImage('foto_espec_Input', $img_espec_Diret);
        }
    }

    // ===== INSERÇÃO DE DADOS NO BANCO =====
    if($nome_espec != $nome_espec_edit && $nome_espec_edit != ""){
        $query = $pdo->query("SELECT * FROM medicos WHERE especialidade = '$nome_espec_edit'");
        $dados = $query->fetchAll(PDO::FETCH_ASSOC);

        for ($i=0; $i < count($dados); $i++) { 
            $id_espec_Atrelada_medico = $dados[$i]['id'];

            $res2 = $pdo->prepare("UPDATE medicos SET especialidade = :especialidade WHERE id = :id");
            $res2->bindValue(":especialidade", $nome_espec);
            $res2->bindValue(":id", $id_espec_Atrelada_medico);
            $res2->execute();
        }
    }
    if($id_espec_edit == ""){
        $res = $pdo->prepare("INSERT INTO especialidade (nome, foto, descricao) VALUES (:nome, :foto, :descricao)");
        $res->bindValue(":foto", $img_espec);
    }
    else{
        $res = $pdo->prepare("UPDATE especialidade SET foto = :foto, nome = :nome, descricao = :descricao WHERE id = :id");
        $res->bindValue(":foto", $img_espec);
        $res->bindValue(":id", $id_espec_edit);
    }

    $res->bindValue(":nome", $nome_espec);
    $res->bindValue(":descricao", $descri_Espec);
    $res->execute();

    if($id_espec_edit == ""){
        echo 'Especialidade adicionada com Sucesso!!';
    }
    else{
        echo 'Especialidade Atualizada com Sucesso!!';
    }
?>
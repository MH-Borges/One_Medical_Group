<?php
    @session_start();
    require_once("../../configs/conexao.php"); 

    $id_Tratamento = $_POST['id_trat_edit'];

    $titulo = $_POST['titulo'];
    $titulo_antigo = $_POST['titulo_trat_edit'];

    $especialidade = $_POST['especialidade'];
    $desc = $_POST['desc'];
    $etapas = $_POST['etapas'];

    $card_edit = $_POST['card_edit'];
    $banner_edit = $_POST['banner_edit'];

    $foto01_edit = $_POST['foto01_edit'];
    $foto02_edit = $_POST['foto02_edit'];
    $foto03_edit = $_POST['foto03_edit'];
    $foto04_edit = $_POST['foto04_edit'];

    $video01_edit = $_POST['video01_edit'];
    $video02_edit = $_POST['video02_edit'];

    @$Card_Input_default = $_POST["Card_Input_default"];
    @$Banner_Input_default = $_POST["Banner_Input_default"];

    @$foto01_Input_default = $_POST["foto01_Input_default"];
    @$foto02_Input_default = $_POST["foto02_Input_default"];
    @$foto03_Input_default = $_POST["foto03_Input_default"];
    @$foto04_Input_default = $_POST["foto04_Input_default"];

    @$video01_Input_default = $_POST["video01_Input_default"];
    @$video02_Input_default = $_POST["video02_Input_default"];

    $pgnt_01 = $_POST['pgnt_01'];
    $pgnt_02 = $_POST['pgnt_02'];
    $pgnt_03 = $_POST['pgnt_03'];
    $pgnt_04 = $_POST['pgnt_04'];
    $pgnt_05 = $_POST['pgnt_05'];
    $pgnt_06 = $_POST['pgnt_06'];

    $resp_01 = $_POST['resp_01'];
    $resp_02 = $_POST['resp_02'];
    $resp_03 = $_POST['resp_03'];
    $resp_04 = $_POST['resp_04'];
    $resp_05 = $_POST['resp_05'];
    $resp_06 = $_POST['resp_06'];


    // ===== VERIFICAÇÃO DE INPUTS VAZIOS + VERIFICAÇÃO DE POSSIVEIS ERROS =====
    if($titulo == ""){
        echo 'Preencha o campo de titulo';
        exit();
    }
    if($titulo != ""){
        $res = $pdo->query("SELECT * FROM tratamentos where id != '$id_Tratamento'"); 
        $dados = $res->fetchAll(PDO::FETCH_ASSOC);
        for ($i=0; $i < count($dados); $i++) { 
            $titulos = $dados[$i]['titulo'];
            if($titulos === $titulo){
                echo 'Tratamento já cadastrado!';
                exit();
            }
        }
    }
    if($especialidade == "" || $especialidade == 'null'){
        echo 'Selecione uma especialidade para continuar!';
        exit();
    }
    if($desc == ""){
        echo 'Preencha o campo de descrição com uma descrição simples';
        exit();
    }
    if($desc !== ""){
        $desc = nl2br(htmlentities($desc, ENT_QUOTES, 'UTF-8'));
    }
    if($etapas !== ""){
        $etapas = nl2br(htmlentities($etapas, ENT_QUOTES, 'UTF-8'));
    }
    
    if($resp_01 !== ""){
        $resp_01 = nl2br(htmlentities($resp_01, ENT_QUOTES, 'UTF-8'));
    }
    if($resp_02 !== ""){
        $resp_02 = nl2br(htmlentities($resp_02, ENT_QUOTES, 'UTF-8'));
    }
    if($resp_03 !== ""){
        $resp_03 = nl2br(htmlentities($resp_03, ENT_QUOTES, 'UTF-8'));
    }
    if($resp_04 !== ""){
        $resp_04 = nl2br(htmlentities($resp_04, ENT_QUOTES, 'UTF-8'));
    }
    if($resp_05 !== ""){
        $resp_05 = nl2br(htmlentities($resp_05, ENT_QUOTES, 'UTF-8'));
    }
    if($resp_06 !== ""){
        $resp_06 = nl2br(htmlentities($resp_06, ENT_QUOTES, 'UTF-8'));
    }
    

    //VALIDAÇÃO DE CARACTERES IMPROPRIOS NO TITULO
    $caracteresProibidos = ['_', '{', '}', '|', '\\', '^', '[', ']', '`', ';', '/', '?', ':', '@', '&', '=', '+', '$', ','];
    foreach ($caracteresProibidos as $caractere) {
        if (str_contains($titulo, $caractere)) {
            echo "O caractere '$caractere' não pode ser utilizado";
            exit();
        }
    }

    //CRIAÇÃO DE PASTAS COM NOME DO TRATAMENTO
    $titulo_novo = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($titulo)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
    $titulo_tratado = preg_replace('/[ -]+/', '_', $titulo_novo);
    
    if(@$titulo_antigo == ""){
        $diretorio = '../../../assets/tratamentos/'.$titulo_tratado.'/';
        if(!is_dir($diretorio)){
            mkdir($diretorio, 0777, true);
            chmod($diretorio, 0777);
        }
    }
    if($titulo != $titulo_antigo && $titulo_antigo != ""){
        $titulo_antigo_limpo = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($titulo_antigo)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
        $titulo_antigo_tratado = preg_replace('/[ -]+/', '_', $titulo_antigo_limpo);

        $DiretorioTituloAntigo = "../../../assets/tratamentos/".$titulo_antigo_tratado."/";
        $DiretorioNovoTitulo = "../../../assets/tratamentos/".$titulo_tratado."/";

        chmod($DiretorioTituloAntigo, 0755);
        rename("$DiretorioTituloAntigo", "$DiretorioNovoTitulo");
    }

    // ===== SCRIPTS PARA SUBIR IMGS E VIDEO PARA O BANCO =====
    function uploadImage($inputName, $targetDir) {
        $uploadedFile = @$_FILES[$inputName];
        $imageName = preg_replace('/[ -]+/' , '-' , $uploadedFile['name']);
        $imageName = preg_replace('/_/' , '-' , $uploadedFile['name']);
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
    function uploadVideo($inputName, $targetDir) {
        $uploadedFile = @$_FILES[$inputName];
        $imageName = preg_replace('/[ -]+/' , '-' , $uploadedFile['name']);
        $imageName = preg_replace('/_/' , '-' , $uploadedFile['name']);
        $targetPath = $targetDir . $imageName;

        $imageTemp = $uploadedFile['tmp_name'];
        $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
        $allowedExtensions = ['mp4', 'mov', 'avi'];

        if (in_array($imageExt, $allowedExtensions)) {
            move_uploaded_file($imageTemp, $targetPath);
            return $imageName;
        } else {
            echo "Extensão de Video não permitido!";
            exit();
        }
    }

    // Diretórios e imagens padrão
    $diretorio_User = '../../../assets/tratamentos/'.$titulo_tratado.'/';
    if($_FILES['Card_Input']['name'] == ""){
        if($Card_Input_default == "true"){
            $card_Banner = 'card_placeholder.webp';
        }
        else{
            if($card_edit != ""){
                $card_Banner = $card_edit;
            }
            if($card_edit == ""){
                $card_Banner = 'card_placeholder.webp';
            }
        }
    }
    else{
        if($_FILES['Card_Input']['name'] == $card_edit){
            $card_Banner = $card_edit;
        }
        else{
            $card_Banner = uploadImage('Card_Input', $diretorio_User);
        }
    }

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
            $banner = uploadImage('Banner_Input', $diretorio_User);
        }
    }

    if($_FILES['foto01_Input']['name'] == ""){
        if($foto01_Input_default == "true"){
            $foto01 = 'resultado.webp';
        }
        else{
            if($foto01_edit != ""){
                $foto01 = $foto01_edit;
            }
            if($foto01_edit == ""){
                $foto01 = 'resultado.webp';
            }
        }
    }
    else{
        if($_FILES['foto01_Input']['name'] == $foto01_edit){
            $foto01 = $foto01_edit;
        }
        else{
            $foto01 = uploadImage('foto01_Input', $diretorio_User);
        }
    }
    if($_FILES['foto02_Input']['name'] == ""){
        if($foto02_Input_default == "true"){
            $foto02 = 'resultado.webp';
        }
        else{
            if($foto02_edit != ""){
                $foto02 = $foto02_edit;
            }
            if($foto02_edit == ""){
                $foto02 = 'resultado.webp';
            }
        }
    }
    else{
        if($_FILES['foto02_Input']['name'] == $foto02_edit){
            $foto02 = $foto02_edit;
        }
        else{
            $foto02 = uploadImage('foto02_Input', $diretorio_User);
        }
    }
    if($_FILES['foto03_Input']['name'] == ""){
        if($foto03_Input_default == "true"){
            $foto03 = 'resultado.webp';
        }
        else{
            if($foto03_edit != ""){
                $foto03 = $foto03_edit;
            }
            if($foto03_edit == ""){
                $foto03 = 'resultado.webp';
            }
        }
    }
    else{
        if($_FILES['foto03_Input']['name'] == $foto03_edit){
            $foto03 = $foto03_edit;
        }
        else{
            $foto03 = uploadImage('foto03_Input', $diretorio_User);
        }
    }
    if($_FILES['foto04_Input']['name'] == ""){
        if($foto04_Input_default == "true"){
            $foto04 = 'resultado.webp';
        }
        else{
            if($foto04_edit != ""){
                $foto04 = $foto04_edit;
            }
            if($foto04_edit == ""){
                $foto04 = 'resultado.webp';
            }
        }
    }
    else{
        if($_FILES['foto04_Input']['name'] == $foto04_edit){
            $foto04 = $foto04_edit;
        }
        else{
            $foto04 = uploadImage('foto04_Input', $diretorio_User);
        }
    }

    if($_FILES['Video01_Input']['name'] == ""){
        if($video01_Input_default == "true"){
            $video01 = 'video_vazio.mp4';
        }
        else{
            if($video01_edit != ""){
                $video01 = $video01_edit;
            }
            if($video01_edit == ""){
                $video01 = 'video_vazio.mp4';
            }
        }
    }
    else{
        if($_FILES['Video01_Input']['name'] == $video01_edit){
            $video01 = $video01_edit;
        }
        else{
            $video01 = uploadVideo('Video01_Input', $diretorio_User);
        }
    }
    if($_FILES['Video02_Input']['name'] == ""){
        if($video02_Input_default == "true"){
            $video02 = 'video_vazio.mp4';
        }
        else{
            if($video02_edit != ""){
                $video02 = $video02_edit;
            }
            if($video02_edit == ""){
                $video02 = 'video_vazio.mp4';
            }
        }
    }
    else{
        if($_FILES['Video02_Input']['name'] == $video02_edit){
            $video02 = $video02_edit;
        }
        else{
            $video02 = uploadVideo('Video02_Input', $diretorio_User);
        }
    }

    // ===== INSERÇÃO DE DADOS NO BANCO =====
    if($id_Tratamento == ""){
        $res = $pdo->prepare("INSERT INTO tratamentos (titulo, card_banner, banner, especialidade_atr, descricao, etapas, foto_relac_01, foto_relac_02, foto_relac_03, foto_relac_04, video_relac_01, video_relac_02, pgnt_01, pgnt_02, pgnt_03, pgnt_04, pgnt_05, pgnt_06, resp_01, resp_02, resp_03, resp_04, resp_05, resp_06) VALUES (:titulo, :card_banner, :banner, :especialidade_atr, :descricao, :etapas, :foto_relac_01, :foto_relac_02, :foto_relac_03, :foto_relac_04, :video_relac_01, :video_relac_02, :pgnt_01, :pgnt_02, :pgnt_03, :pgnt_04, :pgnt_05, :pgnt_06, :resp_01, :resp_02, :resp_03, :resp_04, :resp_05, :resp_06)");
    }
    else{
        $res = $pdo->prepare("UPDATE tratamentos SET titulo = :titulo, card_banner = :card_banner, banner = :banner, especialidade_atr = :especialidade_atr, descricao = :descricao, etapas = :etapas, foto_relac_01 = :foto_relac_01, foto_relac_02 = :foto_relac_02, foto_relac_03 = :foto_relac_03, foto_relac_04 = :foto_relac_04, video_relac_01 = :video_relac_01, video_relac_02 = :video_relac_02, pgnt_01 = :pgnt_01, pgnt_02 = :pgnt_02, pgnt_03 = :pgnt_03, pgnt_04 = :pgnt_04, pgnt_05 = :pgnt_05, pgnt_06 = :pgnt_06, resp_01 = :resp_01, resp_02 = :resp_02, resp_03 = :resp_03, resp_04 = :resp_04, resp_05 = :resp_05, resp_06 = :resp_06 WHERE id = :id");
        $res->bindValue(":id", $id_Tratamento);
    }
    $res->bindValue(":titulo", $titulo);
    $res->bindValue(":card_banner", $card_Banner);
    $res->bindValue(":banner", $banner);
    $res->bindValue(":foto_relac_01", $foto01);
    $res->bindValue(":foto_relac_02", $foto02);
    $res->bindValue(":foto_relac_03", $foto03);
    $res->bindValue(":foto_relac_04", $foto04);
    $res->bindValue(":video_relac_01", $video01);
    $res->bindValue(":video_relac_02", $video02);
    $res->bindValue(":especialidade_atr", $especialidade);

    $res->bindValue(":descricao", $desc);
    $res->bindValue(":etapas", $etapas);

    $res->bindValue(":pgnt_01", $pgnt_01);
    $res->bindValue(":pgnt_02", $pgnt_02);
    $res->bindValue(":pgnt_03", $pgnt_03);
    $res->bindValue(":pgnt_04", $pgnt_04);
    $res->bindValue(":pgnt_05", $pgnt_05);
    $res->bindValue(":pgnt_06", $pgnt_06);

    $res->bindValue(":resp_01", $resp_01);
    $res->bindValue(":resp_02", $resp_02);
    $res->bindValue(":resp_03", $resp_03);
    $res->bindValue(":resp_04", $resp_04);
    $res->bindValue(":resp_05", $resp_05);
    $res->bindValue(":resp_06", $resp_06);


    if ($res->execute()) {
        if($id_Tratamento == ""){
            echo 'Tratamento criado com Sucesso!!';
        }
        else{
            echo 'Tratamento atualizado com Sucesso!!';
        }
    } else {
        echo 'Erro: Tente novamente!';
    }
?>
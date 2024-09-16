<?php
    @session_start();
    require_once("../../configs/conexao.php"); 

    $id_Medico = $_POST['id_Edit_Medico'];

    $nome = $_POST['nome'];
    $nome_antigo = $_POST['nome_antigo'];
    
    $doc = $_POST['doc'];
    $especialidade = $_POST['especialidade'];

    $bio = $_POST['bio'];
    $formacoes = $_POST['formacoes'];

    $linkedin = $_POST['linkedin'];
    $instagram = $_POST['instagram'];
    $facebook = $_POST['facebook'];
    $whatsapp = $_POST['whatsapp'];

    $card_edit = $_POST['card_edit'];
    $foto_edit = $_POST['foto_edit'];
    $video_edit = $_POST['video_edit'];
    @$Card_Input_default = $_POST["Card_Input_default"];
    @$Foto_Input_default = $_POST["Foto_Input_default"];
    @$Video_Input_default = $_POST["Video_Input_default"];

    $novoEmail = filter_var($_POST['novoEmailEditMedico'], FILTER_SANITIZE_EMAIL);
    $confirmaNovoEmail = filter_var($_POST['confirmaNovoEmailEditMedico'], FILTER_SANITIZE_EMAIL);

    $novoEmail = strtolower($novoEmail);
    $confirmaNovoEmail = strtolower($confirmaNovoEmail);

    $novaSenha = $_POST['novaSenhaEditMedico'];
    $confirmaNovaSenha = $_POST['confirmaNovaSenhaEditMedico'];

    $emailUserSemAlteracoes = $_POST['emailMedicoSemAlteracoes'];
    $senhaUserSemAlteracoes = $_POST['senhaMedicoSemAlteracoes'];




    // ===== VERIFICAÇÃO DE INPUTS VAZIOS + VERIFICAÇÃO DE POSSIVEIS ERROS =====
    if($nome == ""){
        echo 'Preencha o campo de nome';
        exit();
    }
    if($nome != ""){
        $res = $pdo->query("SELECT * FROM medicos where id != '$id_Medico'"); 
        $dados = $res->fetchAll(PDO::FETCH_ASSOC);
        for ($i=0; $i < count($dados); $i++) { 
            $nomes = $dados[$i]['nome'];
            if($nomes === $nome){
                echo 'Nome de medico(a) já utilizado!';
                exit();
            }
        }
    }
    if($doc == ""){
        echo 'Preencha o campo de documento';
        exit();
    }
    if($especialidade == "" || $especialidade == 'null'){
        echo 'Selecione uma especialidade para continuar!';
        exit();
    }
    if($bio == ""){
        echo 'Preencha o campo de descrição com uma descrição simples';
        exit();
    }
    if($bio !== ""){
        $bio = nl2br(htmlentities($bio, ENT_QUOTES, 'UTF-8'));
    }
    if($formacoes !== ""){
        $formacoes = nl2br(htmlentities($formacoes, ENT_QUOTES, 'UTF-8'));
    }
    if($linkedin !== "" && $linkedin !== null){
        if($linkedin[0] == 'h' && $linkedin[1] == 't' && $linkedin[2] == 't' && $linkedin[4] == 's' ){
            $linkedin = ltrim($linkedin, 'https://');
        }
        
        if($linkedin[0] == 'h' && $linkedin[1] == 't' && $linkedin[2] == 't' && $linkedin[4] == ':' ){
            $linkedin = ltrim($linkedin, 'http://');
        }
    }
    if($instagram !== "" && $instagram !== null){
        if($instagram[0] == 'h' && $instagram[1] == 't' && $instagram[2] == 't' && $instagram[4] == 's' ){
            $instagram = ltrim($instagram, 'https://');
        }
        
        if($instagram[0] == 'h' && $instagram[1] == 't' && $instagram[2] == 't' && $instagram[4] == ':' ){
            $instagram = ltrim($instagram, 'http://');
        }
    }
    if($facebook !== "" && $facebook !== null){
        if($facebook[0] == 'h' && $facebook[1] == 't' && $facebook[2] == 't' && $facebook[4] == 's' ){
            $facebook = ltrim($facebook, 'https://');
        }
        
        if($facebook[0] == 'h' && $facebook[1] == 't' && $facebook[2] == 't' && $facebook[4] == ':' ){
            $facebook = ltrim($facebook, 'http://');
        }
    }
    if($whatsapp !== "" && $whatsapp !== null){
        if($whatsapp[0] == 'h' && $whatsapp[1] == 't' && $whatsapp[2] == 't' && $whatsapp[4] == 's' ){
            $whatsapp = ltrim($whatsapp, 'https://');
        }
        
        if($whatsapp[0] == 'h' && $whatsapp[1] == 't' && $whatsapp[2] == 't' && $whatsapp[4] == ':' ){
            $whatsapp = ltrim($whatsapp, 'http://');
        }
    }


    //EMAIL
    if($novoEmail != ""){
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
    }
    else{
        $novoEmail = $emailUserSemAlteracoes;
    }


    //SENHA
    if($novaSenha != ""){
        if($novaSenha != $confirmaNovaSenha){
            echo 'Nova senha e confirmação de nova senha não coicidem!';
            exit();
        }
        if($novaSenha == $senhaUserSemAlteracoes){
            echo 'Nova senha é identica a senha já cadastrada!';
            exit();
        }
        $senha_crip = md5($novaSenha);
    }
    else{
        $res = $pdo->query("SELECT * FROM medicos where id = '$id_Medico' LIMIT 1"); 
        $dados = $res->fetchAll(PDO::FETCH_ASSOC);

        $novaSenha = $dados[0]['senha_temp'];
        $senha_crip = md5($novaSenha);
    }

    //VALIDAÇÃO DE CARACTERES IMPROPRIOS NO NOME
    $caracteresProibidos = ['_', '{', '}', '|', '\\', '^', '[', ']', '`', ';', '/', '?', ':', '@', '&', '=', '+', '$', ','];
    foreach ($caracteresProibidos as $caractere) {
        if (str_contains($nome, $caractere)) {
            echo "O caractere '$caractere' não pode ser utilizado";
            exit();
        }
    }

    //CRIAÇÃO DE PASTAS COM NOME DOS MEDICOS
    $nome_novo = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($nome)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
    $nome_tratado = preg_replace('/[ -]+/', '_', $nome_novo);
    if(@$nome_antigo == ""){
        $diretorio = '../../../assets/medicos/'.$nome_tratado.'/';
        if(!is_dir($diretorio)){
            mkdir($diretorio, 0777, true);
            chmod($diretorio, 0777);
        }
    }
    if($nome != $nome_antigo && $nome_antigo != ""){
        $nome_antigo_limpo = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($nome_antigo)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
        $nome_antigo_tratado = preg_replace('/[ -]+/', '_', $nome_antigo_limpo);

        $DiretorioNomeAntigo = "../../../assets/medicos/".$nome_antigo_tratado."/";
        $DiretorioNovoNome = "../../../assets/medicos/".$nome_tratado."/";

        chmod($DiretorioNomeAntigo, 0755);
        rename("$DiretorioNomeAntigo", "$DiretorioNovoNome");
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
    $diretorio_User = '../../../assets/medicos/'.$nome_tratado.'/';

    if($_FILES['Card_Input']['name'] == ""){
        if($Card_Input_default == "true"){
            $card_User = 'user_placeholder.webp';
        }
        else{
            if($card_edit != ""){
                $card_User = $card_edit;
            }
            if($card_edit == ""){
                $card_User = 'user_placeholder.webp';
            }
        }
    }
    else{
        if($_FILES['Card_Input']['name'] == $card_edit){
            $card_User = $card_edit;
        }
        else{
            $card_User = uploadImage('Card_Input', $diretorio_User);
        }
    }

    if($_FILES['Foto_Input']['name'] == ""){
        if($Foto_Input_default == "true"){
            $foto_User = 'foto_placeholder.webp';
        }
        else{
            if($foto_edit != ""){
                $foto_User = $foto_edit;
            }
            if($foto_edit == ""){
                $foto_User = 'foto_placeholder.webp';
            }
        }
    }
    else{
        if($_FILES['Foto_Input']['name'] == $foto_edit){
            $foto_User = $foto_edit;
        }
        else{
            $foto_User = uploadImage('Foto_Input', $diretorio_User);
        }
    }
    
    if($_FILES['Video_Input']['name'] == ""){
        if($Video_Input_default == "true"){
            $video_User = 'video_vazio.mp4';
        }
        else{
            if($video_edit != ""){
                $video_User = $video_edit;
            }
            if($video_edit == ""){
                $video_User = 'video_vazio.mp4';
            }
        }
    }
    else{
        if($_FILES['Video_Input']['name'] == $video_edit){
            $video_User = $video_edit;
        }
        else{
            $video_User = uploadVideo('Video_Input', $diretorio_User);
        }
    }

    // ===== INSERÇÃO DE DADOS NO BANCO =====
    $res = $pdo->prepare("UPDATE medicos SET email = :email, senha = :senha, senha_Crip = :senha_Crip, card_ = :card_, foto = :foto, video = :video, nome = :nome, documento = :documento, especialidade = :especialidade, bio = :bio, formacoes = :formacoes, linkedin = :linkedin, instagram = :instagram, facebook = :facebook, whatsapp = :whatsapp WHERE id = :id");
    $res->bindValue(":email", $novoEmail);

    $res->bindValue(":senha", $novaSenha);
    $res->bindValue(":senha_Crip", $senha_crip);

    $res->bindValue(":card_", $card_User);
    $res->bindValue(":foto", $foto_User);
    $res->bindValue(":video", $video_User);

    $res->bindValue(":nome", $nome);
    $res->bindValue(":documento", $doc);
    $res->bindValue(":especialidade", $especialidade);

    $res->bindValue(":bio", $bio);
    $res->bindValue(":formacoes", $formacoes);

    $res->bindValue(":linkedin", $linkedin);
    $res->bindValue(":instagram", $instagram);
    $res->bindValue(":facebook", $facebook);
    $res->bindValue(":whatsapp", $whatsapp);

    $res->bindValue(":id", $id_Medico);

    if ($res->execute()) {
        echo 'Perfil Atualizado com Sucesso!!';
    } else {
        echo 'Erro: Tente novamente!';
    }
   
?>
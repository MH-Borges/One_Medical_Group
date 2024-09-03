<?php
session_start();
require_once("../configs/conexao.php");

$idUserSession = @$_SESSION['id_user'];
$query = $pdo->query("SELECT * FROM medicos WHERE id = '$idUserSession' LIMIT 1");
$dados = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($dados) > 0){
    $status = $dados[0]['status_perfil'];
    $email = $dados[0]['email'];
    $senha = $dados[0]['senha'];
    $senha_temp = $dados[0]['senha_temp'];
    $card = $dados[0]['card_'];
    $foto = $dados[0]['foto'];
    $video = $dados[0]['video'];
    $especialidade = $dados[0]['especialidade'];
    $nome = $dados[0]['nome'];
    $documento = $dados[0]['documento'];
    $descricao = $dados[0]['bio'];
    $formacoes = $dados[0]['formacoes'];
    $linkedin = $dados[0]['linkedin'];
    $instagram = $dados[0]['instagram'];
    $facebook = $dados[0]['facebook'];
    $whatsapp = $dados[0]['whatsapp'];

    //tratamentos
    $descricao = str_replace('<br />', " ", $descricao);
    $formacoes = str_replace('<br />', " ", $formacoes);

    $nome_novo = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($nome)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
    $nome_tratado = preg_replace('/[ -]+/', '_', $nome_novo);

    $card_edit = $card;
    $foto_edit = $foto;
    $video_edit = $video;
} 
else {
    echo "<script language='javascript'> window.alert('Acesso Negado: Usuario não encontrado!') </script>";
    echo "<script language='javascript'> window.location='../configs/logout.php' </script>";
}

?> 

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil medico <?php echo @$nome; ?> | Clinica Sicuro</title>
    <link rel="icon" href="../../assets/icons/icon.svg" />

    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Mask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- SVG Inject -->
    <script src="../../js/svg-inject.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>

    <!-- Main files -->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header id="menuMedico">
        <ul class="menu">
            <li id="logo">
                <a href="../../">
                    <img src="../../assets/sistema/logo.webp" alt="logo one medical">
                </a>
            </li>

            <li>
                <button type="button" data-bs-toggle="modal" data-bs-target="#ModalEditPerfil">
                    <img src="../../assets/sistema/user_edit.svg" onload="SVGInject(this)">
                    Editar dados
                </button>
            </li>
            <li>
                <button type="button" data-bs-toggle="modal" data-bs-target="#ModalLogout">
                    <img src="../../assets/sistema/logout.svg" onload="SVGInject(this)">
                    Sair
                </button>
            </li>
        </ul>
    </header>

    <main id="Main_Medicos">
        <!-- Modal Cria senha-->
        <div class="modal fade" id="ModalCriaSenha" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog">
                <form id="Form_ModalCriaSenha" method="post" class="modal-content">
                    <div class="modal-body">
                        <h2>Para continuar crie uma senha!</h2>
                        <div class="BlockBox senhaInput">
                            <input type="password" name="novaSenhaUser" id="novaSenhaUser" maxlength="25" required>
                            <span>Digite sua nova senha:</span>
                            <div id="eye_box" onclick="ShowPass('1')">
                                <img id="eye" src="../../assets/sistema/eye.svg" onload="SVGInject(this)">
                                <img id="eye_slash" class="hide" src="../../assets/sistema/eye_slash.svg" onload="SVGInject(this)">
                            </div>
                            <p class="lengthInput novaSenhaInput"></p>
                        </div>
                        <div class="BlockBox senhaInput">
                            <input type="password" name="repetNovaSenhaUser" id="repetNovaSenhaUser" maxlength="25" required>
                            <span>Digite novamente sua nova senha:</span>
                            <div id="eye_box_Repet" onclick="ShowPass('2')">
                                <img id="eye_Repet" src="../../assets/sistema/eye.svg" onload="SVGInject(this)">
                                <img id="eye_slash_Repet" class="hide" src="../../assets/sistema/eye_slash.svg" onload="SVGInject(this)">
                            </div>
                            <p class="lengthInput repetSenhaInput"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input value="<?php echo $idUserSession ?>" class="hide" type="hidden" name="idUserSenha" id="idUserSenha">

                        <button class="btns btn_salvar" type="submit">Salvar Senha</button>
                    </div>
                </form>
            </div>
            <div id="msg_ModalCriaMedico"></div>
        </div>
        <?php
            if($senha == "" && $senha_temp != "") {
                echo "
                    <button id='openModalCriaSenha' class='hide' type='button' data-bs-toggle='modal' data-bs-target='#ModalCriaSenha'></button>
                    <script language='javascript'>$('#openModalCriaSenha').click();</script>
                ";
            }
        ?>

        <section id="home">
            <?php 
                if($status == 'inativo' && $nome == ""){ 
                    echo "<h2 id='status_msg'>Este perfil se encontra desativado, preencha com suas informações para ativa-lo.</h2>"; 
                }
                if($status == 'inativo' && $nome != ""){ 
                    echo "<h2 id='status_msg'>Este perfil se encontra desativado, Entre em contato com o administrador para mais informações!</h2>"; 
                }
            ?>
            
            <form id="Form_DadosMedico" method="post" enctype="multipart/form-data">
                <div id="Card_foto_video">
                    <div id="Card_block">
                        <h3>Selecione uma imagem para o seu card</h3>
                        <span>*Tamanho de imagem recomendado: 225 x 375</span>
                        <input type="hidden" id="Card_Input_default" name="Card_Input_default" value="" required>
                        <input type="file" value="<?php echo $card ?>" id="Card_Input" name="Card_Input" onChange="carregaCard();">
                        <?php
                            if($card == "user_placeholder.webp" || $card == ""){
                                $card = "
                                    <img class='card' id='target_card' src='../../assets/medicos/user_placeholder.webp'>
                                    <button type='button' class='btns btn_VoltaPadrao_Card_Input hide' onclick='imgPadrao(`Card_Input`, `target_card`, `user_placeholder.webp`, `card`)'>Restaurar imagem</button>
                                ";
                            }else{
                                $card = "
                                    <img class='card imgSelected' id='target_card' src='../../assets/medicos/$nome_tratado/$card'>
                                    <button type='button' class='btns btn_VoltaPadrao_Card_Input' onclick='imgPadrao(`Card_Input`, `target_card`, `user_placeholder.webp`, `card`)'>Restaurar imagem</button>
                                ";
                            }
                            
                            echo $card;
                        ?>
                        <img class="editPen" onclick="document.getElementById('Card_Input').click();" src="../../assets/sistema/edit.svg" onload="SVGInject(this)">
                    </div>

                    <div id="Foto_block">
                        <h3>Selecione uma imagem para o seu perfil</h3>
                        <span>*Tamanho de imagem recomendado: 515 x 325</span>
                        <input type="hidden" id="Foto_Input_default" name="Foto_Input_default" value="" required>
                        <input type="file" value="<?php echo $foto ?>" id="Foto_Input" name="Foto_Input" onChange="carregaFoto();">
                        <?php
                            if($foto == "foto_placeholder.webp" || $foto == ""){
                                $foto = "
                                    <img class='foto' id='target_foto' src='../../assets/medicos/foto_placeholder.webp'>
                                    <button type='button' class='btns btn_VoltaPadrao_Foto_Input hide' onclick='imgPadrao(`Foto_Input`, `target_foto`, `foto_placeholder.webp`, `foto`)'>Restaurar imagem</button>
                                ";
                            }else{
                                $foto = "
                                    <img class='foto imgSelected' id='target_foto' src='../../assets/medicos/$nome_tratado/$foto'>
                                    <button type='button' class='btns btn_VoltaPadrao_Foto_Input' onclick='imgPadrao(`Foto_Input`, `target_foto`, `foto_placeholder.webp`, `foto`)'>Restaurar imagem</button>
                                ";
                            }
                            
                            echo $foto;
                        ?>
                        <img class="editPen" onclick="document.getElementById('Foto_Input').click();" src="../../assets/sistema/edit.svg" onload="SVGInject(this)">
                    </div>

                    <div id="Video_block">
                        <h3>Selecione um video para o seu perfil</h3>
                        <span>*Tamanho de Video recomendado: 1920 x 1080</span>
                        <input type="hidden" id="Video_Input_default" name="Video_Input_default" value="" required>
                        <input type="file" value="<?php echo $video ?>" id="Video_Input" name="Video_Input" onChange="carregaVideo();">
                        <?php
                            if($video == "video_vazio.mp4" || $video == ""){
                                $video = "
                                    <video class='video' id='target_video'>
                                        <source src='../../assets/medicos/video_vazio.mp4'>
                                    </video>
                                    <button type='button' class='btns btn_VoltaPadrao_Video_Input hide' onclick='imgPadrao(`Video_Input`, `target_video`, `video_vazio.mp4`, `video`)'>Restaurar imagem</button>
                                ";
                            }else{
                                $video = "
                                    <video class='video imgSelected' id='target_video'>
                                        <source  src='../../assets/medicos/$nome_tratado/$video'>
                                    </video>
                                    <button type='button' class='btns btn_VoltaPadrao_Video_Input' onclick='imgPadrao(`Video_Input`, `target_video`, `video_vazio.mp4`, `video`)'>Restaurar Video</button>
                                ";
                            }
                            
                            echo $video;
                        ?>
                        <img class="editPen" onclick="document.getElementById('Video_Input').click();" src="../../assets/sistema/edit.svg" onload="SVGInject(this)">
                    </div>
                </div>

                <div id="infos">
                    <div class="BlockBox">
                        <input type="text" name="nome" id="nome" value="<?php echo @$nome?>" maxlength="100" required>
                        <span>Seu nome e sobrenome:</span>
                        <p class="lengthInput NomeInput"></p>
                    </div>
                    <div class="BlockBox">
                        <input type="text" name="doc" id="doc" value="<?php echo @$documento?>" maxlength="100" required>
                        <span>Numero de documento (CRM/CRP/Outros):</span>
                    </div>
                    <div class="Seletor">
                        <span>Selecione sua especialidade:</span>
                        <div id="especialidades-select">
                            <input type="checkbox" id="select_input_espec" onchange="OptionSelection('selected_val_espec', 'select_input_espec', 'options_espec');">

                            <div id="select-button">
                                <div id='selected_val_espec'><?php if($especialidade == ""){ echo "Selecione sua especialidade"; } else{ echo $especialidade; } ?></div>
                                <img src="../../assets/sistema/seta_fina.svg" onload="SVGInject(this)">
                            </div>
                        </div>
                        
                        <ul id="options">
                            <?php 

                                echo "
                                    <li class='options_espec'>
                                        <input type='radio' name='especialidade' value='null' data-label='null'>
                                        <span class='label'> Selecione sua especialidade </span>
                                    </li>
                                ";

                                $query = $pdo->query("SELECT * FROM especialidade ORDER BY id DESC");
                                $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                                for ($i=0; $i < count($dados); $i++) {
                                    $nome_espec = $dados[$i]['nome'];
                                    if($nome_espec === $especialidade){
                                        echo "
                                            <li class='options_espec'>
                                                <input type='radio' name='especialidade' value='$nome_espec' data-label='$nome_espec' checked>
                                                <span class='label'>$nome_espec</span>
                                            </li>
                                        ";
                                    }
                                    else{
                                        echo "
                                            <li class='options_espec'>
                                                <input type='radio' name='especialidade' value='$nome_espec' data-label='$nome_espec'>
                                                <span class='label'>$nome_espec</span>
                                            </li>
                                        ";
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                    <div class="BlockBox TextAreaBox">
                        <textarea type="text" name="bio" id="bio" maxlength="5000" required><?php echo $descricao ?></textarea>
                        <span>Sua Biografia:</span>
                    </div>
                    <div class="BlockBox TextAreaBox">
                        <textarea type="text" name="formacoes" id="formacoes" maxlength="1500" required><?php echo $formacoes ?></textarea>
                        <span>Suas Formações:</span>
                    </div>
                    <div class="BlockBox">
                        <input type="text" name="linkedin" id="linkedin" value="<?php echo @$linkedin?>" required>
                        <span><img src="../../assets/sistema/linkedin_full.svg" onload="SVGInject(this)"> Linkedin:</span>
                    </div>
                    <div class="BlockBox">
                        <input type="text" name="instagram" id="instagram" value="<?php echo @$instagram?>" required>
                        <span><img src="../../assets/sistema/instagram_full.svg" onload="SVGInject(this)"> Instagram:</span>
                    </div>
                    <div class="BlockBox">
                        <input type="text" name="facebook" id="facebook" value="<?php echo @$facebook?>" required>
                        <span><img src="../../assets/sistema/facebook_full.svg" onload="SVGInject(this)"> Facebook:</span>
                    </div>
                    <div class="BlockBox">
                        <input type="text" name="whatsapp" id="whatsapp" value="<?php echo @$whatsapp?>" required>
                        <span><img src="../../assets/sistema/whatsapp_full.svg" onload="SVGInject(this)"> Whatsapp:</span>
                    </div>
                </div>

                <?php
                    $hiddenFields = '
                        <input type="hidden" id="card_edit" name="card_edit" value="'.$card_edit.'">
                        <input type="hidden" id="foto_edit" name="foto_edit" value="'.$foto_edit.'">
                        <input type="hidden" id="video_edit" name="video_edit" value="'.$video_edit.'">
                        <input type="hidden" id="nome_antigo" name="nome_antigo" value="'.$nome.'">
                        <input type="hidden" id="idUser" name="idUser" value="'.$idUserSession.'">
                        <input type="hidden" id="status" name="status" value="'.$status.'">
                    ';

                    if($status == 'inativo') {
                        if($nome != "") {
                            echo '<button class="btns btn_salvar btn_desativado" id="btn_salva">Perfil desativado</button>'; 
                        } else {
                            echo $hiddenFields;
                            echo '<button class="btns btn_salvar" type="submit" id="btn_salva">Ativar perfil</button>';
                        }
                    } else {
                        echo $hiddenFields;
                        echo '<button class="btns btn_salvar" type="submit" id="btn_salva">Salvar informações</button>';
                    }
                ?>
            </form>

            <div id="msg_DadosMedico"></div>
        </section>
            
        <!-- Modal Logout-->
        <div class="modal fade" id="ModalLogout" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="CloseBtn" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <h5>Já vai embora?</h5>
                        <h6>Tem certeza que gostaria de sair da sa conta?</h6>
                    </div>
                    <div class="modal-footer">
                        <button class="btns btn_cancel" type="button" data-bs-dismiss="modal">Cancelar</button>
                        <a class="btns btn_salvar" href="../configs/logout.php" type="button">Sair</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Editar perfil-->
        <div class="modal fade" id="ModalEditPerfil" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="CloseBtn" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <div id="MenuAdm" class="nav nav-pills">
                            <a class="active" data-bs-toggle="pill" href="#EmailTroca">Troca de email</a>
                            <a data-bs-toggle="pill" href="#SenhaTroca">Troca de senha</a>
                        </div>
                        <div id="TabsAdm" class="tab-content">
                            <div class="tab-pane fade show active" id="EmailTroca">
                                <h4>Alterar Email:</h4>
                                <form id="formEditEmailUser" class="emailEdit" method="POST">
                                    <div class="BlockBox">
                                        <input type="text" name="antigoEmail" id="antigoEmail" maxlength="50" required>
                                        <span>E-mail Antigo:</span>
                                        <p class="lengthInput emailAntigoEditInput"></p>
                                    </div>
                                    <div class="BlockBox">
                                        <input type="text" name="novoEmail" id="novoEmail" maxlength="50" required>
                                        <span>Novo e-mail:</span>
                                        <p class="lengthInput novoEmailEditInput"></p>
                                    </div>
                                    <div class="BlockBox">
                                        <input type="text" name="confirmaNovoEmail" id="confirmaNovoEmail" maxlength="50" required>
                                        <span>Confirma novo e-mail:</span>
                                        <p class="lengthInput ConfirmaNovoEmailEditInput"></p>
                                    </div>
            
                                    <input value="<?php echo $idUserSession ?>" class="hide" type="hidden" name="idUserEmail" id="idUserEmail">
                                    <input value="<?php echo $email ?>" class="hide" type="hidden" name="emailUserSemAlteracoes" id="emailUserSemAlteracoes">
                                    <button class="btns btn_salvar" type="submit">Salvar</button>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="SenhaTroca">
                                <h4>Alterar Senha:</h4>
                                <form id="formEditSenhaUser" class="senhaEdit" method="POST">
                                    <div class="BlockBox senhaInput">
                                        <input type="password" name="antigaSenha" id="antigaSenha" maxlength="25" required>
                                        <span>Senha antiga:</span>
                                        <div id="eye_box" onclick="ShowPass('3')">
                                            <img id="eye" src="../../assets/sistema/eye.svg" onload="SVGInject(this)">
                                            <img id="eye_slash" class="hide" src="../../assets/sistema/eye_slash.svg" onload="SVGInject(this)">
                                        </div>
                                        <p class="lengthInput SenhaAntigaEditInput"></p>
                                    </div>
                                    <div class="BlockBox senhaInput">
                                        <input type="password" name="novaSenha" id="novaSenha" maxlength="25" required>
                                        <span>Nova senha:</span>
                                        <div id="eye_boxRecup" onclick="ShowPass(`4`)">
                                            <img id="eyeRecup" src="../../assets/sistema/eye.svg" onload="SVGInject(this)">
                                            <img id="eye_slashRecup" class="hide" src="../../assets/sistema/eye_slash.svg" onload="SVGInject(this)">
                                        </div>
                                        <p class="lengthInput NovaSenhaEditInput"></p>
                                    </div>
                                    <div class="BlockBox senhaInput">
                                        <input type="password" name="confirmaNovaSenha" id="confirmaNovaSenha" maxlength="25" required>
                                        <span>Confirma nova senha:</span>
                                        <div id="eye_box_RecupRepet" onclick="ShowPass(`5`)">
                                            <img id="eye_RecupRepet" src="../../assets/sistema/eye.svg" onload="SVGInject(this)">
                                            <img id="eye_slash_RecupRepet" class="hide" src="../../assets/sistema/eye_slash.svg" onload="SVGInject(this)">
                                        </div>
                                        <p class="lengthInput ConfirmaNovaSenhaEditInput"></p>
                                    </div>
                                    <input value="<?php echo $idUserSession ?>" class="hide" type="hidden" name="idUserAlteraSenha" id="idUserAlteraSenha">
                                    <input value="<?php echo $senha ?>" class="hide" type="hidden" name="senhaUserSemAlteracoes" id="senhaUserSemAlteracoes">
                                    <button class="btns btn_salvar" type="submit">Salvar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="msgErro_EditUser"></div>
        </div>
    </main>

    <script>
        //VERICAÇÃO QUANTIDADE DE CARACTERES INPUT + Show Eye Icon
        function verificaTamanhoInput(inputId, displayClass, maxLen) {
            var inputElement = document.getElementById(inputId);
            var displayElement = document.querySelector('.' + displayClass);
            if (inputElement !== null && displayElement !== null) {
                var tamInput = inputElement.value.length;

                if (tamInput < maxLen - 20) {
                    displayElement.innerHTML = '';
                    displayElement.classList.remove('text-warning', 'text-danger');
                } else if (tamInput < maxLen - 10) {
                    displayElement.innerHTML = (maxLen - tamInput) + '/' + maxLen;
                    displayElement.classList.remove('text-danger');
                    displayElement.classList.add('text-warning');
                } else {
                    displayElement.innerHTML = (maxLen - tamInput) + '/' + maxLen;
                    displayElement.classList.remove('text-warning');
                    displayElement.classList.add('text-danger');
                }
            }
        }
        setInterval(
            function () {
                verificaTamanhoInput('novaSenhaUser', 'novaSenhaInput', 25);
                verificaTamanhoInput('repetNovaSenhaUser', 'repetSenhaInput', 25);
        }, 50);

        function ShowPass(boxNum) {
            var elements = {
                '1': {
                    eye: 'eye',
                    eyeSlash: 'eye_slash',
                    passwordInput: 'novaSenhaUser'
                },
                '2': {
                    eye: 'eye_Repet',
                    eyeSlash: 'eye_slash_Repet',
                    passwordInput: 'repetNovaSenhaUser'
                },
                '3': {
                    eye: 'eye',
                    eyeSlash: 'eye_slash',
                    passwordInput: 'antigaSenha'
                },
                '4': {
                    eye: 'eyeRecup',
                    eyeSlash: 'eye_slashRecup',
                    passwordInput: 'novaSenha'
                },
                '5': {
                    eye: 'eye_RecupRepet',
                    eyeSlash: 'eye_slash_RecupRepet',
                    passwordInput: 'confirmaNovaSenha'
                }
            };
            var element = elements[boxNum];
            if (element) {
                var eye = document.getElementById(element.eye);
                var eyeSlash = document.getElementById(element.eyeSlash);
                var passwordInput = document.getElementById(element.passwordInput);

                if (eyeSlash.classList.contains('hide')) {
                    eyeSlash.classList.remove('hide');
                    eye.classList.add('hide');
                    passwordInput.type = 'text';
                } else {
                    eyeSlash.classList.add('hide');
                    eye.classList.remove('hide');
                    passwordInput.type = 'password';
                }
            }
        }

        //FUNÇÃO DE SELETORES CUSTOMIZADOS
        function OptionSelection(selectedValueId, optionsButtonId, optionInputsClass) {
            let selectedValue = document.getElementById(selectedValueId),
                optionsViewButton = document.getElementById(optionsButtonId),
                inputsOptions = document.querySelectorAll('.' + optionInputsClass + ' input');

            inputsOptions.forEach(input => { 
                input.addEventListener('click', event => {

                    var valor = '';
                    if(input.dataset.label == 'null'){
                        valor = 'Selecione sua especialidade';
                    }
                    else{
                        valor = input.dataset.label;
                    }
                    selectedValue.textContent = valor;
                    optionsViewButton.click();
                });
            });
        }

        //INSERT IMGS MEDICO
        function carregaCard(){ carregarImagem('Card_Input', 'target_card', '../../assets/medicos/user_placeholder.webp', 'card'); }
        function carregaFoto(){ carregarImagem('Foto_Input', 'target_foto', '../../assets/medicos/foto_placeholder.webp', 'foto'); }
        function carregaVideo(){ carregarImagem('Video_Input', 'target_video', '../../assets/medicos/video_vazio.mp4', 'video'); }

        // UPLOAD INFOS
        $(document).ready(function () {
            $('#Form_ModalCriaSenha').submit(function(e){
                e.preventDefault();
                $('#msg_ModalCriaMedico').text('');
                $('#msg_ModalCriaMedico').removeClass('text-danger');
                $('#msg_ModalCriaMedico').removeClass('text-success');
                $.ajax({
                    url:"insert_senha.php",
                    method:"post",
                    data: $('form').serialize(),
                    dataType: "text",
                    success: function(msg){
                        if(msg.trim() === 'Nova senha adicionada com Sucesso! Aguarde alguns segundos até a tela reiniciar.'){
                            $('#msg_ModalCriaMedico').addClass('text-success');
                            $('#msg_ModalCriaMedico').text(msg);
                            setTimeout(() => { location.reload(); }, 5000);
                        }
                        else{
                            $('#msg_ModalCriaMedico').addClass('text-danger');
                            $('#msg_ModalCriaMedico').text(msg);
                        }
                    }
                })
            });

            $('#formEditEmailUser').submit(function(e){
                e.preventDefault();
                $('#msgErro_EditUser').text('');
                $('#msgErro_EditUser').removeClass('text-danger');
                $('#msgErro_EditUser').removeClass('text-success');
                $.ajax({
                    url:"EditEmail.php",
                    method:"post",
                    data: $('form').serialize(),
                    dataType: "text",
                    success: function(msg){
                        if(msg.trim() === 'E-mail alterado com Sucesso!'){
                            $('#msgErro_EditUser').addClass('text-success');
                            $('#msgErro_EditUser').text(msg);
                            setTimeout(() => { 
                                window.alert('Necessario relogar para alteração completa do email');
                                window.location='../configs/logout.php';
                            }, 5000);
                        }
                        else{
                            $('#msgErro_EditUser').addClass('text-danger');
                            $('#msgErro_EditUser').text(msg);
                        }
                    }
                })
            });

            $('#formEditSenhaUser').submit(function(e){
                e.preventDefault();
                $('#msgErro_EditUser').text('');
                $('#msgErro_EditUser').removeClass('text-danger');
                $('#msgErro_EditUser').removeClass('text-success');
                $.ajax({
                    url:"EditSenha.php",
                    method:"post",
                    data: $('form').serialize(),
                    dataType: "text",
                    success: function(msg){
                        if(msg.trim() === 'Senha alterada com Sucesso!'){
                            $('#msgErro_EditUser').addClass('text-success');
                            $('#msgErro_EditUser').text(msg);
                            setTimeout(() => { location.reload(); }, 5000);
                        }
                        else{
                            $('#msgErro_EditUser').addClass('text-danger');
                            $('#msgErro_EditUser').text(msg);
                        }
                    }
                });
            });

            $('.btn_salvar').click(function (e) {
                $('#formacoes').prop('required',false);
                $('#bio').prop('required',false);
                $('#linkedin').prop('required',false);
                $('#instagram').prop('required',false);
                $('#facebook').prop('required',false);
                $('#whatsapp').prop('required',false);
            });

            $("#Video_Input").change(function(e){ 
                const fileSize = e.target.files[0].size / 1024 / 1024; // para mb
                if (fileSize > 20) {
                    $('#btn_salva').addClass('btn_desativado');
                    $('#btn_salva').removeAttr('type');
                    $('#msg_DadosMedico').addClass('text-danger');
                    $('#msg_DadosMedico').text('Tamanho do vídeo excedeu o limite do servidor! Apenas vídeos menores que 20 MB são aceitos.');
                }
                if (fileSize < 20) {
                    $('#btn_salva').removeClass('btn_desativado');
                    $('#btn_salva').attr('type', 'submit');
                    $('#msg_DadosMedico').removeClass('text-danger');
                    $('#msg_DadosMedico').text('');
                }
            });

            $("#Form_DadosMedico").submit(function (e) {
                e.preventDefault();
                $('#status_msg').text('');
                $('#msg_DadosMedico').text('');
                $('#msg_DadosMedico').removeClass('text-danger');
                $('#msg_DadosMedico').removeClass('text-success');
                $.ajax({
                    url: "insert_dados.php",
                    type: 'POST',
                    data: new FormData(this),
                    success: function (msg) {
                        if (msg.trim() === "Perfil Atualizado com Sucesso!!") {
                            $('#msg_DadosMedico').addClass('text-success');
                            $('#msg_DadosMedico').text(msg);
                            setTimeout(() => { window.location='./index.php'; }, 2000);
                        }
                        else {
                            $('#msg_DadosMedico').addClass('text-danger');
                            $('#msg_DadosMedico').text(msg);
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    xhr: function () {
                        var myXhr = $.ajaxSettings.xhr();
                        if (myXhr.upload){ myXhr.upload.addEventListener('progress', function() {}, false); }
                        return myXhr;
                    }
                });
            });
        });

        //RESET DE IMG
        function imgPadrao(inputId, targetId, placeholder, imgContainerClass) {
            document.getElementById(targetId).src = '../../assets/medicos/' + placeholder;
            document.getElementById(inputId + '_default').value = 'true';
            document.querySelector('.btn_VoltaPadrao_' + inputId).classList.add('hide');
            document.querySelector('.' + imgContainerClass).classList.remove('imgSelected');
        }

        //UPLOAD DE IMAGENS
        function carregarImagem(inputId, targetId, defaultImagePath, imgContainerClass) {
            var target = document.getElementById(targetId);
            var fileInput = document.querySelector("#" + inputId);
            var file = fileInput.files[0];
            var reader = new FileReader();

            reader.onloadend = function () { target.src = reader.result; };

            if (file) {
                reader.readAsDataURL(file);
                document.querySelector('.btn_VoltaPadrao_' + inputId).classList.remove('hide');
                document.querySelector('.' + imgContainerClass).classList.add('imgSelected');
            } else {
                target.src = defaultImagePath;
                document.getElementById(inputId + '_default').value = 'true';
                document.querySelector('.btn_VoltaPadrao_' + inputId).classList.add('hide');
                document.querySelector('.' + imgContainerClass).classList.remove('imgSelected');
            }
        }
    </script>
</body>
</html>
<section id="Medicos">
    <a class="btns btn_cria" href="index.php?pag=medicos&funcao=novoMedico">
        <p>Novo Medico(a)</p>
    </a>

    <div id="List_Medicos">
        <?php
            $query = $pdo->query("SELECT * FROM medicos WHERE nivel != 'adm' ORDER BY id DESC");
            $dados = $query->fetchAll(PDO::FETCH_ASSOC);

            for ($i=0; $i < count($dados); $i++) {
                $id_medico = $dados[$i]['id'];
                $nome_medico = $dados[$i]['nome'];
                $email_medico = $dados[$i]['email'];
                $card = $dados[$i]['card_'];
                $status = $dados[$i]['status_perfil'];

                if($nome_medico == ""){
                    if($status == "ativo"){
                        $ação = "
                            <a class=".$status." href='index.php?pag=medicos&funcao=statusMedico&id=".$id_medico."'><img src='../../assets/sistema/lampada.svg'></a>
                            <a href='index.php?pag=medicos&funcao=editMedico&id=".$id_medico."'><img src='../../assets/sistema/edit.svg'></a>
                        ";
                    }
                    else{
                        $ação = "<a class=".$status." href='index.php?pag=medicos&funcao=statusMedico&id=".$id_medico."'><img src='../../assets/sistema/lampada.svg'></a>";
                    }

                    $nome_medico = "Usuario sem <br> informações cadastradas";
                }
                else if($nome_medico != ""){
                    $ação = "
                        <a class=".$status." href='index.php?pag=medicos&funcao=statusMedico&id=".$id_medico."'><img src='../../assets/sistema/lampada.svg'></a>
                        <a href='index.php?pag=medicos&funcao=editMedico&id=".$id_medico."'><img src='../../assets/sistema/edit.svg'></a>
                    ";
                }

                if($card == "user_placeholder.webp" || $card == ""){
                    $card = "<img class='cardMedico' src='../../assets/medicos/user_placeholder.webp'>";
                }else{
                    $card = "<img class='cardMedico' src='../../assets/medicos/$card'>";
                }

                echo "
                    <div class='card'>
                        $card
                        <h4 class='nome'>$nome_medico</h4>
                        <p class='email'>$email_medico</p>

                        <div class='acoes'>
                            $ação
                            <a href='index.php?pag=medicos&funcao=deletMedico&id=".$id_medico."'><img src='../../assets/sistema/delet.svg'></a>
                        </div>
                    </div>
                ";
            }
        ?>
    </div>

    <!-- Modal Cria medico -->
    <div class="modal fade" id="ModalCriaMedico" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="Form_ModalCriaMedico" method="post" class="modal-content">
                <button type="button" class="CloseBtn" data-bs-dismiss="modal" aria-label="Close" onclick='window.location=`./index.php?pag=medicos`;'></button>
                <div class="modal-body">
                    <h4>Novo Medico(a)!</h4>
                    <div class="BlockBox">
                        <input type="text" name="email_Medico" id="email_Medico" maxlength="50" required>
                        <span>Email:</span>
                    </div>
                    <div class="BlockBox">
                        <input type="text" name="senha_Temp" id="senha_Temp" maxlength="100" required>
                        <span>Senha temporaria:</span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btns btn_cancel" type="button" data-bs-dismiss="modal" onclick='window.location=`./index.php?pag=medicos`;'>Cancelar</button>
                    <button class="btns btn_salvar" type="submit">Salvar perfil</button>
                </div>
                <div id="msg_ModalCriaMedico"></div>
            </form>
        </div>
    </div>

    <!-- Modal Delete medico-->
    <div class="modal fade" id="ModalDeletMedico" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="Form_ModalDeletMedico" method="post" class="modal-content">
                <button type="button" class="CloseBtn" data-bs-dismiss="modal" aria-label="Close" onclick='window.location=`./index.php?pag=medicos`;'></button>
                <div class="modal-body">
                    <h4>Gostaria mesmo de excluir o perfil deste medico(a)?</h4>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_medico_delete" name="id_medico_delete" value="<?php echo @$_GET['id'] ?>" required>

                    <button class="btns btn_cancel" type="button" data-bs-dismiss="modal" onclick='window.location=`./index.php?pag=medicos`;'>Cancelar</button>
                    <button class="btns btn_excluir" type="submit">Excluir</button>
                </div>
                <div id="msg_ModalDeletMedico"></div>
            </form>
        </div>
    </div>

    <!-- Modal Status categoria-->
    <div class="modal fade" id="ModalStatusPerfil" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <?php 
                $mensagem = '';
                $id_perfil = $_GET['id'];

                $query = $pdo->query("SELECT * FROM medicos WHERE id = '$id_perfil' LIMIT 1");
                $dados = $query->fetchAll(PDO::FETCH_ASSOC);

                if(@count($dados) > 0){
                    $status_perfil = $dados[0]['status_perfil'];
                    $nome = $dados[0]['nome'];
                }

                if($nome == ""){
                    if($status_perfil == "ativo"){
                        $mensagem = '<h4>Gostaria mesmo de desativar este perfil?</h4>';
                    }
                    else{
                        $mensagem = '<h4>Este perfil se encontra sem informações, gostaria mesmo de ativá-lo? <span>(Isso pode ocasionar alguns erros de visualização do perfil.)</span></h4>';
                    }
                }
                if($nome != ""){
                    if($status_perfil == "ativo"){
                        $mensagem = '<h4>Gostaria mesmo de desativar este perfil?</h4>';
                    }
                    else{
                        $mensagem = '<h4>Gostaria de reativar este perfil?</h4>';
                    }
                }

                if($status_perfil == "ativo"){ $btn = 'Desativar'; } 
                else { $btn = 'Ativar'; }
            ?>
            <form id="Form_ModalStatusMedico" method="post" class="modal-content">
                <button type="button" class="CloseBtn" data-bs-dismiss="modal" aria-label="Close" onclick='window.location=`./index.php?pag=medicos`;'></button>
                <div class="modal-body">
                    <?php 
                        echo $mensagem; 
                    ?>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_Medico" name="id_Medico" value="<?php echo @$_GET['id'] ?>" required>
                    <input type="hidden" id="status_perfil" name="status_perfil" value="<?php echo $status_perfil ?>" required>

                    <button class="btns btn_cancel" type="button" data-bs-dismiss="modal" onclick='window.location=`./index.php?pag=medicos`;'>Cancelar</button>
                    <button class="btns <?php echo $status_perfil ?>" type="submit"><?php echo $btn; ?></button>
                </div>
                <div id="msg_ModalStatusMedico"></div>
            </form>
        </div>
    </div>

    <!-- Modal Edit medico-->
    <div class="modal fade" id="ModalEditMedico" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <?php
                $id_perfil = $_GET['id'];
                $query = $pdo->query("SELECT * FROM medicos WHERE id = '$id_perfil' LIMIT 1");
                $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                if(@count($dados) > 0){
                    $status_edit = $dados[0]['status_perfil'];
                    $email_edit = $dados[0]['email'];
                    $senha_edit = $dados[0]['senha'];
                    $card_edit = $dados[0]['card_'];
                    $foto_edit = $dados[0]['foto'];
                    $video_edit = $dados[0]['video'];
                    $especialidade_edit = $dados[0]['especialidade'];
                    $nome_edit = $dados[0]['nome'];
                    $documento_edit = $dados[0]['documento'];
                    $descricao_edit = $dados[0]['bio'];
                    $formacoes_edit = $dados[0]['formacoes'];
                    $linkedin_edit = $dados[0]['linkedin'];
                    $instagram_edit = $dados[0]['instagram'];
                    $facebook_edit = $dados[0]['facebook'];
                    $whatsapp_edit = $dados[0]['whatsapp'];
                
                    //tratamentos
                    $descricao_edit = str_replace('<br />', " ", $descricao_edit);
                    $formacoes_edit = str_replace('<br />', " ", $formacoes_edit);
                
                    $nome_novo = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($nome_edit)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                    $nome_tratado = preg_replace('/[ -]+/', '_', $nome_novo);
                
                    $card_edit_antigo = $card_edit;
                    $foto_edit_antigo = $foto_edit;
                    $video_edit_antigo = $video_edit;
                } 
            ?>
            <form id="Form_ModalEditMedico" method="post" class="modal-content">
                <button type="button" class="CloseBtn" data-bs-dismiss="modal" aria-label="Close" onclick='window.location=`./index.php?pag=medicos`;'></button>
                <div class="modal-body">
                    <h2>Edição de perfil</h2>
                    <div id="Block_Infos">
                        <div id="Card_foto_video">
                            <div id="Card_block">
                                <h3>Selecione uma imagem para o perfil do medico</h3>
                                <span>*Tamanho de imagem recomendado: 225 x 375</span>
                                <input type="hidden" id="Card_Input_default" name="Card_Input_default" value="" required>
                                <input type="file" value="<?php echo $card_edit ?>" id="Card_Input" name="Card_Input" onChange="carregaCard();">
                                <?php
                                    if($card_edit == "user_placeholder.webp" || $card_edit == ""){
                                        $card_edit = "
                                            <img class='card' id='target_card' src='../../assets/medicos/user_placeholder.webp'>
                                            <button type='button' class='btns btn_VoltaPadrao_Card_Input hide' onclick='imgPadrao(`Card_Input`, `target_card`, `user_placeholder.webp`, `card`)'>Restaurar imagem</button>
                                        ";
                                    }else{
                                        $card_edit = "
                                            <img class='card imgSelected' id='target_card' src='../../assets/medicos/$nome_tratado/$card_edit'>
                                            <button type='button' class='btns btn_VoltaPadrao_Card_Input' onclick='imgPadrao(`Card_Input`, `target_card`, `user_placeholder.webp`, `card`)'>Restaurar imagem</button>
                                        ";
                                    }
                                    
                                    echo $card_edit;
                                ?>
                                <img class="editPen" onclick="document.getElementById('Card_Input').click();" src="../../assets/sistema/edit.svg" onload="SVGInject(this)">
                            </div>

                            <div id="Foto_block">
                                <h3>Selecione uma imagem para o perfil do medico</h3>
                                <span>*Tamanho de imagem recomendado: 515 x 325</span>
                                <input type="hidden" id="Foto_Input_default" name="Foto_Input_default" value="" required>
                                <input type="file" value="<?php echo $foto_edit ?>" id="Foto_Input" name="Foto_Input" onChange="carregaFoto();">
                                <?php
                                    if($foto_edit == "foto_placeholder.webp" || $foto_edit == ""){
                                        $foto_edit = "
                                            <img class='foto' id='target_foto' src='../../assets/medicos/foto_placeholder.webp'>
                                            <button type='button' class='btns btn_VoltaPadrao_Foto_Input hide' onclick='imgPadrao(`Foto_Input`, `target_foto`, `foto_placeholder.webp`, `foto`)'>Restaurar imagem</button>
                                        ";
                                    }else{
                                        $foto_edit = "
                                            <img class='foto imgSelected' id='target_foto' src='../../assets/medicos/$nome_tratado/$foto_edit'>
                                            <button type='button' class='btns btn_VoltaPadrao_Foto_Input' onclick='imgPadrao(`Foto_Input`, `target_foto`, `foto_placeholder.webp`, `foto`)'>Restaurar imagem</button>
                                        ";
                                    }
                                    
                                    echo $foto_edit;
                                ?>
                                <img class="editPen" onclick="document.getElementById('Foto_Input').click();" src="../../assets/sistema/edit.svg" onload="SVGInject(this)">
                            </div>

                            <div id="Video_block">
                                <h3>Selecione um video para o perfil do medico</h3>
                                <span>*Tamanho de Video recomendado: 1920 x 1080</span>
                                <input type="hidden" id="Video_Input_default" name="Video_Input_default" value="" required>
                                <input type="file" value="<?php echo $video_edit ?>" id="Video_Input" name="Video_Input" onChange="carregaVideo();">
                                <?php
                                    if($video_edit == "video_vazio.mp4" || $video_edit == ""){
                                        $video_edit = "
                                            <video class='video' id='target_video'>
                                                <source src='../../assets/medicos/video_vazio.mp4'>
                                            </video>
                                            <button type='button' class='btns btn_VoltaPadrao_Video_Input hide' onclick='imgPadrao(`Video_Input`, `target_video`, `video_vazio.mp4`, `video`)'>Restaurar imagem</button>
                                        ";
                                    }else{
                                        $video_edit = "
                                            <video class='video imgSelected' id='target_video'>
                                                <source  src='../../assets/medicos/$nome_tratado/$video_edit'>
                                            </video>
                                            <button type='button' class='btns btn_VoltaPadrao_Video_Input' onclick='imgPadrao(`Video_Input`, `target_video`, `video_vazio.mp4`, `video`)'>Restaurar Video</button>
                                        ";
                                    }
                                    
                                    echo $video_edit;
                                ?>
                                <img class="editPen" onclick="document.getElementById('Video_Input').click();" src="../../assets/sistema/edit.svg" onload="SVGInject(this)">
                            </div>
                        </div>
                        <div id="infos">
                            <div class="BlockBox">
                                <input type="text" name="nome" id="nome" value="<?php echo @$nome_edit?>" maxlength="100" required>
                                <span>Seu nome e sobrenome:</span>
                                <p class="lengthInput NomeInput"></p>
                            </div>
                            <div class="BlockBox">
                                <input type="text" name="doc" id="doc" value="<?php echo @$documento_edit?>" maxlength="100" required>
                                <span>Numero de documento (CRM/CRP/Outros):</span>
                            </div>
                            <div class="Seletor">
                                <span>Selecione sua especialidade:</span>
                                <div id="especialidades-select">
                                    <input type="checkbox" id="select_input_espec" onchange="OptionSelection('selected_val_espec', 'select_input_espec', 'options_espec');">

                                    <div id="select-button">
                                        <div id='selected_val_espec'><?php if($especialidade_edit == ""){ echo "Selecione sua especialidade"; } else{ echo $especialidade_edit; } ?></div>
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
                                            if($nome_espec === $especialidade_edit){
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
                                <textarea type="text" name="bio" id="bio" maxlength="5000" required><?php echo $descricao_edit ?></textarea>
                                <span>Sua Biografia:</span>
                            </div>
                            <div class="BlockBox TextAreaBox">
                                <textarea type="text" name="formacoes" id="formacoes" maxlength="1500" required><?php echo $formacoes_edit ?></textarea>
                                <span>Suas Formações:</span>
                            </div>
                            <div class="BlockBox">
                                <input type="text" name="linkedin" id="linkedin" value="<?php echo @$linkedin_edit?>" required>
                                <span><img src="../../assets/sistema/linkedin_full.svg" onload="SVGInject(this)"> Linkedin:</span>
                            </div>
                            <div class="BlockBox">
                                <input type="text" name="instagram" id="instagram" value="<?php echo @$instagram_edit?>" required>
                                <span><img src="../../assets/sistema/instagram_full.svg" onload="SVGInject(this)"> Instagram:</span>
                            </div>
                            <div class="BlockBox">
                                <input type="text" name="facebook" id="facebook" value="<?php echo @$facebook_edit?>" required>
                                <span><img src="../../assets/sistema/facebook_full.svg" onload="SVGInject(this)"> Facebook:</span>
                            </div>
                            <div class="BlockBox">
                                <input type="text" name="whatsapp" id="whatsapp" value="<?php echo @$whatsapp_edit?>" required>
                                <span><img src="../../assets/sistema/whatsapp_full.svg" onload="SVGInject(this)"> Whatsapp:</span>
                            </div>
                        </div>
                    </div>
                    <div id="Block_SenhaEmail">
                        <div id="EmailTrocaBox">
                            <h4>Alteração de Email:</h4>
                            <div id="EditEmailUser">
                                <div class="BlockBox">
                                    <input type="text" name="novoEmailEditMedico" id="novoEmailEditMedico" maxlength="50" required>
                                    <span>Novo e-mail:</span>
                                    <p class="lengthInput novoEmailEditInput"></p>
                                </div>
                                <div class="BlockBox">
                                    <input type="text" name="confirmaNovoEmailEditMedico" id="confirmaNovoEmailEditMedico" maxlength="50" required>
                                    <span>Confirma novo e-mail:</span>
                                    <p class="lengthInput ConfirmaNovoEmailEditInput"></p>
                                </div>
                            </div>
                        </div>

                        <div id="SenhaTrocaBox">
                            <h4>Alteração de Senha:</h4>
                            <div id="EditSenhaUser">
                                <div class="BlockBox senhaInput">
                                    <input type="password" name="novaSenhaEditMedico" id="novaSenhaEditMedico" maxlength="25" required>
                                    <span>Nova senha:</span>
                                    <div id="eye_boxRecup" onclick="ShowPass(`4`)">
                                        <img id="eyeRecup" src="../../assets/sistema/eye.svg" onload="SVGInject(this)">
                                        <img id="eye_slashRecup" class="hide" src="../../assets/sistema/eye_slash.svg" onload="SVGInject(this)">
                                    </div>
                                    <p class="lengthInput NovaSenhaEditInput"></p>
                                </div>
                                <div class="BlockBox senhaInput">
                                    <input type="password" name="confirmaNovaSenhaEditMedico" id="confirmaNovaSenhaEditMedico" maxlength="25" required>
                                    <span>Confirma nova senha:</span>
                                    <div id="eye_box_RecupRepet" onclick="ShowPass(`5`)">
                                        <img id="eye_RecupRepet" src="../../assets/sistema/eye.svg" onload="SVGInject(this)">
                                        <img id="eye_slash_RecupRepet" class="hide" src="../../assets/sistema/eye_slash.svg" onload="SVGInject(this)">
                                    </div>
                                    <p class="lengthInput ConfirmaNovaSenhaEditInput"></p>
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
                <div class="modal-footer">
                    <button class="btns btn_cancel" type="button" data-bs-dismiss="modal" onclick='window.location=`./index.php?pag=medicos`;'>Cancelar</button>
                    <?php
                        echo '
                            <input type="hidden" id="id_Edit_Medico" name="id_Edit_Medico" value="'.@$_GET['id'].'" required>
                            <input type="hidden" id="card_edit" name="card_edit" value="'.$card_edit_antigo.'">
                            <input type="hidden" id="foto_edit" name="foto_edit" value="'.$foto_edit_antigo.'">
                            <input type="hidden" id="video_edit" name="video_edit" value="'.$video_edit_antigo.'">
                            <input type="hidden" id="nome_antigo" name="nome_antigo" value="'.$nome_edit.'">
                            <input type="hidden" id="emailMedicoSemAlteracoes" name="emailMedicoSemAlteracoes" value="'.$email_edit.'">
                            <input type="hidden" id="senhaMedicoSemAlteracoes" name="senhaMedicoSemAlteracoes" value="'.$senha_edit.'">
                        ';

                        if($nome_edit != "") {
                            echo '<button class="btns btn_salvar" type="submit" id="btn_salva">Salvar alterações</button>';
                        } else {
                            echo '<button class="btns btn_salvar" type="submit" id="btn_salva">Ativar perfil</button>';
                        }
                    ?>
                </div>
                <div id="msg_ModalEditMedico"></div>
            </form>
        </div>
    </div>

    <!-- FUNÇÕES PHP NA CHAMADA DE MODAL -->
    <?php
        if (@$_GET["funcao"] == "novoMedico") {
            echo "
                <button id='openModalCriaMedico' class='hide' type='button' data-bs-toggle='modal' data-bs-target='#ModalCriaMedico'></button>
                <script language='javascript'>$('#openModalCriaMedico').click();</script>
            ";
        }
        else if(@$_GET["funcao"] == "statusMedico"){
            echo "
                <button id='openModalStatusPerfil' class='hide' type='button' data-bs-toggle='modal' data-bs-target='#ModalStatusPerfil'></button>
                <script language='javascript'>$('#openModalStatusPerfil').click();</script>
            ";
        }
        else if (@$_GET["funcao"] == "editMedico") {
            echo "
                <button id='openModalEditMedico' class='hide' type='button' data-bs-toggle='modal' data-bs-target='#ModalEditMedico'></button>
                <script language='javascript'>$('#openModalEditMedico').click();</script>
            ";
        }
        else if (@$_GET["funcao"] == "deletMedico") {
            echo "
                <button id='openModalDeletMedico' class='hide' type='button' data-bs-toggle='modal' data-bs-target='#ModalDeletMedico'></button>
                <script language='javascript'>$('#openModalDeletMedico').click();</script>
            ";
        }
    ?>

    <script>
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

        //RESET DE IMG
        function imgPadrao(inputId, targetId, placeholder, imgContainerClass) {
            document.getElementById(targetId).src = '../../assets/medicos/' + placeholder;
            document.getElementById(inputId + '_default').value = 'true';
            document.querySelector('.btn_VoltaPadrao_' + inputId).classList.add('hide');
            document.querySelector('.' + imgContainerClass).classList.remove('imgSelected');
        }

        //UPLOAD DAS INFOS NO BANCO DE DADOS
        $("#Form_ModalCriaMedico").submit(function (e) {
            e.preventDefault();
            $('#msg_ModalCriaMedico').text('');
            $('#msg_ModalCriaMedico').removeClass('text-danger');
            $('#msg_ModalCriaMedico').removeClass('text-warning');
            $('#msg_ModalCriaMedico').removeClass('text-success');
            $.ajax({
                url: "Medicos/insert.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (msg) {
                    if (msg.trim() === "Perfil de medico(a) criado com Sucesso!!") {
                        $('#msg_ModalCriaMedico').addClass('text-success');
                        $('#msg_ModalCriaMedico').text(msg);
                        setTimeout(() => { window.location='./index.php?pag=medicos'; }, 1500);
                    }
                    if (msg.trim() === "E-mail ja cadastrado no banco de dados!!") {
                        $('#msg_ModalCriaMedico').addClass('text-danger');
                        $('#msg_ModalCriaMedico').text(msg);
                    }
                    else {
                        $('#msg_ModalCriaMedico').addClass('text-warning');
                        $('#msg_ModalCriaMedico').text('O perfil foi criado!! Mas o e-mail com link de acesso para o novo medico não pode ser enviado por falhas com a comunicação do servidor.');
                        setTimeout(() => { window.location='./index.php?pag=medicos'; }, 5000);
                    }
                }
            });
        });

        $('#Form_ModalDeletMedico').submit(function (e) {
            e.preventDefault();
            $('#msg_ModalDeletMedico').text('');
            $('#msg_ModalDeletMedico').removeClass('text-danger');
            $('#msg_ModalDeletMedico').removeClass('text-success');
            $.ajax({
                url: "Medicos/delete.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (msg) {
                    if (msg.trim() === "Excluído com Sucesso!!") {
                        $('#msg_ModalDeletMedico').addClass('text-success');
                        $('#msg_ModalDeletMedico').text(msg);
                        setTimeout(() => { window.location='./index.php?pag=medicos'; }, 1500);
                    }
                    else{
                        $('#msg_ModalDeletMedico').addClass('text-danger');
                        $('#msg_ModalDeletMedico').text(msg)
                    }
                }
            })
        });

        $('#Form_ModalStatusMedico').submit(function (e) {
            e.preventDefault();
            $('#msg_ModalStatusMedico').text('');
            $('#msg_ModalStatusMedico').removeClass('text-danger');
            $('#msg_ModalStatusMedico').removeClass('text-success');
            $.ajax({
                url: "Medicos/status_update.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (msg) {
                    if (msg.trim() === "Status atualizado com Sucesso!!") {
                        $('#msg_ModalStatusMedico').addClass('text-success');
                        $('#msg_ModalStatusMedico').text(msg);
                        setTimeout(() => { window.location='./index.php?pag=medicos'; }, 2000);
                    }
                    else{
                        $('#msg_ModalStatusMedico').addClass('text-danger');
                        $('#msg_ModalStatusMedico').text(msg)
                    }
                }
            })
        });

        $('.btn_salvar').click(function (e) {
            $('#formacoes').prop('required',false);
            $('#bio').prop('required',false);
            $('#linkedin').prop('required',false);
            $('#instagram').prop('required',false);
            $('#facebook').prop('required',false);
            $('#whatsapp').prop('required',false);

            $('#novoEmailEditMedico').prop('required',false);
            $('#confirmaNovoEmailEditMedico').prop('required',false);

            $('#novaSenhaEditMedico').prop('required',false);
            $('#confirmaNovaSenhaEditMedico').prop('required',false);
        });

        $("#Video_Input").change(function(e){ 
            const fileSize = e.target.files[0].size / 1024 / 1024; // para mb
            if (fileSize > 20) {
                $('#btn_salva').addClass('btn_desativado');
                $('#btn_salva').removeAttr('type');
                $('#msg_ModalEditMedico').addClass('text-danger');
                $('#msg_ModalEditMedico').text('Tamanho do vídeo excedeu o limite do servidor! Apenas vídeos menores que 20 MB são aceitos. Selecione outro video para salvar alterações');
            }
            if (fileSize < 20) {
                $('#btn_salva').removeClass('btn_desativado');
                $('#btn_salva').attr('type', 'submit');
                $('#msg_ModalEditMedico').removeClass('text-danger');
                $('#msg_ModalEditMedico').text('');
            }
        });

        $("#Form_ModalEditMedico").submit(function (e) {
            e.preventDefault();
            $('#msg_ModalEditMedico').text('');
            $('#msg_ModalEditMedico').removeClass('text-danger');
            $('#msg_ModalEditMedico').removeClass('text-success');
            $.ajax({
                url: "Medicos/insert_dados_edit.php",
                type: 'POST',
                data: new FormData(this),
                success: function (msg) {
                    if (msg.trim() === "Perfil Atualizado com Sucesso!!") {
                        $('#msg_ModalEditMedico').addClass('text-success');
                        $('#msg_ModalEditMedico').text(msg);
                        setTimeout(() => { window.location='./index.php?pag=medicos'; }, 2000);
                    }
                    else {
                        $('#msg_ModalEditMedico').addClass('text-danger');
                        $('#msg_ModalEditMedico').text(msg);
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
    </script>
</section>
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
                $card = $dados[$i]['card'];
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
            </form>
        </div>
        <div id="msg_ModalCriaMedico"></div>
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
            </form>
            <div id="msg_ModalDeletMedico"></div>
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
                        // echo $mensagem; 
                    ?>
                </div>

                <div class="modal-footer">
                    <input type="hidden" id="id_Medico" name="id_Medico" value="<?php echo @$_GET['id'] ?>" required>
                    <input type="hidden" id="status_perfil" name="status_perfil" value="<?php echo $status_perfil ?>" required>

                    <button class="btns btn_cancel" type="button" data-bs-dismiss="modal" onclick='window.location=`./index.php?pag=medicos`;'>Cancelar</button>
                    <button class="btns <?php 
                    // echo $status_perfil 
                    ?>" type="submit"><?php 
                    // echo $btn; 
                    ?></button>
                </div>
            </form>
            <div id="msg_ModalStatusMedico"></div>
        </div>
    </div>

    <!-- Modal Edit medico-->
    <!-- <div class="modal fade" id="ModalEditMedico" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">

            <?php
                // $id_perfil = $_GET['id'];

                // $query = $pdo->query("SELECT * FROM medicos WHERE id = '$id_perfil' LIMIT 1");
                // $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                // if(@count($dados) > 0){
                //     $email = $dados[0]['email'];
                //     $senha = $dados[0]['senha'];
                //     $imagem = $dados[0]['foto'];
                //     $especialidade = $dados[0]['especialidade'];
                //     $nome_user = $dados[0]['nome'];
                //     $documento = $dados[0]['documento'];
                //     $estado = $dados[0]['estado'];
                //     $tipoAtendimento = $dados[0]['tipo_atendimento'];
                //     $abordagem = $dados[0]['abordagem'];
                //     $publico = $dados[0]['publico'];
                //     $descricao = $dados[0]['bio'];

                //     $linkedin = $dados[0]['linkedin'];
                //     $instagram = $dados[0]['instagram'];
                //     $facebook = $dados[0]['facebook'];
                //     $whatsapp = $dados[0]['whatsapp'];

                //     $publico = str_replace('<br />', " ", $publico);
                //     $descricao = str_replace('<br />', " ", $descricao);
                // } 

            ?>

            <form id="Form_ModalEditMedico" method="post" class="modal-content">
                <button type="button" class="CloseBtn" data-bs-dismiss="modal" aria-label="Close" onclick='window.location=`./index.php?pag=medicos`;'></button>
                <div class="modal-body">
                    <h2>Edição de perfil</h2>

                    <div id="Block_Infos">
                        <div id="imgUser_block">
                            <input type="file" value="<?php 
                            // echo @$imagem 
                            ?>" id="img_User_Input" name="img_User_Input" onChange="carregarImgWeb();">
                            <?php
                                // if(@$imagem == "user_placeholder.webp" || @$imagem == ""){
                                //     $imagem = "<img class='img_user' id='target_img' src='../../../Clinica/assets/users/user_placeholder.webp'>";
                                // }else{
                                //     $imagem = "<img class='img_user imgSelected' id='target_img' src='../../../Clinica/assets/users/$imagem'>";
                                // }
                                
                                // echo $imagem;
                            ?>
                            <img class="editPen" onclick="document.getElementById('img_User_Input').click();" src="../../../assets/sistema/edit.svg" onload="SVGInject(this)">
                        </div>

                        <div id="infos">
                            <div class="BlockBox">
                                <input type="text" name="nome" id="nome" value="<?php 
                                // echo @$nome_user 
                                ?>" maxlength="100" required>
                                <span>Seu nome e sobrenome:</span>
                                <p class="lengthInput NomeInput"></p>
                            </div>
                            <div class="BlockBox">
                                <input type="text" name="doc" id="doc" value="<?php 
                                // echo @$documento 
                                ?>" maxlength="100" required>
                                <span>Numero de documento (CRM/CRP/Outros):</span>
                            </div>
                            <div class="Seletor">
                                <div id="especialidades-select">
                                    <input type="checkbox" id="select_input_espec" onchange="OptionSelection('selected_val_espec', 'select_input_espec', 'options_espec');">

                                    <div id="select-button">
                                        <div id='selected_val_espec'><?php
                                        // if($especialidade == ""){ echo "Selecione sua especialidade"; } else{ echo $especialidade; } 
                                        ?></div>
                                        <img src="../../../assets/sistema/seta_fina.svg" onload="SVGInject(this)">
                                    </div>
                                </div>
                                
                                <ul id="options">
                                    <?php 
                                        // $query = $pdo->query("SELECT * FROM especialidade ORDER BY id DESC");
                                        // $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                                        // for ($i=0; $i < count($dados); $i++) {
                                        //     $nome_espec = $dados[$i]['nome'];
                                        //     if($nome_espec === $especialidade){
                                        //         echo "
                                        //             <li class='options_espec'>
                                        //                 <input type='radio' name='especialidade' value='$nome_espec' data-label='$nome_espec' checked>
                                        //                 <span class='label'>$nome_espec</span>
                                        //             </li>
                                        //         ";
                                        //     }
                                        //     else{
                                        //         echo "
                                        //             <li class='options_espec'>
                                        //                 <input type='radio' name='especialidade' value='$nome_espec' data-label='$nome_espec'>
                                        //                 <span class='label'>$nome_espec</span>
                                        //             </li>
                                        //         ";
                                        //     }
                                        // }
                                    ?>
                                </ul>
                            </div>
                            <div class="Seletor">
                                <div id="atendimento-select">
                                    <input type="checkbox" id="select_input_atendimento" onchange="OptionSelection('selected_val_atendimento', 'select_input_atendimento', 'options_atendimento');">

                                    <div id="select-button">
                                        <div id='selected_val_atendimento'><?php
                                         if($tipoAtendimento == ""){ echo "Selecione a sua modalidade de atendimento"; } else{ echo $tipoAtendimento; } 
                                         ?></div>
                                        <img src="../../../assets/sistema/seta_fina.svg" onload="SVGInject(this)">
                                    </div>
                                </div>
                                <ul id="options">
                                    <?php 
                                        // if($tipoAtendimento != ""){
                                        //     if($tipoAtendimento == "Online&Presencial"){ $tipoAtendimento = "Online e Presencial"; }
                                        //     echo "
                                        //         <li class='options_atendimento'>
                                        //             <input type='radio' name='atendimento' value='$tipoAtendimento' data-label='$tipoAtendimento' checked>
                                        //             <span class='label'>$tipoAtendimento</span>
                                        //         </li>
                                        //     ";
                                        // }
                                    ?>
                                    <li class='options_atendimento'>
                                        <input type='radio' name='atendimento' value='Online' data-label='Online'>
                                        <span class='label'>Online</span>
                                    </li>
                                    <li class='options_atendimento'>
                                        <input type='radio' name='atendimento' value='Presencial' data-label='Presencial'>
                                        <span class='label'>Presencial</span>
                                    </li>
                                    <li class='options_atendimento'>
                                        <input type='radio' name='atendimento' value='Online&Presencial' data-label='Online e Presencial'>
                                        <span class='label'>Online e Presencial</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="Seletor">
                                <div id="abordagem-select">
                                    <input type="checkbox" id="select_input_abordagem" onchange="OptionSelection('selected_val_abordagem', 'select_input_abordagem', 'options_abordagem');">

                                    <div id="select-button">
                                        <div id='selected_val_abordagem'><?php 
                                        // if($abordagem == ""){ echo "Selecione seu estilo de abordagem"; } else{ echo $abordagem; } 
                                        ?></div>
                                        <img src="../../../assets/sistema/seta_fina.svg" onload="SVGInject(this)">
                                    </div>
                                </div>
                                
                                <ul id="options">
                                    <?php 
                                        // $query = $pdo->query("SELECT * FROM abordagem ORDER BY id DESC");
                                        // $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                                        // for ($i=0; $i < count($dados); $i++) {
                                        //     $nome_abordagem = $dados[$i]['nome'];
                                        //     if($nome_abordagem === $abordagem){
                                        //         echo "
                                        //             <li class='options_abordagem'>
                                        //                 <input type='radio' name='abordagem' value='$nome_abordagem' data-label='$nome_abordagem' checked>
                                        //                 <span class='label'>$nome_abordagem</span>
                                        //             </li>
                                        //         ";
                                        //     }
                                        //     else{
                                        //         echo "
                                        //             <li class='options_abordagem'>
                                        //                 <input type='radio' name='abordagem' value='$nome_abordagem' data-label='$nome_abordagem'>
                                        //                 <span class='label'>$nome_abordagem</span>
                                        //             </li>
                                        //         ";
                                        //     }
                                        // }
                                    ?>
                                </ul>
                            </div>
                            <div class="BlockBox TextAreaBox">
                                <textarea type="text" name="publico_alvo" id="publico_alvo" maxlength="1500" required><?php echo $publico ?></textarea>
                                <span>Seu publico alvo:</span>
                            </div>
                            <div class="BlockBox TextAreaBox">
                                <textarea type="text" name="bio" id="bio" maxlength="5000" required><?php echo $descricao ?></textarea>
                                <span>Sua Biografia:</span>
                            </div>
                            <div class="BlockBox">
                                <input type="text" name="linkedin" id="linkedin" value="<?php echo @$linkedin?>" required>
                                <span><img src="../../Clinica/assets/icons/linkedin_full.svg" onload="SVGInject(this)"> Linkedin:</span>
                            </div>
                            <div class="BlockBox">
                                <input type="text" name="instagram" id="instagram" value="<?php echo @$instagram?>" required>
                                <span><img src="../../Clinica/assets/icons/instagram_full.svg" onload="SVGInject(this)"> Instagram:</span>
                            </div>
                            <div class="BlockBox">
                                <input type="text" name="facebook" id="facebook" value="<?php echo @$facebook?>" required>
                                <span><img src="../../Clinica/assets/icons/facebook_full.svg" onload="SVGInject(this)"> Facebook:</span>
                            </div>
                            <div class="BlockBox">
                                <input type="text" name="whatsapp" id="whatsapp" value="<?php echo @$whatsapp?>" required>
                                <span><img src="../../Clinica/assets/icons/whatsapp_full.svg" onload="SVGInject(this)"> Whatsapp:</span>
                            </div>
                        </div>
                    </div>

                    <div id="Block_SenhaEmail">
                        <div id="EmailTroca">
                            <h4>Alteração de Email:</h4>
                            <div id="EditEmailUser">
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
                            </div>
                        </div>

                        <div id="SenhaTroca">
                            <h4>Alteração de Senha:</h4>
                            <div id="EditSenhaUser">
                                <div class="BlockBox senhaInput">
                                    <input type="password" name="novaSenha" id="novaSenha" maxlength="25" required>
                                    <span>Nova senha:</span>
                                    <div id="eye_boxRecup" onclick="ShowPass(`2`)">
                                        <img id="eyeRecup" src="../../../assets/Login/eye.svg" onload="SVGInject(this)">
                                        <img id="eye_slashRecup" class="hide" src="../../../assets/Login/eye_slash.svg" onload="SVGInject(this)">
                                    </div>
                                    <p class="lengthInput NovaSenhaEditInput"></p>
                                </div>
                                <div class="BlockBox senhaInput">
                                    <input type="password" name="confirmaNovaSenha" id="confirmaNovaSenha" maxlength="25" required>
                                    <span>Confirma nova senha:</span>
                                    <div id="eye_box_RecupRepet" onclick="ShowPass(`3`)">
                                        <img id="eye_RecupRepet" src="../../../assets/Login/eye.svg" onload="SVGInject(this)">
                                        <img id="eye_slash_RecupRepet" class="hide" src="../../../assets/Login/eye_slash.svg" onload="SVGInject(this)">
                                    </div>
                                    <p class="lengthInput ConfirmaNovaSenhaEditInput"></p>
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
                
                <div class="modal-footer">
                    <input type="hidden" id="id_Edit_Medico" name="id_Edit_Medico" value="<?php echo @$_GET['id'] ?>" required>
                    
                    <input value="<?php echo $email ?>" class="hide" type="hidden" name="emailUserSemAlteracoes" id="emailUserSemAlteracoes">
                    <input value="<?php echo $senha ?>" class="hide" type="hidden" name="senhaUserSemAlteracoes" id="senhaUserSemAlteracoes">

                    <button class="btns btn_cancel" type="button" data-bs-dismiss="modal" onclick='window.location=`./index.php?pag=medicos`;'>Cancelar</button>
                    <button class="btns btn_salvar" type="submit">Salvar alterações</button>
                </div>
            </form>

            <div id="msg_ModalEditMedico"></div>
        </div>
    </div> -->
    

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
        //CHAMADA DE FUNÇÃO PARA UPLOAD DE IMG BANCO DE DADOS
        function carregarImgWeb(){ carregarImagem('img_User_Input', 'target_img', "../../Clinica/assets/users/user_placeholder.webp", 'img_user'); }

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
    </script>
</section>
<section id="Tratamentos">

    <a class="btns btn_cria" href="index.php?pag=tratamentos&funcao=novoTratamento">
        <p>Novo Tratamento</p>
    </a>

    <div id="List_Tratamentos">
        <?php
            $query = $pdo->query("SELECT * FROM especialidade ORDER BY id DESC");
            $dados = $query->fetchAll(PDO::FETCH_ASSOC);
            for ($i=0; $i < count($dados); $i++) { 

                $id_espec = $dados[$i]['id'];
                $foto_espec = $dados[$i]['foto'];
                $nome_espec = $dados[$i]['nome'];

                if(@$foto_espec == "placeholder.webp" || @$foto_espec == ""){
                    $foto_espec =  "<img class='icon_espec' src='../../assets/especialidades/placeholder.webp'>";
                }else{
                    $foto_espec =  "<img class='icon_espec' src='../../assets/especialidades/$foto_espec'>";
                }

                echo "
                    <div class='espec_card'>
                        ".$foto_espec."
                        <p>".$nome_espec."</p>
                        <div class='acoes'>
                            <a href='index.php?pag=especialidades&funcao=editEspecialidade&id=".$id_espec."'><img src='../../assets/sistema/edit.svg'></a>
                            <a href='index.php?pag=especialidades&funcao=deletEspecialidade&id=".$id_espec."'><img src='../../assets/sistema/delet.svg'></a>
                        </div>
                    </div>
                ";
            }
        ?>
    </div>

    <!-- Modal Cria / Editar tratamentos -->
    <div class="modal fade" id="ModalTratamentos" tabindex="-1">
        <div class="modal-dialog">
            <form id="Form_ModalTratamento" method="POST" class="modal-content">
                <?php 
                    if (@$_GET['funcao'] == 'editTratamento') {
                        $titulo_trat = "Edição de tratamento!";
                        $btn_trat = "Salvar edição";

                        $id_trat_edit = $_GET['id'];

                        $query = $pdo->query("SELECT * FROM tratamentos WHERE id = '$id_trat_edit' LIMIT 1");
                        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                        if(@count($dados) > 0){
                            $nome_trat_edit = $dados[0]['nome'];
                            $descri_trat_edit = $dados[0]['descricao'];

                            $descri_trat_edit = str_replace('<br />', " ", $descri_trat_edit);
                        }
                    } 
                    else{ 
                        $titulo_trat = "Novo Tratamento!"; 
                        $btn_trat = "Salvar tratamento";

                        $card_edit = "";
                        $especialidade_edit = "";
                    }
                ?>
                <button type="button" class="CloseBtn" data-bs-dismiss="modal" aria-label="Close" onclick='window.location=`./index.php?pag=tratamentos`;'></button>
                <div class="modal-body">
                    <h4><?php echo $titulo_trat ?></h4>

                    <div id="Card_foto_video">
                        <div id="Card_block">
                            <h3>Selecione uma card para o tratamento</h3>
                            <span>*Tamanho recomendado: 225 x 375</span>
                            <input type="hidden" id="Card_Input_default" name="Card_Input_default" value="" required>
                            <input type="file" value="<?php echo $card_edit ?>" id="Card_Input" name="Card_Input" onChange="carregaCard();">
                            <?php
                                if($card_edit == "card_placeholder.webp" || $card_edit == ""){
                                    $card_edit = "
                                        <img class='card' id='target_card' src='../../assets/tratamentos/card_placeholder.webp'>
                                        <button type='button' class='btns btn_VoltaPadrao_Card_Input hide' onclick='imgPadrao(`Card_Input`, `target_card`, `card_placeholder.webp`, `card`)'>Restaurar imagem</button>
                                    ";
                                }else{
                                    $card_edit = "
                                        <img class='card imgSelected' id='target_card' src='../../assets/tratamentos/$nome_tratado/$card_edit'>
                                        <button type='button' class='btns btn_VoltaPadrao_Card_Input' onclick='imgPadrao(`Card_Input`, `target_card`, `card_placeholder.webp`, `card`)'>Restaurar imagem</button>
                                    ";
                                }
                                
                                echo $card_edit;
                            ?>
                            <img class="editPen" onclick="document.getElementById('Card_Input').click();" src="../../assets/sistema/edit.svg" onload="SVGInject(this)">
                        </div>
                    </div>
                    <div id="infos">
                        <div class="BlockBox">
                            <input type="text" name="nome" id="nome" value="<?php echo @$nome_edit?>" maxlength="100" required>
                            <span>Titulo:</span>
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
                            <textarea type="text" name="desc" id="desc" maxlength="5000" required><?php echo @$descricao_edit ?></textarea>
                            <span>Descrição:</span>
                        </div>
                        <div class="BlockBox TextAreaBox">
                            <textarea type="text" name="etapas" id="etapas" maxlength="5000" required><?php echo @$etapas_edit ?></textarea>
                            <span>Etapas:</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_trat_edit" name="id_trat_edit" value="<?php echo @$id_trat_edit ?>" required>
                    <input type="hidden" id="nome_trat_edit" name="nome_trat_edit" value="<?php echo @$nome_trat_edit ?>" required>
                    
                    <button class="btns btn_cancel" type="button" data-bs-dismiss="modal" onclick='window.location=`./index.php?pag=tratamentos`;'>Cancelar</button>
                    <button class="btns btn_salvar" type="submit"><?php echo $btn_trat ?></button>
                </div>
                <div id="msg_ModalTratamento"></div>
            </form>
        </div>
    </div>
    
    <!-- Modal Delete tratamentos -->
    <div class="modal fade" id="ModalDeletTratamentos" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="Form_ModalDeletTratamentos" method="post" class="modal-content">
                <button type="button" class="CloseBtn" data-bs-dismiss="modal" aria-label="Close" onclick='window.location=`./index.php?pag=tratamentos`;'></button>
                <div class="modal-body">
                    <h4>Gostaria mesmo de excluir este tratamento?</h4>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_trat_delete" name="id_trat_delete" value="<?php echo @$_GET['id'] ?>" required>

                    <button class="btns btn_cancel" type="button" data-bs-dismiss="modal" onclick='window.location=`./index.php?pag=tratamentos`;'>Cancelar</button>
                    <button class="btns btn_excluir" type="submit">Excluir</button>
                </div>
                <div id="msg_ModalDeletTratamentos"></div>
            </form>
        </div>
    </div>

    <!-- FUNÇÕES PHP NA CHAMADA DE MODAL -->
    <?php
        if (@$_GET["funcao"] == "novoTratamento" || @$_GET["funcao"] == "editTratamento") {
            echo "
                <button id='openModalTratamentos' class='hide' type='button' data-bs-toggle='modal' data-bs-target='#ModalTratamentos'></button>
                <script language='javascript'>$('#openModalTratamentos').click();</script>
            ";
        }
        if (@$_GET["funcao"] == "deletTratamentos") {
            echo "
                <button id='openModalDeletTratamentos' class='hide' type='button' data-bs-toggle='modal' data-bs-target='#ModalDeletTratamentos'></button>
                <script language='javascript'>$('#openModalDeletTratamentos').click();</script>
            ";
        }
    ?>

    <script>
        //CHAMADA DE FUNÇÃO PARA UPLOAD DE IMG BANCO DE DADOS
        function carregaCard(){ carregarImagem('Card_Input', 'target_card', '../../assets/tratamentos/card_placeholder.webp', 'card'); }


        //RESET DE IMG
        function imgPadrao(inputId, targetId, placeholder, imgContainerClass) {
            document.getElementById(targetId).src = '../../assets/tratamentos/' + placeholder;
            document.getElementById(inputId + '_default').value = 'true';
            document.querySelector('.btn_VoltaPadrao_' + inputId).classList.add('hide');
            document.querySelector('.' + imgContainerClass).classList.remove('imgSelected');
        }

        //UPLOAD DAS INFOS NO BANCO DE DADOS
        $("#Form_ModalEspecialidade").submit(function (e) {
            e.preventDefault();
            $('#msg_ModalEspecialidade').text('');
            $('#msg_ModalEspecialidade').removeClass('text-danger');
            $('#msg_ModalEspecialidade').removeClass('text-success');
            $.ajax({
                url: "Especialidades/insert_Edit.php",
                type: 'POST',
                data: new FormData(this),
                success: function (msg) {
                    if (msg.trim() === "Especialidade adicionada com Sucesso!!" || msg.trim() === "Especialidade Atualizada com Sucesso!!" ) {
                        $('#msg_ModalEspecialidade').addClass('text-success');
                        $('#msg_ModalEspecialidade').text(msg);
                        setTimeout(() => { window.location='./index.php?pag=especialidades'; }, 1500);
                    }
                    else {
                        $('#msg_ModalEspecialidade').addClass('text-danger');
                        $('#msg_ModalEspecialidade').text(msg);
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
        
        $('#Form_ModalDeletEspecialidade').submit(function (e) {
            e.preventDefault();
            $('#msg_ModalDeletEspecialidade').text('');
            $('#msg_ModalDeletEspecialidade').removeClass('text-danger');
            $('#msg_ModalDeletEspecialidade').removeClass('text-success');
            $.ajax({
                url: "Especialidades/delete.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (msg) {
                    if (msg.trim() === "Excluído com Sucesso!!") {
                        $('#msg_ModalDeletEspecialidade').addClass('text-success');
                        $('#msg_ModalDeletEspecialidade').text(msg);
                        setTimeout(() => { window.location='./index.php?pag=especialidades'; }, 1500);
                    }
                    else{
                        $('#msg_ModalDeletEspecialidade').addClass('text-danger');
                        $('#msg_ModalDeletEspecialidade').text(msg)
                    }
                }
            })
        });
    </script>
</section>
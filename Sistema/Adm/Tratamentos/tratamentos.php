<section id="Tratamentos">

    <a class="btns btn_cria" href="index.php?pag=tratamentos&funcao=novoTratamento">
        <p>Novo Tratamento</p>
    </a>

    <div id="List_Tratamentos">
        <?php
            $query = $pdo->query("SELECT * FROM tratamentos ORDER BY id DESC");
            $dados = $query->fetchAll(PDO::FETCH_ASSOC);
            for ($i=0; $i < count($dados); $i++) { 

                $id = $dados[$i]['id'];
                $card_Banner = $dados[$i]['card_banner'];
                $titulo = $dados[$i]['titulo'];
                $especialidade_atr = $dados[$i]['especialidade_atr'];

                $titulo_novo = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($titulo)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                $titulo_tratado = preg_replace('/[ -]+/', '_', $titulo_novo);

                if($card_Banner == "card_placeholder.webp" || $card_Banner == ""){
                    $card_Banner = "<img class='card_banner' src='../../assets/tratamentos/card_placeholder.webp'>";
                }else{
                    $card_Banner = "<img class='card_banner' src='../../assets/tratamentos/$titulo_tratado/$card_Banner'>";
                }

                echo "
                    <div class='tratamentos_card'>
                        ".$card_Banner."
                        <p>".$titulo."</p>
                        <span>Especialidade: <b>".$especialidade_atr."</b></span>

                        <div class='acoes'>
                            <a href='index.php?pag=tratamentos&funcao=editTratamento&id=".$id."'><img src='../../assets/sistema/edit.svg'></a>
                            <a href='index.php?pag=tratamentos&funcao=deletTratamentos&id=".$id."'><img src='../../assets/sistema/delet.svg'></a>
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
                        $titulo_modal_trat = "Edição de tratamento!";
                        $btn_trat = "Salvar alterações";

                        $id_trat_edit = $_GET['id'];

                        $query = $pdo->query("SELECT * FROM tratamentos WHERE id = '$id_trat_edit' LIMIT 1");
                        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                        if(@count($dados) > 0){
                            $card_edit = $dados[0]['card_banner'];
                            $titulo_edit = $dados[0]['titulo'];
                            $especialidade_edit = $dados[0]['especialidade_atr'];
                            $descricao_edit = $dados[0]['descricao'];
                            $etapas_edit = $dados[0]['etapas'];
                           
                            $titulo_novo = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($titulo_edit)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                            $titulo_tratado = preg_replace('/[ -]+/', '_', $titulo_novo);

                            $descricao_edit = str_replace('<br />', " ", $descricao_edit);
                            $etapas_edit = str_replace('<br />', " ", $etapas_edit);

                            //IMGS E VIDEOS
                            $foto01 = $dados[0]['foto_relac_01'];
                            $foto02 = $dados[0]['foto_relac_02'];
                            $foto03 = $dados[0]['foto_relac_03'];
                            $foto04 = $dados[0]['foto_relac_04'];

                            $video01 = $dados[0]['video_relac_01'];
                            $video02 = $dados[0]['video_relac_02'];

                            $card_edit_antigo = $card_edit;

                            $foto01_edit_antigo = $foto01;
                            $foto02_edit_antigo = $foto02;
                            $foto03_edit_antigo = $foto03;
                            $foto04_edit_antigo = $foto04;

                            $video01_edit_antigo = $video01;
                            $video02_edit_antigo = $video02;


                            //PERGUNTAS E RESPOSTAS
                            $pgnt_01 = $dados[0]['pgnt_01'];
                            $pgnt_02 = $dados[0]['pgnt_02'];
                            $pgnt_03 = $dados[0]['pgnt_03'];
                            $pgnt_04 = $dados[0]['pgnt_04'];
                            $pgnt_05 = $dados[0]['pgnt_05'];
                            $pgnt_06 = $dados[0]['pgnt_06'];

                            $resp_01 = $dados[0]['resp_01'];
                            $resp_02 = $dados[0]['resp_02'];
                            $resp_03 = $dados[0]['resp_03'];
                            $resp_04 = $dados[0]['resp_04'];
                            $resp_05 = $dados[0]['resp_05'];
                            $resp_06 = $dados[0]['resp_06'];

                            $resp_01 = str_replace('<br />', " ", $resp_01);
                            $resp_02 = str_replace('<br />', " ", $resp_02);
                            $resp_03 = str_replace('<br />', " ", $resp_03);
                            $resp_04 = str_replace('<br />', " ", $resp_04);
                            $resp_05 = str_replace('<br />', " ", $resp_05);
                            $resp_06 = str_replace('<br />', " ", $resp_06);
                        }
                    } 
                    else{ 
                        $titulo_modal_trat = "Novo Tratamento!"; 
                        $btn_trat = "Salvar tratamento";
                        $card_edit = "";
                        $foto01 = "";
                        $foto02 = "";
                        $foto03 = "";
                        $foto04 = "";
                        $video01 = "";
                        $video02 = "";
                    }
                ?>
                <button type="button" class="CloseBtn" data-bs-dismiss="modal" aria-label="Close" onclick='window.location=`./index.php?pag=tratamentos`;'></button>
                <div class="modal-body">
                    <h2><?php echo $titulo_modal_trat ?></h2>
                    <div id="Block_init">
                        <div id="Card_block">
                            <h3>Selecione uma card para o tratamento</h3>
                            <span>*Tamanho recomendado: 960 x 1500</span>
                            <input type="hidden" id="Card_Input_default" name="Card_Input_default" value="" required>
                            <input type="file" id="Card_Input" name="Card_Input" onChange="carregaCard();">
                            <?php
                                if($card_edit == "card_placeholder.webp" || $card_edit == ""){
                                    $card_edit = "
                                        <img class='card' id='target_card' src='../../assets/tratamentos/card_placeholder.webp'>
                                        <button type='button' class='btns btn_VoltaPadrao_Card_Input hide' onclick='imgPadrao(`Card_Input`, `target_card`, `card_placeholder.webp`, `card`)'>Restaurar imagem</button>
                                    ";
                                }else{
                                    $card_edit = "
                                        <img class='card imgSelected' id='target_card' src='../../assets/tratamentos/$titulo_tratado/$card_edit'>
                                        <button type='button' class='btns btn_VoltaPadrao_Card_Input' onclick='imgPadrao(`Card_Input`, `target_card`, `card_placeholder.webp`, `card`)'>Restaurar imagem</button>
                                    ";
                                }
                                
                                echo $card_edit;
                            ?>
                            <img class="editPen" onclick="document.getElementById('Card_Input').click();" src="../../assets/sistema/edit.svg" onload="SVGInject(this)">
                        </div>
                        <div id="infos">
                            <div class="BlockBox">
                                <input type="text" name="titulo" id="titulo" value="<?php echo @$titulo_edit?>" maxlength="100" required>
                                <span>Titulo:</span>
                            </div>
                            <div class="Seletor">
                                <span>Selecione a especialidade atrelada a este tratamento:</span>
                                <div id="especialidades-select">
                                    <input type="checkbox" id="select_input_espec" onchange="OptionSelection('selected_val_espec', 'select_input_espec', 'options_espec');">
                                    <div id="select-button">
                                        <div id='selected_val_espec'><?php if(@$especialidade_edit == ""){ echo "Qual especialidade?"; } else{ echo @$especialidade_edit; } ?></div>
                                        <img src="../../assets/sistema/seta_fina.svg" onload="SVGInject(this)">
                                    </div>
                                </div>
                                <ul id="options">
                                    <?php 
                                        echo "
                                            <li class='options_espec'>
                                                <input type='radio' name='especialidade' value='null' data-label='null'>
                                                <span class='label'> Qual especialidade? </span>
                                            </li>
                                        ";
                                        $query = $pdo->query("SELECT * FROM especialidade ORDER BY id DESC");
                                        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                                        for ($i=0; $i < count($dados); $i++) {
                                            $nome_espec = $dados[$i]['nome'];
                                            if($nome_espec === @$especialidade_edit){
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
                    <div id="Block_fotos">
                        <h2>Selecione imagens para apresentar os resultados</h2>
                        <span>*Tamanho recomendado para imagens: 750 x 750</span>
                        <div id="foto01_block">
                            <input type="hidden" id="foto01_Input_default" name="foto01_Input_default" value="" required>
                            <input type="file" id="foto01_Input" name="foto01_Input" onChange="carregafoto(1);">
                            <?php
                                if($foto01 == "resultado.webp" || $foto01 == ""){
                                    $foto01 = "
                                        <img class='foto01' id='target_foto01' src='../../assets/tratamentos/resultado.webp' onclick='document.getElementById(`foto01_Input`).click();'>
                                        <button type='button' class='btns btn_VoltaPadrao_foto01_Input hide' onclick='imgPadrao(`foto01_Input`, `target_foto01`, `resultado.webp`, `foto01`)'>Restaurar imagem</button>
                                    ";
                                }else{
                                    $foto01 = "
                                        <img class='foto01 imgSelected' id='target_foto01' src='../../assets/tratamentos/$titulo_tratado/$foto01'>
                                        <button type='button' class='btns btn_VoltaPadrao_foto01_Input' onclick='imgPadrao(`foto01_Input`, `target_foto01`, `resultado.webp`, `foto01`)'>Restaurar imagem</button>
                                    ";
                                }
                                echo $foto01;
                            ?>
                        </div>
                        <div id="foto02_block">
                            <input type="hidden" id="foto02_Input_default" name="foto02_Input_default" value="" required>
                            <input type="file" id="foto02_Input" name="foto02_Input" onChange="carregafoto(2);">
                            <?php
                                if($foto02 == "resultado.webp" || $foto02 == ""){
                                    $foto02 = "
                                        <img class='foto02' id='target_foto02' src='../../assets/tratamentos/resultado.webp' onclick='document.getElementById(`foto02_Input`).click();'>
                                        <button type='button' class='btns btn_VoltaPadrao_foto02_Input hide' onclick='imgPadrao(`foto02_Input`, `target_foto02`, `resultado.webp`, `foto02`)'>Restaurar imagem</button>
                                    ";
                                }else{
                                    $foto02 = "
                                        <img class='foto02 imgSelected' id='target_foto02' src='../../assets/tratamentos/$titulo_tratado/$foto02'>
                                        <button type='button' class='btns btn_VoltaPadrao_foto02_Input' onclick='imgPadrao(`foto02_Input`, `target_foto02`, `resultado.webp`, `foto02`)'>Restaurar imagem</button>
                                    ";
                                }
                                echo $foto02;
                            ?>
                        </div>
                        <div id="foto03_block">
                            <input type="hidden" id="foto03_Input_default" name="foto03_Input_default" value="" required>
                            <input type="file" id="foto03_Input" name="foto03_Input" onChange="carregafoto(3);">
                            <?php
                                if($foto03 == "resultado.webp" || $foto03 == ""){
                                    $foto03 = "
                                        <img class='foto03' id='target_foto03' src='../../assets/tratamentos/resultado.webp' onclick='document.getElementById(`foto03_Input`).click();'>
                                        <button type='button' class='btns btn_VoltaPadrao_foto03_Input hide' onclick='imgPadrao(`foto03_Input`, `target_foto03`, `resultado.webp`, `foto03`)'>Restaurar imagem</button>
                                    ";
                                }else{
                                    $foto03 = "
                                        <img class='foto03 imgSelected' id='target_foto03' src='../../assets/tratamentos/$titulo_tratado/$foto03'>
                                        <button type='button' class='btns btn_VoltaPadrao_foto03_Input' onclick='imgPadrao(`foto03_Input`, `target_foto03`, `resultado.webp`, `foto03`)'>Restaurar imagem</button>
                                    ";
                                }
                                echo $foto03;
                            ?>
                        </div>
                        <div id="foto04_block">
                            <input type="hidden" id="foto04_Input_default" name="foto04_Input_default" value="" required>
                            <input type="file" id="foto04_Input" name="foto04_Input" onChange="carregafoto(4);">
                            <?php
                                if($foto04 == "resultado.webp" || $foto04 == ""){
                                    $foto04 = "
                                        <img class='foto04' id='target_foto04' src='../../assets/tratamentos/resultado.webp' onclick='document.getElementById(`foto04_Input`).click();'>
                                        <button type='button' class='btns btn_VoltaPadrao_foto04_Input hide' onclick='imgPadrao(`foto04_Input`, `target_foto04`, `resultado.webp`, `foto04`)'>Restaurar imagem</button>
                                    ";
                                }else{
                                    $foto04 = "
                                        <img class='foto04 imgSelected' id='target_foto04' src='../../assets/tratamentos/$titulo_tratado/$foto04'>
                                        <button type='button' class='btns btn_VoltaPadrao_foto04_Input' onclick='imgPadrao(`foto04_Input`, `target_foto04`, `resultado.webp`, `foto04`)'>Restaurar imagem</button>
                                    ";
                                }
                                echo $foto04;
                            ?>
                        </div>
                    </div>
                    <div id="Block_videos">
                        <h2>Selecione videos para apresentar os resultados</h2>
                        <span>*Tamanho recomendado para imagens: 1920 x 1080</span>
                        <div id="Video01_block">
                            <input type="hidden" id="Video01_Input_default" name="Video01_Input_default" value="" required>
                            <input type="file" id="Video01_Input" name="Video01_Input" onChange="carregaVideo01();">
                            <?php
                                if($video01 == "video_vazio.mp4" || $video01 == ""){
                                    $video01 = "
                                        <video class='video01' id='target_video01' onclick='document.getElementById(`Video01_Input`).click();'>
                                            <source src='../../assets/tratamentos/video_vazio.mp4'>
                                        </video>
                                        <button type='button' class='btns btn_VoltaPadrao_Video01_Input hide' onclick='imgPadrao(`Video01_Input`, `target_video01`, `video_vazio.mp4`, `video01`)'>Restaurar imagem</button>
                                    ";
                                }else{
                                    $video01 = "
                                        <video class='video01 imgSelected' id='target_video01' onclick='document.getElementById(`Video01_Input`).click();'>
                                            <source src='../../assets/tratamentos/$titulo_tratado/$video01'>
                                        </video>
                                        <button type='button' class='btns btn_VoltaPadrao_Video01_Input' onclick='imgPadrao(`Video01_Input`, `target_video01`, `video_vazio.mp4`, `video01`)'>Restaurar Video</button>
                                    ";
                                }
                                
                                echo $video01;
                            ?>
                            <img class="editPen" onclick="document.getElementById('Video01_Input').click();" src="../../assets/sistema/edit.svg" onload="SVGInject(this)">
                        </div>

                        <div id="Video02_block">
                            <input type="hidden" id="Video02_Input_default" name="Video02_Input_default" value="" required>
                            <input type="file" id="Video02_Input" name="Video02_Input" onChange="carregaVideo02();">
                            <?php
                                if($video02 == "video_vazio.mp4" || $video02 == ""){
                                    $video02 = "
                                        <video class='video02' id='target_video02' onclick='document.getElementById(`Video02_Input`).click();'>
                                            <source src='../../assets/tratamentos/video_vazio.mp4'>
                                        </video>
                                        <button type='button' class='btns btn_VoltaPadrao_Video02_Input hide' onclick='imgPadrao(`Video02_Input`, `target_video02`, `video_vazio.mp4`, `video02`)'>Restaurar imagem</button>
                                    ";
                                }else{
                                    $video02 = "
                                        <video class='video02 imgSelected' id='target_video02' onclick='document.getElementById(`Video02_Input`).click();'>
                                            <source src='../../assets/tratamentos/$titulo_tratado/$video02'>
                                        </video>
                                        <button type='button' class='btns btn_VoltaPadrao_Video02_Input' onclick='imgPadrao(`Video02_Input`, `target_video02`, `video_vazio.mp4`, `video02`)'>Restaurar Video</button>
                                    ";
                                }
                                
                                echo $video02;
                            ?>
                            <img class="editPen" onclick="document.getElementById('Video02_Input').click();" src="../../assets/sistema/edit.svg" onload="SVGInject(this)">
                        </div>
                    </div>
                    <div id="Block_FAQ">
                        <h2>Perguntas e respostas</h2>
                        <div class="BlockBox">
                            <input type="text" name="pgnt_01" id="pgnt_01" value="<?php echo @$pgnt_01?>" maxlength="130" required>
                            <span>Pergunta 01:</span>
                        </div>
                        <div class="BlockBox TextAreaBox">
                            <textarea type="text" name="resp_01" id="resp_01" maxlength="325" required><?php echo @$resp_01 ?></textarea>
                            <span>Resposta para a pergunta 01:</span>
                        </div>
                        <div class="BlockBox">
                            <input type="text" name="pgnt_02" id="pgnt_02" value="<?php echo @$pgnt_02?>" maxlength="130" required>
                            <span>Pergunta 02:</span>
                        </div>
                        <div class="BlockBox TextAreaBox">
                            <textarea type="text" name="resp_02" id="resp_02" maxlength="325" required><?php echo @$resp_02 ?></textarea>
                            <span>Resposta para a pergunta 02:</span>
                        </div>
                        <div class="BlockBox">
                            <input type="text" name="pgnt_03" id="pgnt_03" value="<?php echo @$pgnt_03?>" maxlength="130" required>
                            <span>Pergunta 03:</span>
                        </div>
                        <div class="BlockBox TextAreaBox">
                            <textarea type="text" name="resp_03" id="resp_03" maxlength="325" required><?php echo @$resp_03 ?></textarea>
                            <span>Resposta para a pergunta 03:</span>
                        </div>
                        <div class="BlockBox">
                            <input type="text" name="pgnt_04" id="pgnt_04" value="<?php echo @$pgnt_04?>" maxlength="130" required>
                            <span>Pergunta 04:</span>
                        </div>
                        <div class="BlockBox TextAreaBox">
                            <textarea type="text" name="resp_04" id="resp_04" maxlength="325" required><?php echo @$resp_04 ?></textarea>
                            <span>Resposta para a pergunta 04:</span>
                        </div>
                        <div class="BlockBox">
                            <input type="text" name="pgnt_05" id="pgnt_05" value="<?php echo @$pgnt_05?>" maxlength="130" required>
                            <span>Pergunta 05:</span>
                        </div>
                        <div class="BlockBox TextAreaBox">
                            <textarea type="text" name="resp_05" id="resp_05" maxlength="325" required><?php echo @$resp_05 ?></textarea>
                            <span>Resposta para a pergunta 05:</span>
                        </div>
                        <div class="BlockBox">
                            <input type="text" name="pgnt_06" id="pgnt_06" value="<?php echo @$pgnt_06?>" maxlength="130" required>
                            <span>Pergunta 06:</span>
                        </div>
                        <div class="BlockBox TextAreaBox">
                            <textarea type="text" name="resp_06" id="resp_06" maxlength="325" required><?php echo @$resp_06 ?></textarea>
                            <span>Resposta para a pergunta 06:</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_trat_edit" name="id_trat_edit" value="<?php echo @$id_trat_edit ?>">
                    <input type="hidden" id="titulo_trat_edit" name="titulo_trat_edit" value="<?php echo @$titulo_edit ?>">
                    
                    <input type="hidden" id="card_edit" name="card_edit" value="<?php echo @$card_edit_antigo ?>">
                    <input type="hidden" id="foto01_edit" name="foto01_edit" value="<?php echo @$foto01_edit_antigo ?>">
                    <input type="hidden" id="foto02_edit" name="foto02_edit" value="<?php echo @$foto02_edit_antigo ?>">
                    <input type="hidden" id="foto03_edit" name="foto03_edit" value="<?php echo @$foto03_edit_antigo ?>">
                    <input type="hidden" id="foto04_edit" name="foto04_edit" value="<?php echo @$foto04_edit_antigo ?>">
                    
                    <input type="hidden" id="video01_edit" name="video01_edit" value="<?php echo @$video01_edit_antigo ?>">
                    <input type="hidden" id="video02_edit" name="video02_edit" value="<?php echo @$video02_edit_antigo ?>">

                    <button class="btns btn_cancel" type="button" data-bs-dismiss="modal" onclick='window.location=`./index.php?pag=tratamentos`;'>Cancelar</button>
                    <button class="btns btn_salvar" id="btn_salva" type="submit"><?php echo $btn_trat ?></button>
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
                    <h4>Gostaria mesmo de excluir este Tratamento?</h4>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_tratamento_delete" name="id_tratamento_delete" value="<?php echo @$_GET['id'] ?>" required>

                    <button class="btns btn_cancel" type="button" data-bs-dismiss="modal" onclick='window.location=`./index.php?pag=tratamentos`;'>Cancelar</button>
                    <button class="btns btn_excluir" type="submit">Excluir</button>
                </div>
                <div id="msg_ModalDeletTratamento"></div>
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
        //FUNÇÃO DE SELETORES CUSTOMIZADOS
        function OptionSelection(selectedValueId, optionsButtonId, optionInputsClass) {
            let selectedValue = document.getElementById(selectedValueId),
                optionsViewButton = document.getElementById(optionsButtonId),
                inputsOptions = document.querySelectorAll('.' + optionInputsClass + ' input');

            inputsOptions.forEach(input => { 
                input.addEventListener('click', event => {

                    var valor = '';
                    if(input.dataset.label == 'null'){
                        valor = 'Qual especialidade?';
                    }
                    else{
                        valor = input.dataset.label;
                    }
                    selectedValue.textContent = valor;
                    optionsViewButton.click();
                });
            });
        }

        //CHAMADA DE FUNÇÃO PARA UPLOAD DE IMG BANCO DE DADOS
        function carregaCard(){ carregarImagem('Card_Input', 'target_card', '../../assets/tratamentos/card_placeholder.webp', 'card'); }
        function carregaVideo01(){ carregarImagem('Video01_Input', 'target_video01', '../../assets/tratamentos/video_vazio.mp4', 'video01'); }
        function carregaVideo02(){ carregarImagem('Video02_Input', 'target_video02', '../../assets/tratamentos/video_vazio.mp4', 'video02'); }
        
        function carregafoto(num) {
            carregarImagem(`foto0${num}_Input`, `target_foto0${num}`, '../../assets/tratamentos/resultado.webp', `foto0${num}`);
        }

        //RESET DE IMG
        function imgPadrao(inputId, targetId, placeholder, imgContainerClass) {
            document.getElementById(targetId).src = '../../assets/tratamentos/' + placeholder;
            document.getElementById(inputId + '_default').value = 'true';
            document.querySelector('.btn_VoltaPadrao_' + inputId).classList.add('hide');
            document.querySelector('.' + imgContainerClass).classList.remove('imgSelected');
        }

        $("#Video01_Input").change(function(e){ 
            const fileSize = e.target.files[0].size / 1024 / 1024; // para mb
            if (fileSize > 20) {
                $('#btn_salva').addClass('btn_desativado');
                $('#btn_salva').removeAttr('type');
                $('#msg_ModalTratamento').addClass('text-danger');
                $('#msg_ModalTratamento').text('Tamanho do vídeo excedeu o limite do servidor! Apenas vídeos menores que 20 MB são aceitos. Selecione outro video para salvar alterações');
            }
            if (fileSize < 20) {
                $('#btn_salva').removeClass('btn_desativado');
                $('#btn_salva').attr('type', 'submit');
                $('#msg_ModalTratamento').removeClass('text-danger');
                $('#msg_ModalTratamento').text('');
            }
        });
        $("#Video02_Input").change(function(e){ 
            const fileSize = e.target.files[0].size / 1024 / 1024; // para mb
            if (fileSize > 20) {
                $('#btn_salva').addClass('btn_desativado');
                $('#btn_salva').removeAttr('type');
                $('#msg_ModalTratamento').addClass('text-danger');
                $('#msg_ModalTratamento').text('Tamanho do vídeo excedeu o limite do servidor! Apenas vídeos menores que 20 MB são aceitos. Selecione outro video para salvar alterações');
            }
            if (fileSize < 20) {
                $('#btn_salva').removeClass('btn_desativado');
                $('#btn_salva').attr('type', 'submit');
                $('#msg_ModalTratamento').removeClass('text-danger');
                $('#msg_ModalTratamento').text('');
            }
        });


        $('.btn_salvar').click(function (e) {
            $('#etapas').prop('required',false);

            $('#pgnt_01').prop('required',false);
            $('#pgnt_02').prop('required',false);
            $('#pgnt_03').prop('required',false);
            $('#pgnt_04').prop('required',false);
            $('#pgnt_05').prop('required',false);
            $('#pgnt_06').prop('required',false);

            $('#resp_01').prop('required',false);
            $('#resp_02').prop('required',false);
            $('#resp_03').prop('required',false);
            $('#resp_04').prop('required',false);
            $('#resp_05').prop('required',false);
            $('#resp_06').prop('required',false);
        });

        //UPLOAD DAS INFOS NO BANCO DE DADOS
        $("#Form_ModalTratamento").submit(function (e) {
            e.preventDefault();
            $('#msg_ModalTratamento').text('');
            $('#msg_ModalTratamento').removeClass('text-danger');
            $('#msg_ModalTratamento').removeClass('text-success');
            $.ajax({
                url: "Tratamentos/insert_Edit.php",
                type: 'POST',
                data: new FormData(this),
                success: function (msg) {
                    if (msg.trim() === "Tratamento criado com Sucesso!!" || msg.trim() === "Tratamento atualizado com Sucesso!!" ) {
                        $('#msg_ModalTratamento').addClass('text-success');
                        $('#msg_ModalTratamento').text(msg);
                        setTimeout(() => { window.location='./index.php?pag=tratamentos'; }, 1500);
                    }
                    else {
                        $('#msg_ModalTratamento').addClass('text-danger');
                        $('#msg_ModalTratamento').text(msg);
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

        $('#Form_ModalDeletTratamentos').submit(function (e) {
            e.preventDefault();
            $('#msg_ModalDeletTratamento').text('');
            $('#msg_ModalDeletTratamento').removeClass('text-danger');
            $('#msg_ModalDeletTratamento').removeClass('text-success');
            $.ajax({
                url: "Tratamentos/delete.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (msg) {
                    if (msg.trim() === "Excluído com Sucesso!!") {
                        $('#msg_ModalDeletTratamento').addClass('text-success');
                        $('#msg_ModalDeletTratamento').text(msg);
                        setTimeout(() => { window.location='./index.php?pag=tratamentos'; }, 1500);
                    }
                    else{
                        $('#msg_ModalDeletTratamento').addClass('text-danger');
                        $('#msg_ModalDeletTratamento').text(msg)
                    }
                }
            })
        });
    </script>
</section>
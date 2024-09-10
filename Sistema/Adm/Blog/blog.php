<section id="Blog">

    <a class="btns btn_cria" href="index.php?pag=blog&funcao=novoPost">
        <p>Nova postagem</p>
    </a>

    <div id="List_postagem">
        <?php
            $query = $pdo->query("SELECT * FROM blog ORDER BY id DESC");
            $dados = $query->fetchAll(PDO::FETCH_ASSOC);
            for ($i=0; $i < count($dados); $i++) { 

                $id = $dados[$i]['id'];
                $banner = $dados[$i]['banner'];
                $titulo = $dados[$i]['titulo_princ'];
                $data_criacao = $dados[$i]['data_criacao'];
                $especialidade = $dados[$i]['tag_especialidade'];

                if($banner == "banner_placeholder.webp" || $banner == ""){
                    $banner = "<img class='banner' src='../../assets/blog/banner_placeholder.webp'>";
                }else{
                    $banner = "<img class='banner' src='../../assets/blog/$banner'>";
                }

                echo "
                    <div class='Post_card'>
                        ".$banner."
                        <p>".$titulo."</p>
                        <span>".$data_criacao."</span>
                        <span id='espec_card'>".$especialidade."</span>

                        <div class='acoes'>
                            <a href='index.php?pag=blog&funcao=editPost&id=".$id."'><img src='../../assets/sistema/edit.svg'></a>
                            <a href='index.php?pag=blog&funcao=deletPost&id=".$id."'><img src='../../assets/sistema/delet.svg'></a>
                        </div>
                    </div>
                ";
            }
        ?>
    </div>

    <!-- Modal Cria / Editar Postagem -->
    <div class="modal fade" id="ModalPost" tabindex="-1">
        <div class="modal-dialog">
            <form id="Form_ModalPostagem" method="POST" class="modal-content">
                <?php 
                    if (@$_GET['funcao'] == 'editPost') {
                        $titulo_modal_post = "Edição de postagem!";
                        $btn_post = "Salvar alterações";

                        $id_post_edit = $_GET['id'];

                        $query = $pdo->query("SELECT * FROM blog WHERE id = '$id_post_edit' LIMIT 1");
                        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                        if(@count($dados) > 0){
                            $banner_edit = $dados[0]['banner'];
                            $titulo_edit = $dados[0]['titulo_princ'];
                            $especialidade_edit = $dados[0]['tag_especialidade'];
                            $seo_edit = $dados[0]['seo'];

                            $resumo_edit = $dados[0]['resumo'];


                            $titulo_h2_edit = $dados[0]['titulo_h2'];
                            $titulo_h3_edit = $dados[0]['titulo_h3'];
                            $titulo_h4_edit = $dados[0]['titulo_h4'];
                            $titulo_h5_edit = $dados[0]['titulo_h5'];
                            $titulo_h6_edit = $dados[0]['titulo_h6'];

                            $text_h2_edit = $dados[0]['text_h2'];
                            $text_h3_edit = $dados[0]['text_h3'];
                            $text_h4_edit = $dados[0]['text_h4'];
                            $text_h5_edit = $dados[0]['text_h5'];
                            $text_h6_edit = $dados[0]['text_h6'];
                           
                            $resumo_edit = str_replace('<br />', " ", $resumo_edit);
                            $text_h2_edit = str_replace('<br />', " ", $text_h2_edit);
                            $text_h3_edit = str_replace('<br />', " ", $text_h3_edit);
                            $text_h4_edit = str_replace('<br />', " ", $text_h4_edit);
                            $text_h5_edit = str_replace('<br />', " ", $text_h5_edit);
                            $text_h6_edit = str_replace('<br />', " ", $text_h6_edit);

                            //IMGS E VIDEOS
                            $banner_edit_antigo = $banner_edit;
                        }
                    } 
                    else{ 
                        $titulo_modal_post = "Nova Postagem!"; 
                        $btn_post = "Salvar Postagem";
                    }
                ?>
                <button type="button" class="CloseBtn" data-bs-dismiss="modal" aria-label="Close" onclick='window.location=`./index.php?pag=blog`;'></button>
                <div class="modal-body">
                    <h2><?php echo $titulo_modal_post ?></h2>
                    <div id="Block_init">
                        <div id="Banner_block">
                            <h3>Selecione um banner para da postagem</h3>
                            <span>*Tamanho recomendado: 960 x 700</span>
                            <input type="hidden" id="Banner_Input_default" name="Banner_Input_default" value="" required>
                            <input type="file" id="Banner_Input" name="Banner_Input" onChange="carregaBanner();">
                            <?php
                                if(@$banner_edit == "banner_placeholder.webp" || @$banner_edit == ""){
                                    $banner_edit = "
                                        <img class='banner' id='target_banner' src='../../assets/blog/banner_placeholder.webp'>
                                        <button type='button' class='btns btn_VoltaPadrao_Banner_Input hide' onclick='imgPadrao(`Banner_Input`, `target_banner`, `banner_placeholder.webp`, `banner`)'>Restaurar imagem</button>
                                    ";
                                }else{
                                    $banner_edit = "
                                        <img class='banner imgSelected' id='target_banner' src='../../assets/blog/$banner_edit'>
                                        <button type='button' class='btns btn_VoltaPadrao_Banner_Input' onclick='imgPadrao(`Banner_Input`, `target_banner`, `banner_placeholder.webp`, `banner`)'>Restaurar imagem</button>
                                    ";
                                }
                                echo $banner_edit;
                            ?>
                            <img class="editPen" onclick="document.getElementById('Banner_Input').click();" src="../../assets/sistema/edit.svg" onload="SVGInject(this)">
                        </div>
                        <div id="infos">
                            <div class="Seletor">
                                <span>Selecione a especialidade atrelada a esta postagem:</span>
                                <div id="especialidades-select">
                                    <input type="checkbox" id="select_input_espec" onchange="OptionSelection('selected_val_espec', 'select_input_espec', 'options_espec');">
                                    <div id="select-button">
                                        <div id='selected_val_espec'><?php if(@$especialidade_edit == ""){ echo "selecione uma especialidade!"; } else{ echo @$especialidade_edit; } ?></div>
                                        <img src="../../assets/sistema/seta_fina.svg" onload="SVGInject(this)">
                                    </div>
                                </div>
                                <ul id="options">
                                    <?php 
                                        echo "
                                            <li class='options_espec'>
                                                <input type='radio' name='especialidade' value='null' data-label='null'>
                                                <span class='label'> selecione uma especialidade! </span>
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
                            <div class="BlockBox">
                                <input type="text" name="titulo" id="titulo" value="<?php echo @$titulo_edit?>" maxlength="150" required>
                                <span>Titulo Principal:</span>
                            </div>
                            <div class="BlockBox TextAreaBox">
                                <textarea type="text" name="resumo" id="resumo" maxlength="750" required><?php echo @$resumo_edit ?></textarea>
                                <span>Resumo de introdução:</span>
                            </div>
                            <div class="BlockBox">
                                <input type="text" name="h2" id="h2" value="<?php echo @$titulo_h2_edit?>" maxlength="100" required>
                                <span>Titulo de abertura: (Alta importancia)</span>
                            </div>
                            <div class="BlockBox TextAreaBox">
                                <textarea type="text" name="text_h2" id="text_h2" maxlength="5000" required><?php echo @$text_h2_edit ?></textarea>
                                <span>Texto principal:</span>
                            </div>
                            <div class="BlockBox">
                                <input type="text" name="h3" id="h3" value="<?php echo @$titulo_h3_edit?>" maxlength="100" required>
                                <span>Titulo de apoio: (Media importancia)</span>
                            </div>
                            <div class="BlockBox TextAreaBox">
                                <textarea type="text" name="text_h3" id="text_h3" maxlength="1500" required><?php echo @$text_h3_edit ?></textarea>
                                <span>Texto:</span>
                            </div>
                            <div class="BlockBox">
                                <input type="text" name="h4" id="h4" value="<?php echo @$titulo_h4_edit?>" maxlength="100" required>
                                <span>Titulo de apoio: (Media importancia)</span>
                            </div>
                            <div class="BlockBox TextAreaBox">
                                <textarea type="text" name="text_h4" id="text_h4" maxlength="1500" required><?php echo @$text_h4_edit ?></textarea>
                                <span>Texto:</span>
                            </div>
                            <div class="BlockBox">
                                <input type="text" name="h5" id="h5" value="<?php echo @$titulo_h5_edit?>" maxlength="100" required>
                                <span>Titulo de apoio: (Baixa importancia)</span>
                            </div>
                            <div class="BlockBox TextAreaBox">
                                <textarea type="text" name="text_h5" id="text_h5" maxlength="1500" required><?php echo @$text_h5_edit ?></textarea>
                                <span>Texto:</span>
                            </div>
                            <div class="BlockBox">
                                <input type="text" name="h6" id="h6" value="<?php echo @$titulo_h6_edit?>" maxlength="100" required>
                                <span>Titulo de apoio: (Baixa importancia)</span>
                            </div>
                            <div class="BlockBox TextAreaBox">
                                <textarea type="text" name="text_h6" id="text_h6" maxlength="1500" required><?php echo @$text_h6_edit ?></textarea>
                                <span>Texto:</span>
                            </div>
                            <div class="BlockBox">
                                <input type="text" name="seo" id="seo" value="<?php echo @$seo_edit?>" maxlength="500" required>
                                <span>Palavras chave para a postagem:</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_post_edit" name="id_post_edit" value="<?php echo @$id_post_edit ?>">
                    <input type="hidden" id="banner_edit" name="banner_edit" value="<?php echo @$banner_edit_antigo ?>">
                    <input type="hidden" id="data_criacao" name="data_criacao" value="<?php echo @$data_criacao ?>">


                    <button class="btns btn_cancel" type="button" data-bs-dismiss="modal" onclick='window.location=`./index.php?pag=blog`;'>Cancelar</button>
                    <button class="btns btn_salvar" id="btn_salva" type="submit"><?php echo $btn_post ?></button>
                </div>
                <div id="msg_ModalPostagem"></div>
            </form>
        </div>
    </div>
    
    <!-- Modal Deletar Postagem -->
    <div class="modal fade" id="ModalDeletPost" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="Form_ModalDeletPost" method="post" class="modal-content">
                <button type="button" class="CloseBtn" data-bs-dismiss="modal" aria-label="Close" onclick='window.location=`./index.php?pag=blog`;'></button>
                <div class="modal-body">
                    <h4>Gostaria mesmo de excluir esta postagem?</h4>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_Post_Delete" name="id_Post_Delete" value="<?php echo @$_GET['id'] ?>" required>

                    <button class="btns btn_cancel" type="button" data-bs-dismiss="modal" onclick='window.location=`./index.php?pag=blog`;'>Cancelar</button>
                    <button class="btns btn_excluir" type="submit">Excluir</button>
                </div>
                <div id="msg_ModalDeletPost"></div>
            </form>
        </div>
    </div>

    <!-- FUNÇÕES PHP NA CHAMADA DE MODAL -->
    <?php
        if (@$_GET["funcao"] == "novoPost" || @$_GET["funcao"] == "editPost") {
            echo "
                <button id='openModalPost' class='hide' type='button' data-bs-toggle='modal' data-bs-target='#ModalPost'></button>
                <script language='javascript'>$('#openModalPost').click();</script>
            ";
        }
        if (@$_GET["funcao"] == "deletPost") {
            echo "
                <button id='openModalDeletPost' class='hide' type='button' data-bs-toggle='modal' data-bs-target='#ModalDeletPost'></button>
                <script language='javascript'>$('#openModalDeletPost').click();</script>
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
                        valor = 'selecione uma especialidade!';
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
        function carregaBanner(){ carregarImagem('Banner_Input', 'target_banner', '../../assets/blog/banner_placeholder.webp', 'banner'); }
        
        //RESET DE IMG
        function imgPadrao(inputId, targetId, placeholder, imgContainerClass) {
            document.getElementById(targetId).src = '../../assets/blog/' + placeholder;
            document.getElementById(inputId + '_default').value = 'true';
            document.querySelector('.btn_VoltaPadrao_' + inputId).classList.add('hide');
            document.querySelector('.' + imgContainerClass).classList.remove('imgSelected');
        }

        $('.btn_salvar').click(function (e) {
            $('#h3').prop('required',false);
            $('#h4').prop('required',false);
            $('#h5').prop('required',false);
            $('#h6').prop('required',false);

            $('#text_h3').prop('required',false);
            $('#text_h4').prop('required',false);
            $('#text_h5').prop('required',false);
            $('#text_h6').prop('required',false);
        });

        //UPLOAD DAS INFOS NO BANCO DE DADOS
        $("#Form_ModalPostagem").submit(function (e) {
            e.preventDefault();
            $('#msg_ModalPostagem').text('');
            $('#msg_ModalPostagem').removeClass('text-danger');
            $('#msg_ModalPostagem').removeClass('text-success');
            $.ajax({
                url: "Blog/insert_Edit.php",
                type: 'POST',
                data: new FormData(this),
                success: function (msg) {
                    if (msg.trim() === "Postagem criada com Sucesso!!" || msg.trim() === "Postagem atualizada com Sucesso!!" ) {
                        $('#msg_ModalPostagem').addClass('text-success');
                        $('#msg_ModalPostagem').text(msg);
                        setTimeout(() => { window.location='./index.php?pag=blog'; }, 1500);
                    }
                    else {
                        $('#msg_ModalPostagem').addClass('text-danger');
                        $('#msg_ModalPostagem').text(msg);
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

        $('#Form_ModalDeletPost').submit(function (e) {
            e.preventDefault();
            $('#msg_ModalDeletPost').text('');
            $('#msg_ModalDeletPost').removeClass('text-danger');
            $('#msg_ModalDeletPost').removeClass('text-success');
            $.ajax({
                url: "Blog/delete.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (msg) {
                    if (msg.trim() === "Excluído com Sucesso!!") {
                        $('#msg_ModalDeletPost').addClass('text-success');
                        $('#msg_ModalDeletPost').text(msg);
                        setTimeout(() => { window.location='./index.php?pag=blog'; }, 1500);
                    }
                    else{
                        $('#msg_ModalDeletPost').addClass('text-danger');
                        $('#msg_ModalDeletPost').text(msg)
                    }
                }
            })
        });
    </script>
</section>
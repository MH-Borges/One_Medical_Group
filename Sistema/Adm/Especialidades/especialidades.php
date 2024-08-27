<section id="Especialidades">

    <a class="btns btn_cria" href="index.php?pag=especialidades&funcao=novaEspecialidade">
        <p>Nova especialidade</p>
    </a>

    <div id="List_Espec">
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

    <!-- Modal Cria / Editar especialidade -->
    <div class="modal fade" id="ModalEspecialidade" tabindex="-1">
        <div class="modal-dialog">
            <form id="Form_ModalEspecialidade" method="post" class="modal-content">
                <?php 
                    if (@$_GET['funcao'] == 'editEspecialidade') {
                        $titulo_espec = "Edição de Especialidade!";
                        $btn_espec = "Salvar edição";

                        $id_espec_edit = $_GET['id'];

                        $query = $pdo->query("SELECT * FROM especialidade WHERE id = '$id_espec_edit' LIMIT 1");
                        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                        if(@count($dados) > 0){
                            $nome_espec_edit = $dados[0]['nome'];
                            $descri_espec_edit = $dados[0]['descricao'];
                            $foto_espec_edit = $dados[0]['foto'];

                            $descri_espec_edit = str_replace('<br />', " ", $descri_espec_edit);
                        }
                    } else { $titulo_espec = "Nova especialidade!"; $btn_espec = "Salvar especialidade";}
                ?>

                <button type="button" class="CloseBtn" data-bs-dismiss="modal" aria-label="Close" onclick='window.location=`./index.php?pag=especialidades`;'></button>

                <div class="modal-body">
                    <h4><?php echo $titulo_espec ?></h4>

                    <div class="Img_Espec">
                        <input type="file" value="<?php echo @$foto_espec_edit ?>" id="foto_espec_Input" name="foto_espec_Input" onChange="carregarImgWeb();">
                        <?php
                            if(@$foto_espec_edit == "placeholder.webp" || @$foto_espec_edit == ""){
                                echo "<img class='img_espec_modal' id='target_imgEspec' src='../../assets/especialidades/placeholder.webp'>";
                            }else{
                                echo "<img class='img_espec_modal imgSelected' id='target_imgEspec' src='../../assets/especialidades/$foto_espec_edit'>";
                            }
                        ?>
                        <img class="editPen" onclick="document.getElementById('foto_espec_Input').click();" src="../../assets/sistema/edit.svg" onload="SVGInject(this)">
                        
                        <span>*Tamanho de imagem recomendado: 720 x 780</span>
                    </div>

                    <div id="inputs">
                        <div class="BlockBox">
                            <input type="text" value="<?php echo @$nome_espec_edit ?>" name="nome_espec" id="nome_espec" maxlength="150" required>
                            <span>Nome:</span>
                        </div>
    
                        <div class="BlockBox descricaoBox">
                            <textarea type="text" name="descri_Espec" id="descri_Espec" maxlength="5000" required><?php echo @$descri_espec_edit ?></textarea>
                            <span>Descrição:</span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" id="id_espec_edit" name="id_espec_edit" value="<?php echo @$id_espec_edit ?>" required>
                    <input type="hidden" id="nome_espec_edit" name="nome_espec_edit" value="<?php echo @$nome_espec_edit ?>" required>
                    
                    <button class="btns btn_cancel" type="button" data-bs-dismiss="modal" onclick='window.location=`./index.php?pag=especialidades`;'>Cancelar</button>
                    <button class="btns btn_salvar" type="submit"><?php echo $btn_espec ?></button>
                </div>
            </form>
        </div>
        <div id="msg_ModalEspecialidade"></div>
    </div>
    
    <!-- Modal Delete especialidade-->
    <div class="modal fade" id="ModalDeletEspecialidade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="Form_ModalDeletEspecialidade" method="post" class="modal-content">
                <button type="button" class="CloseBtn" data-bs-dismiss="modal" aria-label="Close" onclick='window.location=`./index.php?pag=especialidades`;'></button>
                <div class="modal-body">
                    <h4>Gostaria mesmo de excluir esta especialidade?</h4>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_espec_delete" name="id_espec_delete" value="<?php echo @$_GET['id'] ?>" required>

                    <button class="btns btn_cancel" type="button" data-bs-dismiss="modal" onclick='window.location=`./index.php?pag=especialidades`;'>Cancelar</button>
                    <button class="btns btn_excluir" type="submit">Excluir</button>
                </div>
            </form>
        </div>
        <div id="msg_ModalDeletEspecialidade"></div>
    </div>

    <!-- FUNÇÕES PHP NA CHAMADA DE MODAL -->
    <?php
        if (@$_GET["funcao"] == "novaEspecialidade" || @$_GET["funcao"] == "editEspecialidade") {
            echo "
                <button id='openModalEspecialidade' class='hide' type='button' data-bs-toggle='modal' data-bs-target='#ModalEspecialidade'></button>
                <script language='javascript'>$('#openModalEspecialidade').click();</script>
            ";
        }
        if (@$_GET["funcao"] == "deletEspecialidade") {
            echo "
                <button id='openModalDeletEspecialidade' class='hide' type='button' data-bs-toggle='modal' data-bs-target='#ModalDeletEspecialidade'></button>
                <script language='javascript'>$('#openModalDeletEspecialidade').click();</script>
            ";
        }
    ?>

    <script>
        //CHAMADA DE FUNÇÃO PARA UPLOAD DE IMG BANCO DE DADOS
        function carregarImgWeb(){ carregarImagem('foto_espec_Input', 'target_imgEspec', "../../assets/especialidades/placeholder.webp", 'img_espec_modal'); }

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
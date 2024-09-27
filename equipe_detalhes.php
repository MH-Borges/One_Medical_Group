<?php 
    require_once("./Sistema/configs/conexao.php"); 

    $nome_get = @$_GET['nome'];
    $nome_clean = preg_replace('/_/', ' ', $nome_get);

    $query = $pdo->query("SELECT * FROM medicos WHERE nome = '$nome_clean'");
    $dados = $query->fetchAll(PDO::FETCH_ASSOC);
    if(@count($dados) > 0){
        $nome = $dados[0]['nome'];
        $foto = $dados[0]['foto'];
        $video = $dados[0]['video'];
        $documento = $dados[0]['documento'];
        $especialidade = $dados[0]['especialidade'];

        $bio = $dados[0]['bio'];	
        $formacoes = $dados[0]['formacoes'];

        $linkedin = $dados[0]['linkedin'];		
        $instagram = $dados[0]['instagram'];	
        $facebook = $dados[0]['facebook'];		
        $whatsapp = $dados[0]['whatsapp'];

        if($whatsapp !== ""){
            $whatsapp = str_replace('(', '', $whatsapp);
            $whatsapp = str_replace(')', '', $whatsapp);
            $whatsapp = str_replace('-', '', $whatsapp);
            $whatsapp = str_replace(' ', '', $whatsapp);
        }

        if($foto == "foto_placeholder.webp" || $foto == ""){
            $foto = "<img id='imgUser' src='assets/medicos/foto_placeholder.webp'>";
        }else{
            $foto = "<img id='imgUser' src='assets/medicos/$nome_get/$foto'>";
        }

        if($video !== "video_vazio.mp4" && $video !== ""){
            $video = "
                <div id='Block_VideoMedico'>
                    <img src='assets/icons/play_btn.svg' onload='SVGInject(this)' onclick='PLayVideo(`VideoMedico`)'>
                    <video controlsList='nodownload' id='VideoMedico' onclick='PLayVideo(`VideoMedico`)'>
                        <source src='assets/medicos/$nome_get/$video' type='video/mp4'>
                    </video>
                </div>
            ";
        }else{ $video = ""; }
    }
    else{
        echo "<script language='javascript'> window.location='./' </script>";
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conheça o medico <?php echo $nome ?> | One medical group</title>

    <link rel="icon" href="assets/icons/icon.svg" />
    <link rel="canonical" href="https://onemedicalgroup.com.br/medico_<?php echo $nome_clean ?>" />

    <meta name="author" content="VL7 marketing estrategico">
    <meta name="description" content="One Medical Group, <?php echo $nome_clean ?>">
    <meta name="keywords" content="One Medical Group, <?php echo $nome_clean ?>">

    <meta property="og:locale" content="pt_BR">
    <meta name="og:title" property="og:title" content="One Medical Group">
    <meta name="og:type" property="og:type" content="website">
    <meta name="og:image" property="og:image" content="assets/logo.png">
    <meta property="og:description" content="Na One Medical Group, oferecemos um atendimento médico de excelência com uma equipe de especialistas altamente capacitados. Localizados no Cidade Jardim Corporate Center Continental Tower, proporcionamos uma experiência de saúde premium com conforto e inovação.">

    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <!-- SVG Inject -->
    <script src="js/svg-inject.min.js"></script>

    <!-- Main files -->
    <link rel="stylesheet" href="css/style.css">
    <script defer src="js/Base_script.js"></script>
</head>

<body>
    <header>
        <ul id="menu">
            <li>
                <a href="./">
                    <img src="assets/logo.png" alt="Logo one medical group">
                </a>
            </li>
            <li><a class="btns btn_agendamento" href="" target="_blank">marcar consulta</a></li>
            <li onclick="sideMenu()"><span id="sideMenu_btn"></span></li>
        </ul>
        <div id="sideMenu" class="hide">
            <button type="button" onclick="sideMenu()"></button>

            <a class="itensMenu" href="clinica">A One</a>
            <a class="itensMenu" href="especialidades">Especialidades</a>
            <a class="itensMenu" href="equipe">Equipe one</a>
            <a class="itensMenu" href="tratamentos">Tecnologias</a>
            <a class="itensMenu" href="blog">Blog</a>
            <a class="itensMenu" href="contato">Contato</a>

            <div id="contato_sideMenu">
                <a class="btns btn_agendamento" href="" target="_blank">marcar consulta</a>

                <a href="" class="redes_sideMenu marginLeft" target="_blank"><img src="assets/icons/instagram.svg" onload="SVGInject(this)"></a>
                <a href="" class="redes_sideMenu" target="_blank"><img src="assets/icons/facebook.svg" onload="SVGInject(this)"></a>
            </div>
        </div>
        <div id="background" class="hide" onclick="sideMenu()"></div>
    </header>

    <main id="Main_EquipeDetalhes">
        <a class="whats_link hide" target="_blank" href="https://wa.me/551151081977"><img src="assets/icons/whats.svg" onload="SVGInject(this)"></a>

        <section id="Block_user">
            <div id="imgVideo_User">
                <?php 
                    echo $video;
                    echo $foto;
                ?>
            </div>

            <div id="infos_User">
                <span id="especialidade"><?php echo $especialidade; ?></span>
                <h1 id="nome_user"><?php echo $nome; ?></h1>
                <h2 id="doc"><?php echo $documento; ?></h2>
                <div id="bio">
                    <h3>Biografia:</h3>
                    <p><?php echo $bio; ?></p>
                </div>

                <?php 
                    if($formacoes !== ""){
                        echo '
                            <div id="formacoes">
                                <h3>Formações:</h3>
                                <p>'.$formacoes.'</p>
                            </div>
                        ';
                    }

                    $instagramResult = '';
                    $linkedinResult = '';
                    $facebookResult = '';
                    $whatsappResult = '';

                    


                    if($instagram !== ""){
                        $instagramResult = '<a class="redes" href="https://'.$instagram.'" target="_blank"><img src="assets/icons/instagram.svg" onload="SVGInject(this)"></a>';
                    }
                    if($linkedin !== ""){
                        $linkedinResult = '<a class="redes" href="https://'.$linkedin.'" target="_blank"><img src="assets/icons/Linkedin.svg" onload="SVGInject(this)"></a>';
                    }
                    if($facebook !== ""){
                        $facebookResult = '<a class="redes" href="https://'.$facebook.'" target="_blank"><img src="assets/icons/facebook.svg" onload="SVGInject(this)"></a>';
                    }
                    if($whatsapp !== ""){
                        $whatsappResult = '<a class="btns btn_agendamento" href="https://wa.me/55'.$whatsapp.'" target="_blank">Agendar sessao</a>';
                    }

                    echo '
                        <div id="botoes">
                            '.$instagramResult.'
                            '.$linkedinResult.'
                            '.$facebookResult.'

                            '.$whatsappResult.'
                        </div>
                    ';

                ?>
            </div>
        </section>
    </main>

    <footer>
        <div id="bigFooter">
            <img id="logoRodape" src="assets/logo.png" alt="Logo one medical group">
            <div id="consulta_rodape">
                <h5>Marque a sua consulta</h5>
                <p>Venha conhecer a One Medical Group e agende a sua consulta!</p>
                <a class="btns btn_agendamento" href="" target="_blank">marcar consulta</a>
            </div>
            <div id="endereco_rodape">
                <h5>Endereço</h5>
                <p>
                    Av Magalhães de Castro 4800, Cj 304, Continental Tower, São Paulo, Brasil
                </p>
            </div>
            <div id="telefone_rodape">
                <h5>Contato</h5>
                <p>Telefone:    +55 (11) 51081977
                </p>
            </div>
            <div id="redes_rodape">
                <h5>Entre em contato</h5>
                <a href="https://www.instagram.com/one_medical_group/" target="_blank"><img src="assets/icons/instagram.svg" onload="SVGInject(this)"></a>
                <a href="https://www.facebook.com/profile.php?id=61558016380051" target="_blank"><img src="assets/icons/facebook.svg" onload="SVGInject(this)"></a>
                <a href="https://wa.me/551151081977" target="_blank"><img src="assets/icons/whats.svg" onload="SVGInject(this)"></a>
                <a href="https://malito:contato@onemedicalgroup.com.br" target="_blank"><img src="assets/icons/Email.svg" onload="SVGInject(this)"></a>
            </div>
        </div>
        <div id="smallFooter">
            <p>© <span id="data_footer"></span> One Medical Group</p>
            <a aria-label="link para a VL7" href="https://vl7.com.br" target="_blank">
                <img src="assets/vl7_logo.png">
            </a>
        </div>
    </footer>
</body>
</html>
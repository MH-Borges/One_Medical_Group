<?php 
    require_once("./Sistema/configs/conexao.php"); 

    $nome_get = @$_GET['nome'];
    $nome_clean = preg_replace('/_/', ' ', $nome_get);

    $query = $pdo->query("SELECT * FROM tratamentos WHERE titulo = '$nome_clean'");
    $dados = $query->fetchAll(PDO::FETCH_ASSOC);
    if(@count($dados) > 0){
        $titulo = $dados[0]['titulo'];
        $card_banner = $dados[0]['card_banner'];
        $banner = $dados[0]['banner'];
        $especialidade_atr = $dados[0]['especialidade_atr'];
        $descricao = $dados[0]['descricao'];
        $etapas = $dados[0]['etapas'];

        $foto_relac_01 = $dados[0]['foto_relac_01'];	
        $foto_relac_02 = $dados[0]['foto_relac_02'];		
        $foto_relac_03 = $dados[0]['foto_relac_03'];		
        $foto_relac_04 = $dados[0]['foto_relac_04'];	

        $video_relac_01 = $dados[0]['video_relac_01'];		
        $video_relac_02 = $dados[0]['video_relac_02'];

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

        if($banner === "" || $banner === "banner_placeholder.webp"){
            $banner = "<img src='assets/banner_tratamentos.webp' alt='$titulo'>";
        }
        else{
            $banner = "<img src='assets/tratamentos/$nome_get/$banner' alt='$titulo'>";
        }

        $nome_espec = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($especialidade_atr)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
        $especialidade_tratado = preg_replace('/[ -]+/', '_', $nome_espec);
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
    
    <title>O tratamnento de <?php echo $titulo ?> | One medical group</title>

    <link rel="icon" href="assets/icons/icon.svg" />
    <link rel="canonical" href="https://onemedicalgroup.com.br/tratamento_de_<?php echo $nome_clean ?>" />

    <meta name="author" content="VL7 marketing estrategico">
    <meta name="description" content="<?php echo $titulo ?>">
    <meta name="keywords" content="<?php echo $titulo ?>">

    <meta property="og:locale" content="pt_BR">
    <meta name="og:title" property="og:title" content="One Medical Group">
    <meta name="og:type" property="og:type" content="website">
    <meta name="og:image" property="og:image" content="assets/logo.png">
    <meta property="og:description" content="A One Medical Group oferece atendimento personalizado de saúde e estética com tecnologias avançadas, como o serviço exclusivo All In One e a Concierge de Beleza para um acompanhamento completo.">

    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Mask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <!-- Splide Carousel -->
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

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
            <a class="itensMenu" href="tratamentos">Tratamentos</a>
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

    <main id="Main_TratDetalhes">
        <a class="whats_link hide" target="_blank" href="https://wa.me/551151081977"><img src="assets/icons/whats.svg" onload="SVGInject(this)"></a>

        <section id="banner">
            <?php echo $banner ?>
            <p> o tratamento de </p>
            <h1><?php echo $titulo ?></h1>
            <span>Especialidade:<?php echo "<a href='especialidade_de_$especialidade_tratado'>$especialidade_atr</a>" ?></span>
        </section>
        <section id="como_Funicona">
           <h2>Como funciona o tratamento de <?php echo $titulo ?>?</h2>
           <p><?php echo $descricao ?></p>
        </section>

        <?php 
            // ETAPAS
            if($etapas !== ""){
                echo '
                     <section id="etapas">
                        <h2>Etapas do tratamento</h2>
                        <p>'.$etapas.'</p>
                    </section>
                ';
            }

            // FOTOS RESULTADOS
            if($foto_relac_01 !== "resultado.webp" || $foto_relac_02 !== "resultado.webp" || $foto_relac_03 !== "resultado.webp" || $foto_relac_04 !== "resultado.webp"){
                if($foto_relac_01 !== "resultado.webp"){
                    $result01 = '
                        <div class="img_block">
                            <img src="assets/tratamentos/'.$nome_get.'/'.$foto_relac_01.'">
                        </div> 
                    ';
                }else{ $result01 = '';}

                if($foto_relac_02 !== "resultado.webp"){
                    $result02 = '
                        <div class="img_block">
                            <img src="assets/tratamentos/'.$nome_get.'/'.$foto_relac_02.'">
                        </div> 
                    ';
                }else{ $result02 = '';}

                if($foto_relac_03 !== "resultado.webp"){
                    $result03 = '
                        <div class="img_block">
                            <img src="assets/tratamentos/'.$nome_get.'/'.$foto_relac_03.'">
                        </div> 
                    ';
                }else{ $result03 = '';}

                if($foto_relac_04 !== "resultado.webp"){
                    $result04 = '
                        <div class="img_block">
                            <img src="assets/tratamentos/'.$nome_get.'/'.$foto_relac_04.'">
                        </div> 
                    ';
                }else{ $result04 = '';}

                echo '
                    <section id="resultados">
                        <h2>Nossos resultados</h2>
                        '.$result01.'
                        '.$result02.'
                        '.$result03.'
                        '.$result04.'
                    </section>
                ';
            }
        
            // EQUIPE
            $query = $pdo->query("SELECT * FROM medicos where especialidade = '$especialidade_atr'");
            $dados = $query->fetchAll(PDO::FETCH_ASSOC);
            if(@count($dados) > 0){
                echo '
                    <section id="equipe">
                        <h2>Nossa equipe de '.$titulo.'</h2>
                        <div class="splide" role="group">
                            <div class="splide__track">
                                <ul class="splide__list">';
                                    for ($i=0; $i < count($dados); $i++) {
                                        $status_medico = $dados[$i]['status_perfil'];
                                        $card_medico = $dados[$i]['card_'];
                                        $nome_medico = $dados[$i]['nome'];
                                        $especialidade_medico = $dados[$i]['especialidade'];
        
                                        $nome_novo_medico = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($nome_medico)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                                        $nome_tratado_medico = preg_replace('/[ -]+/', '_', $nome_novo_medico);
        
                                        if($status_medico === "ativo" && $nome_medico !== ""){
                                            if($card_medico == "user_placeholder.webp" || $card_medico == ""){
                                                $card_medico = "<img src='assets/medicos/user_placeholder.webp' alt='$nome_medico - $especialidade_medico'>";
                                            }else{
                                                $card_medico = "<img src='assets/medicos/$nome_tratado_medico/$card_medico' alt='$nome_medico - $especialidade_medico'>";
                                            }
        
                                            echo "
                                                <li class='splide__slide'>
                                                    <a href='medico_$nome_tratado_medico'>
                                                        ".$card_medico."
                                                        <div class='infosCards'>
                                                            <h3 class='nome'>$nome_medico</h3>
                                                            <p class='espec_medico'>$especialidade_medico</p>
                                                        </div>
                                                    </a>
                                                </li>
                                            ";
                                        }
                                    }
                                    echo '
                                </ul>
                            </div>
                        </div>
                    </section>
                ';
            }
            else{
                echo '
                    <section id="equipe">
                        <h2>Conheça nosso corpo clínico</h2>
                        <p>Na ONE MEDICAL GROUP, valorizamos o que é mais importante: sua saúde e bem-estar. 
                            <br><br>
                            Na nossa equipe estão profissionais altamente qualificados em diversas áreas, comprometidos com diagnósticos precisos e tratamentos para atender suas necessidades, de forma integrada e humanizada. Explore nossas especialidades médicas e descubra como podemos ajudar a alcançar a sua melhor versão.
                        </p>
                        <div class="splide" role="group">
                            <div class="splide__track">
                                <ul class="splide__list">';
                                    $query = $pdo->query("SELECT * FROM medicos ORDER BY id DESC");
                                    $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                                    $j = 0;
                                    for ($i=0; $i < count($dados); $i++) {
                                        $status_medico = $dados[$i]['status_perfil'];
                                        $card_medico = $dados[$i]['card_'];
                                        $nome_medico = $dados[$i]['nome'];
                                        $especialidade_medico = $dados[$i]['especialidade'];

                                        $nome_novo_medico = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($nome_medico)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                                        $nome_tratado_medico = preg_replace('/[ -]+/', '_', $nome_novo_medico);
                                        if($status_medico === "ativo" && $nome_medico !== "" && $j <= 9){
                                            if($card_medico == "user_placeholder.webp" || $card_medico == ""){
                                                $card_medico = "<img src='assets/medicos/user_placeholder.webp' alt='$nome_medico - $especialidade_medico'>";
                                            }else{
                                                $card_medico = "<img src='assets/medicos/$nome_tratado_medico/$card_medico' alt='$nome_medico - $especialidade_medico'>";
                                            }

                                            echo "
                                                <li class='splide__slide'>
                                                    <a href='medico_$nome_tratado_medico'>
                                                        ".$card_medico."
                                                        <div class='infosCards'>
                                                            <h3 class='nome'>$nome_medico</h3>
                                                            <p class='espec_medico'>$especialidade_medico</p>
                                                        </div>
                                                    </a>
                                                </li>
                                            ";

                                            $j++;
                                        }
                                    }
                                    echo'
                                </ul>
                            </div>
                        </div>
                        <a href="equipe" class="btns btn_equipe">Conheça toda a equipe<img src="assets/icons/seta.svg" onload="SVGInject(this)"></a>
                    </section>
                ';
            }
        
            // VIDEOS RESULTADOS
            if($video_relac_01 !== "video_vazio.mp4" || $video_relac_02 !== "video_vazio.mp4"){
                if($video_relac_01 !== "video_vazio.mp4"){
                    $result01 = '
                        <div class="Block_VideoDepo" id="Block_VideoDepo01">
                            <img src="assets/icons/play_btn.svg" onload="SVGInject(this)" onclick="PLayVideo(`VideoDepo01`)">
                            <video controlsList="nodownload"  id="VideoDepo01" onclick="PLayVideo(`VideoDepo01`)">
                                <source src="assets/tratamentos/'.$nome_get.'/'.$video_relac_01.'" type="video/mp4">
                            </video>
                        </div>
                    ';
                }else{ $result01 = '';}

                if($video_relac_02 !== "video_vazio.mp4"){
                    $result02 = '
                        <div class="Block_VideoDepo" id="Block_VideoDepo02">
                            <img src="assets/icons/play_btn.svg" onload="SVGInject(this)" onclick="PLayVideo(`VideoDepo02`)">
                            <video controlsList="nodownload"  id="VideoDepo02" onclick="PLayVideo(`VideoDepo02`)">
                                <source src="assets/tratamentos/'.$nome_get.'/'.$video_relac_02.'" type="video/mp4">
                            </video>
                        </div>
                    ';
                }else{ $result02 = '';}

                echo '
                    <section id="depos"> 
                        <h2>Experiência dos nossos pacientes</h2>
                        <div class="Block_videos">
                            '.$result01.'
                            '.$result02.'
                        </div>
                    </section>
                ';
            }
        ?>

        <section id="espaco">
            <div id="Block_textEspaco">
                <h2>Nosso espaço</h2>
                <p>
                    É um imenso prazer apresentar para você um pouco da ONEMEDICAL GROUP, onde a excelência em atendimento encontra a mais avançada estrutura física e tecnologica. 
                    <br><br>
                    Localizada no <b>Cidade Jardim Corporate Center Continental Tower</b>, em um dos bairros mais nobres de São Paulo, a ONE foi projetada para oferecer conforto, elegância, conveniência e uma experiência de saúde premium para nossos pacientes.
                    <br><br>
                    Na ONE, redefinimos o conceito de cuidado médico para uma experiencia única e exclusiva.
                    <br><br>
                    Em um ambiente de elegância e conforto, nossa ampla estrutura inclui uma área exclusiva, um espaço acolhedor e tranquilo enquanto você aguarda seu atendimento. Os consultórios são totalmente equipados, cada um desenhado para garantir que os procedimentos sejam realizados com a máxima precisão, garantindo que você tenha acesso a todos os recursos em um único lugar e com muito conforto. 
                    <br><br>
                    Na ONE, nosso compromisso é proporcionar um atendimento humanizado e de excelência, onde cada paciente recebe um plano de cuidado orientado pelas melhores práticas e inovações na área da saúde. Experimente o padrão ONE de excelência médica, onde seu bem-estar é nossa prioridade. 
                </p>
                <a href="clinica" class="btns btn_espaco">Conheça nossa historia<img src="assets/icons/seta.svg" onload="SVGInject(this)"></a>
            </div>
            <div id="Block_VideoEspaco">
                <img src="assets/icons/play_btn.svg" onload="SVGInject(this)" onclick="PLayVideo('VideoEspaco')">
                <video controlsList="nodownload" id="VideoEspaco" onclick="PLayVideo('VideoEspaco')">
                    <source src="assets/Videos/Bg_video.mp4" type="video/mp4">
                </video>
            </div>
        </section>

        <!-- FAQ -->
        <?php
            if($pgnt_01 !== "" || $pgnt_02 !== "" || $pgnt_03 !== "" || $pgnt_04 !== "" || $pgnt_05 !== "" || $pgnt_06 !== ""){
                // FAQ
                if($pgnt_01 !== ""){
                    $result01 = '
                        <div class="Block_pergunta">
                            <h3>'.$pgnt_01.'</h3>
                            <p>'.$resp_01.'</p>
                        </div>
                    ';
                }else{ $result01 = '';}

                if($pgnt_02 !== ""){
                    $result02 = '
                        <div class="Block_pergunta">
                            <h3>'.$pgnt_02.'</h3>
                            <p>'.$resp_02.'</p>
                        </div>
                    ';
                }else{ $result02 = '';}

                if($pgnt_03 !== ""){
                    $result03 = '
                        <div class="Block_pergunta">
                            <h3>'.$pgnt_03.'</h3>
                            <p>'.$resp_03.'</p>
                        </div>
                    ';
                }else{ $result03 = '';}

                if($pgnt_04 !== ""){
                    $result04 = '
                        <div class="Block_pergunta">
                            <h3>'.$pgnt_04.'</h3>
                            <p>'.$resp_04.'</p>
                        </div>
                    ';
                }else{ $result04 = '';}

                if($pgnt_05 !== ""){
                    $result05 = '
                        <div class="Block_pergunta">
                            <h3>'.$pgnt_05.'</h3>
                            <p>'.$resp_05.'</p>
                        </div>
                    ';
                }else{ $result05 = '';}

                if($pgnt_06 !== ""){
                    $result06 = '
                        <div class="Block_pergunta">
                            <h3>'.$pgnt_06.'</h3>
                            <p>'.$resp_06.'</p>
                        </div>
                    ';
                }else{ $result06 = '';}

                echo'
                    <section id="FAQ">
                        <h2>Perguntas frequentes</h2>
                        <div class="block_perguntas">
                            '.$result01.'
                            '.$result02.'
                            '.$result03.'
                            '.$result04.'
                            '.$result05.'
                            '.$result06.'
                        </div>
                    </section>
                ';
            }
        ?>
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

    <script>
        document.addEventListener( 'DOMContentLoaded', function() {
            var elms = document.getElementsByClassName( 'splide' );
            for ( var i = 0; i < elms.length; i++ ) {
                if(mobileCheck() === false){
                    if(i == 0){
                        new Splide( elms[i], {
                            perPage: 4,
                            perMove: 1,
                            omitEnd: true,
                        }).mount();
                    }
                } 
                else{
                    if(i == 0){
                        new Splide( elms[i], {
                            drag   : 'free',
                            perPage: 1,
                            perMove: 1,
                            omitEnd: true,
                            autoplay: true
                        }).mount();
                    }
                }
            }
        });
    </script>
</body>
</html>
<?php 
    require_once("./Sistema/configs/conexao.php"); 

    $nome_get = @$_GET['nome'];
    $nome_clean = preg_replace('/_/', ' ', $nome_get);

    if($nome_get !== "" && $nome_get !== NULL){
        $title_page = "<title>Tratamentos de $nome_clean | One medical group</title>";
    }
    else{
        $title_page = "<title>Tratamentos | One medical group</title>";
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $title_page ?>

    <link rel="icon" href="assets/icons/icon.svg" />
    <link rel="canonical" href="https://onemedicalgroup.com.br/especialidade_de_<?php echo $nome_clean ?>" />

    <meta name="author" content="VL7 marketing estrategico">
    <meta name="description" content="<?php echo $nome_clean ?>">
    <meta name="keywords" content="<?php echo $nome_clean ?>">

    <meta property="og:locale" content="pt_BR">
    <meta name="og:title" property="og:title" content="One Medical Group">
    <meta name="og:type" property="og:type" content="website">
    <meta name="og:image" property="og:image" content="assets/logo.png">
    <meta property="og:description" content="A One Medical Group oferece atendimento personalizado de saúde e estética com tecnologias avançadas, como o serviço exclusivo All In One e a Concierge de Beleza para um acompanhamento completo.">

    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
            <a class="itensMenu <?php if($nome_get === "" || $nome_get === NULL){ echo "active"; }?>" href="tratamentos">Tratamentos</a>
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

    <main id="Main_tratamentos">
        <a class="whats_link hide" target="_blank" href="https://wa.me/551151081977"><img src="assets/icons/whats.svg" onload="SVGInject(this)"></a>

        <?php
            if($nome_get !== "" && $nome_get !== NULL){
                $query = $pdo->query("SELECT * FROM especialidade where nome = '$nome_clean'");
                $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                if(@count($dados) > 0){
                    $foto_espec = $dados[0]['foto'];
                    $nome_espec = $dados[0]['nome'];
                    $descricao_espec = $dados[0]['descricao'];

                    $cor_back = rand(0,3);
                    if($cor_back == 0){ $cor_back = 'amarelo'; }
                    if($cor_back == 1){ $cor_back = 'preto'; }
                    if($cor_back == 2){ $cor_back = 'cinza'; }
                    if($cor_back == 3){ $cor_back = 'marrom'; }

                    if($foto_espec !== "placeholder.webp"){
                        $foto_espec = "<img src='assets/especialidades/$foto_espec' alt='$nome_espec'>";
                        echo "
                            <section id='banner'>
                                ".$foto_espec."
                                <div id='Titulo_banner' class='$cor_back'>
                                    <span> Especialidade de </span>
                                    <h1>".$nome_espec."</h1>
                                </div>
                                <p>".$descricao_espec."</p>
                            </section>
                        ";
                    }
                    else{
                        echo "<script language='javascript'> window.location='./' </script>";
                    }
                }
                else{
                    echo "<script language='javascript'> window.location='./' </script>";
                }
            }

            else{
                echo '
                    <section id="banner">
                        <div id="Titulo_banner">
                            <span> Conheça todos os </span>
                            <h1>Tratamentos da One</h1>
                        </div>
                        <img src="assets/banner_tratamentos.webp" alt="">
                        <p>
                        Oferecemos uma ampla gama de tratamentos estéticos faciais, corporais e íntimos que combinam técnicas avançadas e tecnologias de última geração para proporcionar resultados naturais e eficazes.
                        <br><br>
                        São procedimentos, cirurgías estéticas ou reparadores que têm como objetivo melhorar a aparência e a função de determinadas áreas do rosto e do corpo e que podem ajudar a corrigir imperfeições, melhorar contornos, restaurar a harmonia e reverter sinais de envelhecimento.</p>
                    </section>
                ';
            }

        ?>
        
        <section id="Listagem_tratamentos">
            <?php
                if($nome_get !== "" && $nome_get !== NULL){
                    $query = $pdo->query("SELECT * FROM tratamentos WHERE especialidade_atr = '$nome_clean'");
                    $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                    if(@count($dados) > 0){
                        echo "<div class='tratamentosEspecialidade_block'>";
                            for ($i=0; $i < count($dados); $i++) {
                                $titulo_tratamento = $dados[$i]['titulo'];
                                $card_Banner = $dados[$i]['card_banner'];

                                $nome_novo_tratamento = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($titulo_tratamento)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                                $nome_tratado_tratamento = preg_replace('/[ -]+/', '_', $nome_novo_tratamento);
                                
                                if($card_Banner !== "card_placeholder.webp" && $titulo_tratamento !== ""){
                                    $card_Banner = "<img src='assets/tratamentos/$nome_tratado_tratamento/$card_Banner' alt='$titulo_tratamento'>";
                                    echo "
                                        <div class='tratamento_card'>
                                            <div class='Block_img'>
                                                ".$card_Banner."
                                            </div>
                                            <div class='infosCards'>
                                                <h3 class='nome'>$titulo_tratamento</h3>
                                                <a href='tratamento_de_$nome_tratado_tratamento' class='btns btn_CardTratamento'>Veja mais</a>
                                            </div>
                                        </div>
                                    ";
                                }
                            }
                        echo "</div>";
                    }
                }
                else{
                    $query = $pdo->query("SELECT * FROM especialidade ORDER BY id DESC");
                    $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                    for ($i=0; $i < count($dados); $i++) { 
                        $foto_espec = $dados[$i]['foto'];
                        $nome_espec = $dados[$i]['nome'];
    
                        $nome_novo_espec = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($nome_espec)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                        $nome_tratado_espec = preg_replace('/[ -]+/', '_', $nome_novo_espec);
                        
                        if($foto_espec !== "placeholder.webp"){
                            $query2 = $pdo->query("SELECT * FROM tratamentos WHERE especialidade_atr = '$nome_espec'");
                            $dados2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                            if(@count($dados2) > 0){
                                echo "
                                    <div class='tratamentos_block'>
                                        <a href='especialidade_de_$nome_tratado_espec'><h2>".$nome_espec."</h2></a>
        
                                        <div class='splide tratamento_splide' role='group'>
                                            <div class='splide__track'>
                                                <ul class='splide__list'>";
        
                                                    $query3 = $pdo->query("SELECT * FROM tratamentos WHERE especialidade_atr = '$nome_espec'");
                                                    $dados3 = $query3->fetchAll(PDO::FETCH_ASSOC);
                                                    for ($j=0; $j < count($dados3); $j++) { 
                                                        $titulo_tratamento = $dados3[$j]['titulo'];
                                                        $card_Banner = $dados3[$j]['card_banner'];
        
                                                        $nome_novo_tratamento = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($titulo_tratamento)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                                                        $nome_tratado_tratamento = preg_replace('/[ -]+/', '_', $nome_novo_tratamento);
                                                        
                                                        if($card_Banner !== "card_placeholder.webp" && $titulo_tratamento !== ""){
                                                            $card_Banner = "<img src='assets/tratamentos/$nome_tratado_tratamento/$card_Banner' alt='$titulo_tratamento'>";
        
                                                            echo "
                                                                <li class='splide__slide'>
                                                                    <div class='Block_img'>
                                                                        ".$card_Banner."
                                                                    </div>
                                                                    <div class='infosCards'>
                                                                        <h3 class='nome'>$titulo_tratamento</h3>
                                                                        <a href='tratamento_de_$nome_tratado_tratamento' class='btns btn_CardTratamento'>Veja mais</a>
                                                                    </div>
                                                                </li>
                                                            ";
                                                        }
                                                    }
        
                                                    echo "    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                ";
                            }
                        }
                    }
                }

            ?>
        </section>

        <?php
            if($nome_get === "" || $nome_get === NULL){
                echo '
                    <section id="depos"> 
                        <h2>Conexão One</h2>
                        <p>Experiências de quem confia na One.</p>
                        <div class="splide depo_splide" role="group">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    <li class="splide__slide">
                                        <div class="Block_VideoDepo" id="Block_VideoDepo01">
                                            <img src="assets/icons/play_btn.svg" onload="SVGInject(this)" onclick="PLayVideo(`VideoDepo01`)">
                                            <video controlsList="nodownload" id="VideoDepo01" onclick="PLayVideo(`VideoDepo01`)">
                                                <source src="assets/Videos/depo_01.mp4" type="video/mp4">
                                            </video>
                                        </div>
                                    </li>
                                    <li class="splide__slide">
                                        <div class="Block_VideoDepo" id="Block_VideoDepo02">
                                            <img src="assets/icons/play_btn.svg" onload="SVGInject(this)" onclick="PLayVideo(`VideoDepo02`)">
                                            <video controlsList="nodownload" id="VideoDepo02" onclick="PLayVideo(`VideoDepo02`)">
                                                <source src="assets/Videos/depo_02.mp4" type="video/mp4">
                                            </video>
                                        </div>
                                    </li>
                                    <li class="splide__slide">
                                        <div class="Block_VideoDepo" id="Block_VideoDepo03">
                                            <img src="assets/icons/play_btn.svg" onload="SVGInject(this)" onclick="PLayVideo(`VideoDepo03`)">
                                            <video controlsList="nodownload" id="VideoDepo03" onclick="PLayVideo(`VideoDepo03`)">
                                                <source src="assets/Videos/depo_01.mp4" type="video/mp4">
                                            </video>
                                        </div>
                                    </li>
                                    <li class="splide__slide">
                                        <div class="Block_VideoDepo" id="Block_VideoDepo04">
                                            <img src="assets/icons/play_btn.svg" onload="SVGInject(this)" onclick="PLayVideo(`VideoDepo04`)">
                                            <video controlsList="nodownload" id="VideoDepo04" onclick="PLayVideo(`VideoDepo04`)">
                                                <source src="assets/Videos/depo_02.mp4" type="video/mp4">
                                            </video>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <script>
                        document.addEventListener( `DOMContentLoaded`, function() {
                            if(mobileCheck() === false){
                                var depos = new Splide( `.depo_splide`, {
                                    omitEnd: true,
                                    perPage: 2,
                                    perMove: 1,
                                    drag   : false
                                });
                            } 
                            else{
                                var depos = new Splide( `.depo_splide`, {
                                    drag   : `free`,
                                    omitEnd: true,
                                    perPage: 1,
                                    perMove: 1,
                                    drag   : false
                                });
                            }
                            depos.mount();
                        });
                    </script>
                ';
            }
        ?>
        
        <section id="equipe">
            <h2>Conheça nosso corpo clínico</h2>
            <p>Na One Medical Group, contamos com um time de profissionais altamente capacitados e reconhecidos em suas áreas de atuação. Cada membro de nossa equipe se destaca por sua expertise e compromisso com a atualização constante nas mais recentes inovações e técnicas médicas. Aqui estão os nossos renomados especialistas que fazem parte da nossa equipe</p>
            <div class="splide equipe_splide" role="group">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php
                            if($nome_get !== "" && $nome_get !== NULL){
                                $query = $pdo->query("SELECT * FROM medicos WHERE especialidade = '$nome_clean'");
                                $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                                if(@count($dados) == 0){
                                    $query = $pdo->query("SELECT * FROM medicos ORDER BY id DESC");
                                    $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                                }
                            }
                            else{
                                $query = $pdo->query("SELECT * FROM medicos ORDER BY id DESC");
                                $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                            }

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
                        ?>
                    </ul>
                </div>
            </div>
            <a href="equipe" class="btns btn_equipe">Conheça toda a equipe<img src="assets/icons/seta.svg" onload="SVGInject(this)"></a>
        </section>

        <?php
            if($nome_get === "" || $nome_get === NULL){
                echo '
                    <section id="concierge">
                        <div id="Block_textConcierge">
                            <h2>Quem é a Concierge <br> de Beleza?</h2>
                            <p>
                                ANNA FARFALLA é a especialista em atendimento ao paciente que atua como o elo entre você e todas as possiblidades
                                de procedimentos estéticos que a ONE oferece.
                                <br><br>
                                Ela possui total conhecimento sobre serviços e tratamentos
                                e estará sempre disponível para escutar suas necessidades, responder suas dúvidas e proporcionar orientações valiosas.
                            </p>
                            <span>
                                Agende sua consulta e descubra como nossa Concierge de Beleza pode transformar sua jornada de beleza em uma experiência única.
                            </span>
                            <a target="_blank" href="https://wa.me/551151081977" class="btns btn_Concierge">Agendar Atendimento</a>
                        </div>
                        <img src="assets/concierge.webp" alt="">
                    </section>
                    <section id="allInOne">
                        <div id="Block_VideoAllinOne">
                            <img src="assets/icons/play_btn.svg" onload="SVGInject(this)" onclick="PLayVideo(`VideoAllinOne`)">
                            <video controlsList="nodownload" id="VideoAllinOne" onclick="PLayVideo(`VideoAllinOne`)">
                                <source src="assets/Videos/atendimento.mp4" type="video/mp4">
                            </video>
                        </div>
                        <div id="Block_textAllinOne">
                            <h2>O que é o atendimento all in one</h2>
                            <p>
                                Acreditamos que o cuidado com a saúde e a beleza deve ser abrangente e contínuo e por isso, desenvolvemos o atendimento <b>All In One</b>, um serviço exclusivo que oferece um acompanhamento personalizado e único. 
                                <br><br>
                                O <b>All In One</b> começa com uma consulta ampla, onde os profissionais de saúde realizam uma análise completa das suas expectativas e desejos.
                                <br><br>
                                Com base nestas informações, elaboramos um plano personalizado que inclui as opções de intervenções que serão executadas, o programa de avaliações periódicas e o monitoramento da evolução do seu procedimento.
                                <br><br>
                                Nosso objetivo é garantir que você receba toda a atenção, além das indispensáveis a sua terapia, com detalhes, sugestões de técnicas novas, procedimentos complementares e suporte contínuo.
                                <br><br>
                                Estamos comprometidos em oferecer um serviço de excelência que se adapte aos seus sonhos e necessidades e que garanta todas opções e recursos terapêuticos sejam considerados e discutidos em conjunto, proporcionando uma experiência de cuidado completa e personalizada.
                                <br><br>
                                Isso é parte fundamental do compromisso da One Medical Group, a sua saúde.
                            </p>
                            <a target="_blank" href="https://wa.me/551151081977" class="btns btn_AllInOne">Marcar Consulta</a>
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
            var elms = document.getElementsByClassName( 'tratamento_splide' );
            for ( var i = 0; i < elms.length; i++ ) {
                if(mobileCheck() === false){
                    new Splide( elms[i], {
                        perPage: 4,
                        perMove: 1,
                        omitEnd: true
                    }).mount();
                } 
                else{
                    new Splide( elms[i], {
                        perPage: 1,
                        perMove: 1,
                        type: 'loop',
                        autoplay: true
                    }).mount();
                }
            }

            if(mobileCheck() === false){
                var equipe = new Splide( '.equipe_splide', {
                    perPage: 5,
                    perMove: 1,
                    omitEnd: true,
                });
            } 
            else{
                var equipe = new Splide( '.equipe_splide', {
                    drag   : 'free',
                    perPage: 1,
                    perMove: 1,
                    omitEnd: true,
                    autoplay: true
                });
            }

            equipe.mount();
        });
    </script>
</body>
</html>
<?php require_once("./Sistema/configs/conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especialidades | One medical group</title>

    <link rel="icon" href="assets/icons/icon.svg" />
    <link rel="canonical" href="https://onemedicalgroup.com.br/especialidades" />

    <meta name="author" content="VL7 marketing estrategico">
    <meta name="description" content="Conheça as especialidades da One Medical Group, com profissionais qualificados e atendimento personalizado. Descubra a Concierge de Beleza e o exclusivo serviço All In One, oferecendo cuidados integrados e contínuos para sua saúde e beleza. Veja também depoimentos de clientes satisfeitos.">
    <meta name="keywords" content="especialidades médicas, atendimento personalizado, Concierge de Beleza, serviço All In One, cuidados de saúde, beleza, tratamentos estéticos, depoimentos clientes, One Medical Group">

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
            <a class="itensMenu active" href="especialidades">Especialidades</a>
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

    <main id="Main_especialidades">
        <a class="whats_link hide" target="_blank" href="https://wa.me/551151081977"><img src="assets/icons/whats.svg" onload="SVGInject(this)"></a>
        
        <section id="Especialidades">
            <h1>Especialidades One Medical Group</h1>
            <h2>Em nossa equipe estão profissionais altamente qualificados em diversas áreas, comprometidos em proporcionar diagnósticos precisos e tratamentos para atender suas necessidades, de forma integrada e humanizada. Explore nossas especialidades médicas e descubra como podemos ajudar a alcançar a sua melhor versão e uma vida mais saudável e equilibrada.</h2>
            
            <div id="especialidadesCards">
                <?php
                    $query = $pdo->query("SELECT * FROM especialidade ORDER BY id DESC");
                    $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                    for ($i=0; $i < count($dados); $i++) { 
                        $foto_espec = $dados[$i]['foto'];
                        $nome_espec = $dados[$i]['nome'];
                        $descricao_espec = $dados[$i]['descricao'];

                        $cor_back = rand(0,3);
                        if($cor_back == 0){ $cor_back = 'amarelo'; }
                        if($cor_back == 1){ $cor_back = 'preto'; }
                        if($cor_back == 2){ $cor_back = 'cinza'; }
                        if($cor_back == 3){ $cor_back = 'marrom'; }

                        $nome_novo_espec = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($nome_espec)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                        $nome_tratado_espec = preg_replace('/[ -]+/', '_', $nome_novo_espec);
                        if($foto_espec !== "placeholder.webp"){
                            $foto_espec = "<img src='assets/especialidades/$foto_espec' alt='$nome_espec'>";
                            
                            echo "
                                <div class='especialidade_card $cor_back'>
                                    ".$foto_espec."
                                    <h3>".$nome_espec."</h3>
                                    <p>".$descricao_espec."</p>
                                    <a class='btns btn_card' href='especialidade_de_$nome_tratado_espec'>Saiba mais <img src='assets/icons/seta.svg' onload='SVGInject(this)'></a>
                                </div>
                            ";
                        }
                    }
                ?>
            </div>
        </section>

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
                <img src="assets/icons/play_btn.svg" onload="SVGInject(this)" onclick="PLayVideo('VideoAllinOne')">
                <video controlsList="nodownload" id="VideoAllinOne" onclick="PLayVideo('VideoAllinOne')">
                    <source src="assets/Videos/atendimento.mp4" type="video/mp4">
                </video>
            </div>
            <div id="Block_textAllinOne">
                <h2>O que é o atendimento all in one</h2>
                <p>
                    É um conceito que define que o cuidado com a saúde e a beleza deve ser abrangente e contínuo. Um serviço exclusivo que oferece um acompanhamento personalizado e único.
                    <br><br>
                    A partir de uma consulta ampla, nossa equipe médica realiza uma análise completa das suas expectativas e desejos e elabora um plano personalizado que inclui: opções de intervenções que serão executadas, o programa de avaliações periódicas e o monitoramento da evolução do seu procedimento, uso das tecnologias. 
                    <br><br>
                    Assim garantimos que você receberá toda a atenção, que vai além das indispensáveis à sua terapia, com detalhes, sugestões de técnicas novas, procedimentos complementares e suporte contínuo.
                    <br><br>
                    O ALL IN ONE é serviço de excelência, que se adapta aos seus sonhos e necessidades e garante que todas opções e recursos terapêuticos sejam considerados e discutidos em conjunto, proporcionando uma experiência de cuidado completa e personalizada.
                    <br><br>
                    Isso é parte fundamental do compromisso da ONE Medical Group com sua saúde e beleza 
                </p>
                <a target="_blank" href="https://wa.me/551151081977" class="btns btn_AllInOne">Marcar Consulta</a>
            </div>
        </section>
        
        <section id="depos"> 
            <h2>Conexão One</h2>
            <p>Experiências de quem confia na One.</p>
            <div class="splide" role="group">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <div class="Block_VideoDepo" id="Block_VideoDepo01">
                                <img src="assets/icons/play_btn.svg" onload="SVGInject(this)" onclick="PLayVideo('VideoDepo01')">
                                <video controlsList="nodownload" id="VideoDepo01" onclick="PLayVideo('VideoDepo01')">
                                    <source src="assets/Videos/depo_01.mp4" type="video/mp4">
                                </video>
                            </div>
                        </li>
                        <li class="splide__slide hide">
                            <div class="Block_VideoDepo" id="Block_VideoDepo02">
                                <img src="assets/icons/play_btn.svg" onload="SVGInject(this)" onclick="PLayVideo('VideoDepo02')">
                                <video controlsList="nodownload" id="VideoDepo02" onclick="PLayVideo('VideoDepo02')">
                                    <source src="assets/Videos/depo_02.mp4" type="video/mp4">
                                </video>
                            </div>
                        </li>
                        <li class="splide__slide hide">
                            <div class="Block_VideoDepo" id="Block_VideoDepo03">
                                <img src="assets/icons/play_btn.svg" onload="SVGInject(this)" onclick="PLayVideo('VideoDepo03')">
                                <video controlsList="nodownload" id="VideoDepo03" onclick="PLayVideo('VideoDepo03')">
                                    <source src="assets/Videos/depo_01.mp4" type="video/mp4">
                                </video>
                            </div>
                        </li>
                        <li class="splide__slide hide">
                            <div class="Block_VideoDepo" id="Block_VideoDepo04">
                                <img src="assets/icons/play_btn.svg" onload="SVGInject(this)" onclick="PLayVideo('VideoDepo04')">
                                <video controlsList="nodownload" id="VideoDepo04" onclick="PLayVideo('VideoDepo04')">
                                    <source src="assets/Videos/depo_02.mp4" type="video/mp4">
                                </video>
                            </div>
                        </li>
                    </ul>
                </div>
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

    <script>
        document.addEventListener( 'DOMContentLoaded', function() {
            var elms = document.getElementsByClassName( 'splide' );
            for ( var i = 0; i < elms.length; i++ ) {
                if(mobileCheck() === false){
                    if(i == 0){
                        new Splide( elms[i], {
                            omitEnd: true,
                            perPage: 2,
                            perMove: 1,
                            drag   : false
                        }).mount();
                    }
                } 
                else{
                    if(i == 0){
                        new Splide( elms[i], {
                            drag   : 'free',
                            omitEnd: true,
                            perPage: 1,
                            perMove: 1,
                            drag   : false
                        }).mount();
                    }
                }
            }
        });
    </script>
</body>
</html>
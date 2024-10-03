<?php require_once("./Sistema/configs/conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONE medical group</title>

    <link rel="icon" href="assets/icons/icon.svg" />
    <link rel="canonical" href="https://onemedicalgroup.com.br" />

    <meta name="author" content="VL7 marketing estrategico">
    <meta name="description" content="A One Medical Group oferece atendimento personalizado e exclusivo para saúde e beleza, com serviços como o All In One, suporte contínuo e a Concierge de Beleza. Localizada em São Paulo, a clínica oferece consultas detalhadas e acompanhamento completo. Agende uma consulta para uma experiência única e diferenciada.">
    <meta name="keywords" content="One Medical Group, saúde, beleza, All In One, Concierge de Beleza, clínica em São Paulo, atendimento personalizado, tratamentos estéticos, consultas, acompanhamento, estética, bem-estar">

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
                <a class="links" href="#home">
                    <h1 class="hide">ONE Medical Group</h1>
                    <img src="assets/logo.png" alt="Logo one medical group">
                </a>
            </li>
            <li><a class="btns btn_agendamento" href="" target="_blank">marcar consulta</a></li>
            <li onclick="sideMenu()"><span id="sideMenu_btn"></span></li>
        </ul>
        <div id="sideMenu" class="hide">
            <button type="button" onclick="sideMenu()"></button>

            <a class="itensMenu" href="clinica">A ONE</a>
            <a class="itensMenu" href="especialidades">Especialidades</a>
            <a class="itensMenu" href="equipe">Equipe ONE</a>
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

    <main id="Main_index">
        <a class="whats_link hide" target="_blank" href="https://wa.me/551151081977"><img src="assets/icons/whats.svg" onload="SVGInject(this)"></a>

        <section id="home">
            <div class="sideBanner" id="Redes_home">
                <a href="" target="_blank" class="redes_banner"><img src="assets/icons/instagram.svg" onload="SVGInject(this)">Instagram</a>
                <a href="" target="_blank" class="redes_banner"><img src="assets/icons/facebook.svg" onload="SVGInject(this)">Facebook</a>
                <button><img src="assets/icons/seta.svg" onload="SVGInject(this)"></button>
            </div>
            <div id="banner">
                <video autoplay loop muted>
                    <source src="assets/Videos/Bg_video.mp4" type="video/mp4">
                </video>
                <h2>
                    FIND YOUR BEST VERSION.
                </h2>
                <h3>Experiencia única, especialistas de referência e tecnologia de última geração.</h3>
                <a href="clinica" class="btns btn_banner">Veja mais da clínica <img src="assets/icons/seta.svg" onload="SVGInject(this)"></a>
            </div>
            <div class="sideBanner" id="whats_home">
                <a href="" target="_blank" class="redes_banner"><img src="assets/icons/whats.svg" onload="SVGInject(this)">Agendar uma consulta</a>
            </div>
        </section>
        <section id="clinica">
            <div id="Block_textClinica">
                <h2>A ONE</h2>
                <p>
                    É um prazer receber você na ONE Medical Group, onde cada detalhe foi pensado para realçar a sua beleza. Temos uma missão de redefinir o conceito de cuidados com a beleza, a partir de uma abordagem integrada e personalizada.
                    <br><br>
                    Desde o primeiro contato nossos especialistas trabalham em conjunto para oferecer um acompanhamento coordenado e contínuo, em cada etapa do seu tratamento. Este diferencial da ONE em unir diversas especialidades em um só lugar, para um cuidado completo e multidisciplinar nos capacita a oferecer soluções que respeitam a individualidade e as necessidades do paciente. Com uma infraestrutura moderna e acolhedora, que garante total privacidade e conforto, a ONE se destaca pelo atendimento excepcional e busca constante pela excelência.
                    Aqui, você encontra mais do que uma clínica: Nós somos seu parceiro na sua jornada para encontrar a sua melhor versão.
                </p>
                <a href="clinica" class="btns btn_clinica">Veja mais da clínica <img src="assets/icons/seta.svg" onload="SVGInject(this)"></a>
            </div>
            <img id="clinica_Img" src="assets/Clinica.webp" alt="">
        </section>
        <section id="espaco">
            <div id="Block_VideoEspaco">
                <img src="assets/icons/play_btn.svg" onload="SVGInject(this)" onclick="PLayVideo('VideoEspaco')">
                <video controlsList="nodownload" id="VideoEspaco" onclick="PLayVideo('VideoEspaco')">
                    <source src="assets/Videos/Bg_video.mp4" type="video/mp4">
                </video>
            </div>
            <div id="Block_textEspaco">
                <h2>Nosso espaço</h2>
                <p>
                    Localizada no Complexo do Shopping Cidade Jardim, em um dos bairros mais nobres de São Paulo. Temos o privilégio de estar próximos aos principais hospitais da cidade. Buscamos trazer o requinte e sofisticação de um Hotel Boutique, propiciando o acolhimento necessário para uma imersão na experiência ONE. 
                    <br><br>
                    O conceito traz uma experiencia única, num ambiente de elegância e tranquilidade, com ampla estrutura que inclui desde um espaço exclusivo e acolhedor, e consultórios totalmente equipados, desenhados para garantir que os procedimentos sejam realizados com a máxima precisão e segurança.
                </p>
            </div>
        </section>
        <section id="especialidades">
            <div id="textEspecialidade" class="especialidadeBlock">
                <h2>As especialidades da ONE Medical</h2>
                <p>Na ONE MEDICAL GROUP, valorizamos o que é mais importante para você: a sua saúde e bem-estar. Por isso, oferecemos um atendimento personalizado e de excelência.</p>
                <a href="especialidades" class="btns btn_especialidades">Veja as especialidades</a>
            </div>
            <?php
                $query = $pdo->query("SELECT * FROM especialidade ORDER BY id DESC");
                $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                $j = 0;
                for ($i=0; $i < count($dados); $i++) { 
                    $foto_espec = $dados[$i]['foto'];
                    $nome_espec = $dados[$i]['nome'];

                    $cor_back = rand(0,3);
                    if($cor_back == 0){ $cor_back = 'amarelo'; }
                    if($cor_back == 1){ $cor_back = 'preto'; }
                    if($cor_back == 2){ $cor_back = 'cinza'; }
                    if($cor_back == 3){ $cor_back = 'marrom'; }

                    $nome_novo_espec = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($nome_espec)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                    $nome_tratado_espec = preg_replace('/[ -]+/', '_', $nome_novo_espec);
                    if($foto_espec !== "placeholder.webp" && $j <= 6){
                        $foto_espec = "<img src='assets/especialidades/$foto_espec' alt='$nome_espec'>";
                        echo "
                            <a class='especialidadeBlock' href='especialidade_de_$nome_tratado_espec'>
                                ".$foto_espec."
                                <p class='$cor_back'>".$nome_espec."</p>
                            </a>
                        ";
                        $j++;
                    }
                }
            ?>
        </section>
        <section id="equipe">
            <h2>Conheça nosso corpo clínico</h2>
            <p>
                Na ONE Medical Group, contamos com profissionais altamente capacitados e reconhecidos em suas áreas de atuação. 
                <br><br>
                Cada membro de nossa equipe se destaca por sua expertise e pelo compromisso com a atualização constante nas mais recentes inovações tecnológicas e práticas de saúde e beleza 
                <br><br>
                Aqui estão os especialistas que fazem parte da nossa equipe.
            </p>
            <div class="splide" role="group">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php
                            $query = $pdo->query("SELECT * FROM medicos ORDER BY id ASC");
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
                        ?>
                    </ul>
                </div>
            </div>
            <a href="equipe" class="btns btn_equipe">Conheça toda a equipe<img src="assets/icons/seta.svg" onload="SVGInject(this)"></a>
        </section>
        <section id="tratamentos">
            <div id="tratamentosInfos">
                <div id="Block_textTratamentos">
                    <h2>As Tecnologias da ONE medical group</h2>
                    <p>
                        Na ONE Medical Group estamos comprometidos em oferecer aos pacientes soluções de saúde e estética que atendam às suas mais altas expectativas e para isso, acesso às tecnologias mais avançadas do mercado de estética. Nossos equipamentos de última geração foram selecionados para garantir resultados excepcionais e atender às necessidades de cada procedimento.
                        <br><br>
                        Entre eles, destacam-se o <b>Ultraformer MPT</b>, que realiza lifting e rejuvenescimento com alta precisão, o <b>Laser Fotona Dynamis NX</b>, conhecido por sua versatilidade e eficácia, o <b>Discovery Pico Plus</b>, a escolha ideal para tratamentos de pigmentações e rejuvenescimento da pele, o <b>Vectra XT</b> que oferece uma análise detalhada das características física no planejamento de procedimentos estéticos e o Volnewmer que combina tecnologia avançada para tratar a firmeza e revitalização da pele.
                        <br><br>
                        Cada um desses <b>equipamentos é uma peça fundamental no nosso compromisso com a qualidade e a inovação.</b> Clique e conheça cada um.
                    </p>
                </div>
                <img src="assets/tratamentos/tratamentos.webp" alt="">
            </div>
            <div id="tratamentosimgs">
                <div class="splide" role="group">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php
                                $query = $pdo->query("SELECT * FROM tratamentos ORDER BY id DESC");
                                $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                                $j = 0;
                                for ($i=0; $i < count($dados); $i++) {
                                    $titulo_tratamento = $dados[$i]['titulo'];
                                    $card_Banner = $dados[$i]['card_banner'];

                                    $nome_novo_tratamento = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($titulo_tratamento)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                                    $nome_tratado_tratamento = preg_replace('/[ -]+/', '_', $nome_novo_tratamento);
                                    if($card_Banner !== "card_placeholder.webp" && $titulo_tratamento !== "" && $j <= 11){
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
                                        $j++;
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section id="allInOne">
            <div id="Block_VideoAllinOne">
                <img src="assets/icons/play_btn.svg" onload="SVGInject(this)" onclick="PLayVideo('VideoAllinOne')">
                <video controlsList="nodownload" id="VideoAllinOne" onclick="PLayVideo('VideoAllinOne')">
                    <source src="assets/Videos/atendimento.mp4" type="video/mp4">
                </video>
            </div>
            <div id="Block_textAllinOne">
                <h2>O que é o atendimento all in ONE</h2>
                <p>
                    É um conceito de atendimento inédito no Brasil, que define que o cuidado com a saúde e a beleza deve ser abrangente e contínuo. 
                    <br><br>                
                    Primeiro passo:
                    O paciente que opta por passar por esse atendimento “ALL IN ONE” recebe um questionário bem completo onde constará todo o seu histórico de saúde e o que vem buscar na ONE antes de comparecer à clínica. 
                    <br><br>                
                    Segundo passo: 
                    Com os dados obtidos é realizada uma pré-triagem pela nossa equipe especializada que avaliará minuciosamente quais são os profissionais necessários para o atendimento e realiza o agendamento da consulta.
                    <br><br>                
                    Terceiro passo:
                    No dia da consulta o time de profissionais recrutados estará junto, em uma sala especial idealizada para um atendimento único e exclusivo, para trazer a maior segurança e assertividade na escolha dos tratamentos, alinhando suas expectativas e desejos e elaborando um plano personalizado que inclui a escolha das intervenções que serão executadas, o programa de avaliações periódicas e o monitoramento da evolução do seu procedimento.
                    Assim garantimos que você receberá toda a atenção, que vai além das indispensáveis à sua terapia, com detalhes, sugestões de técnicas novas, procedimentos complementares e suporte contínuo.
                    <br><br>                
                    O ALL IN ONE é serviço de excelência, que se adapta aos seus sonhos e necessidades e garante que todas opções e recursos terapêuticos sejam considerados e discutidos em conjunto, proporcionando uma experiência de cuidado completa e personalizada.
                    <br><br>                
                    Isso é parte fundamental do compromisso da ONE Medical Group com sua saúde e beleza
                    <br><br>                
                    Uma verdadeira experiência de cuidado onde o paciente é o CENTRO de toda a jornada.
                </p>
                <a target="_blank" href="https://wa.me/551151081977" class="btns btn_AllInOne">Marcar Consulta</a>
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
        <section id="depos"> 
            <h2>Conexão ONE</h2>
            <p>Conheça o que algumas pessoas, que confiaram sua beleza a ONE Medical Group, consideram sobre nossa empresa.</p>
            
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
        <section id="blog">
            <h2>Blog</h2>
            <p>
                É uma satisfação apresentar para você o Blog da ONE Medical Group, o seu espaço dedicado a insights, novidades e informações relevantes sobre saúde e estética. 
                <br><br>
                Aqui, compartilhamos artigos, dicas e atualizações para ajudá-lo a manter-se informado sobre os avanços na medicina e as melhores práticas para o seu bem-estar. 
                <br><br>
                Explore nossos conteúdos e fique por dentro das tendências e inovações que podem transformar sua vida.
            </p>
            <div id="Blog_cards">
                <?php
                    $query = $pdo->query("SELECT * FROM blog ORDER BY id DESC");
                    $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                    $j = 0;
                    for ($i=0; $i < count($dados); $i++) {
                        $banner_post = $dados[$i]['banner'];
                        $titulo_post = $dados[$i]['titulo_princ'];
                        $data_post = $dados[$i]['data_criacao'];
                        $especialidade_post = $dados[$i]['tag_especialidade'];

                        if($j <= 2){
                            $titulo_novo_post = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($titulo_post)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                            $titulo_tratado_post = preg_replace('/[ -]+/', '_', $titulo_novo_post);

                            $especialidade_novo_post = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($especialidade_post)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                            $especialidade_tratado_post = preg_replace('/[ -]+/', '_', $especialidade_novo_post);

                            $banner_post = "<img src='assets/blog/$banner_post' alt='$titulo_post'>";
                            
                            echo "
                                <div class='cards'>
                                    ".$banner_post."
                                    <span class='data'>".$data_post."</span>
                                    <p class='doutor' onclick='window.location=`blog_tag_$especialidade_tratado_post`'>".$especialidade_post."</p>
                                    <h3 class='titulo'>".$titulo_post."</h3>
                                    <button type='button' class='btns btn_BlogCard' onclick='window.location=`postagem_$titulo_tratado_post`'>Saiba mais <img src='assets/icons/seta.svg' onload='SVGInject(this)'></button>
                                </div>
                            ";
                            $j++;
                        }
                    }
                ?>
            </div>
            <a href="blog" class="btns btn_blog">Veja todas as postagens <img src="assets/icons/seta.svg" onload="SVGInject(this)"></a>
        </section>
        <section id="contatos">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3656.0716611460825!2d-46.70095038821422!3d-23.60176277868368!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce57f8afa36267%3A0x1a3578348e2ae1bd!2sEdif%C3%ADcio%20Continental%20Tower!5e0!3m2!1spt-BR!2sbr!4v1726078441393!5m2!1spt-BR!2sbr" loading="lazy"></iframe>
            <div id="infosContato">
                <img id="LogoContato" src="assets/logo_vetor.svg" onload="SVGInject(this)">
                <div class="blockContato">
                    <img src="assets/icons/relogio.svg" onload="SVGInject(this)">
                    <p>Segunda a Sexta: 09:00 as 19:00hs</p>
                </div>
                <div class="blockContato">
                    <img src="assets/icons/telefone.svg" onload="SVGInject(this)">
                    <p>+55 (11) 51081977</p>
                </div>
                <div class="blockContato">
                    <img src="assets/icons/whats.svg" onload="SVGInject(this)">
                    <p>+55 (11) 51081977</p>
                </div>
                <div class="blockContato">
                    <img src="assets/icons/Email.svg" onload="SVGInject(this)">
                    <p>contato@onemedicalgroup.com.br</p>
                </div>
                <div class="blockContato">
                    <img src="assets/icons/localizacao.svg" onload="SVGInject(this)">
                    <p>Av Magalhães de Castro 4800, Cj 304, Continental Tower, São Paulo, Brasil</p>
                </div>
            </div>
        </section>
        <section id="form">
            <h2>Fale conosco</h2>
            <p>Se você tem alguma duvida sobre um tratamento ou alguma especialidade, estamos aqui para te ajudar.</p>
            <div class="formBlock">
                <form id="formulario" method="POST">
                    <div class="BlockBox">
                        <input type="text" name="nome" id="nome" required>
                        <p>Nome completo</p><span>*</span>
                    </div>
                    <div class="BlockBox">
                        <input type="text" name="email" id="email" required>
                        <p>E-mail</p><span>*</span>
                    </div>
                    <div class="BlockBox">
                        <input type="text" name="telefone" id="telefone" required>
                        <p>Telefone de contato</p>
                    </div>
                    <div class="BlockBox">
                        <textarea type="text" name="mensagem" id="mensagem" required></textarea>
                        <p>Sua mensagem</p>
                    </div>
                    <div class="termosPrivacidade">
                        <input type="checkbox" name="termosPrivacidade" id="termosPrivacidade" required>
                        <h3>Li e estou de acordo com os termos da <a href="politica_Privacidades">Política de Privacidade</a></h3>
                    </div>
                    
                    <button id="btn_form" class="btns" type="submit">Enviar mensagem</button>
                </form>

                <div id="msg_form"></div> 
            </div>
        </section>
    </main>

    <footer>
        <div id="bigFooter">
            <img id="logoRodape" src="assets/logo.png" alt="Logo one medical group">
            <div id="consulta_rodape">
                <h5>Marque a sua consulta</h5>
                <p>Venha conhecer a ONE Medical Group e agende a sua consulta!</p>
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
            <p>© <span id="data_footer"></span> ONE Medical Group</p>
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
                            perPage: 5,
                            perMove: 1,
                            omitEnd: true,
                        }).mount();
                    }
                    if(i == 1){
                        new Splide( elms[i], {
                            perPage: 4,
                            perMove: 1,
                            omitEnd: true
                        }).mount();
                    }
                    if(i == 2){
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
                            perPage: 1,
                            perMove: 1,
                            omitEnd: true,
                            autoplay: true
                        }).mount();
                    }
                    if(i == 1){
                        new Splide( elms[i], {
                            perPage: 1,
                            perMove: 1,
                            type: 'loop',
                            autoplay: true
                        }).mount();
                    }
                    if(i == 2){
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
        //formulario
        $(document).ready(function () {
            $('#telefone').mask('(00) 00000 - 0000');

            $('#formulario').submit(function (e) {
                e.preventDefault();
                $('#msg_form').text('');
                $('#msg_form').removeClass('text-danger');
                $('#msg_form').removeClass('text-success');
                $('#msg_form').removeClass('text-warning');
                $.ajax({
                    url: "email.php",
                    method: "post",
                    data: $('form').serialize(),
                    dataType: "text",
                    success: function (msg) {
                        if (msg.trim() === 'Mensagem enviada com sucesso! Entraremos em contato em breve!') {
                            $('#msg_form').addClass('text-success');
                            $('#msg_form').text(msg);
                            setTimeout(() => { window.location.reload(); }, 5000)
                        }
                        else if (msg.trim() == "Preencha o campo de 'Nome completo'" || msg.trim() == 'Preencha o campo de E-mail' || msg.trim() == 'O campo de mensagem está vazio!' || msg.trim() == 'Para continuar, é necessario aceitar os termos de privacidade!') {
                            $('#msg_form').addClass('text-danger');
                            $('#msg_form').text(msg);
                        }
                        else{
                            $('#msg_form').addClass('text-warning');
                            $('#msg_form').text('Erro ao enviar o formulario! Ele não pode ser enviado por falhas com a comunicação com o servidor, você pode tentar novamente ou tentar nos contactar via Instagram ou Whatsapp');
                        }
                    }
                })
            });
        });
    </script>
</body>
</html>
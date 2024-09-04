<?php require_once("./Sistema/configs/conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A clinica | One medical group</title>

    <link rel="icon" href="assets/icons/icon.svg" />
    <link rel="canonical" href="" />

    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <meta property="og:locale" content="pt_BR">
    <meta name="og:title" property="og:title" content="">
    <meta name="og:type" property="og:type" content="">
    <meta name="og:image" property="og:image" content="">
    <meta property=”og:description” content=""/>

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

            <a class="itensMenu active" href="clinica.php">A One</a>
            <a class="itensMenu" href="especialidades.php">Especialidades</a>
            <a class="itensMenu" href="equipe.php">Equipe one</a>
            <a class="itensMenu" href="tratamentos.php">Tratamentos</a>
            <a class="itensMenu hide" href="blog.php">Blog</a>
            <a class="itensMenu" href="contato.html">Contato</a>

            <div id="contato_sideMenu">
                <a class="btns btn_agendamento" href="" target="_blank">marcar consulta</a>

                <a href="" class="redes_sideMenu marginLeft" target="_blank"><img src="assets/icons/instagram.svg" onload="SVGInject(this)"></a>
                <a href="" class="redes_sideMenu" target="_blank"><img src="assets/icons/facebook.svg" onload="SVGInject(this)"></a>
            </div>
        </div>
        <div id="background" class="hide" onclick="sideMenu()"></div>
    </header>

    <main id="Main_clinica">
        <a class="whats_link hide" target="_blank" href="https://wa.me/551151081977"><img src="assets/icons/whats.svg" onload="SVGInject(this)"></a>

        <section id="banner">
            <img src="assets/A_Clinica/banner.webp" alt="">
            <span> A sua clínica </span>
            <h1>One Medical Group</h1>
        </section>
        <section id="oneMedical">
            <img src="assets/A_Clinica/a_One.webp" alt="">
            <div id="Block_textOne">
                <h2>Quem é a One Medical Group?</h2>
                <p>
                    Olá, eu sou a Dra. Nicole Daher Cóser Capovilla, sócia da ONE Medical Group e gostaria de convidar você a conhecer um pouco da nossa história.
                    <br><br>
                    Sou de Londrina-PR de uma família de médicos e sempre sonhei seguir este caminho. Cursei Medicina em Marília-SP e cirurgia geral e plástica na cidade de São Paulo, onde atuo há mais de 13 anos. Na equipe de Coordenação do Hospital São Luiz Morumbi me aprofundei em experiência do paciente, trazendo para meus médicos a importância do atender com excelência, empatia e carinho.
                    <br><br>
                    Num dia de folga quando assistia um seriado voltado à cirurgia plástica e estética, surgiram ideias que fui trazendo para a realidade e necessidade no Brasil.  Pensei em criar um espaço acolhedor, com serviços de qualidade e cuidados personalizados e, surgiu o conceito ALL IN ONE, algo inovador na experiência e atendimento.  
                    <br><br>
                    Com ele, as técnicas, cirúrgicas ou não, são especificadas de uma só vez por uma junta médica e equipe multidisciplinar, fazendo do paciente o CENTRO de toda a jornada. 
                    <br><br>
                    Na construção desse sonho, Deus colocou em meu caminho pessoas maravilhosas com anos de experiência na área da saúde, cirurgia plástica e de gestão e, sonhamos juntos ao unir conhecimentos e valores para fundar a ONE Medical Group. 
                    <br><br>
                    Escolhemos criteriosamente todo o corpo clínico profissionais de destaque, adquirimos as melhores tecnologias do mercado para que cada paciente tenha atenção e cuidado especial e inauguramos nossa clinica no melhor local da capital de São Paulo. Estamos comprometidos em oferecer um atendimento humanizado e responsável, que busque o bem-estar e a satisfação de cada pessoa que passar por aqui. 
                    <br><br>
                    Juntos vamos auxiliar você a encontrar sua melhor versão. Vem pra ONE!
                </p>
                <a href="tratamentos.php" class="btns btn_tratamentos">Conheça nossos tratamentos<img src="assets/icons/seta.svg" onload="SVGInject(this)"></a>
            </div>
        </section>
        <section id="MVV">
            <div id="cards_MVV">
                <div class="card">
                    <img src="assets/A_Clinica/card_1.webp" alt="">
                    <h2>Missão</h2>
                    <p>Proporcionar <b>transformações</b> pessoais <b>seguras</b> e <b>impactantes</b>, melhorando a saúde e a estética dos nossos clientes através de <b>tecnologias</b> avançadas e serviços <b>personalizados</b> de alta qualidade, com foco na <b>excelência</b> em cada detalhe e na <b>felicidade</b> de quem nos escolhe.</p>
                    <button class="btns btn_card">Veja mais</button>
                </div>
                <div class="card">
                    <img src="assets/A_Clinica/card_2.webp" alt="">
                    <h2>Visão</h2>
                    <p>Ser uma <b>referência em saúde</b> e estética de <b>excelência</b>, oferecendo <b>transformações seguras e significativas</b> que fortalecem a autoestima e ajudam cada cliente a viver o  <b>melhor da vida.</b></p>
                    <button class="btns btn_card">Veja mais</button>
                </div>
                <div class="card">
                    <img src="assets/A_Clinica/card_3.webp" alt="">
                    <h2>Principios</h2>
                    <p>
                        <b>Competência técnica:</b> Garante que os serviços sejam realizados com habilidade e precisão excepcionais. <br>
                        <b>Credibilidade:</b> Assegura que cada inovação tecnológica ou tratamento oferecido seja confiável e eficaz.<br>
                        <b>Integridade:</b> Mantem altos padrões éticos e morais em todas as operações e interações.<br>
                        <b>Humanização e Respeito:</b> Promove um ambiente onde o cuidado e a atenção personalizada são primordiais.
                    </p>
                    <button class="btns btn_card">Veja mais</button>
                </div>
            </div>
            <div id="Footer_Mvv">
                <h2>Conheça alguns dos nossos <br> maiores diferenciais</h2>
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
                <a target="_blank" href="https://wa.me/551151081977" class="btns btn_Concierge">Agendar sessão</a>
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
                    Acreditamos que o cuidado com a saúde e a beleza deve ser abrangente e contínuo e por isso, desenvolvemos o atendimento All In One, um serviço exclusivo que oferece um acompanhamento personalizado e único à você. 
                    <br><br>
                    O All In One começa com uma consulta inicial ampla, onde os profissionais de saúde realizam uma análise completa das suas expectativas e desejos.
                    <br><br>
                    Com base neste diagnóstico, elaboramos um plano personalizado que inclui as intervenções que serão executadas, avaliações periódicas e monitoramento da evolução do seu procedimento.
                    <br><br>
                    Nosso objetivo é garantir que você receba toda a atenção, além das indispensáveis a sua terapia, com avaliações detalhadas, sugestões de técnicas novas ou complementares e suporte contínuo.
                    <br><br>
                    Estamos comprometidos em oferecer um serviço de excelência, que se adapta às suas necessidades e que garanta que todas opções e recursos terapêuticos sejam considerados e discutidos em conjunto, proporcionando uma experiência de cuidado completa e personalizada.
                    <br><br>
                    Isso é parte integrante do compromisso da One Medical Group, a sua saúde. 
                </p>
                <a target="_blank" href="https://wa.me/551151081977" class="btns btn_AllInOne">Agendar sessão</a>
            </div>
        </section>
        <section id="especialidades">
            <div id="textEspecialidade" class="especialidadeBlock">
                <h2>As especialidades da One Medical</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mattis rhoncus urna neque viverra justo.</p>
                <a href="especialidades.php" class="btns btn_especialidades">Veja as especialidades<img src="assets/icons/seta.svg" onload="SVGInject(this)"></a>
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
                <a href="" target="_blank"><img src="assets/icons/instagram.svg" onload="SVGInject(this)"></a>
                <a href="" target="_blank"><img src="assets/icons/facebook.svg" onload="SVGInject(this)"></a>
                <a href="https://wa.me/551151081977" target="_blank"><img src="assets/icons/whats.svg" onload="SVGInject(this)"></a>
                <a href="https://malito:contato@onemedicalgroup.com.br" target="_blank"><img src="assets/icons/Email.svg" onload="SVGInject(this)"></a>
            </div>
        </div>
        <div id="smallFooter">
            <p>© <span id="data_footer"></span> One Medical Group</p>
            <a aria-label="link para a VL7" href="https://www.google.com" target="_blank">
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
                            perPage: 3,
                            perMove: 1,
                            omitEnd: true
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
                }
            }
        });
    </script>
</body>
</html>
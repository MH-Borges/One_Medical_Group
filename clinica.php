<?php require_once("./Sistema/configs/conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A clinica | ONE medical group</title>

    <link rel="icon" href="assets/icons/icon.svg" />
    <link rel="canonical" href="https://onemedicalgroup.com.br/clinica" />

    <meta name="author" content="VL7 marketing estrategico">
    <meta name="description" content="Conheça a One Medical Group: uma clínica dedicada a proporcionar transformações pessoais seguras e impactantes com tecnologias avançadas e atendimento personalizado. Descubra nossa missão, visão, princípios e o atendimento All In One. Saiba mais sobre nossa especialista em Concierge de Beleza e como agendar uma sessão.">
    <meta name="keywords" content="One Medical Group, clínica, transformações pessoais, saúde e estética, tecnologias avançadas, atendimento personalizado, missão, visão, princípios, atendimento All In One, Concierge de Beleza, Marcar Consulta">
    
    <meta property="og:title" content="One Medical Group - Clínica de Saúde e Estética">
    <meta property="og:description" content="Explore a One Medical Group, uma clínica especializada em saúde e estética com uma abordagem inovadora. Conheça nossa missão, visão, princípios e o conceito All In One. Agende uma sessão com nossa Concierge de Beleza e descubra como podemos transformar sua jornada de beleza.">
    
    <meta property="og:type" content="website">
    <meta property="og:locale" content="pt_BR">
    <meta name="og:image" property="og:image" content="assets/logo.png">

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

            <a class="itensMenu active" href="clinica">A ONE</a>
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

    <main id="Main_clinica">
        <a class="whats_link hide" target="_blank" href="https://wa.me/551151081977"><img src="assets/icons/whats.svg" onload="SVGInject(this)"></a>

        <section id="banner">
            <img src="assets/A_Clinica/banner.webp" alt="">
            <span> A sua clínica </span>
            <h1>ONE Medical Group</h1>
        </section>
        <section id="oneMedical">
            <img src="assets/A_Clinica/a_One.webp" alt="">
            <div id="Block_textOne">
                <h2>A ONE Medical Group</h2>
                <p>
                    Como nasceu a ONE? 
                    <br><br>                
                    Um pouquinho da minha história e de como nasceu a ONE:
                    <br><br>                
                    Para quem não me conhece, sou Nicole Daher Cóser Capovilla, nascida em Londrina-PR em família de médicos e desde muito novinha sempre falei em seguir o caminho, tendo principalmente meu pai e meu avô como exemplos. Cursei a Faculdade de Medicina de Marília no interior de São Paulo e depois cirurgia geral e cirurgia plástica em São Paulo capital, atuo na minha área há mais de 13 anos e sou uma verdadeira apaixonada pela MEDICINA. Por muitos anos fiz parte do time de coordenação médica do setor de emergência adulto do Hospital São Luiz Morumbi, onde aprendi muito e me aprofundei nos estudos relacionados a experiência do paciente e a importância de um atendimento de excelência além da empatia e carinho que julgo ser fundamental. O amor é capaz de curar! 
                    Sempre sonhei em criar um espaço acolhedor e inovador, onde pudesse oferecer serviços de qualidade e cuidados personalizados aos meus pacientes, e queria trazer algo novo, realmente inovador no quesito experiência e atendimento, onde o paciente fosse o centro da jornada.
                    Na construção desse sonho, Deus colocou em meu caminho pessoas maravilhosas que passaram a sonhar comigo e trouxeram na bagagem também anos de experiência na área da saúde, cirurgia plástica e da gestão, decidimos unir nossos conhecimentos e valores para fundar a ONE Medical Group. 
                    <br><br>   
                    Acreditamos que cada indivíduo merece atenção e cuidado especial, e é isso que buscamos proporcionar em nossa clínica: um ambiente onde o cuidado e o conforto dos pacientes estão em primeiro lugar. Escolhemos minuciosamente todo o corpo clínico com profissionais maravilhosos e competentes, adquirimos as melhores tecnologias do mercado. Estamos comprometidos em oferecer um atendimento humanizado e responsável, visando sempre o bem-estar e a satisfação. Esperamos que este seja o início de uma jornada de sucesso e crescimento, onde poderemos contribuir de forma significativa para a saúde e felicidade dos nossos pacientes. Juntos queremos te ajudar a encontrar sua melhor versão. Vem pra ONE!
                </p>
                <a href="tratamentos" class="btns btn_tratamentos">Conheça nossos tratamentos<img src="assets/icons/seta.svg" onload="SVGInject(this)"></a>
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
        <section id="especialidades">
            <div id="textEspecialidade" class="especialidadeBlock">
                <h2>As especialidades da ONE Medical</h2>
                <p>Na ONE MEDICAL GROUP, valorizamos o que é mais importante para você: a sua saúde e bem-estar. Por isso, oferecemos um atendimento personalizado e de excelência.</p>
                <a href="especialidades" class="btns btn_especialidades">Veja as especialidades<img src="assets/icons/seta.svg" onload="SVGInject(this)"></a>
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
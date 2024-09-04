<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One medical group</title>

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

    <!-- Mixitup -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
    
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

            <a class="itensMenu" href="clinica.php">A One</a>
            <a class="itensMenu" href="especialidades.php">Especialidades</a>
            <a class="itensMenu" href="equipe.php">Equipe one</a>
            <a class="itensMenu" href="tratamentos.php">Tratamentos</a>
            <a class="itensMenu active" href="blog.php">Blog</a>
            <a class="itensMenu" href="contato.html">Contato</a>

            <div id="contato_sideMenu">
                <a class="btns btn_agendamento" href="" target="_blank">marcar consulta</a>

                <a href="" class="redes_sideMenu marginLeft" target="_blank"><img src="assets/icons/instagram.svg" onload="SVGInject(this)"></a>
                <a href="" class="redes_sideMenu" target="_blank"><img src="assets/icons/facebook.svg" onload="SVGInject(this)"></a>
            </div>
        </div>
        <div id="background" class="hide" onclick="sideMenu()"></div>
    </header>

    <main id="Main_blog">
        <a class="whats_link hide" target="_blank" href="https://wa.me/551151081977"><img src="assets/icons/whats.svg" onload="SVGInject(this)"></a>

        <section id="banner">
            <span>Acompanhe nosso blog</span>
            <h1>Saiba o que nossos médicos têm a dizer</h1>
        </section>
        <section id="Block_blog">
            <div id="menu_blog">
                <div class="splide">
                    <div class="splide__track">
                        <ul class="controls splide__list">
                            <li class="splide__slide active" data-filter="*">Todos</li>
                            <li class="splide__slide" data-filter=".Otorrinolaringologia">Otorrinolaringologia</li>
                            <li class="splide__slide" data-filter=".Fisioterapia">Fisioterapia</li>
                            <li class="splide__slide" data-filter=".Cirurgia_de_face">Cirurgia de face</li>
                            <li class="splide__slide" data-filter=".Ginecologia">Ginecologia</li>
                            <li class="splide__slide" data-filter=".Cirurgia_plastica">Cirurgia plástica</li>
                            <li class="splide__slide" data-filter=".Dermatologia">Dermatologia</li>
                            <li class="splide__slide" data-filter=".Nutrologia">Nutrologia</li>
                        </ul>
                    </div>
                </div>
                <div class="searchBar">
                    <img class="lupa" src="assets/icons/lupa.svg" onload="SVGInject(this)">
                    <input type="text" id="filter" placeholder="Buscar...">
                </div>
                <div class="Search_resultBox hide"></div>
            </div>
            <div class="Blog_cards filter">
                <a href="blog_post.html" class="mix Otorrinolaringologia card_blog">
                    <img src="assets/blog/blog_01.webp" alt="">
                    <span class="data">31/12/2024</span>
                    <p class="doutor">Dra. Aline farias</p>
                    <h3 class="titulo">Lorem ipsum dolor sit amet, consectetur adipiscing elit</h3>
                    <button type="button" class="btns btn_BlogCard" onclick="window.location='clinica.html'">Saiba mais <img src="assets/icons/seta.svg" onload="SVGInject(this)"></button>
                </a>
                <a href="blog_post.html" class="mix Fisioterapia card_blog">
                    <img src="assets/blog/blog_02.webp" alt="">
                    <span class="data">31/12/2024</span>
                    <p class="doutor">Dra. Aline farias</p>
                    <h3 class="titulo">Lorem ipsum dolor sit amet, consectetur adipiscing elit</h3>
                    <button type="button" class="btns btn_BlogCard" onclick="window.location='clinica.html'">Saiba mais <img src="assets/icons/seta.svg" onload="SVGInject(this)"></button>
                </a>
                <a href="blog_post.html" class="mix Cirurgia_de_face card_blog">
                    <img src="assets/blog/blog_03.webp" alt="">
                    <span class="data">31/12/2024</span>
                    <p class="doutor">Dra. Aline farias</p>
                    <h3 class="titulo">Lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit</h3>
                    <button type="button" class="btns btn_BlogCard" onclick="window.location='clinica.html'">Saiba mais <img src="assets/icons/seta.svg" onload="SVGInject(this)"></button>
                </a>
                <a href="blog_post.html" class="mix Ginecologia card_blog">
                    <img src="assets/especialidades/otorrinolaringologia.webp" alt="">
                    <span class="data">31/12/2024</span>
                    <p class="doutor">Dra. Aline farias</p>
                    <h3 class="titulo">Lorem ipsum dolor sit amet, consectetur adipiscing elit</h3>
                    <button type="button" class="btns btn_BlogCard" onclick="window.location='clinica.html'">Saiba mais <img src="assets/icons/seta.svg" onload="SVGInject(this)"></button>
                </a>
                <a href="blog_post.html" class="mix Cirurgia_plastica card_blog">
                    <img src="assets/especialidades/dermatologia.webp" alt="">
                    <span class="data">31/12/2024</span>
                    <p class="doutor">Dra. Aline farias</p>
                    <h3 class="titulo">Lorem ipsum dolor sit amet, consectetur adipiscing elit</h3>
                    <button type="button" class="btns btn_BlogCard" onclick="window.location='clinica.html'">Saiba mais <img src="assets/icons/seta.svg" onload="SVGInject(this)"></button>
                </a>
                <a href="blog_post.html" class="mix Dermatologia card_blog">
                    <img src="assets/especialidades/cirurgia_plástica.webp" alt="">
                    <span class="data">31/12/2024</span>
                    <p class="doutor">Dra. Aline farias</p>
                    <h3 class="titulo">Lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit</h3>
                    <button type="button" class="btns btn_BlogCard" onclick="window.location='clinica.html'">Saiba mais <img src="assets/icons/seta.svg" onload="SVGInject(this)"></button>
                </a>
                <a href="blog_post.html" class="mix Nutrologia card_blog">
                    <img src="assets/blog/blog_03.webp" alt="">
                    <span class="data">31/12/2024</span>
                    <p class="doutor">Dra. Aline farias</p>
                    <h3 class="titulo">Lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit</h3>
                    <button type="button" class="btns btn_BlogCard" onclick="window.location='clinica.html'">Saiba mais <img src="assets/icons/seta.svg" onload="SVGInject(this)"></button>
                </a>
                <a href="blog_post.html" class="mix Nutrologia card_blog">
                    <img src="assets/especialidades/Cirurgia_de_face.webp" alt="">
                    <span class="data">31/12/2024</span>
                    <p class="doutor">Dra. Aline farias</p>
                    <h3 class="titulo">Lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit</h3>
                    <button type="button" class="btns btn_BlogCard" onclick="window.location='clinica.html'">Saiba mais <img src="assets/icons/seta.svg" onload="SVGInject(this)"></button>
                </a>
                <a href="blog_post.html" class="mix Otorrinolaringologia card_blog">
                    <img src="assets/A_Clinica/card_1.webp" alt="">
                    <span class="data">31/12/2024</span>
                    <p class="doutor">Dra. Aline farias</p>
                    <h3 class="titulo">Lorem ipsum dolor sit amet, consectetur adipiscing elit</h3>
                    <button type="button" class="btns btn_BlogCard" onclick="window.location='clinica.html'">Saiba mais <img src="assets/icons/seta.svg" onload="SVGInject(this)"></button>
                </a>
                <a href="blog_post.html" class="mix Cirurgia_de_face card_blog">
                    <img src="assets/tratamentos/tratamento01.webp" alt="">
                    <span class="data">31/12/2024</span>
                    <p class="doutor">Dra. Aline farias</p>
                    <h3 class="titulo">Lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit</h3>
                    <button type="button" class="btns btn_BlogCard" onclick="window.location='clinica.html'">Saiba mais <img src="assets/icons/seta.svg" onload="SVGInject(this)"></button>
                </a>
                <a href="blog_post.html" class="mix Ginecologia card_blog">
                    <img src="assets/tratamentos/tratamento02.webp" alt="">
                    <span class="data">31/12/2024</span>
                    <p class="doutor">Dra. Aline farias</p>
                    <h3 class="titulo">Lorem ipsum dolor sit amet, consectetur adipiscing elit</h3>
                    <button type="button" class="btns btn_BlogCard" onclick="window.location='clinica.html'">Saiba mais <img src="assets/icons/seta.svg" onload="SVGInject(this)"></button>
                </a>
                <a href="blog_post.html" class="mix Fisioterapia card_blog">
                    <img src="assets/tratamentos/tratamento03.webp" alt="">
                    <span class="data">31/12/2024</span>
                    <p class="doutor">Dra. Aline farias</p>
                    <h3 class="titulo">Lorem ipsum dolor sit amet, consectetur adipiscing elit</h3>
                    <button type="button" class="btns btn_BlogCard" onclick="window.location='clinica.html'">Saiba mais <img src="assets/icons/seta.svg" onload="SVGInject(this)"></button>
                </a>
                <a href="blog_post.html" class="mix Cirurgia_plastica card_blog">
                    <img src="assets/especialidades/ginecologia.webp" alt="">
                    <span class="data">31/12/2024</span>
                    <p class="doutor">Dra. Aline farias</p>
                    <h3 class="titulo">Lorem ipsum dolor sit amet, consectetur adipiscing elit</h3>
                    <button type="button" class="btns btn_BlogCard" onclick="window.location='clinica.html'">Saiba mais <img src="assets/icons/seta.svg" onload="SVGInject(this)"></button>
                </a>
                <a href="blog_post.html" class="mix Dermatologia card_blog">
                    <img src="assets/especialidades/nutrologia.webp" alt="">
                    <span class="data">31/12/2024</span>
                    <p class="doutor">Dra. Aline farias</p>
                    <h3 class="titulo">Lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit</h3>
                    <button type="button" class="btns btn_BlogCard" onclick="window.location='clinica.html'">Saiba mais <img src="assets/icons/seta.svg" onload="SVGInject(this)"></button>
                </a>
                <a href="blog_post.html" class="mix Nutrologia card_blog">
                    <img src="assets/tratamentos/tratamentos.webp" alt="">
                    <span class="data">31/12/2024</span>
                    <p class="doutor">Dra. Aline farias</p>
                    <h3 class="titulo">Lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit</h3>
                    <button type="button" class="btns btn_BlogCard" onclick="window.location='clinica.html'">Saiba mais <img src="assets/icons/seta.svg" onload="SVGInject(this)"></button>
                </a>
                <a href="blog_post.html" class="mix Otorrinolaringologia card_blog">
                    <img src="assets/tratamentos/tratamento07.webp" alt="">
                    <span class="data">31/12/2024</span>
                    <p class="doutor">Dra. Aline farias</p>
                    <h3 class="titulo">Lorem ipsum dolor sit amet, consectetur adipiscing elit</h3>
                    <button type="button" class="btns btn_BlogCard" onclick="window.location='clinica.html'">Saiba mais <img src="assets/icons/seta.svg" onload="SVGInject(this)"></button>
                </a>
                <a href="blog_post.html" class="mix Cirurgia_de_face card_blog">
                    <img src="assets/concierge.webp" alt="">
                    <span class="data">31/12/2024</span>
                    <p class="doutor">Dra. Aline farias</p>
                    <h3 class="titulo">Lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit</h3>
                    <button type="button" class="btns btn_BlogCard" onclick="window.location='clinica.html'">Saiba mais <img src="assets/icons/seta.svg" onload="SVGInject(this)"></button>
                </a>
                <a href="blog_post.html" class="mix Ginecologia card_blog">
                    <img src="assets/banner_equipe.webp" alt="">
                    <span class="data">31/12/2024</span>
                    <p class="doutor">Dra. Aline farias</p>
                    <h3 class="titulo">Lorem ipsum dolor sit amet, consectetur adipiscing elit</h3>
                    <button type="button" class="btns btn_BlogCard" onclick="window.location='clinica.html'">Saiba mais <img src="assets/icons/seta.svg" onload="SVGInject(this)"></button>
                </a>
            </div>
        </section>
        <section id="tratamentos">
            <h2>Saiba mais sobre nossos tratamentos</h2>
            <div class="splide" role="group">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <div class="Block_img">
                                <img src="assets/tratamentos/tratamento01.webp" alt="">
                            </div>
                            <div class="infosCards">
                                <h3 class="nome">tratamentos avançados</h3>
                                <a href="tratamentos_detalhes.html" class="btns btn_CardTratamento">Veja mais</a>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="Block_img">
                                <img src="assets/tratamentos/tratamento02.webp" alt="">
                            </div>
                            <div class="infosCards">
                                <h3 class="nome">cirurgias plásticas</h3>
                                <a href="tratamentos_detalhes.html" class="btns btn_CardTratamento">Veja mais</a>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="Block_img">
                                <img src="assets/tratamentos/tratamento03.webp" alt="">
                            </div>
                            <div class="infosCards">
                                <h3 class="nome">cuidados dermatológicos</h3>
                                <a href="tratamentos_detalhes.html" class="btns btn_CardTratamento">Veja mais</a>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="Block_img">
                                <img src="assets/tratamentos/tratamento04.webp" alt="">
                            </div>
                            <div class="infosCards">
                                <h3 class="nome">serviços de nutrologia</h3>
                                <a href="tratamentos_detalhes.html" class="btns btn_CardTratamento">Veja mais</a>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="Block_img">
                                <img src="assets/tratamentos/tratamento05.webp" alt="">
                            </div>
                            <div class="infosCards">
                                <h3 class="nome">Lorem Ipsum Dolum sit amet</h3>
                                <a href="tratamentos_detalhes.html" class="btns btn_CardTratamento">Veja mais</a>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="Block_img">
                                <img src="assets/tratamentos/tratamento06.webp" alt="">
                            </div>
                            <div class="infosCards">
                                <h3 class="nome">Lorem Ipsum Dolum sit amet</h3>
                                <a href="tratamentos_detalhes.html" class="btns btn_CardTratamento">Veja mais</a>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="Block_img">
                                <img src="assets/tratamentos/tratamento07.webp" alt="">
                            </div>
                            <div class="infosCards">
                                <h3 class="nome">Lorem Ipsum Dolum sit amet</h3>
                                <a href="tratamentos_detalhes.html" class="btns btn_CardTratamento">Veja mais</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section id="equipe">
            <h2>Conheça os doutores responsáveis pelos conteúdos</h2>
            <div class="splide" role="group">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <a href="equipe_detalhes.html">
                                <img src="assets/medicos/medico01.webp" alt="">
                                <div class="infosCards">
                                    <h3 class="nome">Dra. Francini Belluci</h3>
                                    <p class="espec_medico">Dermatologista</p>
                                </div>
                            </a>
                        </li>
                        <li class="splide__slide">
                            <a href="equipe_detalhes.html">
                                <img src="assets/medicos/medico02.webp" alt="">
                                <div class="infosCards">
                                    <h3 class="nome">Dr. Rodrigo De Léo</h3>
                                    <p class="espec_medico">Ginecologista</p>
                                </div>
                            </a>
                        </li>
                        <li class="splide__slide">
                            <a href="equipe_detalhes.html">
                                <img src="assets/medicos/medico03.webp" alt="">
                                <div class="infosCards">
                                    <h3 class="nome">Dra. Raquel Ferrari</h3>
                                    <p class="espec_medico">Dermatologista</p>
                                </div>
                            </a>
                        </li>
                        <li class="splide__slide">
                            <a href="equipe_detalhes.html">
                                <img src="assets/medicos/medico04.webp" alt="">
                                <div class="infosCards">
                                    <h3 class="nome">Dra. Cybele Guedes</h3>
                                    <p class="espec_medico">Dermatologista</p>
                                </div>
                            </a>
                        </li>
                        <li class="splide__slide">
                            <a href="equipe_detalhes.html">
                                <img src="assets/medicos/medico05.webp" alt="">
                                <div class="infosCards">
                                    <h3 class="nome">Dr. Gabriel Costa</h3>
                                    <p class="espec_medico">Nutrólogo</p>
                                </div>
                            </a>
                        </li>
                        <li class="splide__slide">
                            <a href="equipe_detalhes.html">
                                <img src="assets/medicos/user_placeholder.webp" alt="">
                                <div class="infosCards">
                                    <h3 class="nome">Dra. Lorem Ipsum</h3>
                                    <p class="espec_medico">DolumsitAmet</p>
                                </div>
                            </a>
                        </li>
                        <li class="splide__slide">
                            <a href="equipe_detalhes.html">
                                <img src="assets/medicos/user_placeholder.webp" alt="">
                                <div class="infosCards">
                                    <h3 class="nome">Dra. Lorem Ipsum</h3>
                                    <p class="espec_medico">DolumsitAmet</p>
                                </div>
                            </a>
                        </li>
                        <li class="splide__slide">
                            <a href="equipe_detalhes.html">
                                <img src="assets/medicos/user_placeholder.webp" alt="">
                                <div class="infosCards">
                                    <h3 class="nome">Dr. Lorem Ipsum</h3>
                                    <p class="espec_medico">DolumsitAmet</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="equipe.html" class="btns btn_equipe">Conheça toda a equipe<img src="assets/icons/seta.svg" onload="SVGInject(this)"></a>
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
                            padding: { left: '0', right: '7.5vw' },
                            perPage: 4,
                            perMove: 1,
                            focus  : 0,
                            omitEnd: true,
                            drag   : 'free',
                            arrowPath: 'M28.6236 16.8294C31.0942 18.6647 31.0942 22.3353 28.6236 24.1706L7.88833 39.574C4.83451 41.8426 0.476562 39.6843 0.476562 35.9034L0.476564 5.09658C0.476564 1.31565 4.83451 -0.842576 7.88833 1.42598L28.6236 16.8294Z',
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
                            perPage: 5,
                            perMove: 1,
                            omitEnd: true,
                        }).mount();
                    }
                } 
                else{
                    if(i == 0){
                        new Splide( elms[i], {
                            padding: { left: '0', right: '7.5vw' },
                            perPage: 2,
                            perMove: 1,
                            focus  : 0,
                            omitEnd: true,
                            drag   : 'free',
                            arrowPath: 'M28.6236 16.8294C31.0942 18.6647 31.0942 22.3353 28.6236 24.1706L7.88833 39.574C4.83451 41.8426 0.476562 39.6843 0.476562 35.9034L0.476564 5.09658C0.476564 1.31565 4.83451 -0.842576 7.88833 1.42598L28.6236 16.8294Z',
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

        //BARRA DE PESQUISA
        const filter = document.getElementById('filter');
        const listPosts = [];
        getData();
        filter.addEventListener('input', (e) => {
            filterData(e.target.value);
            document.querySelector('.searchBar').addEventListener('click', () => {
                if (filter.value !== "") {
                    filter.value = "";
                    filterData(e.target.value);
                }
            });
        });

        function getData() {
            document.querySelectorAll('.card_blog').forEach(e => {
                const img = e.children[0].src;
                const data = e.children[1].innerHTML;
                const tag = e.children[2].innerHTML;
                const titulo = e.children[3].innerHTML;

                listPosts.push({
                    img: img,
                    data: data,
                    tag: tag,
                    titulo: titulo
                });
            });
        }

        function filterData(searchTerm) {
            document.querySelectorAll('.searchResult').forEach(e => e.remove());

            listPosts.forEach(post => {
                if (post.data.toLowerCase().includes(searchTerm.toLowerCase()) ||
                    post.tag.toLowerCase().includes(searchTerm.toLowerCase()) ||
                    post.titulo.toLowerCase().includes(searchTerm.toLowerCase())) {
                    
                    document.querySelector('.Search_resultBox').classList.remove('hide');
                    
                    const resultElement = document.createElement('a');
                    resultElement.classList.add('searchResult');
                    resultElement.href = 'blog_post.html';
                    resultElement.innerHTML = `
                        <img src="${post.img}" alt="">
                        <span class="data">${post.data}</span>
                        <span class="tag">${post.tag}</span>
                        <h4 class="titulo">${post.titulo}</h4>
                    `;
                    document.querySelector('.Search_resultBox').appendChild(resultElement);
                }
            });

            if (document.querySelector('.Search_resultBox').innerHTML.trim() === "") {
                const noResultElement = document.createElement('a');
                noResultElement.classList.add('searchResult', 'nullResult');
                noResultElement.innerHTML = `<span>Nenhum resultado encontrado</span>`;
                document.querySelector('.Search_resultBox').appendChild(noResultElement);
            }

            if (searchTerm === "") {
                document.querySelector('.Search_resultBox').classList.add('hide');
                document.querySelector('.Search_resultBox').textContent = '';
            }
        }
    </script>
</body>
</html>
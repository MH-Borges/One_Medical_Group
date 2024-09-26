<?php 
    require_once("./Sistema/configs/conexao.php"); 

    $nome_get = @$_GET['nome'];
    $nome_clean = preg_replace('/_/', ' ', $nome_get);

    $query = $pdo->query("SELECT * FROM blog WHERE titulo_princ = '$nome_clean'");
    $dados = $query->fetchAll(PDO::FETCH_ASSOC);
    if(@count($dados) > 0){

        $banner = $dados[0]['banner'];
        $titulo = $dados[0]['titulo_princ'];
        $data_criacao = $dados[0]['data_criacao'];
        $especialidade = $dados[0]['tag_especialidade'];

        $resumo = $dados[0]['resumo'];

        $titulo_h2 = $dados[0]['titulo_h2'];
        $titulo_h3 = $dados[0]['titulo_h3'];
        $titulo_h4 = $dados[0]['titulo_h4'];
        $titulo_h5 = $dados[0]['titulo_h5'];
        $titulo_h6 = $dados[0]['titulo_h6'];

        $text_h2 = $dados[0]['text_h2'];
        $text_h3 = $dados[0]['text_h3'];
        $text_h4 = $dados[0]['text_h4'];
        $text_h5 = $dados[0]['text_h5'];
        $text_h6 = $dados[0]['text_h6'];

        $seo = $dados[0]['seo'];

        if($banner == "banner_placeholder.webp" || $banner == ""){
            $banner = "<img class='banner' src='assets/blog/banner_placeholder.webp' alt='$titulo'>";
        }else{
            $banner = "<img class='banner' src='assets/blog/$banner' alt='$titulo'>";
        }

        $nome_espec_tag = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($especialidade)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
        $especialidade_tratado = preg_replace('/[ -]+/', '_', $nome_espec_tag);

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
    <title><?php echo $nome_clean ?> | One medical group</title>

    <link rel="icon" href="assets/icons/icon.svg" />
    <link rel="canonical" href="https://onemedicalgroup.com.br/postagem_<?php echo $nome_get ?>" />

    <meta name="author" content="VL7 marketing estrategico">
    <meta name="description" content="<?php echo $resumo ?>">
    <meta name="keywords" content="<?php echo $seo ?>">
    
    <meta name="og:title" property="og:title" content="Blog da ONE MEDICAL GROUP">
    <meta property="og:description" content="<?php echo $resumo ?>">
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

            <a class="itensMenu" href="clinica">A One</a>
            <a class="itensMenu" href="especialidades">Especialidades</a>
            <a class="itensMenu" href="equipe">Equipe one</a>
            <a class="itensMenu" href="tratamentos">Tratamentos</a>
            <a class="itensMenu" href="blog">Blog</a>
            <a class="itensMenu" href="contato.html">Contato</a>

            <div id="contato_sideMenu">
                <a class="btns btn_agendamento" href="" target="_blank">marcar consulta</a>

                <a href="" class="redes_sideMenu marginLeft" target="_blank"><img src="assets/icons/instagram.svg" onload="SVGInject(this)"></a>
                <a href="" class="redes_sideMenu" target="_blank"><img src="assets/icons/facebook.svg" onload="SVGInject(this)"></a>
            </div>
        </div>
        <div id="background" class="hide" onclick="sideMenu()"></div>
    </header>

    <main id="Main_blogPost">
        <a class="whats_link hide" target="_blank" href="https://wa.me/551151081977"><img src="assets/icons/whats.svg" onload="SVGInject(this)"></a>

        <section id="banner">
            <?php echo $banner ?>
            <h1><?php echo $titulo ?></h1>
            <span onclick="window.location='blog_tag_<?php echo $especialidade_tratado?>'"><b><?php echo $especialidade ?></b></span>
        </section>
        <section id="conteudo">
            <div class="Postagem">
                <span class="data"><?php echo $data_criacao ?></span>
                <span class="tag" onclick="window.location='blog_tag_<?php echo $especialidade_tratado?>'"><?php echo $especialidade ?></span>
                <p class="txt_Intro">
                    <?php echo $resumo ?>
                </p>
                <div class="Content">
                    <?php 
                        if($titulo_h2 != ""){
                            echo "<h2>$titulo_h2</h2>";
                        }
                        if($text_h2 != ""){
                            echo "<p>$text_h2</p>";  
                        }

                        if($titulo_h3 != ""){
                            echo "<h3>$titulo_h3</h3>";  
                        }
                        if($text_h3 != ""){
                            echo "<p>$text_h3</p>";  
                        }

                        if($titulo_h4 != ""){
                            echo "<h4>$titulo_h4</h4>";  
                        }
                        if($text_h4 != ""){
                            echo "<p>$text_h4</p>";  
                        }

                        if($titulo_h5 != ""){
                            echo "<h5>$titulo_h5</h5>";  
                        }
                        if($text_h5 != ""){
                            echo "<p>$text_h5</p>";  
                        }

                        if($titulo_h6 != ""){
                            echo "<h6>$titulo_h6</h6>";  
                        }
                        if($text_h6 != ""){
                            echo "<p>$text_h6</p>";  
                        }
                    ?>
                </div>
            </div>
    
            <aside>
                <div class="searchBar">
                    <img class="lupa" src="assets/icons/lupa.svg" onload="SVGInject(this)">
                    <input type="text" id="filter" placeholder="Buscar...">
                </div>
                <div class="Search_resultBox hide"></div>
    
                <h2>Outros tópicos</h2>
                
                <?php
                    $query = $pdo->query("SELECT * FROM especialidade ORDER BY id DESC");
                    $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                    
                    for ($i=0; $i < count($dados); $i++) { 
                        $nome_espec = $dados[$i]['nome'];

                        $query2 = $pdo->query("SELECT * FROM blog where tag_especialidade = '$nome_espec'");
                        $dados2 = $query2->fetchAll(PDO::FETCH_ASSOC);

                        if(@count($dados2) !== 0){
                            $nome_novo_espec = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($nome_espec)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                            $nome_tratado_espec = preg_replace('/[ -]+/', '_', $nome_novo_espec);

                            if($nome_espec === $especialidade){
                                echo "<a class='tags active' href='blog_tag_$nome_tratado_espec'>$nome_espec</a>";
                            }
                            else{
                                echo "<a class='tags' href='blog_tag_$nome_tratado_espec'>$nome_espec</a>";
                            }
                        } 
                    }
                ?>
                
                <h2 id="postsH2"> Confira nossos últimos posts</h2>

                <div class="block_cardsAside">
                    <?php
                        $query = $pdo->query("SELECT * FROM blog ORDER BY id DESC");
                        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                        $j = 0;
                        for ($i=0; $i < count($dados); $i++) {
                            if($j <= 4){
                                $banner_post = $dados[$i]['banner'];
                                $titulo_post = $dados[$i]['titulo_princ'];
                                $data_post = $dados[$i]['data_criacao'];
                                $especialidade_post = $dados[$i]['tag_especialidade'];
    
                                $titulo_novo_post = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($titulo_post)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                                $titulo_tratado_post = preg_replace('/[ -]+/', '_', $titulo_novo_post);
    
                                $especialidade_novo_post = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($especialidade_post)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                                $especialidade_tratado_post = preg_replace('/[ -]+/', '_', $especialidade_novo_post);
    
                                $banner_post = "<img src='assets/blog/$banner_post' alt='$titulo_post'>";
                                
                                echo "
                                    <div class='card_blog'>
                                        $banner_post
                                        <span class='data'>$data_post</span>
                                        <p class='doutor' onclick='window.location=`blog_tag_$especialidade_tratado_post`'>$especialidade_post</p>
                                        <h3 class='titulo'>$titulo_post</h3>
                                        <button type='button' class='btns btn_BlogCard' onclick='window.location=`postagem_$titulo_tratado_post`'>Saiba mais <img src='assets/icons/seta.svg' onload='SVGInject(this)'></button>
                                    </div>
                                ";

                                $j++;
                            }
                        }
                    ?>
                </div>

            </aside>
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
                            $query = $pdo->query("SELECT * FROM medicos ORDER BY id asc");
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

    <div class="hide searchBar_List">
        <?php
            $query = $pdo->query("SELECT * FROM blog ORDER BY id DESC");
            $dados = $query->fetchAll(PDO::FETCH_ASSOC);
            for ($i=0; $i < count($dados); $i++) {
                $banner_post = $dados[$i]['banner'];
                $titulo_post = $dados[$i]['titulo_princ'];
                $data_post = $dados[$i]['data_criacao'];
                $especialidade_post = $dados[$i]['tag_especialidade'];

                $titulo_novo_post = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($titulo_post)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                $titulo_tratado_post = preg_replace('/[ -]+/', '_', $titulo_novo_post);

                $especialidade_novo_post = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($especialidade_post)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                $especialidade_tratado_post = preg_replace('/[ -]+/', '_', $especialidade_novo_post);

                $banner_post = "<img src='assets/blog/$banner_post' alt='$titulo_post'>";
                
                echo "
                    <div class='hidelist'>
                        $banner_post
                        <span class='data'>$data_post</span>
                        <p class='doutor' onclick='window.location=`blog_tag_$especialidade_tratado_post`'>$especialidade_post</p>
                        <h3 class='titulo'>$titulo_post</h3>
                        <button type='button' class='btns btn_BlogCard' onclick='window.location=`postagem_$titulo_tratado_post`'>Saiba mais <img src='assets/icons/seta.svg' onload='SVGInject(this)'></button>
                    </div>

                ";
            }
        ?>
    </div>

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
            document.querySelectorAll('.hidelist').forEach(e => {
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
                    
                    const tituloTratado = post.titulo.replace(/\s+/g, '_');

                    const resultElement = document.createElement('a');
                    resultElement.classList.add('searchResult');
                    resultElement.href = `postagem_${tituloTratado}`;
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
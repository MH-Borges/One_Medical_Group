<?php require_once("./Sistema/configs/conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Equipe | One medical group</title>

    <link rel="icon" href="assets/icons/icon.svg" />
    <link rel="canonical" href="https://onemedicalgroup.com.br/equipe" />

    <meta name="author" content="VL7 marketing estrategico">
    <meta name="description" content="Na One Medical Group, contamos com um time de profissionais altamente capacitados e reconhecidos em suas áreas de atuação. Cada membro de nossa equipe se destaca por sua expertise e compromisso com a atualização constante nas mais recentes inovações e técnicas médicas. Conheça nossa equipe e a excelência dos nossos serviços médicos.">
    <meta name="keywords" content="One Medical Group, profissionais de saúde, equipe médica, especialistas, atendimento médico, saúde, inovação médica, estrutura médica, excelência em saúde">

    <meta property="og:locale" content="pt_BR">
    <meta name="og:title" property="og:title" content="One Medical Group">
    <meta name="og:type" property="og:type" content="website">
    <meta name="og:image" property="og:image" content="assets/logo.png">
    <meta property="og:description" content="Na One Medical Group, oferecemos um atendimento médico de excelência com uma equipe de especialistas altamente capacitados. Localizados no Cidade Jardim Corporate Center Continental Tower, proporcionamos uma experiência de saúde premium com conforto e inovação.">


    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <!-- Mixitup -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
    
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
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
            <a class="itensMenu active" href="equipe.php">Equipe one</a>
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

    <main id="Main_Equipe">
        <a class="whats_link hide" target="_blank" href="https://wa.me/551151081977"><img src="assets/icons/whats.svg" onload="SVGInject(this)"></a>

        <section id="banner">
            <img src="assets/banner_equipe.webp" alt="">
            <span> Corpo clínico One Medical </span>
            <h1>O De excelência</h1>
            <p>Na One Medical Group, contamos com um time de profissionais altamente capacitados e reconhecidos em suas áreas de atuação. Cada membro de nossa equipe se destaca por sua expertise e compromisso com a atualização constante nas mais recentes inovações e técnicas médicas. Aqui estão alguns dos renomados especialistas que fazem parte da nossa equipe:</p>
        </section>
        <section id="Block_medicos">
            <div class="dropdown">
                <button class="dropdown-toggle" id="dropdownBtn" type="button" id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
                    Selecione por especialidade
                </button>
                <ul class="dropdown-menu controls" aria-labelledby="dropdownMenu">
                    <li class="active" data-filter="*" onclick="changeButton(this)">Ver todas especialidades</li>
                    <?php
                        $query = $pdo->query("SELECT * FROM especialidade ORDER BY id DESC");
                        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                        for ($i=0; $i < count($dados); $i++) { 
                            $nome_espec = $dados[$i]['nome'];
                            $foto_espec = $dados[$i]['foto'];

                            $nome_novo_espec = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($nome_espec)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                            $nome_tratado_espec = preg_replace('/[ -]+/', '_', $nome_novo_espec);
                            if($foto_espec !== "placeholder.webp"){
                                $query2 = $pdo->query("SELECT * FROM medicos WHERE especialidade = '$nome_espec'");
                                $dados2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                                if(@count($dados2) > 0){
                                    echo "<li data-filter='.$nome_tratado_espec' onclick='changeButton(this)'>$nome_espec</li>";
                                }
                            }
                        }
                    ?>
                </ul>
            </div>

            <div class="filter">
                <?php
                    $query = $pdo->query("SELECT * FROM medicos ORDER BY id DESC");
                    $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                    for ($i=0; $i < count($dados); $i++) {
                        $status_medico = $dados[$i]['status_perfil'];
                        $card_medico = $dados[$i]['card_'];
                        $nome_medico = $dados[$i]['nome'];
                        $especialidade_medico = $dados[$i]['especialidade'];

                        $nome_novo_medico = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($nome_medico)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                        $nome_tratado_medico = preg_replace('/[ -]+/', '_', $nome_novo_medico);
                        
                        $espec_novo_medico = strtolower(preg_replace("[^a-zA-Z0-9-]", "_", strtr(utf8_decode(trim($especialidade_medico)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
                        $espec_tratado_medico = preg_replace('/[ -]+/', '_', $espec_novo_medico);
                        
                        if($status_medico === "ativo" && $nome_medico !== ""){
                            if($card_medico == "user_placeholder.webp" || $card_medico == ""){
                                $card_medico = "<img src='assets/medicos/user_placeholder.webp' alt='$nome_medico - $especialidade_medico'>";
                            }else{
                                $card_medico = "<img src='assets/medicos/$nome_tratado_medico/$card_medico' alt='$nome_medico - $especialidade_medico'>";
                            }

                            echo "
                                <div class='mix $espec_tratado_medico'>
                                    <a href='medico_$nome_tratado_medico'>
                                        ".$card_medico."
                                        <div class='infosCards'>
                                            <h3 class='nome'>$nome_medico</h3>
                                            <p class='espec_medico'>$especialidade_medico</p>
                                        </div>
                                    </a>
                                </div>
                            ";
                        }
                    }
                ?>
            </div>
        </section>
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
                <a href="clinica.php" class="btns btn_espaco">Conheça nossa historia<img src="assets/icons/seta.svg" onload="SVGInject(this)"></a>
            </div>
            <div id="Block_VideoEspaco">
                <img src="assets/icons/play_btn.svg" onload="SVGInject(this)" onclick="PLayVideo('VideoEspaco')">
                <video controlsList="nodownload" id="VideoEspaco" onclick="PLayVideo('VideoEspaco')">
                    <source src="assets/Videos/Bg_video.mp4" type="video/mp4">
                </video>
            </div>
            
        </section>
        <section id="FAQ">
            <h2>Perguntas frequentes</h2>
            <div class="block_perguntas">
                <div class="Block_pergunta">
                    <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt?</h3>
                    <p>Mauris sit amet massa vitae. Sit amet justo donec enim diam vulputate ut pharetra. Massa id neque aliquam vestibulum morbi blandit. Egestas pretium aenean pharetra magna ac placerat. Quam viverra orci sagittis eu volutpat odio facilisis.</p>
                </div>
                <div class="Block_pergunta">
                    <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt?</h3>
                    <p>Mauris sit amet massa vitae. Sit amet justo donec enim diam vulputate ut pharetra. Massa id neque aliquam vestibulum morbi blandit. Egestas pretium aenean pharetra magna ac placerat. Quam viverra orci sagittis eu volutpat odio facilisis.</p>
                </div>
                <div class="Block_pergunta">
                    <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt?</h3>
                    <p>Mauris sit amet massa vitae. Sit amet justo donec enim diam vulputate ut pharetra. Massa id neque aliquam vestibulum morbi blandit. Egestas pretium aenean pharetra magna ac placerat. Quam viverra orci sagittis eu volutpat odio facilisis.</p>
                </div>
                <div class="Block_pergunta">
                    <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt?</h3>
                    <p>Mauris sit amet massa vitae. Sit amet justo donec enim diam vulputate ut pharetra. Massa id neque aliquam vestibulum morbi blandit. Egestas pretium aenean pharetra magna ac placerat. Quam viverra orci sagittis eu volutpat odio facilisis.</p>
                </div>
                <div class="Block_pergunta">
                    <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt?</h3>
                    <p>Mauris sit amet massa vitae. Sit amet justo donec enim diam vulputate ut pharetra. Massa id neque aliquam vestibulum morbi blandit. Egestas pretium aenean pharetra magna ac placerat. Quam viverra orci sagittis eu volutpat odio facilisis.</p>
                </div>
                <div class="Block_pergunta">
                    <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt?</h3>
                    <p>Mauris sit amet massa vitae. Sit amet justo donec enim diam vulputate ut pharetra. Massa id neque aliquam vestibulum morbi blandit. Egestas pretium aenean pharetra magna ac placerat. Quam viverra orci sagittis eu volutpat odio facilisis.</p>
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
        function changeButton(e) {
            if(e.dataset.filter == '*'){
                document.getElementById('dropdownBtn').innerText = 'Selecione por especialidade';
            }
            else{
                document.getElementById('dropdownBtn').innerText = e.innerText;           
            }
        }
    </script>
</body>
</html>
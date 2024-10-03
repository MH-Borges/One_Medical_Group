<?php require_once("./Sistema/configs/conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Equipe | ONE medical group</title>

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

            <a class="itensMenu" href="clinica">A ONE</a>
            <a class="itensMenu" href="especialidades">Especialidades</a>
            <a class="itensMenu active" href="equipe">Equipe ONE</a>
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

    <main id="Main_Equipe">
        <a class="whats_link hide" target="_blank" href="https://wa.me/551151081977"><img src="assets/icons/whats.svg" onload="SVGInject(this)"></a>

        <section id="banner">
            <img src="assets/banner_equipe.webp" alt="">
            <span> Corpo clínico ONE Medical </span>
            <h1>O De excelência</h1>
            <p>Na ONE Medical Group, contamos com um time de profissionais altamente capacitados e reconhecidos em suas áreas de atuação. Cada membro de nossa equipe se destaca por sua expertise e compromisso com a atualização constante nas mais recentes inovações e técnicas médicas. Aqui estão os nossos renomados especialistas que fazem parte da nossa equipe</p>
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
                    Localizada no Complexo do Shopping Cidade Jardim, em um dos bairros mais nobres de São Paulo. Temos o privilégio de estar próximos aos principais hospitais da cidade. Buscamos trazer o requinte e sofisticação de um Hotel Boutique, propiciando o acolhimento necessário para uma imersão na experiência ONE. 
                    <br><br>
                    O conceito traz uma experiencia única, num ambiente de elegância e tranquilidade, com ampla estrutura que inclui desde um espaço exclusivo e acolhedor, e consultórios totalmente equipados, desenhados para garantir que os procedimentos sejam realizados com a máxima precisão e segurança.
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
        <section id="FAQ">
            <h2>Perguntas frequentes</h2>
            <div class="block_perguntas">
                <div class="Block_pergunta">
                    <h3>A toxina botulínica faz mal à saúde?</h3>
                    <p>Quando usada de forma adequada e administrada por profissionais qualificados, a toxina botulínica é segura e eficaz. Ela já utilizada há décadas para fins médicos e estéticos e os riscos geralmente estão associados a procedimentos mal executados, excesso de produto ou aplicação em locais inadequados.</p>
                </div>
                <div class="Block_pergunta">
                    <h3>⁠Preenchimentos faciais podem deixar o rosto artificial?</h3>
                    <p>Sim, é possível, especialmente se houver excesso de produto ou se não houver um planejamento adequado. No entanto, quando realizados por profissionais experientes que respeitam a harmonia facial, os preenchimentos proporcionam resultados naturais que melhoram a aparência sem exageros.</p>
                </div>
                <div class="Block_pergunta">
                    <h3>⁠O que é melhor: toxina botulínica ou preenchimento?</h3>
                    <p>Depende do objetivo do paciente. A toxina botulínica é ideal para suavizar rugas dinâmicas (como linhas de expressão), enquanto os preenchimentos faciais são usados para repor volume perdido e melhorar contornos faciais. Um profissional pode indicar a melhor opção, ou até a combinação de ambos, conforme o caso.</p>
                </div>
                <div class="Block_pergunta">
                    <h3>⁠Quanto tempo leva para ver os resultados de um tratamento com laser?</h3>
                    <p>Os resultados podem variar dependendo do tipo de laser e da condição tratada. Geralmente, os resultados iniciais começam a ser percebidos dentro de alguns dias a semanas após o tratamento, mas melhorias significativas podem ser notadas após algumas sessões.</p>
                </div>
                <div class="Block_pergunta">
                    <h3>⁠Qual é o tratamento mais eficaz para acabar com a flacidez?</h3>
                    <p>Existem várias opções, como radiofrequência, ultrassom microfocado (Ultraformer), bioestimuladores de colágeno, e lifting facial cirúrgico. A escolha do tratamento depende da área afetada, grau de flacidez e expectativas do paciente. Uma consulta é essencial para determinar o melhor plano de tratamento.</p>
                </div>
                <div class="Block_pergunta">
                    <h3>Quais são os efeitos colaterais comuns de tratamentos estéticos?</h3>
                    <p>Efeitos colaterais comuns incluem vermelhidão, inchaço, hematomas, sensibilidade no local da aplicação e leve desconforto. Estes geralmente desaparecem em alguns dias. Reações adversas graves são raras, mas podem ocorrer, especialmente se o procedimento for realizado por profissionais não qualificados.</p>
                </div>
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
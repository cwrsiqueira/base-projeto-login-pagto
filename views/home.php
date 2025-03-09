<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dulang Web - Aprendizado Natural de Inglês</title>

    <!-- Meta Tags para SEO -->
    <meta name="description" content="O Dulang Web é a melhor forma de ensinar inglês para crianças de maneira natural e divertida. Aprenda com vídeos selecionados e uma experiência imersiva!">
    <meta name="keywords" content="aprendizado de inglês, crianças, vídeos educativos, imersão em inglês, ensino bilíngue">
    <meta name="author" content="Dulang">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Dulang Web - Aprendizado Natural de Inglês">
    <meta property="og:description" content="Ensine inglês para crianças de forma natural e divertida com vídeos imersivos!">
    <meta property="og:image" content="<?= BASE_URL ?>/assets/images/logo.png">
    <meta property="og:url" content="<?= BASE_URL ?>">
    <meta property="og:site_name" content="Dulang Web">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Dulang Web - Aprendizado Natural de Inglês">
    <meta name="twitter:description" content="Ensine inglês para crianças de forma natural e divertida com vídeos imersivos!">
    <meta name="twitter:image" content="<?= BASE_URL ?>/assets/images/logo.png">
    <meta name="twitter:site" content="<?= BASE_URL ?>">

    <!-- Favicon -->
    <link rel="icon" href="<?= BASE_URL ?>/assets/images/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/home.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?= BASE_URL ?>">
            <img src="<?= BASE_URL ?>/assets/images/logo.png" alt="Dulang Web" width="80" height="80">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>">Início</a></li>
                <li class="nav-item"><a class="nav-link" href="#por-que-o-dulang">Por que o Dulang?</a></li>
                <li class="nav-item"><a class="nav-link" href="#como-funciona">Como funciona?</a></li>
                <!-- <li class="nav-item"><a class="nav-link" href="#testemunhos">Testemunhos</a></li> -->
                <li class="nav-item"><a class="nav-link" href="#preco">Preço</a></li>
                <li class="nav-item"><a class="nav-link btn btn-primary text-white" href="<?= BASE_URL ?>auth/signup">Teste por 7 dias grátis</a></li>
            </ul>
        </div>
    </nav>

    <section class="container text-center my-5">
        <div class="d-md-flex">
            <h2 class="font-weight-bold mr-3" style="font-size: 36px;">Seu filho aprendendo inglês</h2>
            <h2 id="dynamic-title" class="font-weight-bold text-primary" style="font-size: 36px;">NATURALMENTE</h2>
        </div>
        <a href="<?= BASE_URL ?>auth/signup" class="btn btn-primary btn-lg my-3">Teste por 7 dias grátis</a>
        <p><a href="<?= BASE_URL ?>auth/login" class="text-primary">Faça o login</a></p>
        <div class="embed-responsive embed-responsive-16by9 mt-3">
            <video class="embed-responsive-item" controls poster="<?= BASE_URL ?>assets/images/thumbnail.png">
                <source src="<?= BASE_URL ?>assets/videos/hero.mp4" type="video/mp4">
                Seu navegador não suporta vídeos.
            </video>
        </div>

        <h3 class="mt-4">Aprendizado sem esforço, diversão garantida!</h3>
        <p class="lead">Com o Dulang Web, seu filho aprende inglês naturalmente, com vídeos educativos selecionados que garantem imersão real no idioma.</p>
    </section>

    <header class="bg-primary text-white text-center py-5">
        <h1>Dulang Web</h1>
        <p>Aprendizado natural e divertido de inglês para crianças</p>
        <a href="<?= BASE_URL ?>auth/signup" class="btn btn-light btn-lg">Teste por 7 dias grátis</a>
    </header>

    <section class="container my-5" id="por-que-o-dulang">
        <h2 class="text-center font-weight-bold">Por que escolher o Dulang Web?</h2>
        <p class="text-center text-success font-weight-bold">Aprendizado eficiente, economia inteligente e um futuro promissor para seu filho!</p>

        <div class="row text-center">
            <div class="col-md-4">
                <i class="fas fa-piggy-bank fa-3x text-primary"></i>
                <h3>Mais Econômico</h3>
                <p>Aprenda inglês pagando menos! Muito mais acessível do que cursos tradicionais, economize milhares de reais ao longo dos anos.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-rocket fa-3x text-primary"></i>
                <h3>Oportunidades no Futuro</h3>
                <p>O contato precoce com o inglês abre portas acadêmicas e profissionais, preparando seu filho para um mundo globalizado.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-brain fa-3x text-primary"></i>
                <h3>Desenvolvimento Cognitivo</h3>
                <p>Aprender um novo idioma estimula o cérebro, melhora o foco e amplia a capacidade de resolver problemas.</p>
            </div>
        </div>

        <div class="row text-center mt-4">
            <div class="col-md-4">
                <i class="fas fa-play-circle fa-3x text-primary"></i>
                <h3>Aprendizado Natural</h3>
                <p>Seu filho aprende inglês como uma criança nativa, absorvendo o idioma de forma espontânea e sem esforço.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-graduation-cap fa-3x text-primary"></i>
                <h3>Fluência Sem Estresse</h3>
                <p>Com a imersão desde cedo, falar inglês se torna algo natural, sem precisar de anos de cursos formais.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-smile-beam fa-3x text-primary"></i>
                <h3>Aprender Brincando</h3>
                <p>Transforme o aprendizado em um hábito divertido! Vídeos educativos mantêm as crianças engajadas e entretidas.</p>
            </div>
        </div>
    </section>


    <section class="bg-light py-5" id="como-funciona">
        <div class="container text-center">
            <h2 class="font-weight-bold">Como Funciona?</h2>
            <p class="text-success font-weight-bold">Seu filho aprende inglês de forma natural e divertida!</p>

            <div class="row text-center">
                <div class="col-md-4">
                    <i class="fas fa-video fa-3x text-primary"></i>
                    <h3>Seleção Cuidadosa</h3>
                    <p>Vídeos educativos e imersivos, como os que crianças nativas assistem, garantindo aprendizado intuitivo.</p>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-clock fa-3x text-primary"></i>
                    <h3>Tempo de Qualidade</h3>
                    <p>Aprender inglês sem esforço! Seu filho aprende no próprio ritmo, sem estresse ou pressão.</p>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-chart-line fa-3x text-primary"></i>
                    <h3>Monitoramento Fácil</h3>
                    <p>Acompanhe o progresso do seu filho com um histórico dos vídeos assistidos.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="container my-5" id="testemunhos">
        <h2 class="text-center font-weight-bold">O que os pais dizem?</h2>
        <p class="text-center text-success font-weight-bold">Milhares de crianças já estão aprendendo com o Dulang Web!</p>

        <div class="row text-center">
            <div class="col-md-4">
                <div class="card shadow-sm p-4">
                    <blockquote class="blockquote mb-0">
                        <p class="text-dark">"Meu filho aprendeu várias cores e números em inglês em poucos meses!"</p>
                        <footer class="blockquote-footer mt-2">Ana Souza</footer>
                    </blockquote>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm p-4">
                    <blockquote class="blockquote mb-0">
                        <p class="text-dark">"Ele começou a assistir e, em poucos meses, já reconhece várias palavras e frases!"</p>
                        <footer class="blockquote-footer mt-2">Felipe Andrade</footer>
                    </blockquote>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm p-4">
                    <blockquote class="blockquote mb-0">
                        <p class="text-dark">"Minha filha canta músicas infantis em inglês sem precisar de ajuda!"</p>
                        <footer class="blockquote-footer mt-2">Bruno Costa</footer>
                    </blockquote>
                </div>
            </div>
        </div>

        <div class="row text-center mt-4">
            <div class="col-md-4">
                <div class="card shadow-sm p-4">
                    <blockquote class="blockquote mb-0">
                        <p class="text-dark">"Fiquei impressionada! Em poucos meses, minha filha aprendeu o alfabeto em inglês!"</p>
                        <footer class="blockquote-footer mt-2">Vanessa Martins</footer>
                    </blockquote>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm p-4">
                    <blockquote class="blockquote mb-0">
                        <p class="text-dark">"Sem perceber, ele já entende várias palavras e responde algumas frases básicas!"</p>
                        <footer class="blockquote-footer mt-2">Camila Oliveira</footer>
                    </blockquote>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm p-4">
                    <blockquote class="blockquote mb-0">
                        <p class="text-dark">"Em poucos meses, meu filho começou a falar nomes de animais e objetos em inglês!"</p>
                        <footer class="blockquote-footer mt-2">Daniela Lopes</footer>
                    </blockquote>
                </div>
            </div>
        </div>

        <div class="row text-center mt-4">
            <div class="col-md-4">
                <div class="card shadow-sm p-4">
                    <blockquote class="blockquote mb-0">
                        <p class="text-dark">"Depois de algumas semanas, já repetia várias expressões do dia a dia em inglês!"</p>
                        <footer class="blockquote-footer mt-2">Ricardo Silva</footer>
                    </blockquote>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm p-4">
                    <blockquote class="blockquote mb-0">
                        <p class="text-dark">"Não acreditei quando minha filha começou a falar os dias da semana em inglês espontaneamente!"</p>
                        <footer class="blockquote-footer mt-2">Juliana Costa</footer>
                    </blockquote>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm p-4">
                    <blockquote class="blockquote mb-0">
                        <p class="text-dark">"Testamos por curiosidade, mas ficamos surpresos! Ele já reconhece várias palavras e números!"</p>
                        <footer class="blockquote-footer mt-2">Thiago Moreira</footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </section> -->


    <section class="container my-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="font-weight-bold">Uma Experiência Real, Um Propósito Verdadeiro</h2>
                <p class="text-muted">
                    Como pai, sempre quis oferecer ao meu filho a melhor educação possível. Mesmo vivendo no Brasil, cercado pelo português, percebi que ele poderia aprender inglês de forma natural e espontânea.
                    <br><br>
                    Ele começou a assistir vídeos em inglês e, sem esforço, aprendeu as letras do alfabeto, números, formas geométricas e até frases completas! Isso me inspirou a criar o **Dulang Web**, uma plataforma segura e eficaz para ajudar outros pais a proporcionar essa experiência incrível aos seus filhos.
                    <br><br>
                    O aprendizado acontece naturalmente, sem pressão, no ritmo da criança. Agora, quero compartilhar isso com você!
                </p>
            </div>
            <div class="col-md-6 text-center">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/M6qSmI2vhNA" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>



    <section class="container my-5 text-center" id="preco">
        <h2 class="font-weight-bold">Plano Dulang Web</h2>
        <p class="text-success font-weight-bold">Economize com pagamento anual!</p>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4">
                    <h3 class="text-primary font-weight-bold">R$ 19,90/mês</h3>
                    <p class="text-muted">Cobrado anualmente R$ 199,00/ano</p>
                    <p class="text-success font-weight-bold">Economize 2 meses!</p>

                    <div class="d-flex justify-content-center">
                        <ul class="list-unstyled my-3 text-left">
                            <li><i class="fas fa-check-circle text-success"></i> Teste por 7 dias grátis</li>
                            <li><i class="fas fa-check-circle text-success"></i> Acesso ilimitado a vídeos educativos</li>
                            <li><i class="fas fa-check-circle text-success"></i> Conteúdo 100% seguro para crianças</li>
                            <li><i class="fas fa-check-circle text-success"></i> Aprendizado natural e divertido</li>
                            <li><i class="fas fa-check-circle text-success"></i> Funciona em qualquer dispositivo</li>
                            <li><i class="fas fa-check-circle text-success"></i> Sem anúncios</li>
                        </ul>
                    </div>

                    <a href="<?= BASE_URL ?>auth/signup" class="btn btn-primary btn-lg">Teste por 7 dias grátis</a>
                    <p class="mt-3 text-muted">Cancelamento fácil a qualquer momento.</p>
                </div>
            </div>
        </div>
    </section>


    <section id="plano" class="bg-primary text-white text-center py-5">
        <h2>Assine Agora</h2>
        <p class="lead">Garanta acesso ilimitado ao Dulang Web!</p>
        <a href="<?= BASE_URL ?>auth/signup" class="btn btn-light btn-lg">Teste por 7 dias grátis</a>
    </section>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2025 Dulang. Todos os direitos reservados.</p>
        <p><i class="fas fa-envelope"></i> contato@carlosdev.com.br</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const titles = [
            "brincando",
            "se divertindo",
            "com imersão",
            "sem esforço",
            "naturalmente",
        ];
        let index = 0;
        setInterval(() => {
            document.getElementById("dynamic-title").innerText = titles[index].toLocaleUpperCase();
            index = (index + 1) % titles.length;
        }, 2000);
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener("click", function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute("href"));
                    if (target) {
                        window.scrollTo({
                            top: target.offsetTop - 50, // Ajuste para evitar sobreposição com menus fixos
                            behavior: "smooth"
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>
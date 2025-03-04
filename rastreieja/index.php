<!DOCTYPE html>
<html lang="pt-BR">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>RastreiaJá</title>

    <!-- Bootstrap  -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/jpg" href="assets/images/favicon_certa1.png">

    <!--  CSS  -->
    <link rel="stylesheet" href="assets/css/index.css">

  </head>

<body>


  <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <!-- ***** Logo Start ***** -->
                      <a href="index.php" class="logo">
                          <img src="assets/images/arte.png">
                      </a>    
                      <a class='menu-trigger'>
                          <span>Menu</span>
                      </a>
                  </nav>
              </div>
          </div>
      </div>
  </header>

  <section class="main-banner" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="header-text">
            <h6>Bem-Vindo ao RastreiaJá</h6>
            <h2>Rastreie suas Encomendas Rápido e <em>Fácil!</em></h2>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="right-image">
            <img src="assets/images/poster1.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <section class="simple-cta">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 offset-lg-1">
          <div class="left-image">
            <img src="assets/images/encomendas.png" alt="">
          </div>
        </div>
        <div class="col-lg-5 align-self-center">
          <!-- FORMULARIO -->
          <?php
          $usuario = "carloscamisa88@gmail.com"; 
          $token = "e5f1e8d53a803d8cedcb631ce1b66d088d1b4078060e881fc0eef5df2f7ae7a1";
          
          if ($_SERVER["REQUEST_METHOD"] === "POST") {
              $codigo_rastreio = $_POST["codigo_rastreio"] ?? '';
          
              if (!empty($codigo_rastreio)) {
                  $url = "https://api.linketrack.com/track/json?user=$usuario&token=$token&codigo=$codigo_rastreio";
          
                  $ch = curl_init($url);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  $response = curl_exec($ch);
                  $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                  curl_close($ch);
          
                  $rastreio_data = json_decode($response, true);
          
                  if ($http_code == 200) {
                      $eventos = $rastreio_data["eventos"] ?? [];
                  } else {
                      $erro = "Erro ao rastrear: " . ($rastreio_data["erro"] ?? "Nenhuma informação encontrada.");
                      $eventos = [];
                  }
              } else {
                  $erro = "Por favor, insira um código de rastreamento.";
              }
          }
          ?>
          <!-- FIM DO FORMULARIO -->

          <!DOCTYPE html>
          <html lang="pt-br">
          <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Rastreio de Encomendas</title>
          </head>
          <body>
              <h1>Rastreio de Encomendas</h1><br><br>
          
              <form method="POST">
                  <label for="codigo_rastreio">Código de Rastreamento:</label> 
                  <input type="text" id="codigo_rastreio" name="codigo_rastreio" required>
                  <button type="submit">Rastrear</button>
              </form>
          
              <?php
              if (!empty($erro)) {
                  echo "<p style='color: red;'>$erro</p>";
              }
          
              if (!empty($rastreio_data)) {
                  echo "<h2>Informações Gerais</h2>";
                  echo "<p><strong>Serviço:</strong> " . ($rastreio_data["servico"] ?? "Não informado") . "</p>";
                  echo "<p><strong>Código de Rastreio:</strong> " . ($rastreio_data["codigo"] ?? "Não informado") . "</p>";
                  echo "<p><strong>Quantidade de Eventos:</strong> " . ($rastreio_data["quantidade"] ?? "0") . "</p>";
                  echo "<p><strong>Servidor da API:</strong> " . ($rastreio_data["host"] ?? "Desconhecido") . "</p>";
          
                  if (!empty($eventos)) {
                      echo "<h2>Status do Rastreio</h2><ul>";
                      foreach ($eventos as $evento) {
                          $descricao = $evento['status'] ?? 'Sem status';
                          $data = $evento['data'] ?? 'Data não informada';
                          $local = $evento['local'] ?? 'Local desconhecido';
          
                          echo "<li>$descricao - $data ($local)</li>";
                      }
                      echo "</ul>";
                  }
              }
              ?>
          </body>
          </html>
          
        </div>
      </div>
    </div>
  </section>

  <section class="contact-us" id="contact-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div id="map">
          
            <!-- You just need to go to Google Maps for your own map point, and copy the embed code from Share -> Embed a map section -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14623.907743423115!2d-46.9131087!3d-23.6051601!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cf00a8be03c375%3A0xea5ee74a29d9b1a2!2sEtec%20de%20Cotia!5e0!3m2!1spt-BR!2sbr!4v1741065441140!5m2!1spt-BR!2sbr" width="100%" height="420px" frameborder="0" style="border:0; border-radius: 15px; position: relative; z-index: 2;" allowfullscreen=""></iframe>
            <div class="row">
              <div class="col-lg-4 offset-lg-1">
                <div class="contact-info">
                  <div class="icon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <h4>Telefone</h4>
                  <span>(11) 4614-3093</span>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
              <div class="col-lg-12">
              </div>
              <div class="col-lg-12">
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-12">
        </div>
        <div class="col-lg-12">
          <p class="copyright">Copyright © 2025 RastreiaJá. All Rights Reserved. 
        
        </div>
      </div>
    </div>
  </section>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function (e) {
          e.preventDefault();
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>
</body>

</html>
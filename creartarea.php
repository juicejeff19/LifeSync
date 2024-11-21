<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
    exit();
}

include_once 'conexion.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT idusuarios FROM usuarios WHERE nombre = :nombre";
$stmt = $db->prepare($query);
$stmt->bindParam(':nombre', $_SESSION['nombre']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$idusuario = $user['idusuarios'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars(strip_tags($_POST['nombre']));
    $duracion = htmlspecialchars(strip_tags($_POST['duracion']));
    $tipo = htmlspecialchars(strip_tags($_POST['tipo']));
    $limite = htmlspecialchars(strip_tags($_POST['limite']));

    $query = "INSERT INTO tarea (nombre, duracion, tipo, completado, limite, idusuario) VALUES (:nombre, :duracion, :tipo, '0', :limite, :idusuario)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':duracion', $duracion);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':limite', $limite);
    $stmt->bindParam(':idusuario', $idusuario);

    if ($stmt->execute()) {
        echo "Task created successfully.";
    } else {
        echo "Failed to create task.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Crear Tarea - QuickStart Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index_li.php" class="logo d-flex align-items-center me-auto">
        <img src="assets/img/logo.png" alt="">
        <h1 class="sitename">LifeSync</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index_li.php#hero" class="active">Inicio</a></li>
          <li><a href="index_li.php#services">Servicios</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn-getstarted" href="logout.php">Cerrar Sesión</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="hero-bg">
        <img src="assets/img/hero-bg-light.webp" alt="">
      </div>
      <div class="container text-center">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <h1 data-aos="fade-up">Bienvenido a <span>LifeSync</span>, <?php echo htmlspecialchars($_SESSION['nombre']); ?>!</h1>
          <p data-aos="fade-up" data-aos-delay="100">Organiza tus horarios de la mejor manera<br></p>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="#crear-tarea" class="btn-get-started">Crear Tarea</a>
          </div>
        </div>
      </div>
    </section><!-- /Hero Section -->

    <!-- Crear Tarea Section -->
    <section id="crear-tarea" class="crear-tarea section">
      <div class="container">
        <h2 class="text-center">Crear Nueva Tarea</h2>
        <form action="creartarea.php" method="post">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" id="nombre" required>
          </div>
          <div class="form-group">
            <label for="duracion">Duración (minutos)</label>
            <input type="number" name="duracion" class="form-control" id="duracion" required>
          </div>
          <div class="form-group">
            <label for="tipo">Tipo</label>
            <input type="text" name="tipo" class="form-control" id="tipo" required>
          </div>
          <div class="form-group">
            <label for="limite">Límite (fecha)</label>
            <input type="text" name="limite" class="form-control" id="limite" required>
          </div>
          <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
          <div class="form-group text-center">
            <button type="submit" class="btn btn-primary custom-btn">Crear Tarea</button>
          </div>
        </form>
      </div>
    </section><!-- /Crear Tarea Section -->

  </main>

  <footer id="footer" class="footer position-relative light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">LifeSync</span>
          </a>
          <div class="footer-contact pt-3">
            <p>ESCOM</p>
            <p>INSTITUTO POLITÉCNICO NACIONAL</p>
            <p class="mt-3"><strong>Phone:</strong> <span>55 6987 6390</span></p>
            <p><strong>Email:</strong> <span>lifesynco@gmail.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Links Útiles</h4>
          <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Acerca de</a></li>
            <li><a href="#">Servicios</a></li>
            <li><a href="#">Terminos y condiciones</a></li>
            <li><a href="#">Politica de privacidad</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Nuestra misión</h4>
          Proveer a nuestros usuarios de una herramienta que les permita organizar sus actividades diarias de manera eficiente.
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Nuestros avisos</h4>
          <p>Suscribete a nuestros avisos para obetener noticias de LifeSync</p>
          <form action="forms/newsletter.php" method="post" class="php-email-form">
            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
          </form>
        </div>

      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
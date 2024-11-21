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
    if (isset($_POST['completar_tarea'])) {
        $idtarea = htmlspecialchars(strip_tags($_POST['idtarea']));
        $query = "UPDATE tarea SET completado = 1 WHERE idtarea = :idtarea AND idusuario = :idusuario";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':idtarea', $idtarea);
        $stmt->bindParam(':idusuario', $idusuario);
        $stmt->execute();
    } elseif (isset($_POST['eliminar_tarea'])) {
        $idtarea = htmlspecialchars(strip_tags($_POST['idtarea']));
        $query = "DELETE FROM tarea WHERE idtarea = :idtarea AND idusuario = :idusuario";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':idtarea', $idtarea);
        $stmt->bindParam(':idusuario', $idusuario);
        $stmt->execute();
    }
}

$query = "SELECT * FROM tarea WHERE idusuario = :idusuario";
$stmt = $db->prepare($query);
$stmt->bindParam(':idusuario', $idusuario);
$stmt->execute();
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Mis Tareas - QuickStart Bootstrap Template</title>
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

  <style>
    .listar-tareas {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 50px 0;
    }
    .listar-tareas .container {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    .listar-tareas h2 {
      margin-bottom: 30px;
      font-size: 24px;
      font-weight: 700;
      color: #333;
    }
    .listar-tareas table {
      width: 100%;
      border-collapse: collapse;
    }
    .listar-tareas th, .listar-tareas td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    .listar-tareas th {
      background-color: #f8f9fa;
      font-weight: 600;
    }
    .listar-tareas tr:hover {
      background-color: #f1f1f1;
    }
    .listar-tareas .btn-completar, .listar-tareas .btn-eliminar {
      background-color: #28a745;
      color: #fff;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
      border-radius: 5px;
    }
    .listar-tareas .btn-completar:hover, .listar-tareas .btn-eliminar:hover {
      background-color: #218838;
    }
    .listar-tareas .btn-eliminar {
      background-color: #dc3545;
    }
    .listar-tareas .btn-eliminar:hover {
      background-color: #c82333;
    }
    .btn-crear-tarea {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 5px;
      margin-top: 20px;
    }
    .btn-crear-tarea:hover {
      background-color: #0056b3;
    }
  </style>
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
          <li><a href="index.html#hero" class="active">Inicio</a></li>
          <li><a href="index.html#about">Acerca de</a></li>
          <li><a href="index.html#features">Productos</a></li>
          <li><a href="index.html#services">Servicios</a></li>
          <li><a href="index.html#pricing">Paquetes</a></li>
          <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li>
          <li><a href="index.html#contact">Contacto</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn-getstarted" href="logout.php">Cerrar Sesión</a>

    </div>
  </header>

  <main class="main">

    <!-- Listar Tareas Section -->
    <section id="listar-tareas" class="listar-tareas section">
      <div class="container">
        <h2 class="text-center">Mis Tareas</h2>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Duración (minutos)</th>
              <th>Tipo</th>
              <th>Límite</th>
              <th>Completado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($tareas as $tarea): ?>
              <tr>
                <td><?php echo htmlspecialchars($tarea['nombre']); ?></td>
                <td><?php echo htmlspecialchars($tarea['duracion']); ?></td>
                <td><?php echo htmlspecialchars($tarea['tipo']); ?></td>
                <td><?php echo htmlspecialchars($tarea['limite']); ?></td>
                <td><?php echo $tarea['completado'] ? 'Sí' : 'No'; ?></td>
                <td>
                  <?php if (!$tarea['completado']): ?>
                    <form action="tareas.php" method="post" style="display:inline;">
                      <input type="hidden" name="idtarea" value="<?php echo $tarea['idtarea']; ?>">
                      <button type="submit" name="completar_tarea" class="btn-completar">Marcar como completado</button>
                    </form>
                  <?php else: ?>
                    <form action="tareas.php" method="post" style="display:inline;">
                      <input type="hidden" name="idtarea" value="<?php echo $tarea['idtarea']; ?>">
                      <button type="submit" name="eliminar_tarea" class="btn-eliminar">Eliminar</button>
                    </form>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div class="text-center">
          <a href="creartarea.php" class="btn-crear-tarea">Crear Tarea</a>
        </div>
      </div>
    </section><!-- /Listar Tareas Section -->

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
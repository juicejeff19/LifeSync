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

$query = "SELECT duracion, tipo, completado FROM tarea WHERE idusuario = :idusuario";
$stmt = $db->prepare($query);
$stmt->bindParam(':idusuario', $idusuario);
$stmt->execute();
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_minutes = 24 * 60;
$sleep_minutes = 8 * 60;
$task_minutes = 0;
$category_minutes = [];
$completed_tasks = 0;
$total_tasks = count($tareas);

foreach ($tareas as $tarea) {
    $task_minutes += $tarea['duracion'];
    if (!isset($category_minutes[$tarea['tipo']])) {
        $category_minutes[$tarea['tipo']] = 0;
    }
    $category_minutes[$tarea['tipo']] += $tarea['duracion'];
    if ($tarea['completado']) {
        $completed_tasks++;
    }
}

$other_minutes = $total_minutes - $sleep_minutes - $task_minutes;
$completed_percentage = $total_tasks > 0 ? ($completed_tasks / $total_tasks) * 100 : 0;
$average_task_time = $total_tasks > 0 ? $task_minutes / $total_tasks : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Distribución de Tiempo - QuickStart Bootstrap Template</title>
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
    .distribucion {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 50px 0;
    }
    .distribucion .container {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    .distribucion h2 {
      margin-bottom: 30px;
      font-size: 24px;
      font-weight: 700;
      color: #333;
    }
    .distribucion .chart-container,
    .distribucion .bar-chart-container,
    .distribucion .category-chart-container {
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto;
    }
    .distribucion .chart-container canvas,
    .distribucion .bar-chart-container canvas,
    .distribucion .category-chart-container canvas {
      max-width: 400px;
      max-height: 400px;
    }
    .distribucion .percentage-container {
      margin-top: 30px;
      text-align: center;
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
          <li><a href="index_li.php#hero" class="active">Inicio</a></li>
          <li><a href="index_li.php#services">Servicios</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn-getstarted" href="logout.php">Cerrar Sesión</a>

    </div>
  </header>

  <main class="main">

    <!-- Distribución Section -->
    <section id="distribucion" class="distribucion section">
      <div class="container">
        <h2 class="text-center">Distribución de Tiempo</h2>
        <div class="chart-container">
          <canvas id="timeDistributionChart"></canvas>
        </div>
        <div class="percentage-container">
          <h3>Porcentaje de Tareas Completadas</h3>
          <p><?php echo number_format($completed_percentage, 2); ?>%</p>
        </div>
        <div class="bar-chart-container">
          <canvas id="completedTasksChart"></canvas>
        </div>
        <div class="percentage-container">
          <h3>Distribución por Categoría</h3>
        </div>
        <div class="category-chart-container">
          <canvas id="categoryDistributionChart"></canvas>
        </div>
        <div class="percentage-container">
          <h3>Tiempo Promedio por Tarea</h3>
          <p><?php echo number_format($average_task_time, 2); ?> minutos</p>
        </div>
      </div>
    </section><!-- /Distribución Section -->

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

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const ctx = document.getElementById('timeDistributionChart').getContext('2d');
      const data = {
        labels: ['Sueño', 'Tareas', 'Libre'],
        datasets: [{
          label: 'Distribución de Tiempo',
          data: [
            <?php echo $sleep_minutes; ?>,
            <?php echo $task_minutes; ?>,
            <?php echo $other_minutes; ?>
          ],
          backgroundColor: ['#007bff', '#28a745', '#dc3545'],
          hoverOffset: 4
        }]
      };

      const config = {
        type: 'doughnut',
        data: data,
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            },
            tooltip: {
              callbacks: {
                label: function (context) {
                  const label = context.label || '';
                  const value = context.raw || 0;
                  const total = context.dataset.data.reduce((a, b) => a + b, 0);
                  const percentage = ((value / total) * 100).toFixed(2);
                  return `${label}: ${percentage}% (${value} minutos)`;
                }
              }
            }
          }
        }
      };

      new Chart(ctx, config);

      const ctxBar = document.getElementById('completedTasksChart').getContext('2d');
      const dataBar = {
        labels: ['Completadas', 'Pendientes'],
        datasets: [{
          label: 'Porcentaje de Tareas',
          data: [
            <?php echo $completed_percentage; ?>,
            <?php echo 100 - $completed_percentage; ?>
          ],
          backgroundColor: ['#28a745', '#dc3545'],
          hoverOffset: 4
        }]
      };

      const configBar = {
        type: 'bar',
        data: dataBar,
        options: {
          responsive: true,
          plugins: {
            legend: {
              display: false,
            },
            tooltip: {
              callbacks: {
                label: function (context) {
                  const label = context.label || '';
                  const value = context.raw || 0;
                  return `${label}: ${value.toFixed(2)}%`;
                }
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              max: 100,
              ticks: {
                callback: function (value) {
                  return value + '%';
                }
              }
            }
          }
        }
      };

      new Chart(ctxBar, configBar);

      const ctxCategory = document.getElementById('categoryDistributionChart').getContext('2d');
      const dataCategory = {
        labels: <?php echo json_encode(array_keys($category_minutes)); ?>,
        datasets: [{
          label: 'Distribución por Categoría',
          data: <?php echo json_encode(array_values($category_minutes)); ?>,
          backgroundColor: ['#007bff', '#28a745', '#dc3545', '#ffc107', '#17a2b8', '#6f42c1', '#fd7e14'],
          hoverOffset: 4
        }]
      };

      const configCategory = {
        type: 'pie',
        data: dataCategory,
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            },
            tooltip: {
              callbacks: {
                label: function (context) {
                  const label = context.label || '';
                  const value = context.raw || 0;
                  const total = context.dataset.data.reduce((a, b) => a + b, 0);
                  const percentage = ((value / total) * 100).toFixed(2);
                  return `${label}: ${percentage}% (${value} minutos)`;
                }
              }
            }
          }
        }
      };

      new Chart(ctxCategory, configCategory);
    });
  </script>

</body>

</html>
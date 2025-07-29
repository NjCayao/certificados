<!DOCTYPE html>
<html lang="es" class="pos-relative">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Consulta de Certificados</title>

  <!-- vendor css -->
  <link href="../../public/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="../../public/lib/Ionicons/css/ionicons.css" rel="stylesheet">

  <link href="../../public/lib/datatables/jquery.dataTables.css" rel="stylesheet">
  <link href="../../public/datatables/buttons.dataTables.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/consulta.css">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
  <!-- Header Section -->
  <header class="site-header">
    <div class="header-container">
      <div class="site-branding">
        <a href="#">
          <img src="../../public/logo.png" alt="BIMDEC Logo" style=" width: 150px">
        </a>
      </div>

      <nav class="main-navigation">
        <ul>
          <li><a href="https://bimdec.pe/">Inicio</a></li>
          <li><a href="https://facebook.com/bimdec.pe" target="_blank">Comunidad</a></li>
        </ul>
      </nav>

      <div class="contact-info">
        <i class="fa fa-phone"></i>
        <span>+51 925 432 672</span>
      </div>
    </div>
  </header>

  <!-- Main Content Area -->
  <main class="main-content">
    <div class="container">
      <!-- Hero Banner with Welding Image -->
      <section class="hero-banner">
        <div class="hero-content">
          <h1>Certificados de Capacitación</h1>
          <p>Verifique sus certificados oficiales de soldadura y especialización técnica.</p>
          <br>
          <h5>CURSOS PRESENCIALES Y ONLINE EN VIVO</h5>
        </div>
      </section>

      <!-- Features Section -->
      <section class="features-section">
        <div class="features-container">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fa fa-certificate"></i>
            </div>
            <h3>Certificados Oficiales</h3>
            <p>Todos nuestros certificados cuentan con validez oficial y respaldo institucional.</p>
          </div>

          <div class="feature-card">
            <div class="feature-icon">
              <i class="fa fa-search"></i>
            </div>
            <h3>Verificación Rápida</h3>
            <p>Consulta y verifica tus certificados de manera fácil y rápida con tu número de DNI.</p>
          </div>

          <div class="feature-card">
            <div class="feature-icon">
              <i class="fa fa-download"></i>
            </div>
            <h3>Descarga Inmediata</h3>
            <p>Descarga tus certificados en formato digital para presentarlos donde necesites.</p>
          </div>
        </div>
      </section>

      <!-- Search Section -->
      <section class="search-container">
        <div class="section-title">
          <h2>Consulta de Certificados</h2>
          <p>Ingrese su número de DNI para verificar sus certificados</p>
        </div>

        <div class="search-box">
          <input type="text" id="usu_dni" class="search-input" placeholder="Ingrese su DNI...">
          <button id="btnconsultar" class="search-btn">
            <i class="fa fa-search"></i> Buscar
          </button>
        </div>

        <div class="loader" id="loader">
          <i class="fa fa-spinner"></i>
          <p>Buscando certificados...</p>
        </div>
      </section>

      <!-- Regular Certificates Panel -->
      <section class="certificate-panel" id="divpanel">
        <div class="panel-header">
          <h2 id="lbldatos">Listado de Cursos</h2>
        </div>

        <p class="panel-description">Aquí podrá visualizar sus Certificados de Cursos Regulares</p>

        <div class="responsive-table">
          <table id="cursos_data" class="certificate-table">
            <thead>
              <tr>
                <th style="width: 35%">Curso</th>
                <th style="width: 15%">Fecha Inicio</th>
                <th style="width: 15%">Fecha Fin</th>
                <th style="width: 25%">Estado</th>
                <th style="width: 10%">Certificado</th>
              </tr>
            </thead>
            <tbody>
              <!-- Datos dinámicos -->
            </tbody>
          </table>
        </div>
      </section>

      <!-- Special Certificates Panel -->
      <section class="certificate-panel" id="divpanelespecial">
        <div class="panel-header">
          <h2>CAPACITACIÓN Y CALIFICACIÓN DE SOLDADORES</h2>
        </div>

        <p class="panel-description">Aquí podrá visualizar su homologación</p>

        <div class="responsive-table">
          <table id="certificados_especiales_data" class="certificate-table">
            <thead>
              <tr>
                <th>Homologación</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Certificado</th>
              </tr>
            </thead>
            <tbody>
              <!-- Datos dinámicos -->
            </tbody>
          </table>
        </div>
      </section>
    </div>
  </main>

  <!-- Footer -->
  <footer class="site-footer">
    <div class="container">
      <div class="footer-content">
        <div class="footer-section">
          <h3>BIMDEC</h3>
          <p>Somos una institución especializada en capacitación y certificación técnica en soldadura y otros procesos industriales.</p>
        </div>

        <div class="footer-section">
          <h3>Enlaces Rápidos</h3>
          <ul class="footer-links">
            <li><a href="https://bimdec.pe/">Inicio</a></li>
            <li><a href="https://facebook.com/bimdec.pe" target="_blank">Comunidad</a></li>
          </ul>
        </div>

        <div class="footer-section">
          <h3>Contacto</h3>
          <div class="contact-info-footer">
            <i class="fa fa-map-marker"></i>
            <span>Lima, Perú</span>
          </div>
          <div class="contact-info-footer">
            <i class="fa fa-phone"></i>
            <span>+51 925 432 672</span>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <p>&copy; 2025 BIMDEC. Todos los derechos reservados.</p>
      </div>
    </div>
  </footer>

  <!-- WhatsApp Button -->
  <a href="https://wa.me/51925432672?text=Me%20gustaría%20obtener%20más%20información%20sobre%20los%20cursos." class="whatsapp-button" target="_blank">
    <i class="fa fa-whatsapp"></i>
  </a>

  <!-- Scripts -->
  <script src="../../public/lib/jquery/jquery.js"></script>
  <script src="../../public/lib/popper.js/popper.js"></script>
  <script src="../../public/lib/bootstrap/bootstrap.js"></script>
  <script src="../../public/lib/datatables/jquery.dataTables.js"></script>
  <script src="../../public/lib/datatables-responsive/dataTables.responsive.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Scripts separados para certificados -->
  <script src="cert_normal.js"></script>
  <script src="cert_especial.js"></script>
  <script src="consulta_main.js"></script>
</body>

</html>
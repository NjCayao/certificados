<div class="br-logo">
  <a href="../UsuHome/">
    <img src="../../public/logo.png" alt="BIMDEC Logo" style=" width: 150px">
  </a>
</div>



<div class="br-sideleft overflow-y-auto ps ps--theme_default" data-ps-id="a55c14e3-c302-c74f-01e7-e7901b6efa38">
  <label class="sidebar-label pd-x-15 mg-t-20">Menu</label>
  <div class="br-sideleft-menu">

    <a href="../UsuHome/" class="br-menu-link">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-home tx-22"></i>
        <span class="menu-item-label">Inicio</span>
      </div>
    </a>

    <?php
    if ($_SESSION["rol_id"] == 1) {
    ?>
      <a href="../UsuCurso/" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-22"></i>
          <span class="menu-item-label">Mis Cursos</span>
        </div>
      </a>
    <?php
    } else {
    ?>

      <a href="#" class="br-menu-link">
        <div class="br-menu-item">

          <i class="menu-item-icon icon ion-person-stalker tx-22"></i>
          <span class="menu-item-label">Usuarios</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->
      <ul class="br-menu-sub nav flex-column">
        <li class="nav-item"><a href="../AdminMntUsuario/" class="nav-link">Alumnos</a></li>
        <li class="nav-item"><a href="../AdminMntAdmin/" class="nav-link">Administrador</a></li>
      </ul>

      <a href="../AdminMntCurso/" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon icon fa fa-book tx-24"></i>
          <span class="menu-item-label">Curso</span>
        </div>
      </a>

      <a href="../AdminMntCategoria/" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon icon fa fa-bars tx-22"></i>
          <span class="menu-item-label">Categoria</span>
        </div>
      </a>

      <a href="../AdminMntInstructor/" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon icon fa fa-user tx-22"></i>
          <span class="menu-item-label">Instructores</span>
        </div>
      </a>


      <a href="../AdminDetalleCertificado/" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon icon fa fa-address-card tx-20"></i>
          <span class="menu-item-label">Detalle Certificado</span>
        </div>
      </a>

      <!-- Agregar aquí, justo antes del cierre de la sección de admin -->
      <a href="../AdminCertificadoEspecial/" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-certificate tx-20"></i>
          <span class="menu-item-label">Certificados Especiales</span>
        </div>
      </a>

    <?php
    }
    ?>


    <!-- <a href="../AdminDirector/" class="br-menu-link">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-gear-outline tx-20"></i>
        <span class="menu-item-label">Director Academico</span>
      </div>
    </a> -->


    <a href="../Consulta/" target="_blank" class="br-menu-link">
      <div class="br-menu-item">
        <i class="menu-item-icon icon fa fa-laptop tx-20"></i>
        <span class="menu-item-label">Consulta web</span>
      </div>
    </a>


    <a href="../UsuPerfil/" class="br-menu-link">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-gear-outline tx-20"></i>
        <span class="menu-item-label">Perfil</span>
      </div>
    </a>

    <a href="../html/Logout.php" class="br-menu-link">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-power tx-20"></i>
        <span class="menu-item-label">Cerrar Sesion</span>
      </div>
    </a>

  </div>
</div>
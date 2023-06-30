<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <div class="card my-4">
        <div class="card-header">
          <i class="fas fa-table me-1"></i>
          <? if ($this->session->userdata('usuario')->Rol == 'Admin') { ?>
            Prestamos
          <? } else { ?>
            Mis prestamos
          <? } ?>
        </div>
        <div class="card-body">
          <table id="datatablesSimple">
            <thead>
              <tr>
                <th>Usuario</th>
                <th>Libro</th>
                <th>Fecha de prestamo</th>
                <th>Fecha de devolucion</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Usuario</th>
                <th>Libro</th>
                <th>Fecha de prestamo</th>
                <th>Fecha de devolucion</th>
              </tr>
            </tfoot>
            <tbody>
              <? if ($prestamos != false) {
                foreach ($prestamos as $prestamo) { ?>
                  <tr>
                    <td><?= $prestamo->Usuario ?> </td>
                    <td><?= $prestamo->Libro ?> </td>
                    <td><?= $prestamo->FechaPrestamo ?> </td>
                    <td><?= $prestamo->FechaDevolucion ?> </td>
                  </tr>
              <? }
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</div>
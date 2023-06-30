<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <div class="card my-4">
        <div class="card-header">
          <i class="fas fa-table me-1"></i>
          <? if ($this->session->userdata('usuario')->Rol == 'Admin') { ?>
            Libros
          <? } else { ?>
            Libros disponibles
          <? } ?>
        </div>
        <div class="card-body">
          <? if ($this->session->userdata('usuario')->Rol == 'Admin') { ?>
            <a href="<?= base_url() ?>libros/agregar" class="btn btn-secondary mb-3">Agregar libro</a>
          <? } ?>
          <div id="errorLibro" role="alert" style="display: none;"></div>
          <table id="datatablesSimple">
            <thead>
              <tr>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Año</th>
                <? if ($this->session->userdata('usuario')->Rol == 'Admin') { ?>
                  <th></th>
                  <th></th>
                <? } else { ?>
                  <th></th>
                <? } ?>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Año</th>
                <? if ($this->session->userdata('usuario')->Rol == 'Admin') { ?>
                  <th></th>
                  <th></th>
                <? } else { ?>
                  <th></th>
                <? } ?>
              </tr>
            </tfoot>
            <tbody>
              <? if ($libros != false) {
                foreach ($libros as $libro) { ?>
                  <tr>
                    <td><?= $libro->Titulo ?> </td>
                    <td><?= $libro->Autor ?> </td>
                    <td><?= $libro->AnioPublicacion ?> </td>
                    <? if ($this->session->userdata('usuario')->Rol == 'Admin') { ?>
                      <td><a href="<?= base_url() ?>libros/editar/<?= $libro->ID ?>" class="btn btn-warning">Editar</a></td>
                      <td><button onclick="eliminar(<?= $libro->ID ?>)" class="btn btn-danger">Eliminar</button></td>
                    <? } else {
                      $texto = 'Solicitar';
                      $prestamo = true;
                      if (in_array($libro->ID, $prestamos)) {
                        $texto = 'Solictado';
                        $prestamo = false;
                      } ?>
                      <td><button <? if ($prestamo) { ?>onclick="solicitar(<?= $libro->ID ?>)" class="btn btn-success" <? } else { ?> class="btn btn-info" <? } ?>><?= $texto ?></button></td>
                    <? } ?>
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
<script>
  <? if ($this->session->userdata('usuario')->Rol == 'Admin') { ?>

    function eliminar(id) {
      if (confirm("¿Está seguro de eliminar este libro?")) {
        document.getElementById('errorLibro').removeAttribute('class');
        document.getElementById('errorLibro').setAttribute('class', 'alert alert-success');
        document.getElementById('errorLibro').innerHTML = 'Eliminando libro...';
        document.getElementById('errorLibro').style.display = '';
        //enviar los datos al controlador
        let data = new FormData();
        data.append('id', id);
        fetch('<?= base_url() ?>libros/eliminar', {
            method: 'POST',
            body: data
          })
          .then(res => res.json())
          .then(data => {
            if (data.status == 200) {
              document.getElementById('errorLibro').innerHTML = 'Libro eliminado correctamente';
              document.getElementById('errorLibro').style.display = '';
              setTimeout(() => {
                location.reload();
              }, 2000);
            } else {
              document.getElementById('errorLibro').removeAttribute('class');
              document.getElementById('errorLibro').setAttribute('class', 'alert alert-danger');
              document.getElementById('errorLibro').innerHTML = data.message;
              document.getElementById('errorLibro').style.display = '';
            }
          })
          .catch(err => {
            console.log(err);
          });
      }
      return false;
    }
  <? } else { ?>

    function solicitar(id) {
      if (confirm("¿Está seguro de solicitar este libro?")) {
        document.getElementById('errorLibro').removeAttribute('class');
        document.getElementById('errorLibro').setAttribute('class', 'alert alert-success');
        document.getElementById('errorLibro').innerHTML = 'Solicitando libro...';
        document.getElementById('errorLibro').style.display = '';
        //enviar los datos al controlador
        let data = new FormData();
        data.append('id', id);
        fetch('<?= base_url() ?>libros/solicitar', {
            method: 'POST',
            body: data
          })
          .then(res => res.json())
          .then(data => {
            if (data.status == 200) {
              document.getElementById('errorLibro').innerHTML = 'Libro solicitado correctamente';
              document.getElementById('errorLibro').style.display = '';
              setTimeout(() => {
                location.reload();
              }, 2000);
            } else {
              document.getElementById('errorLibro').removeAttribute('class');
              document.getElementById('errorLibro').setAttribute('class', 'alert alert-danger');
              document.getElementById('errorLibro').innerHTML = data.message;
              document.getElementById('errorLibro').style.display = '';
            }
          })
          .catch(err => {
            console.log(err);
          });
      }
      return false;
    }
  <? } ?>
</script>
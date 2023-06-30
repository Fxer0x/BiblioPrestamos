<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <div class="card my-4">
        <div class="card-header">
          <i class="fas fa-table me-1"></i>
          Editar libro
        </div>
        <div class="card-body">
          <form onsubmit="return editar()">
            <input type="hidden" id="id" value="<?= $libro->ID ?>">
            <div class="mb-3">
              <label for="titulo" class="form-label">Titulo</label>
              <input type="text" class="form-control" id="titulo" required value="<?= $libro->Titulo ?>">
            </div>
            <div class="mb-3">
              <label for="autor" class="form-label">Autor</label>
              <input type="text" class="form-control" id="autor" required value="<?= $libro->Autor ?>">
            </div>
            <div class="mb-3">
              <label for="anio" class="form-label">Año de publicación</label>
              <input type="number" class="form-control" id="anio" required value="<?= $libro->AnioPublicacion ?>">
            </div>
            <div id="errorLibro" role="alert" style="display: none;"></div>
            <button type="submit" class="btn btn-primary">Editar</button>
          </form>
        </div>
      </div>
    </div>
  </main>
</div>
<script>
  function editar() {
    let id = document.getElementById('id').value;
    let titulo = document.getElementById('titulo').value;
    let autor = document.getElementById('autor').value;
    let anio = document.getElementById('anio').value;
    if (titulo == '' || autor == '' || anio == '') {
      document.getElementById('errorLibro').removeAttribute('class');
      document.getElementById('errorLibro').setAttribute('class', 'alert alert-danger');
      document.getElementById('errorLibro').innerHTML = 'Todos los campos son obligatorios';
      document.getElementById('errorLibro').style.display = '';
    } else {
      if (isNaN(anio) || anio <= 0) {
        document.getElementById('errorLibro').removeAttribute('class');
        document.getElementById('errorLibro').setAttribute('class', 'alert alert-danger');
        document.getElementById('errorLibro').innerHTML = 'El año debe ser un número y mayor a 0';
        document.getElementById('errorLibro').style.display = '';
        return false;
      }
      document.getElementById('errorLibro').removeAttribute('class');
      document.getElementById('errorLibro').setAttribute('class', 'alert alert-success');
      document.getElementById('errorLibro').innerHTML = 'Guardando...';
      document.getElementById('errorLibro').style.display = '';
      //enviar los datos al controlador
      let data = new FormData();
      data.append('id', id);
      data.append('titulo', titulo);
      data.append('autor', autor);
      data.append('anio', anio);
      fetch('<?= base_url() ?>libros/cambiar', {
          method: 'POST',
          body: data
        })
        .then(res => res.json())
        .then(data => {
          if (data.status == 200) {
            document.getElementById('errorLibro').innerHTML = data.message;
            document.getElementById('errorLibro').style.display = '';
            setTimeout(() => {
              window.location.href = '<?= base_url() ?>libros';
            }, 1000);
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
</script>
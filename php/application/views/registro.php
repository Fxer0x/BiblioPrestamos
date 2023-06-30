<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Register - BiblioPrestamos</title>
  <link href="<?= BASE_URL ?>css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-7">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                  <h3 class="text-center font-weight-light my-4">Crear cuenta</h3>
                </div>
                <div class="card-body">
                  <form onsubmit="return registro()">
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                          <input class="form-control" id="nombre" type="text" placeholder="Nombre" />
                          <label for="nombre">Nombre</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating">
                          <input class="form-control" id="apellido" type="text" placeholder="Apellido" />
                          <label for="apellido">Apellido</label>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                          <input class="form-control" id="direccion" type="text" placeholder="Dirección" />
                          <label for="direccion">Dirección</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating">
                          <input class="form-control" id="telefono" type="text" placeholder="Teléfono" />
                          <label for="telefono">Teléfono</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" id="email" type="email" placeholder="name@example.com" />
                      <label for="email">Email</label>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                          <input class="form-control" id="pass" type="password" placeholder="Contraseña" />
                          <label for="pass">Contraseña</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                          <input class="form-control" id="passConf" type="password" placeholder="Confirmar contraseña" />
                          <label for="passConf">Confirmar contraseña</label>
                        </div>
                      </div>
                    </div>
                    <div id="errorRegistro" role="alert" style="display: none;"></div>
                    <div class="mt-4 mb-0">
                      <div class="d-grid"><button class="btn btn-primary btn-block" type="submit">Crear cuenta</button></div>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center py-3">
                  <div class="small"><a href="<?= base_url() ?>login">Ya tenes cuenta? Logueate</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="<?= BASE_URL ?>js/scripts.js"></script>
  <script>
    function registro() {
      let nombre = document.getElementById('nombre').value;
      let apellido = document.getElementById('apellido').value;
      let direccion = document.getElementById('direccion').value;
      let telefono = document.getElementById('telefono').value;
      let email = document.getElementById('email').value;
      let pass = document.getElementById('pass').value;
      let passConf = document.getElementById('passConf').value;
      if (nombre == '' || apellido == '' || direccion == '' || telefono == '' || email == '' || pass == '' || passConf == '') {
        document.getElementById('errorRegistro').removeAttribute('class');
        document.getElementById('errorRegistro').setAttribute('class', 'alert alert-danger');
        document.getElementById('errorRegistro').innerHTML = 'Todos los campos son obligatorios';
        document.getElementById('errorRegistro').style.display = '';
      } else {
        if (pass != passConf) {
          document.getElementById('errorRegistro').removeAttribute('class');
          document.getElementById('errorRegistro').setAttribute('class', 'alert alert-danger');
          document.getElementById('errorRegistro').innerHTML = 'Las contraseñas no coinciden';
          document.getElementById('errorRegistro').style.display = '';
        } else {
          //eliminar el alert danger y poner alert success
          document.getElementById('errorRegistro').removeAttribute('class');
          document.getElementById('errorRegistro').setAttribute('class', 'alert alert-success');
          document.getElementById('errorRegistro').innerHTML = 'Registrando...';
          document.getElementById('errorRegistro').style.display = '';
          //enviar los datos al controlador
          let data = new FormData();
          data.append('nombre', nombre);
          data.append('apellido', apellido);
          data.append('direccion', direccion);
          data.append('telefono', telefono);
          data.append('email', email);
          data.append('pass', pass);
          data.append('passConf', passConf);
          fetch('<?= base_url() ?>home/crear', {
              method: 'POST',
              body: data
            })
            .then(res => res.json())
            .then(data => {
              if (data.status == 200) {
                document.getElementById('errorRegistro').innerHTML = data.message;
                document.getElementById('errorRegistro').style.display = '';
                setTimeout(() => {
                  window.location.href = '<?= base_url() ?>';
                }, 2000);
              } else {
                document.getElementById('errorRegistro').removeAttribute('class');
                document.getElementById('errorRegistro').setAttribute('class', 'alert alert-danger');
                document.getElementById('errorRegistro').innerHTML = data.message;
                document.getElementById('errorRegistro').style.display = '';
              }
            })
            .catch(err => {
              console.log(err);
            });
        }
      }
      return false;
    }
  </script>

</body>

</html>
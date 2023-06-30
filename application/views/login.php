<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Login - BiblioPrestamos</title>
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                  <h3 class="text-center font-weight-light my-4">Login</h3>
                </div>
                <div class="card-body">
                  <form onsubmit="return login()">
                    <div class="form-floating mb-3">
                      <input class="form-control" id="emailLogin" type="email" placeholder="name@example.com" />
                      <label for="emailLogin">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input class="form-control" id="passLogin" type="password" placeholder="Password" />
                      <label for="passLogin">Password</label>
                    </div>
                    <div id="errorLogin" role="alert" style="display: none;"></div>
                    <div class="d-flex align-items-center justify-content-between mb-0">
                      <button class="btn btn-primary" type="submit">Ingresar</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center py-3">
                  <div class="small"><a href="<?= base_url() ?>registro">Necesitas cuenta? Crear cuenta!</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
  <script>
    function login() {
      let email = document.getElementById('emailLogin').value;
      let pass = document.getElementById('passLogin').value;
      if (email == '' || pass == '') {
        document.getElementById('errorLogin').removeAttribute('class');
        document.getElementById('errorLogin').setAttribute('class', 'alert alert-danger');
        document.getElementById('errorLogin').innerHTML = 'Todos los campos son obligatorios';
        document.getElementById('errorLogin').style.display = '';
      } else {
        //eliminar el alert danger y poner alert success
        document.getElementById('errorLogin').removeAttribute('class');
        document.getElementById('errorLogin').setAttribute('class', 'alert alert-success');
        document.getElementById('errorLogin').innerHTML = 'Iniciando sesión...';
        document.getElementById('errorLogin').style.display = '';
        //enviar los datos al controlador
        let data = new FormData();
        data.append('email', email);
        data.append('pass', pass);
        fetch('<?= base_url() ?>home/ingresar', {
            method: 'POST',
            body: data
          })
          .then(res => res.json())
          .then(data => {
            if (data.status == 200) {
              document.getElementById('errorLogin').innerHTML = data.message;
              document.getElementById('errorLogin').style.display = '';
              setTimeout(() => {
                window.location.href = '<?= base_url() ?>';
              }, 1000);
            } else {
              document.getElementById('errorLogin').removeAttribute('class');
              document.getElementById('errorLogin').setAttribute('class', 'alert alert-danger');
              document.getElementById('errorLogin').innerHTML = data.message;
              document.getElementById('errorLogin').style.display = '';
            }
          })
          .catch(err => {
            console.log(err);
          });
      }
      return false;
    }
  </script>

</body>

</html>